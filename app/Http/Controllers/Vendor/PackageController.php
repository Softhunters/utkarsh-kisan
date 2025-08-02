<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index()
    {
        $vendor = User::with('vendorProfile')->where('id', auth()->id())->first();
        dd($vendor);
dd($vendor->vendorProfile->package_id);
        return view('vendor.package.index', compact('products'));
    }
}
