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
                    return view('includes.pages-actions', ['item' => 'page', 'value' => $page]);
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
            ->editColumn('deleted_at', function ($page) {
                $deleted = $page->deleted_at;
                return $deleted === null ? '---' : $deleted->diffForHumans();
            })
            ->rawColumns(['action', 'allUsers', 'bookings'])
            ->make(true);
    }
}
