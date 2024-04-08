<?php

namespace App\Http\Controllers;

use App\Enum\Active;
use App\Enum\Status;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.category.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'categoryName' => ['required', 'min:2', 'max:100', Rule::unique('categories', 'name')],
            'description' => 'max:255'
        ], [
            'categoryName.required' => 'សូមបញ្ចូលនូវឈ្មោះប្រភេទ',
            'categoryName.unique' => 'ឈ្មោះប្រភេទមានរួចហើយ',
            'categoryName.min' => 'ឈ្មោះតិចបំផុតត្រឹម ០២ អក្សរ',
            'categoryName.max' => 'ឈ្មោះច្រើនបំផុតត្រឹម ១០០ អក្សរ',
            'description.max' => 'ឈ្មោះច្រើនបំផុតត្រឹម ២៥៥ អក្សរ'
        ]);

        try {
            $name = $request->input('categoryName');
            $description = $request->input('description');
            Category::create([
                'name' => $name,
                'description' => $description,
                'status' => Status::APPROVE,
                'isActive' => Active::ACTIVE
            ]);
            return redirect('/categories')->with('message', '');
        } catch (Exception $e) {
            return redirect()->back()->with('message', 'Please try again!!!');
        }
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'categoryName' => ['required', 'min:2', 'max:100', Rule::unique('categories', 'name')->whereNot('id', $category)],
            'description' => 'max:255',
        ], [
            'categoryName.required' => 'សូមបញ្ចូលនូវឈ្មោះប្រភេទ',
            'categoryName.unique' => 'ឈ្មោះប្រភេទមានរួចហើយ',
            'categoryName.min' => 'ឈ្មោះតិចបំផុតត្រឹម ០២ អក្សរ',
            'categoryName.max' => 'ឈ្មោះច្រើនបំផុតត្រឹម ១០០ អក្សរ',
            'description.max' => 'ឈ្មោះច្រើនបំផុតត្រឹម ២៥៥ អក្សរ'
        ]);

        try {
            $name = $request->input('categoryName');
            $description = $request->input('description');
            $isActive = $request->input('isActive');

            $category->update([
                'name' => $name,
                'description' => $description,
                'status' => Status::APPROVE,
                'isActive' => $isActive
            ]);

            return redirect('/categories')->with('message', '');
        } catch (Exception $e) {
            return redirect()->back()->with('message', 'Please try again!!!');
        }
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->back()->with('message', 'ជោគជ័យ');
    }
}
