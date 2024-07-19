<?php

namespace App\View\Components\Table;

use Illuminate\View\Component;

class Table extends Component
{
    public array $headers;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(array $headers)
    { 
        // dd($this->formatHeader($headers));
        $this -> headers = $this -> formatHeader($headers);
    }

    private function formatHeader(array $headers): array
    {
        // dd($headers)
        return array_map(function ($header){
            $name = is_array($header) ? $header['name'] : $header;

            return[
                'name' => $name,
                'classes' => $this->alignText($header['align'] ?? 'left'),
            ];
        }, $headers);
    }

    private function alignText($align): string
    {
        return[
            'left' => 'text-left',
            'right' => 'text-right',
            'center' => 'text-center'
        ][$align] ?? 'text-left';

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.table.table');
    }
}
