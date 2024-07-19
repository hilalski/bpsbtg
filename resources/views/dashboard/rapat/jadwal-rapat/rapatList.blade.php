    {{-- Loop through each attendance record and display its related meeting details --}}
    @foreach ($rapatPresensiRecords as $record)
        <div class="col-sm-6 col-md-6">
            <div class="card info-card border-top
                @if ($record->rapat->waktu_selesai > now())
                    border-primary
                @elseif($record->rapat->waktu_selesai->diffInDays(now('Asia/Jakarta'), false) <= 2)
                    border-success
                @else
                    border-secondary
                @endif
                border-5">
                <div class="card-body">
                    <h5 class="card-title-card-siagau">{{ $record->rapat->nama_rapat }}</h5>

                    @php
                        $kehadiran = $record->persentase !== null ? $record->persentase : 0;
                    @endphp
                    <div id="progress-presensi-rapat-siagau">
                        <div class="progress-outer">
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped"
                                    style="width:{{ $kehadiran }}%; background-color:
                                @if($kehadiran >= 75)
                                    green
                                @elseif($kehadiran < 75 && $kehadiran > 50)
                                    yellow
                                @else
                                    red
                                @endif
                            "></div>
                                <div class="progress-value"><span>{{ $kehadiran }}</span>%</div>
                            </div>
                        </div>
                    </div>

                    <ul id="detail-rapat-card-siagau" class="text-muted list-inline">
                        <li class="list-inline-item">
                            <i class="bi bi-calendar"></i>
                            {{ $record->rapat->tanggal }}
                        </li>
                        <li class="list-inline-item">
                            <i class="bi bi-clock"></i>
                            {{ $record->rapat->formatted_waktu_mulai }} - {{ $record->rapat->formatted_waktu_selesai }}
                        </li>
                        <li class="list-inline-item">
                            <i class="bi bi-map"></i>
                            @if (isset($record->rapat->detail_tempat) && $record->rapat->detail_tempat)
                                {{ $record->rapat->pelaksanaan }} - {{ $record->rapat->detail_tempat }}
                            @else
                                {{ $record->rapat->pelaksanaan }} -
                                @if ($record->rapat->pelaksanaan == "Online")
                                    @switch($record->rapat->tempat->nama_tempat)
                                        @case("Ruang Virtual 1")
                                            @php $zoomUrl = "https://stis-ac-id.zoom.us/j/5456101047?pwd=RFJPQmptd3FLSXhEMFdHeE44ak5adz09"; @endphp
                                            @break
                                        @case("Ruang Virtual 2")
                                            @php $zoomUrl = "https://stis-ac-id.zoom.us/j/9903263737?pwd=UFM4MnU4RzhvSEQrWmdwUUZoRWNmdz09"; @endphp
                                            @break
                                        @case("Ruang Virtual 3")
                                            @php $zoomUrl = "https://stis-ac-id.zoom.us/j/5881160900?pwd=THBjYUlWSG1sTk1RTHZzTVYwelUwdz09"; @endphp
                                            @break
                                        @case("Ruang Virtual 4")
                                            @php $zoomUrl = "https://stis-ac-id.zoom.us/j/4185812554?pwd=MW9UTEVKTHlxcW5hKzBEU1llUEp3Zz09"; @endphp
                                            @break
                                        @case("Ruang Virtual 5")
                                            @php $zoomUrl = "https://stis-ac-id.zoom.us/j/4587533259?pwd=YmR3YThwVjAvU2FqOE8yRForZXVIQT09"; @endphp
                                            @break
                                        @default
                                            @php $zoomUrl = ""; @endphp
                                    @endswitch

                                    <a href="{{ $zoomUrl }}" class="text-secondary zoom-meet">{{ $record->rapat->tempat->nama_tempat }}</a>
                                @else
                                    {{ $record->rapat->tempat->nama_tempat }}
                                @endif
                            @endif

                        </li>
                    </ul>
                    <div id="button-action-rapat-card-siagau" class="mb-2">
                        <a href="{{ route('jadwal-rapat.izin', ['id_rapat' => $record->rapat_id]) }}" class="badge btn btn-warning mr-2 text-dark" role="button">
                            <i class="fa-solid fa-circle-exclamation mr-2"></i> Izin
                        </a>
                        @if ($record->rapat->notulensi)
                        <a href="{{ route('notula.show', ['id' => $record->rapat_id]) }}" class="badge btn btn-success mr-2">
                            <i class="fa fa-check mr-2" role="button"></i> Notula
                        </a>
                        @else
                        <div class="badge btn btn-danger mr-2">
                            <i class="fa fa-times mr-2"></i> Notula
                        </div>
                        @endif
                        <a href="{{ route('jadwal-rapat.detail', ['id' => $record->rapat_id]) }}" class="badge btn btn-primary mr-2">
                            <i class="fa-solid fa-circle-info" role="button"></i> Detail
                        </a>
                    </div>
                    {{-- Other details and actions for the meeting can be added here --}}
                </div>
            </div>
        </div>
    @endforeach

    {{-- Check if there are no attendance records to display --}}
    @if($rapatPresensiRecords->isEmpty())
        <div id="norapat">
            <h6 class="text-center text-muted font-italic">Belum ada jadwal rapat terkini</h6>
            <div class="row d-flex justify-content-center">
                <img id="norapatpict" src="{{ asset('assets/img/dashboard/kosong.png') }}" alt="Tidak ada rapat" class="w-25">
            </div>
        </div>
    @endif

    <script>


        // $(document).ready(function() {
        //     var options = {
        //         html: true,
        //         //html element
        //         //content: $("#popover-content")
        //         content: $('[data-name="popover-content"]')
        //         //Doing below won't work. Shows title only
        //         //content: $("#popover-content").html()

        //     }
        //     // var exampleEl = document.getElementById('example')
        //     // var popover = new bootstrap.Popover(exampleEl, options)
        //     var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
        //     var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
        //         return new bootstrap.Popover(popoverTriggerEl)
        //     })
        // })

        // $(document).ready(function() {
        //     var options = {
        //         html: true,
        //         content: function () {
        //             return $('[data-name="popover-content"]').html();
        //         }
        //     }

        //     var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
        //     var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
        //         return new bootstrap.Popover(popoverTriggerEl, options)
        //     })
        // })

        // set hover warna
        $(document).ready(function () {
            $('.zoom-meet').hover(
                function () {
                    $(this).css('color', 'blue');
                },
                function () {
                    $(this).css('color', '');
                }
            );
        });

    </script>
