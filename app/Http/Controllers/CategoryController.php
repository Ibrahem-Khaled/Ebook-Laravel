<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('category.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function save(Request $request)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'category_name' => 'required',
            'category_description' => 'required',
            'category_image' => 'required|image', // Adjusted validation rule
        ]);

        if ($request->hasFile("category_image")) {
            $image = $request->file("category_image");
            $imageName = Str::slug($validatedData['category_name']) . "." . $image->guessExtension();
            $destinationPath = public_path("img/categories/");
            if ($image->move($destinationPath, $imageName)) {
                Category::create([
                    'category_name' => $validatedData['category_name'],
                    'category_description' => $validatedData['category_description'],
                    'category_image_url' => 'img/categories/' . $imageName,
                ]);

                return redirect()->route('category.index')->with('success', 'Categoría creada exitosamente.');
            } else {
                return redirect()->route('category.index')->with('danger', 'Error al subir la imagen');
            }
        } else {
            return redirect()->route('category.index')->with('danger', 'No se ha seleccionado ninguna imagen.');
        }
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $category = Category::findOrFail($id);
        $categories = Category::all();
        return view('category.show', compact('category', 'categories'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate the incoming request
        $request->validate([
            'category_name' => 'required',
            'category_description' => 'required',
        ]);

        // Find the category by ID
        $category = Category::findOrFail($id);

        // Handle file upload if provided
        if ($request->hasFile("category_image")) {
            // Delete the old image if it exists
            if (Storage::exists(public_path($category->category_image_url))) {
                Storage::delete(public_path($category->category_image_url));
            }

            $image = $request->file("category_image");
            $imageName = Str::slug($request->category_name) . "." . $image->guessExtension();
            $destinationPath = public_path("img/categories/");

            // Attempt to move the uploaded file
            if ($image->move($destinationPath, $imageName)) {
                // Update category record with new image
                $category->update([
                    'category_name' => $request->category_name,
                    'category_description' => $request->category_description,
                    'category_image_url' => 'img/categories/' . $imageName,
                    'updated_at' => now()->toDateTimeString(),
                ]);
            }
        } else {
            // No file uploaded, update category record without changing the image URL
            $category->update([
                'category_name' => $request->category_name,
                'category_description' => $request->category_description,
                'updated_at' => now()->toDateTimeString(),
            ]);
        }

        // Redirect with success message
        return redirect()->route('category.index')->with('success', 'Categoria actualizada exitosamente.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('category.index')->with('success', 'Categoría eliminada exitosamente.');
    }
}
