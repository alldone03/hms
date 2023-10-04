<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDeviceRequest;
use App\Http\Requests\UpdateDeviceRequest;
use App\Models\Device;

class DeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $device = Device::all();
        return view('pages.manage_device.index', compact('device'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDeviceRequest $request)
    {

        $validate = request()->validate([
            'nama_device' => 'required|min:5|unique:devices',

        ], [
            'required' => 'Perlu diisi!!!',
        ]);
        Device::create($validate);
        return response()->json([
            'message' => "Success",
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Device $device)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Device $device)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDeviceRequest $request, Device $device)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Device $device)
    {
        //
    }
    public function deletedevice()
    {
        $device = Device::find(request()->id);

        $device->delete();
        return redirect()->back()->with('status', 'Berhasil Delete');
    }
}