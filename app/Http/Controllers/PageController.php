<?php

namespace App\Http\Controllers;

use App\Http\Requests\PageRequest;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::paginate(10);
        return view('admin.pages.index', compact('pages'));
    }
    public function create()
    {
        return view('admin.pages.create');
    }
    public function store(PageRequest $request)
    {
        Page::create($request->validated());
        return redirect()->route('pages.index')->with('message', 'Page created');
    }
    public function show(Page $page)
    {
        return view('admin.pages.show', compact('page'));
    }
    public function edit(Page $page)
    {
        return view('admin.pages.edit', compact('page'));
    }
    public function update(Page $page, PageRequest $request)
    {
        $page->update($request->validated());
        $page->save();
        return redirect()->route('pages.index')->with('message', 'Page updated');
    }
    public function destroy(Page $page)
    {
        $page->delete();
        return redirect()->route('pages.index')->with('message', 'Page deleted');
    }
}
