<?php

namespace App\Livewire\Websites;

use Illuminate\Contracts\View\View;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;

    #[Url]
    public int $pagination = 10;

    public function render(): View
    {
        return view(
            'livewire.websites.table',
            [
                'websites' => auth()->user()?->websites()->simplePaginate($this->pagination),
            ]
        );
    }
}
