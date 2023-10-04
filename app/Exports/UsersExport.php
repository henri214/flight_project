<?php

namespace App\Exports;

use App\Models\User;
use Carbon\Traits\Date;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class UsersExport implements FromCollection, WithHeadings, WithMapping, WithEvents, ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return User::all();
    }
    public function map($user): array
    {
        return [
            $user->id,
            $user->username,
            $user->email,
            $user->image,
            $user->gender,
            $user->phone,
            $user->age,
            $user->page?->name,
        ];
    }
    public function headings(): array
    {
        return [
            'Id',
            'Username',
            'Email',
            'Image',
            'Gender',
            'Phone',
            'Birthday',
            'Page Name',
        ];
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function (AfterSheet $event) {
                $styleHeader = [
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => 'thin',
                            'color' => ['rgb' => '808080']
                        ],
                    ]
                ];
                $styleOutline = [
                    'borders' => [
                        'outline' => [
                            'borderStyle' => 'thick',
                            'color' => ['argb' => '808080 '],
                        ],
                    ]
                ];
                $event->sheet->getStyle("A2:H26")->applyFromArray($styleOutline);
                $event->sheet->getStyle("A1:H1")->applyFromArray($styleHeader);
            }
        ];
    }
}
