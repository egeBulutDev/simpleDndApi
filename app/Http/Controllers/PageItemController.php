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
        $perPage = 10;

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

        // Clear cache for all pages related to page items
        $this->clearPageItemsCache();

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
            'order' => 'required|integer',
        ]);

        $item->update($validatedData);

        // Clear cache for all pages related to page items
        $this->clearPageItemsCache();

        return response()->json($item);
    }

    public function destroy($id)
    {
        $item = PageItem::findOrFail($id);
        $item->delete();

        $this->clearPageItemsCache();

        return response()->json(null, 204);
    }

    private function clearPageItemsCache()
    {
        $keys = Cache::get('page_items_cache_keys', []);
        foreach ($keys as $key) {
            Cache::forget($key);
        }

        Cache::flush();
        Cache::forget('page_items_cache_keys');
    }

    public function saveOrder(Request $request)
    {
        $order = $request->input('order');

        // Loop through the order array and update the 'order' column in the database
        foreach ($order as $index => $itemId) {
            PageItem::where('id', $itemId)->update(['order' => $index + 1]);
        }

        // Clear cache for all pages related to page items
        $this->clearPageItemsCache();

        // Fetch and return the updated items after saving the order
        $updatedItems = PageItem::orderBy('order')->get();


        return response()->json(['message' => 'Item order saved successfully', 'data' => $updatedItems]);
    }

}
