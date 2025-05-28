<?php

// app/Http/Controllers/CategoryController.php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::where('group_id', Auth::user()->group_id)->orderBy('created_at', 'desc')->paginate(10);
        return view('dashboard.category.index', compact('categories'));
    }

    public function create()
    {
        return view('dashboard.category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('categories')->where(function ($query) {
                    return $query->where('user_id', Auth::id());
                })
            ]
        ], [
            'name.unique' => 'You already have this category.',
        ]);

        Category::create([
            'name' => $request->name,
            'group_id' => Auth::user()->group_id,
            'user_id' => Auth::id()
        ]);

        return redirect()->route('category.index')->with('success', 'Category created.');
    }

    public function edit(Category $cat)
    {
        return view('dashboard.category.edit', compact('cat'));
    }

    public function update(Request $request, Category $cat)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $cat->update(['name' => $request->name]);

        return redirect()->route('category.index')->with('success', 'Category updated.');
    }

    public function destroy(Category $cat)
    {
        $cat->delete();
        return back()->with('success', 'Category deleted.');
    }
}
