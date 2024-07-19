@props(['idTable'])

<div class="card-block container-fluid">
    <div id="izin-container-sesuai">
        <div class="dt-responsive table-responsive">
            <table id="{{ $idTable }}" class="table table-bordered nowrap hover" style="overflow: auto;">
                <thead>
                    <tr>
                        @foreach($headers as $header)
                            <th class="{{ $header['classes'] }}">{{ $header['name'] }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    {{ $slot }}
                </tbody>
            </table>
        </div>
    </div>
</div>
