<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\VendorProduct;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function index($type)
    {
        if ($type === 'active') {
            $vendors = User::where('utype', 'VDR')->where('status', 1)->get();
        } elseif ($type === 'deactivated') {
            $vendors = User::where('utype', 'VDR')->where('status', 0)->get();
        } else {
            $vendors = User::where('utype', 'VDR')->whereHas('vendorProfile', function ($q) {
                $q->where('status', 0);
            })->get();
        }

        return view('admin.vendor.index', compact('vendors', 'type'));
    }

    public function show($id)
    {
        $vendor = User::with([
            'vendorProfile',
            'vendorProducts.product.category',
            'vendorProducts.product.subCategories',
            'vendorProducts.product.brands',
            'vendorProducts.product.vendorProducts.vendor.vendorProfile'
        ])->findOrFail($id);

        return view('admin.vendor.show', compact('vendor'));
    }

    public function toggleVerification($id)
    {
        $vendor = User::findOrFail($id);
        $profile = $vendor->vendorProfile;

        if ($profile) {
            $profile->status = !$profile->status;
            $profile->save();
        }

        return back()->with('message', 'Vendor verification status updated.');
    }
    public function toggleStatus($id)
    {
        $vendor = User::findOrFail($id);

        if ($vendor) {
            $vendor->status = !$vendor->status;
            $vendor->save();
        }

        return back()->with('message', 'Vendor status updated.');
    }


}
