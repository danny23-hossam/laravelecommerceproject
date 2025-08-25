<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use id;

class CouponController extends Controller
{
    // Show all coupons
    public function index()
    {
        $coupons = Coupon::all();
        return view('coupons.index', compact('coupons'));
    }

    // Show create form
    public function create()
    {
        return view('coupons.create');
    }

    // Store new coupon
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:coupons,code',
            'discount' => 'required|numeric|min:0',
            'expires_at' => 'nullable|date',
        ]);

     Coupon::create([
        'code' => $request->code,
        'discount' => $request->discount,
        'expires_at' => $request->expires_at,
    ]);

        return redirect()->route('coupons.index')->with('success', 'Coupon created successfully!');
    }

    // Show edit form
    public function edit(Coupon $coupon)
    {
        return view('coupons.edit', compact('coupon'));
    }

    // Update coupon
    public function update(Request $request, Coupon $coupon)
    {
        $request->validate([
            'code' => 'required|unique:coupons,code,' . $coupon->id,
            'discount' => 'required|numeric|min:0',
            'expires_at' => 'nullable|date',
        ]);

         $coupon->update([
        'code' => $request->code,
        'discount' => $request->discount,
        'expires_at' => $request->expires_at,
    ]);

        return redirect()->route('coupons.index')->with('success', 'Coupon updated successfully!');
    }

    // Delete coupon
    public function destroy(Coupon $coupon)
    {
        $coupon->delete();

        return redirect()->route('coupons.index')->with('success', 'Coupon deleted successfully!');
    }
    

   

  
}

