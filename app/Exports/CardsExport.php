<?php

namespace App\Exports;
// use App\User;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CardsExport implements FromCollection, WithHeadings
{
    use Exportable;

    public $cards;

    public function __construct(array $cards)
    {
        $this->cards = $cards;
    }

    public function collection()
    {
        return collect([$this->cards]);
    }

    public function headings(): array
    {
        return [
            'Card Numbers',
            'Value'
        ];
    }
}
