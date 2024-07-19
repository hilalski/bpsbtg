<?php

namespace App\Http\Controllers\Dashboard\Rapat;

use App\Models\RapatPresensiDosen;
use Exception;
use Carbon\Carbon;
use App\Models\Menu;
use App\Models\Rapat;
use App\Models\Seksi;
use App\Models\Bagian;
use App\Models\Tempat;
use App\Models\Subseksi;
use App\Models\RisetBidang;
use Illuminate\Http\Request;
use App\Models\UserMahasiswa;
use App\Models\RapatPenyelenggara;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\RapatPresensiMahasiswa;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Stmt\TryCatch;

class AnselController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
            function generateRandomCodeRapat($length)
            {
                $alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890';
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
                $ketua_rapat_nim = UserMahasiswa::where('jabatan_bidang_id', 'JM14')->first();
            } elseif ($jabatanUser === 'JM18' || $jabatanUser === 'JM19') {
                $ketua_rapat_nim = UserMahasiswa::where('jabatan_bidang_id', 'JM17')->where('seksi_bidang_id', $user->seksi_bidang_id)->first();
            }

            $ketua_rapat_nim = $ketua_rapat_nim->nim;


            $rapat = new Rapat;
            $rapat->id = generateRandomCodeRapat(10);
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
            Log::info('Rapat created successfully', ['rapat_id' => $rapat->id]);

            if ($rapat->save()) {
                // Retrieve selected mahasiswa NIMs from the request
                $selectedMahasiswa = $request->input('select_mahasiswa'); // Make sure this is the name of your select input
                $selectedDosen = $request->input('select_dosen'); // Make sure this is the name of your select input

                // Loop through each mahasiswa NIM and create RapatPresensiMahasiswa entries
                foreach ($selectedMahasiswa as $nim) {
                    $presensi = new RapatPresensiMahasiswa([
                        'rapat_id' => $rapat->id,
                        'mahasiswa_nim' => $nim,
                        'persentase' => 0, // Default value
                    ]);
                    $presensi->save();
                    Log::info('Presensi created', ['rapat_id' => $rapat->id, 'mahasiswa_nim' => $nim]);
                }

                // Loop through each dosen NIP and create RapatPresensiDosen entries
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

                $rapatPenyelenggara = new RapatPenyelenggara([
                    'rapat_id' => $rapat->id,
                ]);

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
        } catch (\Exception $e) {
            // Log the error
            Log::error('Error in rapat creation', ['error' => $e->getMessage()]);

            // Error response
            //return redirect()->route('dashboard-rapat.add')->with('status.error', 'Rapat gagal ditambahkan');
            return redirect()->back()->with('status.error', 'Rapat gagal ditambahkan');
        }
        return redirect()->route('dashboard-rapat.index')->with('status.success', 'Rapat berhasil ditambahkan');
    }

    public function tambahOptionTempat(Request $request)
    {
        $pelaksanaan = $request->input('pelaksanaan');

        // Assuming 'Tempat' is your model name and you have appropriate data in the database
        try {
            if ($pelaksanaan === 'Online') {
                $tempatOptions = Tempat::where('id', 'like', 'ON%')->get();
            } elseif ($pelaksanaan === 'Offline') {
                $tempatOptions = Tempat::where('id', 'like', 'OF%')->get();
            }
            return response()->json(['tempatOptions' => $tempatOptions]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Invalid pelaksanaan value']);
        }
    }
}
