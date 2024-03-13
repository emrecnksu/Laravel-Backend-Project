<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class ProductController extends Controller
{
    private $messages = [];

    public function index()
    {
        if (Auth::check()) {
            $products = Product::all();
            return response()->json(['products' => $products], 200);
        } else {
            return response()->json(['error' => 'Yetkisiz Erişim.'], 401);
        }
    }
    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_name' => 'required|string',
            'product_price' => 'required|numeric',
            'description' => 'required|string',
        ], [
            'product_name.required' => 'Ürün adı alanı boş bırakılmamalıdır.',
            'product_price.required' => 'Ürün fiyatı alanı boş bırakılmamalıdır.',
            'product_price.numeric' => 'Ürün fiyatı sayı olmalıdır.',
            'description.required' => 'Açıklama alanı boş bırakılmamalıdır.',
        ]);

        if ($validator->fails()) {
            $this->messages[] = $validator->errors()->first();
            return response()->json(['status' => 0, 'error' => $this->messages[0]], 422);
        }

        $product = new Product([
            'product_name' => $request->input('product_name'),
            'product_price' => $request->input('product_price'),
            'description' => $request->input('description'),
        ]); 

        Auth::user()->products()->save($product);

        $this->messages[] = 'Ürün başarıyla oluşturuldu.';
        return response()->json(['message' => $this->messages[0]], 201);
    }

    public function edit(Product $product)
    {
        if (Auth::check()) {
            return response()->json(['product' => $product], 200);
        } else {
            return response()->json(['error' => 'Yetkisiz Erişim.'], 401);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'product_name' => 'required|string',
            'product_price' => 'required|numeric',
            'description' => 'required|string',
        ], [
            'product_name.required' => 'Ürün adı alanı boş bırakılmamalıdır.',
            'product_price.required' => 'Ürün fiyatı alanı boş bırakılmamalıdır.',
            'product_price.numeric' => 'Ürün fiyatı sayı olmalıdır.',
            'description.required' => 'Açıklama alanı boş bırakılmamalıdır.',
        ]);

        if ($validator->fails()) {
            // Hata olduğunda mesajı ekleyin
            $this->messages[] = $validator->errors()->first();
            return response()->json(['status' => 0, 'error' => $this->messages[0]], 422);
        }

        $product = Product::findOrFail($id); 
        $product->update([
            'product_name' => $request->input('product_name'),
            'product_price' => $request->input('product_price'),
            'description' => $request->input('description'),
        ]);

        // Başarı mesajını ekleyin
        $this->messages[] = 'Ürün başarıyla güncellendi.';
        return response()->json(['message' => $this->messages[0]], 200);
    }

    public function destroy($id)
    {

        
    $product = Product::find($id);

    if (!$product) {
        return response()->json(['error' => 'Ürün bulunamadı.']);
    }

    $product->delete();

    return response()->json(['message' => 'Ürün başarıyla silindi.'], 200);
    }

    public function show($id)
    {
        if (Auth::check()) {
            $product = Product::find($id);
            return response()->json(['product' => $product], 200);
        } else {
            return response()->json(['error' => 'Yetkisiz Erişim.'], 401);
        }
    }
}