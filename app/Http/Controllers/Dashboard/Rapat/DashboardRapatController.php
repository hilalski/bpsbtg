<?php

namespace App\Http\Controllers\Dashboard\Rapat;

use Carbon\Carbon;
use App\Models\Menu;
use App\Models\Rapat;
use App\Models\Seksi;
use App\Models\Bagian;
use App\Models\Tempat;
use App\Models\Jabatan;
use App\Models\Subseksi;
use App\Models\UserDosen;
use App\Models\RapatJenis;
use App\Models\RisetBidang;
use App\Models\RapatKodeDua;
use Illuminate\Http\Request;
use App\Models\RapatKodeSatu;
use App\Models\UserMahasiswa;
use App\Mail\RapatNotification;
use App\Models\RapatPresensiDosen;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;
use App\Models\RapatPresensiMahasiswa;
use Illuminate\Support\Facades\Storage;


class DashboardRapatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Eager load the tempat relationship with rapat
        $rapat = Rapat::with('tempat')
            ->orderBy('waktu_mulai', 'desc')
            ->get();

        foreach ($rapat as $r) {
            $mulai = Carbon::parse($r->waktu_mulai);
            $selesai = Carbon::parse($r->waktu_selesai);

            $r->tanggal = $mulai->translatedFormat('l, d F Y');
            $r->formatted_waktu_mulai = $mulai->format('H:i');
            $r->formatted_waktu_selesai = $selesai->format('H:i');

            $waktuSelesai = Carbon::parse($r->waktu_selesai, 'Asia/Jakarta');
            if ($waktuSelesai > now('Asia/Jakarta')) {
                $r->borderClass = 'border-primary';
            } elseif ($waktuSelesai->diffInDays(now('Asia/Jakarta'), false) <= 2) {
                $r->borderClass = 'border-success';
            } else {
                $r->borderClass = 'border-secondary';
            }
        }

        $menu = Menu::with('submenu')->get();
        $userMahasiswa = null;

        if (Auth::check()) {
            $userId = Auth::id();
            $userMahasiswa = UserMahasiswa::where('user_id', $userId)->first();
        }

        return view('dashboard.rapat.dashboard-rapat.index', [
            'menu' => $menu,
            'rapat' => $rapat,
            'userMahasiswa' => $userMahasiswa,
        ]);
    }

    // public function detail($id)
    // {
    //     $menu = Menu::with('submenu')->get();
    //     $rapat = Rapat::findOrFail($id); // Fetch the meeting details
    //     $rapat_presensi_mahasiswa = RapatPresensiMahasiswa::where('rapat_id', $id)->get();
    //     $rapat_presensi_dosen = RapatPresensiDosen::where('rapat_id', $id)->get();
    //     $tempat = Tempat::find($rapat->tempat_id);
    //     $rapat->nama_tempat = $tempat ? $tempat->nama_tempat : null;

    //     foreach ($rapat_presensi_mahasiswa as $rpm) {
    //         $keterangan = 'Belum Presensi';
    //         $userMahasiswa = UserMahasiswa::where('nim', $rpm->mahasiswa_nim)->first();
    //         $rpm->nama = $userMahasiswa ? $userMahasiswa->nama : 'Nama Tidak Ditemukan';

    //         $waktuMulaiRapat = Carbon::parse($rapat->waktu_mulai);
    //         $waktuSelesaiRapat = Carbon::parse($rapat->waktu_selesai);

    //         if ($rpm->waktu_kode_satu && $rpm->waktu_kode_dua) {
    //             $waktuMulaiPresensi = Carbon::parse($rpm->waktu_kode_satu);
    //             $selisihWaktu = $waktuMulaiRapat->diffInMinutes($waktuMulaiPresensi, false);

    //             if ($selisihWaktu <= 15) {
    //                 $keterangan = 'Tepat Waktu';
    //             } elseif ($selisihWaktu <= 30) {
    //                 $keterangan = 'Terlambat 15-30 Menit';
    //             } elseif ($selisihWaktu <= 45) {
    //                 $keterangan = 'Terlambat 30-45 Menit';
    //             } elseif ($selisihWaktu <= 60) {
    //                 $keterangan = 'Terlambat 45-60 Menit';
    //             } else {
    //                 $keterangan = 'Tidak Hadir';
    //             }
    //         } elseif (Carbon::now()->lessThan($waktuMulaiRapat)) {
    //             $keterangan = 'Belum Dimulai';
    //         } elseif (Carbon::now()->greaterThan($waktuSelesaiRapat)) {
    //             $keterangan = 'Tidak Hadir';
    //         }
    //         $rpm->keterangan = $keterangan;
    //     }

    //     foreach ($rapat_presensi_dosen as $rpd) {
    //         $keterangan = 'Belum Presensi';
    //         $userDosen = UserDosen::where('nip', $rpd->dosen_nip)->first();
    //         $rpd->nama = $userDosen ? $userDosen->nama : 'Nama Tidak Ditemukan';

    //         $waktuMulaiRapat = Carbon::parse($rapat->waktu_mulai);
    //         $waktuSelesaiRapat = Carbon::parse($rapat->waktu_selesai);

    //         // Assuming $rpd->waktu_kode_satu is a string in a format Carbon can parse
    //         $waktuKehadiranDosen = $rpd->waktu_kode_satu ? Carbon::parse($rpd->waktu_kode_satu) : null;

    //         $keterangan = 'Belum Presensi';

    //         if ($waktuKehadiranDosen != null && $waktuKehadiranDosen->lessThan($waktuSelesaiRapat)) {
    //             $keterangan = 'Hadir';
    //         } elseif ($waktuKehadiranDosen == null) {
    //             if (Carbon::now()->lessThan($waktuMulaiRapat)) {
    //                 $keterangan = 'Belum Dimulai';
    //             } elseif (Carbon::now()->greaterThan($waktuSelesaiRapat)) {
    //                 $keterangan = 'Tidak Hadir';
    //             }
    //         }

    //         $rpd->keterangan = $keterangan;
    //     }
    //     // Pass the meeting details to the view
    //     return view('dashboard.rapat.dashboard-rapat.detail', [
    //         'rapat' => $rapat,
    //         'menu' => $menu,
    //         'rapat_presensi_mahasiswa' => $rapat_presensi_mahasiswa,
    //         'rapat_presensi_dosen' => $rapat_presensi_dosen,
    //     ]);
    // }

    public function detail($id)
    {
        // Eager load related models with the Rapat model
        $menu = Menu::with('submenu')->get();
        $rapat = Rapat::with(['rapatPresensiMahasiswa.mahasiswa', 'rapatPresensiDosen.dosen', 'tempat'])
            ->findOrFail($id);

        return view('dashboard.rapat.dashboard-rapat.detail', [
            'rapat' => $rapat,
            'menu' => $menu,
            'rapat_presensi_mahasiswa' => $rapat->rapatPresensiMahasiswa,
            'rapat_presensi_dosen' => $rapat->rapatPresensiDosen,
        ]);
    }


    public function notula($id)
    {
        $menu = Menu::with('submenu')->get();
        $rapat = Rapat::findOrFail($id); // Fetch the meeting details
        $tempat = Tempat::find($rapat->tempat_id);
        $rapat->nama_tempat = $tempat ? $tempat->nama_tempat : null;
        // Pass the meeting details to the view
        return view('dashboard.rapat.dashboard-rapat.notula', [
            'rapat' => $rapat,
            'menu' => $menu,
        ]);
    }

    public function upload_notula($id)
    {
        $rules = [
            'notula' => 'required|file|max:10240|mimes:pdf',
        ];

        $this->validate(request(), $rules);
        $file = request()->file('notula'); // Ensure this matches the file input name in your form
        $fileName = $id . '/' . time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('notula', $fileName);
        Rapat::where('id', $id)->update(['notulensi' => $filePath]);

        return redirect()->route('dashboard-rapat.notula', $id)->with('status.success', 'Notula berhasil diunggah');
    }

    public function delete_notula($id)
    {
        $rapat = Rapat::findOrFail($id);
        if ($rapat->notulensi) {
            Storage::delete($rapat->notulensi);
        }
        Rapat::where('id', $id)->update(['notulensi' => null]);

        session()->flash("msg-notula", "<script>swal('SUKSES!','Sukses menghapus notula','success')</script>");
        return redirect()->route('dashboard-rapat.notula', $id);
    }

    public function show($id)
    {
        // Mengambil ID dari request

        $rapat = Rapat::findOrFail($id);
        if (empty($rapat->notulensi)) {
            return redirect()->back()->with('status.error', 'File notulensi tidak tersedia.');
        }

        $filePath = $rapat->notulensi;
        if (!Storage::exists($filePath)) {
            return redirect()->back()->with('status.error', 'File notulensi tidak ditemukan.');
        }

        return response()->file(storage_path('app/' . $filePath));
    }

    public function download_notula($id)
    {

        $rapat = Rapat::findOrFail($id);

        if (empty($rapat->notulensi)) {
            return redirect()->back()->with('status.error', 'File notulensi tidak tersedia.');
        }

        $filePath = $rapat->notulensi;
        if (!Storage::exists($filePath)) {
            return redirect()->back()->with('status.error', 'File notulensi tidak ditemukan.');
        }
        return response()->download(storage_path('app/' . $filePath));
    }


    public function deleteRapat($id_rapat)
    {
        $rapat = Rapat::with([
            'rapatPenyelenggara', 'perizinanDosen', 'perizinanMahasiswa', 'rapatPresensiDosen', 'rapatPresensiMahasiswa'
        ])->find($id_rapat);

        if ($rapat) {
            // Delete related records from each table
            foreach ($rapat->perizinanDosen as $item) {
                $item->delete();
            }
            foreach ($rapat->perizinanMahasiswa as $item) {
                $item->delete();
            }
            foreach ($rapat->rapatPresensiDosen as $item) {
                $item->delete();
            }
            foreach ($rapat->rapatPresensiMahasiswa as $item) {
                $item->delete();
            }
            foreach ($rapat->rapatPenyelenggara as $item) {
                $item->delete();
            }
            // Now delete the rapat
            $rapat->delete();

            // Redirect to a relevant route with a success message
            return redirect('/dashboard/rapat/dashboard')->with('status.success', 'Rapat berhasil dihapus');
        } else {
            // Handle jika rapat tidak ditemukan
            return redirect('/dashboard/rapat/dashboard')->with('status.error', 'Rapat tidak ditemukan');
        }
    }


    public function akhiriRapat($id)
    {
        $rapat = Rapat::find($id);
        $rapat->waktu_selesai = now(); // Gunakan waktu saat ini atau logika lainnya
        $rapat->save();

        return redirect('/dashboard/rapat/dashboard')->with('status.success', 'Rapat Sudah Diakhiri');
    }


    private function getFilteredRapatJenis($jabatanRisetId, $jabatanBidangId)
    {
        $allRapatJenis = RapatJenis::all();

        // Base rules for "Semua Sekre"
        $semuaSekreRules = [
            'Rapat Koordinasi Dosen',
            'Rapat Koordinasi Intra Modul/Bidang/Seksi',
            'Rapat Koordinasi Modul/Bidang/Seksi'
        ];

        // Initialize with base rules
        // $finalRules = $semuaSekreRules;
        $finalRules = $jabatanRisetId !== 'JM11' ? $semuaSekreRules : [];

        // Add specific rules based on Jabatan IDs
        switch (true) {
            case $jabatanRisetId === 'JM03':
                $finalRules = array_merge($finalRules, ['Rapat Pleno', 'Rapat Akbar', 'Rapat BPH 6', 'Rapat BPH 12', 'Rapat BPH 42']);
                break;
            case $jabatanRisetId === 'JM08':
                $finalRules = array_merge($finalRules, ['Rapat Seksi', 'Rapat BPH Seksi']);
                break;
            case $jabatanRisetId === 'JM11':
                $finalRules = array_merge(['Rapat Subseksi', 'Rapat Bagian']);
                break;
            case $jabatanBidangId === 'JM15':
                $finalRules = array_merge($finalRules, ['Rapat Bidang', 'Rapat BPH Bidang']);
                break;
            case in_array($jabatanBidangId, ['JM18', 'JM19']):
                $finalRules = array_merge(['Rapat Seksi', 'Rapat BPH Seksi']);
                break;
        }
        Log::info('Final rules for Rapat Jenis: ', $finalRules);
        $filteredRapatJenis = $allRapatJenis->whereIn('nama_jenis_rapat', $finalRules);
        Log::info('Filtered Rapat Jenis: ', $filteredRapatJenis->toArray());

        return $filteredRapatJenis;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menu = Menu::with('submenu')->get();
        $risetBidang = RisetBidang::all();
        $seksi = Seksi::all();
        $subseksi = Subseksi::all();
        $bagian = Bagian::all();
        $rapatJenis = RapatJenis::all();
        $userDosen = UserDosen::all();
        $idRapatBagian = RapatJenis::where('nama_jenis_rapat', 'Rapat Bagian')->first()->id;

        // Retrieve current user and their details
        $userId = Auth::user()->id;
        $user = UserMahasiswa::where('user_id', $userId)->first();

        $penyelenggara = null;
        $labelJabatan = null;
        $additionalInfo = [];

        Log::info('User Jabatan Riset ID: ' . $user->jabatan_riset_id);
        Log::info('User Jabatan Bidang ID: ' . $user->jabatan_bidang_id);

        if ($user->jabatan_bph_id != null) {
            $filteredRapatJenis = $this->getFilteredRapatJenis($user->jabatan_bph_id, $user->jabatan_bidang_id);
        } else {
            $filteredRapatJenis = $this->getFilteredRapatJenis($user->jabatan_riset_id, $user->jabatan_bidang_id);
        }

        // Prepare user details for the view
        $userDetails = $this->prepareUserDetails($user);

        // FIlter Penyelenggara
        if (in_array($user->jabatan_bph_id, ['JM03'])) {
            $penyelenggara = RisetBidang::find($user->riset_id);
            $labelJabatan = $user->jabatan_bph_nama;
        } elseif (in_array($user->jabatan_riset_id, ['JM08', 'JM11'])) {
            $penyelenggara = RisetBidang::find($user->riset_id);
            $jabatan = Jabatan::find($user->jabatan_riset_id);
            $labelJabatan = $jabatan->nama_jabatan;

            if ($user->jabatan_riset_id == 'JM08') {
                $jabatan = Seksi::find($user->seksi_riset_id);
                $additionalInfo['seksi'] = $jabatan->nama_seksi;

                $risetBidang = RisetBidang::where('id', $user->riset_id)->get();
                $seksi = Seksi::where('id', $user->seksi_riset_id)->get();
                $seksiIds = $seksi->pluck('id');
                $subseksi = Subseksi::whereIn('seksi_id', $seksiIds)->get();
                $subseksiIds = $subseksi->pluck('id');
                $bagian = Bagian::whereIn('subseksi_id', $subseksiIds)->get();
            } elseif ($user->jabatan_riset_id == 'JM11') {
                $jabatan = Seksi::find($user->seksi_riset_id);
                $additionalInfo['seksi'] = $jabatan->nama_seksi;
                $jabatan = Subseksi::find($user->subseksi_riset_id);
                $additionalInfo['subseksi'] = $jabatan->nama_subseksi;
                $jabatan = Bagian::where('subseksi_id', $user->subseksi_riset_id)->get();
                $additionalInfo['bagian'] = $jabatan;

                $risetBidang = RisetBidang::where('id', $user->riset_id)->get();
                $seksi = Seksi::where('id', $user->seksi_riset_id)->get();
                $subseksi = Subseksi::where('id', $user->subseksi_riset_id)->get();
                $subseksiIds = $subseksi->pluck('id');
                $bagian = Bagian::whereIn('subseksi_id', $subseksiIds)->get();
            }
        } elseif (in_array($user->jabatan_bidang_id, ['JM15', 'JM18', 'JM19'])) {
            $penyelenggara = RisetBidang::find($user->bidang_id);
            $jabatan = Jabatan::find($user->jabatan_bidang_id);
            $labelJabatan = $jabatan ? $jabatan->nama_jabatan : 'Jabatan tidak ditemukan';

            if (in_array($user->jabatan_bidang_id, ['JM15', 'JM18', 'JM19'])) {
                if ($user->jabatan_bidang_id == 'JM15') {
                    $risetBidang = RisetBidang::where('id', $user->bidang_id)->get();
                    $seksi = Seksi::where('riset_bidang_id', $risetBidang->first()->id)->get();
                    $seksiIds = $seksi->pluck('id');
                    $subseksi = Subseksi::whereIn('seksi_id', $seksiIds)->get();
                    $subseksiIds = $subseksi->pluck('id');
                    $bagian = Bagian::whereIn('subseksi_id', $subseksiIds)->get();
                } elseif ($user->jabatan_bidang_id == 'JM18') {
                    $jabatan = Seksi::find($user->seksi_bidang_id);
                    $additionalInfo['seksi'] = $jabatan->nama_seksi;

                    $jabatan = Subseksi::find($user->subseksi_bidang_id);
                    $additionalInfo['subseksi'] = $jabatan->nama_subseksi;
                    $risetBidang = RisetBidang::where('id', $user->bidang_id)->get();
                    $seksi = Seksi::where('id', $user->seksi_bidang_id)->get();
                    $subseksi = Subseksi::where('id', $user->subseksi_bidang_id)->get();
                } elseif ($user->jabatan_bidang_id == 'JM19') {
                    $jabatan = Seksi::find($user->seksi_bidang_id);
                    $additionalInfo['seksi'] = $jabatan->nama_seksi;
                    $risetBidang = RisetBidang::where('id', $user->bidang_id)->get();
                    $seksi = Seksi::where('id', $user->seksi_bidang_id)->get();
                }
            }
        }

        // Get filtered 'Jenis Rapat' based on user's 'Jabatan'

        $tempatOptions = [
            'Offline' => Tempat::where('id', 'like', 'OF%')->get(),
            'Online' => Tempat::where('id', 'like', 'ON%')->get(),
            'idLainnya' => Tempat::where('nama_tempat', 'Lainnya')->first(),
        ];

        $userId = Auth::user()->id;
        $user = UserMahasiswa::where('user_id', $userId)->first();

        if ($user->jabatan_bph_id != null) {
            $jabatanUser = $user->jabatan_bph_id;
        } elseif ($user->jabatan_bidang_id != null) {
            $jabatanUser = $user->jabatan_bidang_id;
        } else {
            $jabatanUser = $user->jabatan_riset_id;
        }

        if ($jabatanUser === "JM03") {
            $ketua_rapat_nim = UserMahasiswa::where('jabatan_bph_id', 'JM01')->first();
        } elseif ($jabatanUser === "JM08") {
            $ketua_rapat_nim = UserMahasiswa::where('jabatan_riset_id', 'JM07')->where('seksi_riset_id', $user->seksi_riset_id)->first();
        } elseif ($jabatanUser === "JM11") {
            $ketua_rapat_nim = UserMahasiswa::where('jabatan_riset_id', 'JM10')->where('subseksi_riset_id', $user->subseksi_riset_id)->first();
        } elseif ($jabatanUser === "JM15") {
            $ketua_rapat_nim = UserMahasiswa::where('jabatan_bidang_id', 'JM14')->first();
        } elseif ($jabatanUser === 'JM18') {
            $ketua_rapat_nim = UserMahasiswa::where('jabatan_bidang_id', 'JM17')->where('seksi_bidang_id', $user->seksi_bidang_id)->first();
        } elseif ($jabatanUser === 'JM19') {
            $ketua_rapat_nim = UserMahasiswa::where('jabatan_bidang_id', 'JM17')->where('seksi_bidang_id', $user->seksi_bidang_id)->first();
        }

        return view('dashboard.rapat.dashboard-rapat.add', [
            'menu' => $menu,
            'risetBidang' => $risetBidang,
            'seksi' => $seksi,
            'subseksi' => $subseksi,
            'bagian' => $bagian,
            'userDetails' => $userDetails,
            'filteredRapatJenis' => $filteredRapatJenis,
            'penyelenggara' => $penyelenggara,
            'labelJabatan' => $labelJabatan,
            'additionalInfo' => $additionalInfo,
            'idRapatBagian' => $idRapatBagian,
            'userDosen' => $userDosen,
            'ketuaRapatNim' => $ketua_rapat_nim,
            // other data to pass to view...
        ], compact('tempatOptions'));
    }

    private function prepareUserDetails($user)
    {
        // Extract user details and prepare them for the view
        $userDetails = [
            'risetUser' => $user->riset ? $user->riset->nama_riset_bidang : null,
            'jabatanRisetUser' => $user->jabatanRiset ? $user->jabatanRiset->nama_jabatan : null,
            'seksiUser' => $user->seksiRiset ? $user->seksiRiset->nama_seksi : null,
            'subseksiUser' => $user->subseksiRiset ? $user->subseksiRiset->nama_subseksi : null,
            'bagianUser' => $user->bagianRiset ? $user->bagianRiset->nama_bagian : null,
            'bidangUser' => $user->bidang ? $user->bidang->nama_riset_bidang : null,
            'jabatanBidangUser' => $user->jabatanBidang ? $user->jabatanBidang->nama_jabatan : null,
            'seksiBidangUser' => $user->seksiBidang ? $user->seksiBidang->nama_seksi : null,
            'subseksiBidangUser' => $user->subseksiBidang ? $user->subseksiBidang->nama_subseksi : null,
        ];

        return $userDetails;
    }

    public function sendEmailToParticipants($id)
    {
        $rapat = Rapat::with(['rapatPresensiMahasiswa.mahasiswa.user', 'rapatPresensiDosen.dosen.user'])
            ->findOrFail($id);
        Log::info('Rapat id: ' . $rapat->id);

        $initialStateKey = 'rapat_initial_state_' . $rapat->id;
        $initialState = Cache::get($initialStateKey);

        if (!$initialState) {
            // Simpan state awal jika belum ada
            $this->saveInitialState($rapat, $initialStateKey);
        }

        // Cek apakah ada perubahan
        $hasChanges = $this->checkForChanges($rapat, $initialState);


        foreach ([$rapat->rapatPresensiMahasiswa, $rapat->rapatPresensiDosen] as $presensis) {
            foreach ($presensis as $presensi) {
                $user = $presensi->mahasiswa->user ?? $presensi->dosen->user;
                try {
                    Mail::to($user->email)->send(new RapatNotification($rapat, $hasChanges));
                    Log::info('Email berhasil dikirim ke: ' . $user->email);
                } catch (\Exception $e) {
                    Log::error('Gagal mengirim email ke: ' . $user->email . ' Error: ' . $e->getMessage());
                }
            }
        }

        return back()->with('status.success', 'Email terkirim ke semua peserta rapat.');
    }

    private function saveInitialState($rapat, $key)
    {
        $state = [
            'jenis_rapat_id' => $rapat->jenis_rapat_id,
            'nama_rapat' => $rapat->nama_rapat,
            'agenda' => $rapat->agenda,
            'pelaksanaan' => $rapat->pelaksanaan,
            'tempat_id' => $rapat->tempat_id,
            'detail_tempat' => $rapat->detail_tempat,
            'waktu_mulai' => $rapat->waktu_mulai->toDateTimeString(),
            'waktu_selesai' => $rapat->waktu_selesai->toDateTimeString()
        ];
        Cache::forever($key, $state);
    }

    private function checkForChanges($rapat, $initialState)
    {
        if (!$initialState) return true;

        foreach ($initialState as $key => $value) {
            if ($rapat->{$key} instanceof \Illuminate\Support\Carbon) {
                if ($rapat->{$key}->toDateTimeString() !== $value) {
                    return true;
                }
            } elseif ($rapat->{$key} != $value) {
                return true;
            }
        }
        return false;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
