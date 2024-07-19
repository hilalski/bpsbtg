<x-dashboard.layouts.layouts :menu="$menu">
    <x-slot name="css">
        <style>
            #simpletable thead th, #simpletable2 thead th, #simpletable3 thead th {
                background-color: #666;
                color: white;
            }

            .dataTables_length, .dataTables_filter, .dataTables_info, .dataTables_paginate {
                margin: 15px
            }

            .zoom-meet:hover {
                color: blue !important;
            }

            .progress-title {
        font-size: 10px;
        font-weight: 700;
        color: #000;
        margin: 0 0 5px; /* Adjust the bottom margin */
    }

    .progress-outer {
        background: #fff;
        padding: 3px 8px 3px 3px; /* Adjust padding */
        border: 3px solid #bebfbf;
        border-radius: 25px; /* Adjust the border-radius */
        margin-bottom: 10px; /* Adjust the bottom margin */
        position: relative;
    }

    .progress {
        background: #bebfbf;
        border-radius: 8px; /* Adjust the border-radius */
        margin: 0;
        height: 12px; /* Adjust the height */
    }

    .progress .progress-bar {
        border-radius: 8px; /* Adjust the border-radius */
        box-shadow: none;
        animation: animate-positive 2s;
        height: 100%; /* Set the height of the progress bar to 100% */
    }

    .progress .progress-value {
        font-size: 12px; /* Adjust the font size */
        font-weight: 700;
        color: var(--branding-base-color);
        position: absolute;
        top: 0px;
        right: 15px; /* Adjust the right margin */
    }

    @keyframes animate-positive {
        0% {
            width: 0;
        }
    }

        </style>
    </x-slot>

    <x-slot name="js_head"></x-slot>

    <section class="section dashboard">
        <!-- Pop-up detail rapat -->
        <div class="modal fade" id="detailModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <!-- ... Modal content ... -->
        </div>

        <!-- Jadwal Rapat Pribadi Masing-masing Mahasiswa -->
        <x-card.card grid="small" >

            <div class="d-flex flex-wrap justify-content-between mt-2">
                <!-- Filter Dropdown -->
                <div class="ml-auto d-flex align-items-center justify-content-left mx-4 my-3">
                    <span class="flex-shrink-0 mx-2"><strong>Filter rapat: </strong></span>
                    <select id="select" name="select" class="form-control form-control-primary">
                        <option value="terkini">Terkini</option>
                        <option value="semua">Semua</option>
                    </select>
                </div>
                <!-- Search Input -->
                <div class="ml-auto d-flex align-items-center justify-content-right mx-4 my-3">
                    <label class="mx-2" for="searchQuery"><strong>Pencarian: </strong></label>
                    <input type="text" id="searchQuery" placeholder="Pencarian" class="form-control">
                </div>
            </div>

            <div class="row p-3" id="rapatContent">

            </div>
        </x-card.card>

    </section>

    {{-- Script coba lihat di sikoko 62, ada beberapa logic untuk pindah ke form izin, ngatur tampilan ga ada rapat, load rapat, filter rapat, dan formating date --}}
    <x-slot name="js_body">
        <script>
        $(document).ready(function(){
            $('.progress-value > span').each(function(){
                $(this).prop('Counter',0).animate({
                    Counter: $(this).text()
                },{
                    duration: 1500,
                    easing: 'swing',
                    step: function (now){
                        $(this).text(Math.ceil(now));
                    }
                });
            });
        });

        $(document).ready(function() {
            // Search and Filter Handler
            $('#select, #searchQuery').on('change keyup', function() {
                var filter = $('#select').val();
                var searchQuery = $('#searchQuery').val();
                fetchRapatData(filter, searchQuery);
            });
            // AJAX Request to Fetch Data
            function fetchRapatData(filter, searchQuery) {
                $.ajax({
                    url: "{{ route('jadwal-rapat.fetch') }}",
                    method: 'GET',
                    data: {
                        filter: filter,
                        search: searchQuery
                    },
                    dataType: 'json',
                    success: function(data) {
                        $('#rapatContent').html(data.html);
                    }
                });
            }

            fetchRapatData($('#select').val(), $('#searchQuery').val());
        });


    </script>
    </x-slot>
</x-dashboard.layouts.layouts>
