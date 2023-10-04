<?php

namespace App\Http\Controllers;

use App\Http\Requests\PageRequest;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        try {
            $pages = Page::withTrashed()->paginate(10);
            return view('admin.pages.index', compact('pages'));
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
            return redirect()->route('pages.index')->with('message', 'Page created');
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
            return redirect()->route('pages.index')->with('message', 'Page updated');
        } catch (\Throwable $th) {
            return back()->withError($th->getMessage())->withInput();
        }
    }
    public function destroy(Page $page)
    {
        try {
            $page->delete();
            return redirect()->route('pages.index')->with('message', 'Page deleted');
        } catch (\Throwable $th) {
            return back()->withError($th->getMessage())->withInput();
        }
    }
    public function restore($page)
    {
        try {
            Page::withTrashed()->findOrFail($page)->restore();
            return redirect()->back()->with('message', 'Page restored');
        } catch (\Throwable $th) {
            return back()->withError($th->getMessage())->withInput();
        }
    }
}
