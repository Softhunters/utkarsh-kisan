<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\VendorProfile;
use Illuminate\Http\Request;

class VendorProfileController extends Controller
{
    public function edit()
    {
        $vendorProfile = VendorProfile::firstOrNew(['vendor_id' => auth()->id()]);
        $countries = Country::all();
        return view('vendor.profile.edit', compact('vendorProfile', 'countries'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'address' => 'required|string',
            'country' => 'required|exists:countries,id',
            'state' => 'required|exists:states,id',
            'city' => 'required|exists:cities,id',
            'pin_code' => 'required',
            'id_proof_type' => 'required|string',
            'proof_image' => 'nullable',
            'gstin_number' => 'nullable',
            'gstin_image' => 'nullable',
        ]);


        $data['vendor_id'] = auth()->id();

        if ($request->hasFile('proof_image')) {
            $proofImage = $request->file('proof_image');
            $proofImageName = time() . '_' . $proofImage->getClientOriginalName();
            $proofImage->move(public_path('assets/vendor/proofs'), $proofImageName);
            $data['proof_image'] = 'assets/vendor/proofs/' . $proofImageName;
        }

        if ($request->hasFile('gstin_image')) {
            $gstinImage = $request->file('gstin_image');
            $gstinImageName = time() . '_' . $gstinImage->getClientOriginalName();
            $gstinImage->move(public_path('assets/vendor/proofs'), $gstinImageName);
            $data['gstin_image'] = 'assets/vendor/proofs/' . $gstinImageName;
        }


        VendorProfile::updateOrCreate(['vendor_id' => auth()->id()], $data);

        return back()->with('message', 'Vendor profile updated successfully.');
    }

}
