<?php

namespace App\Http\Controllers;

use App\Models\ClothingItem;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;

class ClothingItemController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request)
    {
        $query = ClothingItem::with(['category', 'user'])
            ->where('user_id', auth()->id());

        // Search filter
        $query->when($request->filled('search'), function ($q) use ($request) {
            $q->where('name', 'like', '%' . $request->search . '%')
              ->orWhere('description', 'like', '%' . $request->search . '%');
        });

        // Category filter
        $query->when($request->filled('category'), fn($q) => $q->where('category_id', $request->category));

        return response()->json($query->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'          => 'required|string|max:255',
            'description'   => 'nullable|string',
            'color'         => 'nullable|string',
            'size'          => 'nullable|string',
            'image'         => 'nullable|image|max:2048',
            'category_id'   => 'nullable|exists:categories,id',
            'category_name' => 'nullable|string|max:255',
        ]);

        // Ensure category_id is set
        if (empty($validated['category_id'])) {
            if (!empty(trim($validated['category_name']))) {
                $category = Category::firstOrCreate(['name' => trim($validated['category_name'])]);
                $validated['category_id'] = $category->id;
            } else {
                return response()->json(['error' => 'Category is required'], 422);
            }
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('images', 'public');
        }

        $item = ClothingItem::create(array_merge($validated, ['user_id' => auth()->id()]));

        return response()->json($item, 201);
    }

    public function update(Request $request, ClothingItem $clothingItem)
    {
        $this->authorize('update', $clothingItem);

        $validated = $request->validate([
            'name'          => 'sometimes|string|max:255',
            'description'   => 'nullable|string',
            'color'         => 'nullable|string',
            'size'          => 'nullable|string',
            'image'         => 'nullable|image|max:2048',
            'category_id'   => 'nullable|exists:categories,id',
            'category_name' => 'nullable|string|max:255',
        ]);

        // Ensure category_id is set
        if (empty($validated['category_id'])) {
            if (!empty(trim($validated['category_name']))) {
                $category = Category::firstOrCreate(['name' => trim($validated['category_name'])]);
                $validated['category_id'] = $category->id;
            }
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            if ($clothingItem->image) {
                Storage::disk('public')->delete($clothingItem->image);
            }
            $validated['image'] = $request->file('image')->store('images', 'public');
        }

        $clothingItem->update($validated);

        return response()->json($clothingItem);
    }

    public function destroy(ClothingItem $clothingItem)
    {
        $this->authorize('delete', $clothingItem);

        // Delete image file if it exists
        if ($clothingItem->image) {
            Storage::disk('public')->delete($clothingItem->image);
        }

        $clothingItem->delete();

        return response()->json(null, 204);
    }
}
