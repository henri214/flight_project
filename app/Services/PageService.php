<?php

namespace App\Services;

use App\Models\Page;
use Illuminate\Http\Request;
use App\Interfaces\DataTableInterface;
use Yajra\DataTables\Facades\DataTables;

class PageService implements DataTableInterface
{
    public function getAll(Request $request)
    {
        if ($request->ajax()) {
            $data = Page::withTrashed()->get();
            return $this->dataTable($data);
        }

        return view('admin.pages.index');
    }
    public function dataTable($data)
    {
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($page) {
                if ($page->deleted_at == null) {
                    return view('components.form.form-action', ['item' => 'page', 'value' => $page]);
                } else {
                    return view('components.form.form-restore', ['item' => 'page', 'value' => $page]);
                }
            })
            ->addColumn('allUsers', function ($page) {
                return $page->users->count();
            })
            ->addColumn('bookings', function ($page) {
                return $page->bookings->count();
            })
            ->rawColumns(['action', 'allUsers', 'bookings'])
            ->make(true);
    }
}
