<?php

namespace App\Http\Controllers\Dashboard\Rapat;

use App\Models\Menu;
use App\Models\Rapat;
use App\Models\RapatPenyelenggara;
use App\Models\RapatPresensiMahasiswa;
use App\Models\RapatPresensiDosen;
use App\Models\Seksi;
use App\Models\Bagian;
use App\Models\Tempat;
use App\Models\Jabatan;
use App\Models\Subseksi;
use App\Models\RapatJenis;
use App\Models\RisetBidang;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\UserMahasiswa;
use App\Models\UserDosen;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class UmaruController extends Controller
{
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
        $finalRules = $semuaSekreRules;

        // Add specific rules based on Jabatan IDs
        switch (true) {
            case $jabatanRisetId === 'JM03':
                $finalRules = array_merge($finalRules, ['Rapat Pleno', 'Rapat Akbar', 'Rapat BPH 6', 'Rapat BPH 12', 'Rapat BPH 42']);
                break;
            case $jabatanRisetId === 'JM08':
                $finalRules = array_merge($finalRules, ['Rapat Seksi', 'Rapat BPH Seksi']);
                break;
            case $jabatanRisetId === 'JM11':
                $finalRules = array_merge($finalRules, ['Rapat Subseksi', 'Rapat Bagian']);
                break;
            case $jabatanBidangId === 'JM15':
                $finalRules = array_merge($finalRules, ['Rapat Bidang', 'Rapat BPH Bidang']);
                break;
        }
        Log::info('Final rules for Rapat Jenis: ', $finalRules);
        $filteredRapatJenis = $allRapatJenis->whereIn('nama_jenis_rapat', $finalRules);
        Log::info('Filtered Rapat Jenis: ', $filteredRapatJenis->toArray());

        return $filteredRapatJenis;
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

    public function edit(Request $request, $id)
    {
        $rapat = Rapat::where('id', $id)->first();
        $tanggal = Carbon::parse($rapat->waktu_mulai)->format('Y-m-d');
        $waktu_mulai = Carbon::parse($rapat->waktu_mulai)->format('H:i');
        $waktu_selesai = Carbon::parse($rapat->waktu_selesai)->format('H:i');
        $menu = Menu::with('submenu')->get();
        $risetBidang = RisetBidang::all();
        $seksi = Seksi::all();
        $subseksi = Subseksi::all();
        $bagian = Bagian::all();
        $dosen = UserDosen::all();
        $rapatPenyelenggara = RapatPenyelenggara::where('rapat_id', $id)->first();
        $rapatMahasiswaIds = RapatPresensiMahasiswa::where('rapat_id', $id)->pluck('mahasiswa_nim');
        $mahasiswaSelected = UserMahasiswa::whereIn('nim', $rapatMahasiswaIds)->get();
        $idRapatBagian = RapatJenis::where('nama_jenis_rapat', 'Rapat Bagian')->first()->id;

        $rapatDosenIds = RapatPresensiDosen::where('rapat_id', $id)->pluck('dosen_nip');
        $dosenSelected = UserDosen::whereIn('nip', $rapatDosenIds)->get();

        //Cari User
        $userId = Auth::user()->id;
        $user = UserMahasiswa::where('user_id', $userId)->first();
        // Determine the 'Penyelenggara' based on 'Jabatan'
        //$penyelenggara = $this->determinePenyelenggara($user);
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

        return view('dashboard.rapat.dashboard-rapat.sunting', [
            'rapatPenyelenggara' => $rapatPenyelenggara,
            'rapat' => $rapat,
            'menu' => $menu,
            'riset_bidang' => $risetBidang,
            'seksi' => $seksi,
            'subseksi' => $subseksi,
            'bagian' => $bagian,
            'userDetails' => $userDetails,
            'tanggal' => $tanggal,
            'waktu_mulai' => $waktu_mulai,
            'waktu_selesai' => $waktu_selesai,
            'filteredRapatJenis' => $filteredRapatJenis,
            'penyelenggara' => $penyelenggara,
            'labelJabatan' => $labelJabatan,
            'additionalInfo' => $additionalInfo,
            'idRapatBagian' => $idRapatBagian,
            'dosen' => $dosen,
            'mahasiswaSelected' => $mahasiswaSelected,
            'dosenSelected' => $dosenSelected,
            'ketuaRapatNim' => $ketua_rapat_nim,
        ], compact('tempatOptions'));
    }

    public function update(Request $request, $id)
    {
        Log::info('Store method started');
        $menu = Menu::with('submenu')->get();

        Log::info('Data diterima dari form:', $request->all());

        // Define validation rules
        $validator = Validator::make($request->all(), [
            'jenis_rapat_id' => 'required',
            'nama_rapat' => 'required',
            'tanggal' => 'required|date',
            'waktu_mulai' => 'required|date_format:H:i',
            'waktu_selesai' => 'required|date_format:H:i',
            'pelaksanaan' => 'required|not_in:Choose...', // Memastikan pelaksanaan tidak kosong dan bukan "Choose..."
            'tempat' => 'required|not_in:Choose...', // Memastikan tempat tidak kosong dan bukan "Choose..."
            'agenda' => 'required',
            'detail_tempat' => 'required_if:tempat,Lainnya',
            'jenis_rapat_id' => 'required|not_in:Choose...', // Validasi jenis rapat
            'bagianName' => 'required_if:jenis_rapat_id,idRapatBagian|not_in:Choose...', // Validasi nama bagian jika rapat bagian dipilih
        ]);

        // Check if the validation fails
        if ($validator->fails()) {
            $agenda = $request->input('detail_tempat');
            Log::info('Agenda data:', ['agenda' => $agenda]);
            Log::info('Validation failed', ['errors' => $validator->errors()]);
            // Redirect back with errors
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $validatedData = $validator->validated();
            Log::info('Received data for rapat creation', $request->all());
            $waktuMulai = $validatedData['tanggal'] . ' ' . $validatedData['waktu_mulai'] . ':00';
            $waktuMulaiFormatted = Carbon::createFromFormat('Y-m-d H:i:s', $waktuMulai);
            $validatedData['waktu_mulai'] = $waktuMulaiFormatted;

            $waktuSelesai = $validatedData['tanggal'] . ' ' . $validatedData['waktu_selesai'] . ':00';
            $waktuSelesaiFormatted = Carbon::createFromFormat('Y-m-d H:i:s', $waktuSelesai);
            $validatedData['waktu_selesai'] = $waktuSelesaiFormatted;

            function generateRandomCode($length)
            {
                $alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
                $alphabetLength = strlen($alphabet);
                $randomString = '';
                for ($i = 0; $i < $length; $i++) {
                    $index = rand(0, $alphabetLength - 1);
                    $randomString .= $alphabet[$index];
                }
                return $randomString;
            }

            $kode_satu = generateRandomCode(6);
            $kode_dua = generateRandomCode(6);

            $userId = Auth::user()->id;
            $user = UserMahasiswa::where('user_id', $userId)->first();
            $sekretaris_nim = $user->nim;

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
                $ketua_rapat_nim = UserMahasiswa::where('jabatan_riset_id', 'JM14')->first();
            } elseif ($jabatanUser === 'JM18' || $jabatanUser === 'JM19') {
                $ketua_rapat_nim = UserMahasiswa::where('jabatan_bidang_id', 'JM17')->where('seksi_bidang_id', $user->seksi_bidang_id)->first();
            }

            $ketua_rapat_nim = $ketua_rapat_nim->nim;


            $rapat = Rapat::where('id', $id)->first();
            $rapat->jenis_rapat_id = $validatedData['jenis_rapat_id'];
            $rapat->nama_rapat = $validatedData['nama_rapat'];
            $rapat->agenda = $validatedData['agenda'];
            $rapat->pelaksanaan = $validatedData['pelaksanaan'];
            $rapat->tempat_id = $validatedData['tempat'];
            $rapat->kode_satu = $kode_satu;
            $rapat->kode_dua = $kode_dua;
            $rapat->waktu_mulai = $validatedData['waktu_mulai'];
            $rapat->waktu_selesai = $validatedData['waktu_selesai'];
            $rapat->ketua_rapat_nim = $ketua_rapat_nim;
            $rapat->sekretaris_nim = $sekretaris_nim;
            // Cek jika tempat_id adalah OF002, maka set detail_tempat
            if ($validatedData['tempat'] === 'OF002') {
                $rapat->detail_tempat = $request->input('detail_tempat');
            }

            $rapat->save();
            Log::info('Rapat updated successfully', ['rapat_id' => $rapat->id]);

            if ($rapat->save()) {
                // Retrieve selected mahasiswa NIMs from the request
                $selectedMahasiswa = $request->input('select_mahasiswa'); // Make sure this is the name of your select input

                // Loop through each mahasiswa NIM and create RapatPresensiMahasiswa entries
                RapatPresensiMahasiswa::where('rapat_id', $id)->delete();
                foreach ($selectedMahasiswa as $nim) {
                    $presensi = new RapatPresensiMahasiswa([
                        'rapat_id' => $rapat->id,
                        'mahasiswa_nim' => $nim,
                        'persentase' => 0, // Default value
                    ]);
                    $presensi->save();

                    Log::info('Presensi updated', ['rapat_id' => $rapat->id, 'mahasiswa_nim' => $nim]);
                }

                RapatPresensiDosen::where('rapat_id', $id)->delete();
                $selectedDosen = $request->input('select_dosen');
                if ($selectedDosen != null) {
                    foreach ($selectedDosen as $nip) {
                        $presensi = new RapatPresensiDosen([
                            'rapat_id' => $rapat->id,
                            'dosen_nip' => $nip,
                            'persentase' => 0, // Default value
                        ]);
                        $presensi->save();
                        Log::info('Presensi created', ['rapat_id' => $rapat->id, 'dosen_nip' => $nip]);
                    }
                }

                $rapatPenyelenggara = RapatPenyelenggara::where('rapat_id', $id)->first();

                if ($request->has('risetName')) {
                    $risetBidang = RisetBidang::where('id', $request->input('risetName'))->first();
                    if ($risetBidang) {
                        $rapatPenyelenggara->riset_bidang_id = $risetBidang->id;
                    }
                }

                if ($request->has('seksiName')) {
                    $seksi = Seksi::where('id', $request->input('seksiName'))->first();
                    if ($seksi) {
                        $rapatPenyelenggara->seksi_id = $seksi->id;
                    }
                }

                if ($request->has('subseksiName')) {
                    $subseksi = Subseksi::where('id', $request->input('subseksiName'))->first();
                    if ($subseksi) {
                        $rapatPenyelenggara->subseksi_id = $subseksi->id;
                    }
                }

                if ($request->has('bagianName')) {
                    $bagian = Bagian::where('id', $request->input('bagianName'))->first();
                    if ($bagian) {
                        $rapatPenyelenggara->bagian_id = $bagian->id;
                    }
                }

                $rapatPenyelenggara->save();
            }

            // Redirect or return a response
            return redirect()->route('dashboard-rapat.index')->with('status.success', 'Rapat berhasil diubah');
        } catch (\Exception $e) {
            // Log the error
            Log::error('Error in rapat updating', ['error' => $e->getMessage()]);

            // Error response
            //return redirect()->route('dashboard-rapat.add')->with('status.error', 'Rapat gagal ditambahkan');
            return redirect()->back()->with('status.error', 'Rapat gagal diubah');
        }
    }

    function exportRapat($id)
    {
        $rapat = Rapat::where('id', $id)->first();
        $rapatMahasiswa = RapatPresensiMahasiswa::where('rapat_id', $id)->get();
        $rapatDosen = RapatPresensiDosen::where('rapat_id', $id)->get();

        // Mahasiswa
        $spreadsheet = new Spreadsheet();
        $sheet1 = $spreadsheet->getActiveSheet();
        $sheet1->setTitle('Mahasiswa');

        $sheet1->setCellValue('A1', 'No');
        $sheet1->setCellValue('B1', 'NIM');
        $sheet1->setCellValue('C1', 'Nama Mahasiswa');
        $sheet1->setCellValue('D1', 'Waktu Presensi 1');
        $sheet1->setCellValue('E1', 'Waktu Presensi 2');
        $sheet1->setCellValue('F1', 'Persentase Kehadiran');

        $row = 2;
        $nomor = 1;

        foreach ($rapatMahasiswa as $rapatMhs) {
            $sheet1->setCellValue('A' . $row, $nomor++);
            $sheet1->setCellValue('B' . $row, $rapatMhs->mahasiswa_nim);
            $sheet1->setCellValue('C' . $row, UserMahasiswa::where('nim', $rapatMhs->mahasiswa_nim)->first()->nama);
            $sheet1->setCellValue('D' . $row, $rapatMhs->waktu_kode_satu);
            $sheet1->setCellValue('E' . $row, $rapatMhs->waktu_kode_dua);
            $sheet1->setCellValue('F' . $row, $rapatMhs->persentase);

            $row++;
        }

        // Dosen
        $sheet2 = $spreadsheet->createSheet();
        $spreadsheet->setActiveSheetIndex(1);
        $sheet2->setTitle('Dosen');

        $sheet2->setCellValue('A1', 'No');
        $sheet2->setCellValue('B1', 'NIP');
        $sheet2->setCellValue('C1', 'Nama Dosen');
        $sheet2->setCellValue('D1', 'Waktu Presensi');
        $sheet2->setCellValue('E1', 'Persentase Kehadiran');

        $row = 2;
        $nomor = 1;

        foreach ($rapatDosen as $rapatDosen) {
            $sheet2->setCellValue('A' . $row, $nomor++);
            $sheet2->setCellValue('B' . $row, $rapatDosen->dosen_nip);
            $sheet2->setCellValue('C' . $row, UserDosen::where('nip', $rapatDosen->dosen_nip)->first()->nama);
            $sheet2->setCellValue('D' . $row, $rapatDosen->waktu_kode_satu);
            $sheet2->setCellValue('E' . $row, $rapatDosen->persentase);

            $row++;
        }

        // Menulis file Excel
        $writer = new Xlsx($spreadsheet);
        $filename = 'Presensi Rapat ' . $rapat->nama_rapat;

        $writer->save($filename);
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filename));
        flush();
        readfile($filename);
        exit;

        return redirect()->back();
    }
}
