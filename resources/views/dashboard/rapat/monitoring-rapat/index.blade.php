<x-dashboard.layouts.layouts :menu="$menu">
    <x-slot name="css">
        <style>
            .zoom-meet:hover {
                color: blue !important;
            }
        </style>
    </x-slot>

    <x-slot name="js_head">
        <!-- Custom JavaScript for head if any -->
    </x-slot>

    <section class="section dashboard">
        <x-card.card grid='small' >
            @if(is_null($rapat))
                <div id="norapat">
                    <h6 class='text-center text-muted font-italic'>Belum ada jadwal rapat terkini</h6>
                    <div class='row'>
                        <img id='norapatpict' src='{{ asset("assets/img/home/maintenance.gif") }}' alt='Tidak ada rapat..' srcset=''>
                    </div>
                </div>
            @else
                {{-- search rapat --}}
                <div class="d-flex flex-wrap justify-content-between mt-2">
                    <div class="ml-auto d-flex align-items-center justify-content-left mx-4 my-3">
                        <label class="mx-2" for="search">
                            <strong>Pencarian: </strong>
                        </label>
                        <input class="form-control" type="text" id="searchInput" name="search" placeholder="Pencarian">
                    </div>
                    <div class="dropdown ml-auto d-flex align-items-center justify-content-left mx-4 my-2">
                        <button class="btn btn-primary dropdown-toggle" type="button" id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            Semua
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="filterDropdown">
                            <li><a class="dropdown-item filter-option" href="#" data-filter="all">Semua</a></li>
                            <li><a class="dropdown-item filter-option" href="#" data-filter="upcoming">Akan Datang</a></li>
                            <li><a class="dropdown-item filter-option" href="#" data-filter="ongoing">Sedang Berlangsung</a></li>
                            <li><a class="dropdown-item filter-option" href="#" data-filter="completed">Sudah Selesai</a></li>
                        </ul>
                    </div>
                </div>

                <div class="row p-3" id="rapatList">
                    {{-- list rapat --}}
                    @foreach ($rapat as $r)
                        <div class="col-sm-6 col-md-6">
                            <div class="card info-card border-top {{ $r->borderClass }} border-5" data-date="{{ $r->hari_tanggal }}" data-start-time="{{ $r->waktu_mulai->format('H:i') }}" data-end-time="{{ $r->waktu_selesai->format('H:i') }}">
                                <div class="card-body">
                                    {{-- detail pelaksanaan rapat --}}
                                    <div class="card-body">
                                        <h5 class="card-title-card-siagau">{{ $r->nama_rapat }}</h5>
                                        <ul id="detail-rapat-card-siagau" class="text-muted list-inline">
                                            <li class="list-inline-item">
                                                <i class="bi bi-calendar"></i>
                                                {{ $r->hari_tanggal }}
                                            </li>
                                            <li class="list-inline-item">
                                                <i class="bi bi-clock"></i>
                                                {{ $r->waktu_mulai->format('H:i') }} - {{ $r->waktu_selesai->format('H:i') }}
                                            </li>
                                            <li class="list-inline-item">
                                                <i class="bi bi-map"></i>
                                                @if(empty($r->detail_tempat))
                                                    {{ $r->pelaksanaan }} - {{ $r->nama_tempat ?? $r->tempat_id }}
                                                @else
                                                    {{ $r->pelaksanaan }} -
                                                    @if ($r->pelaksanaan == "Online")
                                                        @switch($r->nama_tempat)
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

                                                        <a href="{{ $zoomUrl }}" class="text-secondary zoom-meet">{{ $r->nama_tempat }}</a>
                                                    @else
                                                        {{ $r->nama_tempat }}
                                                    @endif
                                                @endif
                                            </li>
                                        </ul>
                                        <!-- Notula Links and other content -->
                                    </div>

                                    {{-- tombol action bawah --}}
                                    <div id="button-action-rapat-card-siagau" class="mb-2">
                                        <!-- Buttons and badges here -->
                                        @if ($r->notulensi)
                                        {{-- ini harusnya ganti route langsung download hasil rapatnya --}}
                                            <a href="{{ route('notula.show', ['id' => $r->id]) }}" class="badge bg-success mr-2">
                                                <i class="fa fa-check mr-2"></i> Notula
                                            </a>
                                        @else
                                            <div class="badge bg-danger mr-2">
                                                <i class="fa fa-times mr-2"></i> Notula
                                            </div>
                                        @endif
                                        <a href="{{ route('monitoring-rapat.detail', $r->id) }}" class="badge bg-primary mr-2">
                                            <i class="bi bi-card-list"></i> Detail
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
        </x-card.card>
    </section>

    <x-slot name="js_body">
        <script type="text/javascript">
            $(document).ready(function () {
                // Variabel untuk menyimpan status filter yang aktif
                var activeFilter = 'all';

                function applySearchFilter(searchValue) {
                    $('#rapatList .col-sm-6.col-md-6').each(function () {
                        var isVisible = $(this).find('.card').text().toLowerCase().indexOf(searchValue) > -1;
                        $(this).toggleClass('d-none', !isVisible);
                    });
                }

                // Fungsi untuk memfilter dan menyortir ulang kartu
                function filterAndSort() {
                    var filter = activeFilter;
                    var selectedOptionText = $('#filterDropdown').text();
                    var now = moment();
                    var cards = [];

                    // Menunjukkan semua kartu sebelum memfilter
                    $('#rapatList .col-sm-6.col-md-6').show();

                    $('#rapatList .col-sm-6.col-md-6').each(function () {
                        var card = $(this).find('.card');
                        var cardDate = moment(card.data('date'), 'DD-MM-YYYY');
                        var startTime = moment(cardDate.format('YYYY-MM-DD') + ' ' + card.data('start-time'), 'YYYY-MM-DD H:mm');
                        var endTime = moment(cardDate.format('YYYY-MM-DD') + ' ' + card.data('end-time'), 'YYYY-MM-DD H:mm');

                        var shouldShow = false;
                        if (filter === 'all') {
                            shouldShow = true;
                        } else if (filter === 'upcoming') {
                            shouldShow = startTime > now;
                        } else if (filter === 'ongoing') {
                            shouldShow = startTime <= now && now <= endTime;
                        } else if (filter === 'completed') {
                            shouldShow = now >= endTime;
                        }

                        if (shouldShow) {
                            cards.push(this); // Push the whole .col-sm-6.col-md-6 element
                        }
                    });

                    // Sort cards based on date and time in descending order
                    cards.sort(function(a, b) {
                        var aDate = moment($(a).find('.card').data('date'), 'DD-MM-YYYY');
                        var bDate = moment($(b).find('.card').data('date'), 'DD-MM-YYYY');
                        var aTime = moment(aDate.format('YYYY-MM-DD') + ' ' + $(a).find('.card').data('start-time'), 'YYYY-MM-DD H:mm');
                        var bTime = moment(bDate.format('YYYY-MM-DD') + ' ' + $(b).find('.card').data('start-time'), 'YYYY-MM-DD H:mm');
                        return bTime - aTime; // Change aTime - bTime to bTime - aTime for descending order
                    });

                    // Sembunyikan semua kartu sebelum menyortir ulang
                    $('#rapatList .col-sm-6.col-md-6').hide();

                    // Tampilkan kartu yang sudah diurutkan
                    $.each(cards, function(i, card) {
                        $(card).show();
                    });

                    // Scroll to the first card
                    if (cards.length) {
                        $('html, body').animate({
                            scrollTop: $(cards[0]).offset().top
                        }, 500);
                    }
                }

                // Event handler untuk filter dropdown
                $('.filter-option').on('click', function (e) {
                    e.preventDefault();
                    var newFilter = $(this).data('filter');
                    var selectedOptionText = $(this).text();

                    // Hanya memproses filter jika filter yang dipilih tidak sama dengan filter yang aktif
                    if (newFilter !== activeFilter) {
                        activeFilter = newFilter;
                        $('#filterDropdown').text(selectedOptionText);

                        // Memanggil fungsi filterAndSort untuk menerapkan filter dan pengurutan
                        filterAndSort();
                    }
                });

                // Event handler untuk input pencarian
                $('#searchInput').on('keyup', function () {
                    var value = $(this).val().toLowerCase();
                    applySearchFilter(value);
                });
            });
        </script>

    </x-slot>
</x-dashboard.layouts.layouts>
