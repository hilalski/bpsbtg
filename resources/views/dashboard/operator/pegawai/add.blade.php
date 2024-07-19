<x-dashboard.layouts.layouts :menu="$menu">
    <x-slot name="css">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/dashboard/main.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/form-bau.css') }}">
    </x-slot>

    <x-slot name="js_head">
    </x-slot>

    <section class="section draft-pengajuan">
        <div class="">
            <div class="row">
                <div class="col-lg-12">
                  <div class="card">
                    <div class="card-body">
                      <h5 class="card-title fw-bold fs-3 text-center">Form Pembuatan Akun Pegawai</h5>
                      <br>

                      <!-- General Form Elements -->
                      <form class="font-form fw-bold" action="{{ route('operator.pegawai.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row mb-3">
                          <label for="name" class="col-sm-2 col-form-label">Nama Pegawai</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" id="name" />
                          </div>
                        </div>

                        <div class="row mb-3">
                          <label for="nip" class="col-sm-2 col-form-label">NIP</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" name="nip" id="nip" />
                          </div>
                        </div>
                        
                        <div class="row mb-3">
                          <label for="email" class="col-sm-2 col-form-label">Email</label>
                          <div class="col-sm-10">
                            <input type="email" class="form-control" name="email" id="email" />
                          </div>
                        </div>

                        <div class="row mb-3">
                          <label for="address" class="col-sm-2 col-form-label">Alamat</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" name="address" id="address" />
                          </div>
                        </div>

                        <div class="row mb-3">
                          <label for="password" class="col-sm-2 col-form-label">Password</label>
                          <div class="col-sm-10">
                            <input type="password" class="form-control" name="password"
                            id="password"/>
                          </div>
                        </div>

                        <div class="row mb-3">
                          <label for="confirmpassword" class="col-sm-2 col-form-label">Konfirmasi Password</label>
                          <div class="col-sm-10">
                            <input type="password" class="form-control"
                            name="confirmpassword" id="confirmpassword" />
                          </div>
                        </div>

                        <div class="row mb-3">
                            <label for="picture" class="col-sm-2 col-form-label">Gambar</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" name="picture" id="picture" accept=".jpg, .jpeg, .png">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="role" class="col-sm-2 col-form-label">Jabatan</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="role" id="role">
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                          </div>
  

                        <div class="row mb-3">
                          <label for="inputRolePegawai" class="col-sm-2 col-form-label">Role</label>
                          <div class="col-sm-10 d-inline-flex fw-normal">
                            @foreach ($roles as $role)
                              <div class="me-5">
                                <input type="checkbox" name="{{ $role->name }}" id="role{{ $loop->iteration }}" value="{{ $role->name }}">
                                <label for="role{{ $loop->iteration }}"> {{ $role->name }}</label>
                              </div>
                            @endforeach            
                          </div>
                        </div>

                        <div class="row mb-3">
                            <div class="text-end">
                            <button type="button" class="btn btn-danger" onclick="window.location.href='{{route('operator.pegawai.index')}}'">Batal</button>
                            <button type="submit" class="btn btn-primary">Kirim</button>
                            </div>
                        </div>
                        </form>
                      <!-- End General Form Elements -->
                    </div>
                  </div>
                </div>
              </div>
        </div>

      </section>

    <x-slot name="js_body">
    </x-slot>
</x-dashboard.layouts.layouts>
