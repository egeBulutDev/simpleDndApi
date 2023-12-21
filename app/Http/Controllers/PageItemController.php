<?php

namespace App\Http\Controllers;

use App\Models\PageItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PageItemController extends Controller
{
    public function index()
    {

        $page = request()->get('page', 1);
        $perPage = 16;

        $items = Cache::remember("page_items_page_$page", now()->addMinutes(10), function () use ($perPage) {
            return PageItem::paginate($perPage);
        });

        return response()->json($items);
    }

    public function show($id)
    {
        $item = PageItem::findOrFail($id);
        return response()->json($item);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'page_action_link' => 'required|url',
            'page_hero_image' => 'required|url',
            'author' => 'required',
        ]);

        $item = PageItem::create($validatedData);
        return response()->json($item, 201);
    }

    public function update(Request $request, $id)
    {
        $item = PageItem::findOrFail($id);

        $validatedData = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'page_action_link' => 'required|url',
            'page_hero_image' => 'required|url',
            'author' => 'required',
        ]);

        $item->update($validatedData);
        return response()->json($item);
    }

    public function destroy($id)
    {
        $item = PageItem::findOrFail($id);
        $item->delete();
        return response()->json(null, 204);
    }
}
