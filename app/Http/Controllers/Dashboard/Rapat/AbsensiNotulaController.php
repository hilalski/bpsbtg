<?php

namespace App\Http\Controllers\Dashboard\Rapat;

use App\Models\UserDosen;
use Carbon\Carbon;
use App\Models\Menu;
use App\Models\Rapat;
use Illuminate\Http\Request;
use App\Models\UserMahasiswa;
use App\Models\RapatPresensiDosen;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\RapatPresensiMahasiswa;


class AbsensiNotulaController extends Controller
{
    public function detail($rapatId)
    {
        $rapatDetail = Rapat::find($rapatId);
        if (!$rapatDetail) {
            abort(404, 'Rapat not found');
        }

        $presensiRapat = $rapatDetail->presensiRapat;
        $currentUserId = auth()->user()->id;
        $userMahasiswa = UserMahasiswa::where('user_id', $currentUserId)->first();

        $userPresensiRapat = RapatPresensiMahasiswa::where('mahasiswa_nim', $userMahasiswa->nim)
            ->with('rapat')
            ->get();

        $menu = Menu::with('submenu')->get();

        return view('dashboard.rapat.jadwal-rapat.detail', [
            'menu' => $menu,
            'rapatDetail' => $rapatDetail,
            'presensiRapat' => $presensiRapat,
            'userPresensiRapat' => $userPresensiRapat,
            'rapatId' => $rapatId,
        ]);
    }

    // Metode untuk menangani pengisian presensi
    public function submitPresensi(Request $request): \Illuminate\Http\RedirectResponse
    {
        $rapatId = $request->rapat_id;
        $kodePresensi = $request->kode_presensi;
        $kodeType1 = $request->kode_type1;
        $kodeType2 = $request->kode_type2;

        $rapat = Rapat::find($rapatId);
        if (!$rapat) {
            return back()->with('status.error', 'Rapat not found.');
        }

        $userId = Auth::id();
        $userMahasiswa = UserMahasiswa::where('user_id', $userId)->first();
        $userDosen = UserDosen::where('user_id', $userId)->first();

        $userType = $userMahasiswa ? 'mahasiswa' : ($userDosen ? 'dosen' : null);
        if (!$userType) {
            Log::info('User not found for user ID', ['userID' => $userId]);
            return view('dashboard.error', ['message' => 'User information not found']);
        }

        $userKey = $userType === 'mahasiswa' ? 'mahasiswa_nim' : 'dosen_nip';
        $userValue = $userType === 'mahasiswa' ? $userMahasiswa->nim : $userDosen->nip;

        $presensiModel = $userType === 'mahasiswa' ? RapatPresensiMahasiswa::class : RapatPresensiDosen::class;

        $presensi = $presensiModel::where('rapat_id', $rapatId)
            ->where($userKey, $userValue)
            ->first();

        if (!$presensi) {
            $presensi = new $presensiModel([
                'rapat_id' => $rapatId,
                $userKey => $userValue,
            ]);
        }

        // Logika untuk kode type satu
        if ($kodeType1 == 'kode_satu') {
            if ($presensi->waktu_kode_satu) {
                return back()->with('status.error', 'Waktu kehadiran sudah tercatat.');
            }
            if ($rapat->kode_satu == $kodePresensi) {
                $presensi->waktu_kode_satu = now();
                if ($userType === 'dosen') {
                    $presensi->persentase = 100; // Dosen selalu mendapat persentase 100%
                }
                $presensi->save();

                $message = $userType === 'mahasiswa' ? 'Waktu kehadiran recorded. Silakan isi kode dua.' : 'Waktu kehadiran recorded. Terima kasih.';
                return back()->with('status.success', $message);
            }
        }

        // Logika untuk kode type dua - hanya untuk mahasiswa
        if ($kodeType2 == 'kode_dua' && $userType === 'mahasiswa') {
            if ($presensi->persentase) {
                return back()->with('status.error', 'Presensi sudah tercatat.');
            }

            if ($rapat->kode_dua == $kodePresensi) {
                $presensi->waktu_kode_dua = now();
                $presensi->save();
                $waktuSekarang = Carbon::parse($presensi->waktu_kode_dua)->format('l, d F Y H:i:s');
                $meetingStartTime = Carbon::parse($rapat->waktu_mulai);

                $delayMinutes = $presensi->waktu_kode_dua->greaterThanOrEqualTo($meetingStartTime)
                    ? $presensi->waktu_kode_dua->diffInMinutes($meetingStartTime)
                    : 0;

                if ($delayMinutes <= 15) {
                    $presensi->persentase = 100;
                } elseif ($delayMinutes <= 30) {
                    $presensi->persentase = 90;
                } elseif ($delayMinutes <= 45) {
                    $presensi->persentase = 75;
                } elseif ($delayMinutes <= 60) {
                    $presensi->persentase = 50;
                } else {
                    $presensi->persentase = 0;
                }

                $presensi->save();
                return back()->with('status.success', 'Presensi completed. Terima kasih.')
                    ->with('waktuSekarang', $waktuSekarang);
            }
        }

        return back()->with('status.error', 'Invalid code.');
    }



    //Update Presensi Mahasiswa di Detail Rapat
        public function update(Request $request, $rapat_id, $mahasiswa_nim)
        {
            // Validate the request data
            $validatedData = $request->validate([
                'persentase' => 'required|numeric',
            ]);

            // Find the specific record using both rapat_id and mahasiswa_nim
            $presensiMahasiswa = RapatPresensiMahasiswa::where('rapat_id', $rapat_id)
                                                    ->where('mahasiswa_nim', $mahasiswa_nim)
                                                    ->first();
            // Update the persentase
            $presensiMahasiswa->persentase = $validatedData['persentase'];
            $presensiMahasiswa->save();

            if (!$presensiMahasiswa) {
                // Handle the case where the record is not found
                return redirect()->back()->with('status.error', 'Data kehadiran tidak ditemukan.');
            }

            // Redirect back with a success message
            return redirect()->back()->with('status.success', 'Persentase kehadiran berhasil diperbarui.');
        }

        //Update Presensi Dosen di Detail Rapat
        public function updatePresensiDosen(Request $request, $rapat_id, $dosen_nip)
        {
            // Validate the request data
            $validatedData = $request->validate([
                'persentase' => 'required|numeric',
            ]);

            // Find the specific record using both rapat_id and mahasiswa_nim
            $presensiDosen = RapatPresensiDosen::where('rapat_id', $rapat_id)
                                                    ->where('dosen_nip', $dosen_nip)
                                                    ->first();
            // Update the persentase
            $presensiDosen->persentase = $validatedData['persentase'];
            $presensiDosen->save();

            if (!$presensiDosen) {
                // Handle the case where the record is not found
                return redirect()->back()->with('status.error', 'Data kehadiran tidak ditemukan.');
            }

            return redirect()->back()->with('status.success', 'Persentase kehadiran Dosen berhasil diperbarui.');
        }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
