<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
   public function index()
   {
      $cart = session()->get('cart', []);
      return view('cart.index', compact('cart'));
   }

   public function add(Product $product)
   {
      $cart = session()->get('cart', []);
      if(isset($cart[$product->id])) {
         $cart[$product->id]['quantity']++;
      } else {
         $cart[$product->id] = [
         "nama" => $product->nama,
         "quantity" => 1,
         "harga" => $product->harga,
         "foto" => $product->foto
         ];
      }
      session()->put('cart', $cart);
      return redirect()->route('cart.index')->with('success', 'Produk ditambahkan ke keranjang!');
   }

   public function remove(Product $product)
   {
      $cart = session()->get('cart', []);
      if(isset($cart[$product->id])) {
         unset($cart[$product->id]);
         session()->put('cart', $cart);
      }
      return redirect()->route('cart.index')->with('success', 'Produk dihapus dari keranjang!');
   }

   public function update(Request $request, Product $product)
   {
      $cart = session()->get('cart', []);
      if(isset($cart[$product->id])) {
         $cart[$product->id]['quantity'] = $request->quantity;
         session()->put('cart', $cart);
      }
      return redirect()->route('cart.index')->with('success', 'Jumlah produk diperbarui!');
   }
}