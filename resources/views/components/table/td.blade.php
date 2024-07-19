@props(['align' => 'left'])

@php
    $textAlign = [
        'left' => 'text-left',
        'right' => 'text-right',
        'center' => 'text-center'
    ][$align] ?? 'text-left';
    
@endphp

<td class="px-2 {{ $textAlign }}">
    {{ $slot }}
</td>
