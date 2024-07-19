<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\UndanganRapat;
use App\Mail\PerubahanJadwalRapat;

class HomeController extends Controller{
/*    protected $rapat_model;
    public function __construct(Rapat $rapat_model){
        $this->rapat_model = $rapat_model;
    }

    public function update_absensi($id_rapat){
        $rules = [
            'persentase' => 'required|numeric|max:100',
        ];
        $this->validate(request(), $rules);
        $id_peserta = request('id-peserta');
        $persentase = request('persentase');
        $this->rapat_model->update_absensi($id_peserta, $id_rapat, $persentase);
        session()->flash("informasi", '<script>swal("SUKSES!","Sukses mengunggah absensi","success")</script>');
        return redirect()->to('sikoko/rapat/view/' . $id_rapat);
    }

    public function notula($id_rapat){
        $rapat = $this->rapat_model->findOrFail($id_rapat);
        return view('sikoko.rapat.rapat-notula', compact('rapat'));
    }

    public function upload_notula($id_rapat){
        $rules = [
            'notula' => 'required|file|max:10240|mimes:pdf',
        ];

        $this->validate(request(), $rules);
        $file = request()->file('notula');
        $fileName = $file->storeAs('notula', $file->getClientOriginalName());
        $this->rapat_model->update_rapat_notula($id_rapat, ['link_notulensi' => $fileName]);
        session()->flash("msg-notula", "<script>swal('SUKSES!','Sukses mengunggah notula','success')</script>");
        return redirect()->to('sikoko/rapat/notula/' . $id_rapat);
    }

    public function delete_notula($id_rapat)
    {
        $rapat = $this->rapat_model->findOrFail($id_rapat);
        if ($rapat->link_notulensi) {
            Storage::delete($rapat->link_notulensi);
        }
        $this->rapat_model->update_rapat_notula($id_rapat, ['link_notulensi' => null]);
        session()->flash("msg-notula", "<script>swal('SUKSES!','Sukses menghapus notula','success')</script>");
        return redirect()->to('sikoko/rapat/notula/' . $id_rapat);
    }
*/

    public function akhiri_rapat($id_rapat){
        $this->rapat_model->akhiri_rapat($id_rapat);
        session()->flash("informasi", "<script>swal('SUKSES!','Sukses mengakhiri rapat','success')</script>");
        return redirect()->to('sikoko/rapat/dashboard');
    }

    public function send_email_to_rapat_participant($id_rapat){
        $rapat = $this->rapat_model->findOrFail($id_rapat);
        $peserta = $this->rapat_model->get_peserta_rapat($id_rapat);
        $email_peserta = $peserta->pluck('email')->toArray();
        $email = new UndanganRapat($rapat);
        if (count($email_peserta) > 500) {
            $email_group = ["kelas-3si1@stis.ac.id", "kelas-3si2@stis.ac.id", "kelas-3si3@stis.ac.id", "kelas-3sd1@stis.ac.id", "kelas-3sd2@stis.ac.id", "kelas-3se1@stis.ac.id", "kelas-3se2@stis.ac.id", "kelas-3se3@stis.ac.id", "kelas-3se4@stis.ac.id", "kelas-3se5@stis.ac.id", "kelas-3sk1@stis.ac.id", "kelas-3sk2@stis.ac.id", "kelas-3sk3@stis.ac.id", "kelas-3sk4@stis.ac.id", "kelas-3sk5@stis.ac.id"]; // Array of email addresses for large groups
            Mail::to($email_group)->send($email);
        } else {
            Mail::to($email_peserta)->send($email);
        }

        session()->flash("informasi", "<script>swal('SUKSES!','Sukses mengirim undangan','success')</script>");
        return redirect()->to('sikoko/rapat/dashboard');
    }

    public function send_email_perubahan($id_rapat){
        $rapat = $this->rapat_model->findOrFail($id_rapat);
        $peserta = $this->rapat_model->get_peserta_rapat($id_rapat);
        $email_peserta = $peserta->pluck('email')->toArray();
        $email = new PerubahanJadwalRapat($rapat);

        if (count($email_peserta) > 500) {
            $email_group = ["kelas-3si1@stis.ac.id", "kelas-3si2@stis.ac.id", "kelas-3si3@stis.ac.id", "kelas-3sd1@stis.ac.id", "kelas-3sd2@stis.ac.id", "kelas-3se1@stis.ac.id", "kelas-3se2@stis.ac.id", "kelas-3se3@stis.ac.id", "kelas-3se4@stis.ac.id", "kelas-3se5@stis.ac.id", "kelas-3sk1@stis.ac.id", "kelas-3sk2@stis.ac.id", "kelas-3sk3@stis.ac.id", "kelas-3sk4@stis.ac.id", "kelas-3sk5@stis.ac.id"]; // Array of email addresses for large groups
            Mail::to($email_group)->send($email);
        } else {
            Mail::to($email_peserta)->send($email);
        }

        session()->flash("informasi", "<script>swal('SUKSES!','Sukses mengirim perubahan jadwal','success')</script>");
        return redirect()->to('sikoko/rapat/dashboard');
    }
}

