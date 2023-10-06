<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use App\Services\PageService;
use App\Http\Requests\PageRequest;

class PageController extends Controller
{
    public function index(Request $request)
    {
        try {
            $service = new PageService();
            return $service->getAll($request);
        } catch (\Throwable $th) {
            return back()->withError($th->getMessage())->withInput();
        }
    }
    public function create()
    {
        try {
            return view('admin.pages.create');
        } catch (\Throwable $th) {
            return back()->withError($th->getMessage())->withInput();
        }
    }
    public function store(PageRequest $request)
    {
        try {
            Page::create($request->validated());
            return redirect()->route('pages.index')->with('success', 'Page created');
        } catch (\Throwable $th) {
            return back()->withError($th->getMessage())->withInput();
        }
    }
    public function show(Page $page)
    {
        try {
            return view('admin.pages.show', compact('page'));
        } catch (\Throwable $th) {
            return back()->withError($th->getMessage())->withInput();
        }
    }
    public function edit(Page $page)
    {
        try {
            return view('admin.pages.edit', compact('page'));
        } catch (\Throwable $th) {
            return back()->withError($th->getMessage())->withInput();
        }
    }
    public function update(Page $page, PageRequest $request)
    {
        try {
            $page->update($request->validated());
            return redirect()->route('pages.index')->with('success', 'Page updated');
        } catch (\Throwable $th) {
            return back()->withError($th->getMessage())->withInput();
        }
    }
    public function destroy(Page $page)
    {
        try {
            $page->delete();
            return redirect()->route('pages.index')->with('success', 'Page deleted');
        } catch (\Throwable $th) {
            return back()->withError($th->getMessage())->withInput();
        }
    }

    public function restore($page)
    {
        try {
            Page::withTrashed()->findOrFail($page)->restore();
            return redirect()->back()->with('success', 'Page restored');
        } catch (\Throwable $th) {
            return back()->withError($th->getMessage())->withInput();
        }
    }
}
