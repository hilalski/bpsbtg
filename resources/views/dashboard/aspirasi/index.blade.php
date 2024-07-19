<x-dashboard.layouts.layouts :menu="$menu">
    <x-slot name="css">
    </x-slot>

    <x-slot name="js_head">
    </x-slot>
    
    <section class="section dashboard">
      <x-card.card grid='small' judul='Form Aspirasi' desc='Sampaikan Aspirasi dan Keluh Kesahmu disini'>
        <div class="text-center container-fluid"><img src="{{ asset('assets/img/dashboard/duduk.png') }}" alt="" class="img-fluid" style="max-width: 25%; min-width: 240px;"></div>

        <div class="card-body p-4">
          <form action="{{ route('aspirasi.store') }}" method="POST" class="col-12">
            @csrf
            @method('POST')

            <div class="form-group row">
                <label for="pengirim" class="col-sm-2 col-form-label fw-bold">Nama Pengirim</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="pengirim" name="pengirim" placeholder="Boleh nama samaran atau dikosongkan" value="{{ old('pengirim') }}" autofocus>
                </div>
            </div>
            <br>
            <div class="form-group row mb-3">
                <label for="isi" class="col-sm-2 col-form-label fw-bold">Isi</label>
                <div class="col-sm-10">
                    <textarea type="text" class="form-control @error('isi') is-invalid @enderror" id="isi" name="isi" required placeholder="sampaikan unek-unek mu hehe :)">{{ old('isi') }}</textarea>
                    <div class="invalid-feedback">
                        @error('isi')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>


            <div class="form-group text-end">
                <button type="submit" class="btn btn-primary float-right btn-aspirasi">
                    Kirim
                </button>
            </div>
        </form>
      </div>
      </x-card.card>

    </section>

    <x-slot name="js_body">
        <script>
            $(document).ready(function() {
                $('.btn-aspirasi').on('click', function(e) {
                    e.preventDefault();
                    var form = $(this).closest('form');
            
                    Swal.fire({
                        title: "Apakah kamu yakin?",
                        text: "Periksa kembali aspirasi yang kamu sampaikan",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Ya, sampaikan!",
                        cancelButtonText: "Kembali"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        </script>
    </x-slot>
</x-dashboard.layouts.layouts>