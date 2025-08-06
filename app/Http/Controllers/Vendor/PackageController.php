<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\User;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index()
    {
        $vendor = User::with(['vendorProfile', 'vendorPackage'])->where('id', auth()->id())->first();
        $package = Package::where('id', $vendor->vendorProfile->package_id)->first();

        return view('vendor.package.index', compact('vendor', 'package'));
    }
}
