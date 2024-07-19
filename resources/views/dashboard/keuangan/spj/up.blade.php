<button type="button" class="btn btn-success m-1" @if($spj->status !== 'Menunggu Persetujuan') disabled @endif data-bs-toggle="modal" data-bs-target="#setujuispj">
    Setujui
  </button>

  <div class="modal fade" id="setujui" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Setujui Pengajuan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Apakah Anda yakin untuk menyetujui pengajuan ini?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
          <form method="post" action="{{ url('/setujui-spj/' . $spj->id) }}">
            @csrf
            <input
            type="hidden"
            class="form-control"
            value="Menunggu Pencairan Dana"
            readonly
            name="status"
          />
          <button type="submit" class="btn btn-success m-1">
            Setujui
          </button>
        </form>
        </div>
      </div>
    </div>
  </div>