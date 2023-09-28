<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\AddressRequest;
use App\Http\Requests\UpdateAddressRequest;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    public function index()
    {
        $addresses = Auth::user()->addresses;

        return view('customer.address.index', [
            'addresses' => $addresses,
        ]);
    }

    public function create()
    {
        $user = Auth::user();

        return view('customer.address.create', [
            'user' => $user,
        ]);
    }

    public function store(AddressRequest $request)
    {
        $request->validated();

        $user = Auth::user();

        $user->addresses()->create([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        alert()->success(__('Success'), __('Address added successfully.'));

        return redirect()->route('customer.address.index');
    }

    public function edit(Address $address)
    {
        $user = Auth::user();
        if (!$user->addresses->contains($address)) {
            abort(403);
        }

        return view('customer.address.edit', [
            'address' => $address,
        ]);
    }

    public function update(Address $address, AddressRequest $request)
    {
        $request->validated();

        $user = Auth::user();
        if (!$user->addresses->contains($address)) {
            abort(403);
        }

        $address->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        alert()->success('Success Update', __('Address updated successfully.'));
        
        return redirect()->route('customer.address.index');
    }

    public function destroy(Address $address)
    {
        $address->delete();

        return redirect()->back();
    }
}
