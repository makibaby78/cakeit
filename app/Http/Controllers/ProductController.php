<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();

        if(!$products) abort(404);

        return view('product.index', compact('products'));
    }

    public function destroy(Request $request)
    {
        $ids = json_decode($request->input('ids'), true);
    
        if (is_array($ids) && count($ids)) {
            // Get the products
            $products = Product::whereIn('id', $ids)->get();
    
            foreach ($products as $product) {
                // Image path saved as 'products/filename.jpg'
                $imagePath = 'public/' . $product->image;
    
                if ($product->image && Storage::exists($imagePath)) {
                    Storage::delete($imagePath);
                }
            }
    
            // Delete products from DB
            Product::whereIn('id', $ids)->delete();
    
            return redirect()->route('product.index')->with('success', 'Products and images deleted.');
        }
    
        return redirect()->route('product.index')->with('error', 'No products selected.');
    }
    

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
            
        // Handle Image Upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        // Store product in database
        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $imagePath ?? null, // Store the image path
        ]);
    
        return redirect()->route('product.index')->with('status', 'Product added successfully!');
    }
    
}
