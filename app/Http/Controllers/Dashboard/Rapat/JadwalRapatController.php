<?php

namespace App\Http\Controllers\Dashboard\Rapat;

use Carbon\Carbon;
use App\Models\Menu;
use App\Models\Rapat;
use App\Models\UserDosen;
use App\Models\RapatJenis;
use Illuminate\Http\Request;
use App\Models\UserMahasiswa;
use App\Models\RapatPenyelenggara;
use App\Models\RapatPresensiDosen;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\RapatPresensiMahasiswa;
use App\Models\RapatPerizinanMahasiswa;
use Illuminate\Support\Facades\Storage;
use App\Models\RapatPerizinanDosen;


class JadwalRapatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //menampilkan jadwal rapat yang akan datang
    public function index()
    {
        Log::info('Starting index function in RapatController');

        // Fetch Menus with Submenus
        $menu = Menu::with('submenu')->get();
        Log::info('Menus fetched', ['count' => count($menu)]);

        return view('dashboard.rapat.jadwal-rapat.index', [
            'menu' => $menu,
        ]);
    }

    public function detail($rapatId)
    {
        $rapatDetail = Rapat::find($rapatId);
        if (!$rapatDetail) {
            abort(404, 'Rapat not found');
        }

        $currentUserId = auth()->user()->id;
        $userMahasiswa = UserMahasiswa::where('user_id', $currentUserId)->first();
        $userDosen = UserDosen::where('user_id', $currentUserId)->first();

        $userType = $userMahasiswa ? 'mahasiswa' : ($userDosen ? 'dosen' : null);
        if (!$userType) {
            abort(404, 'User not found');
        }

        $presensiModel = $userType === 'mahasiswa' ? RapatPresensiMahasiswa::class : RapatPresensiDosen::class;
        $userKey = $userType === 'mahasiswa' ? 'mahasiswa_nim' : 'dosen_nip';
        $userValue = $userType === 'mahasiswa' ? $userMahasiswa->nim : $userDosen->nip;

        $presensiRapat = $presensiModel::where('rapat_id', $rapatId)
            ->where($userKey, $userValue)
            ->first();

        $waktuKehadiranTerisi = $presensiModel::where('rapat_id', $rapatId)
            ->where($userKey, $userValue)
            ->whereNotNull('waktu_kode_satu')
            ->exists();

        $rapat = Rapat::where('id', $rapatId)->first();
        $waktuMulai = Carbon::parse($rapat->waktu_mulai);
        $notula = $rapat->notulensi;
        $now = Carbon::now();

        if ($now->lt($waktuMulai)) {
            $statusKehadiran = 'Belum Dimulai';
        } else {
            if ($userType === 'mahasiswa') {
                $waktuHadir = RapatPresensiMahasiswa::where('rapat_id', $rapatId)
                    ->where('mahasiswa_nim', $userMahasiswa->nim)
                    ->whereNotNull('waktu_kode_satu')
                    ->whereNotNull('waktu_kode_dua')
                    ->first();
            } else {
                $waktuHadir = RapatPresensiDosen::where('rapat_id', $rapatId)
                    ->where('dosen_nip', $userDosen->nip)
                    ->whereNotNull('waktu_kode_satu')
                    ->first();
            }

            if (!$waktuHadir) {
                $statusKehadiran = 'Tidak Hadir';

                $presensiRapat->keterangan = $statusKehadiran;
                $presensiRapat->save();
            } else {
                $waktuKehadiran = Carbon::parse($waktuHadir->waktu_kode_satu);
                $statusKehadiran = $this->calculateKehadiranStatus($waktuMulai, $waktuKehadiran);

                $presensiRapat->keterangan = $statusKehadiran;
                $presensiRapat->save();
            }
        }

        $izinModel = $userType === 'mahasiswa' ? RapatPerizinanMahasiswa::class : RapatPerizinanDosen::class;
        $rapatIzin = $izinModel::where('rapat_id', $rapatId)
            ->where($userKey, $userValue)
            ->first();

        $waktuSelesai = Carbon::parse($rapat->waktu_selesai);
        $status = $now->lt($waktuMulai) ? 'sebelum' : ($now->between($waktuMulai, $waktuSelesai) ? 'berlangsung' : 'selesai');

        $waktuTanggalFormatted = Carbon::parse($rapat->waktu_mulai)->translatedFormat('l, d F Y');
        $waktuMulaiFormatted = Carbon::parse($rapat->waktu_mulai)->format('H:i');
        $waktuSelesaiFormatted = Carbon::parse($rapat->waktu_selesai)->format('H:i');

        $isDosen = $userType === 'dosen';

        return view('dashboard.rapat.jadwal-rapat.detail', [
            'menu' => Menu::with('submenu')->get(),
            'rapatDetail' => $rapatDetail,
            'presensiRapat' => $presensiRapat,
            'waktuKehadiranTerisi' => $waktuKehadiranTerisi,
            'rapatId' => $rapatId,
            'statusKehadiran' => $statusKehadiran,
            'rapatIzin' => $rapatIzin,
            'notula' => $notula,
            'status' => $status,
            'waktuTanggalFormatted' => $waktuTanggalFormatted,
            'waktuMulaiFormatted' => $waktuMulaiFormatted,
            'waktuSelesaiFormatted' => $waktuSelesaiFormatted,
            'isDosen' => $isDosen,
        ]);
    }


    private function calculateKehadiranStatus($waktuMulai, $waktuKehadiran)
    {

        if (!$waktuKehadiran) {
            return 'Tidak Hadir';
        }

        $delayMinutes = $waktuMulai->diffInMinutes($waktuKehadiran, false);

        $delayMinutes = max($delayMinutes, 0);

        if ($delayMinutes <= 15) {
            return 'Tepat Waktu';
        } elseif ($delayMinutes <= 30) {
            return 'Terlambat 16-30 menit';
        } elseif ($delayMinutes <= 45) {
            return 'Terlambat 31-45 menit';
        } elseif ($delayMinutes <= 60) {
            return 'Terlambat 46-60 menit';
        } else {
            return 'Terlambat >60 Menit';
        }
    }


    public function izin($id)
    {
        // dd($id);
        $rapat = Rapat::where('id', $id)->first();
        // dd($rapat);
        $jenisRapat = $rapat->jenisRapat->nama_jenis_rapat;
        // dd($jenisRapat);
        // $namaJenisRapat = $jenisRapat->nama_jenis_rapat;
        $namaRapat = $rapat->nama_rapat;
        $tanggal = Carbon::parse($rapat->waktu_mulai);
        Carbon::setlocale('id');
        $formattedTanggal = $tanggal->translatedFormat('l, j F Y');
        // dd($formattedTanggal);
        $userId = Auth::user()->id;
        $user = UserMahasiswa::where('user_id', $userId)->first();
        $nama = $user->nama;
        $nim = $user->nim;
        $menu = Menu::with('submenu')->get();
        return view('dashboard.rapat.jadwal-rapat.izin', [
            'menu' => $menu,
            'namaJenisRapat' => $jenisRapat,
            'namaRapat' => $namaRapat,
            'formattedTanggal' => $formattedTanggal,
            'nama' => $nama,
            'nim' => $nim
        ]);
    }

    public function submit(Request $request)
    {
        // dd($request->formFile);
        // dd('iya');

        $validatedData = $request->validate([
            'nim' => 'required|string|max:20', // Adjust validation rules as needed
            'namaRapat' => 'required|string',
            'jenisIzin' => 'required|in:Tidak Hadir,Terlambat',
            'alasan' => 'required|string',
            'formFile' => 'required|file|mimes:pdf|max:2048', // Validate for PDF and max size of 2MB
        ]);

        // dd($validatedData['jenisIzin']);

        $rapat = Rapat::where('nama_rapat', $validatedData['namaRapat'])->first();
        $rapatId = $rapat->id;
        // dd($rapatId);
        // dd($rapat);
        $sekre_nim = $rapat->sekretaris_nim;

        // Handle file upload
        if ($request->hasFile('formFile')) {
            $filePath = $request->file('formFile')->store('perizinan_files', 'public');
        } else {
            // Handle the case where no file is uploaded
            $filePath = null;
        }

        // Create and save the RapatPerizinanMahasiswa model
        $perizinan = new RapatPerizinanMahasiswa([
            'mahasiswa_nim' => $validatedData['nim'],
            'rapat_id' => $rapatId,
            'alasan' => $validatedData['alasan'],
            'jenis_izin' => $validatedData['jenisIzin'],
            'status' => 'Menunggu',
            'file_perizinan' => $filePath,
            'sekretaris_nim' => $sekre_nim,
            // Set other fields as necessary
        ]);
        // dd('berhasil');
        $perizinan->save();

        // Redirect to a specific route after saving
        return redirect()->route('jadwal-rapat.index');
    }

    public function fetchRapatData(Request $request)
    {
        // Ensure the user is authenticated
        if (!Auth::check()) {
            Log::info('User is not authenticated');
            return redirect()->route('login');
        }

        $userId = Auth::id();

        $userMahasiswa = UserMahasiswa::where('user_id', $userId)->first();
        $userDosen = UserDosen::where('user_id', $userId)->first();

        if ($userMahasiswa) {
            $userNim = $userMahasiswa->nim;
            Log::info('UserMahasiswa NIM fetched', ['NIM' => $userNim]);

            $query = RapatPresensiMahasiswa::with(['rapat' => function ($query) {
                $query->orderBy('waktu_mulai', 'desc')
                    ->with('tempat'); // Eager load the tempat relationship
            }])
                ->where('mahasiswa_nim', $userNim);

            // Apply filter for 'terkini' if requested
            if ($request->filter === 'terkini') {
                $query->whereHas('rapat', function ($q) {
                    $twoDaysAgo = now()->subDays(2);
                    $q->where('waktu_selesai', '>=', $twoDaysAgo);
                });
            }

            // Apply search query if provided
            if (!empty($request->search)) {
                $query->whereHas('rapat', function ($q) use ($request) {
                    $q->where('nama_rapat', 'like', '%' . $request->search . '%');
                });
            }
            $rapatPresensiRecords = $query->get();
            foreach ($rapatPresensiRecords as $record) {
                if ($record->rapat) {
                    $mulai = Carbon::parse($record->rapat->waktu_mulai);
                    $selesai = Carbon::parse($record->rapat->waktu_selesai);

                    $record->rapat->tanggal = $mulai->translatedFormat('l, d F Y');
                    $record->rapat->formatted_waktu_mulai = $mulai->format('H:i');
                    $record->rapat->formatted_waktu_selesai = $selesai->format('H:i');
                }

                $waktuSelesai = Carbon::parse($record->rapat->formatted_waktu_selesai, 'Asia/Jakarta');
                if ($waktuSelesai > now('Asia/Jakarta')) {
                    $record->rapat->borderClass = 'border-primary';
                } elseif ($waktuSelesai->diffInDays(now('Asia/Jakarta'), false) <= 2) {
                    $record->rapat->borderClass = 'border-success';
                } else {
                    $record->rapat->borderClass = 'border-secondary';
                }
            }
            Log::info('RapatPresensiMahasiswa records fetched', ['count' => count($rapatPresensiRecords)]);
        } elseif ($userDosen) {
            $userNip = $userDosen->nip;
            Log::info('User Dosen NIP fetched', ['NIP' => $userNip]);

            $query = RapatPresensiDosen::with(['rapat' => function ($query) {
                $query->orderBy('waktu_mulai', 'desc')
                    ->with('tempat'); // Eager load the tempat relationship
            }])
                ->where('dosen_nip', $userNip);

            // Apply filter for 'terkini' if requested
            if ($request->filter === 'terkini') {
                $query->whereHas('rapat', function ($q) {
                    $twoDaysAgo = now()->subDays(2);
                    $q->where('waktu_selesai', '>=', $twoDaysAgo);
                });
            }

            // Apply search query if provided
            if (!empty($request->search)) {
                $query->whereHas('rapat', function ($q) use ($request) {
                    $q->where('nama_rapat', 'like', '%' . $request->search . '%');
                });
            }
            $rapatPresensiRecords = $query->get();
            foreach ($rapatPresensiRecords as $record) {
                if ($record->rapat) {
                    $mulai = Carbon::parse($record->rapat->waktu_mulai);
                    $selesai = Carbon::parse($record->rapat->waktu_selesai);

                    $record->rapat->tanggal = $mulai->translatedFormat('l, d F Y');
                    $record->rapat->formatted_waktu_mulai = $mulai->format('H:i');
                    $record->rapat->formatted_waktu_selesai = $selesai->format('H:i');
                }

                $waktuSelesai = Carbon::parse($record->rapat->formatted_waktu_selesai, 'Asia/Jakarta');
                if ($waktuSelesai > now('Asia/Jakarta')) {
                    $record->rapat->borderClass = 'border-primary';
                } elseif ($waktuSelesai->diffInDays(now('Asia/Jakarta'), false) <= 2) {
                    $record->rapat->borderClass = 'border-success';
                } else {
                    $record->rapat->borderClass = 'border-secondary';
                }
            }
            Log::info('RapatPresensiMahasiswa records fetched', ['count' => count($rapatPresensiRecords)]);
        } else {
            Log::info('User Mahasiswa not found for user ID', ['userID' => $userId]);
            Log::info('Dosen Mahasiswa not found for user ID', ['userID' => $userId]);
            return view('dashboard.error', ['message' => 'User information not found']);
        }

        $html = view('dashboard.rapat.jadwal-rapat.rapatList', ['rapatPresensiRecords' => $rapatPresensiRecords])->render();
        return response()->json(['html' => $html]);
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
    public function update(Request $request, $id)
    {
        //
    }

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
