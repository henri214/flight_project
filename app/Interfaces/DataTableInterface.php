<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface DataTableInterface
{
    public function getAll(Request $request);
    public function dataTable($data);
}
