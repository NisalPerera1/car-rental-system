<?php

namespace App\Http\Controllers;
use App\Models\Models\Vehicle;
use app\Models\Booking;
use app\Models\Customer;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::all();
        return view('admin.vehicles.index', compact('vehicles'));
    }
    
    public function create()
    {
        return view('admin.vehicles.create');
    }
    
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'rental_price' => 'required|numeric'
        ]);
    
        $vehicle = new Vehicle;
        $vehicle->name = $request->name;
        $vehicle->rental_price = $request->rental_price;
        $vehicle->save();
    
        return redirect()->route('vehicles.index')->with('success', 'Vehicle added successfully.');
    }
    
    public function edit($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        return view('admin.vehicles.edit', compact('vehicle'));
    }
    
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'rental_price' => 'required|numeric'
        ]);
    
        $vehicle = Vehicle::findOrFail($id);
        $vehicle->name = $request->name;
        $vehicle->rental_price = $request->rental_price;
        $vehicle->save();
    
        return redirect()->route('vehicles.index')->with('success', 'Vehicle updated successfully.');
    }
    
}
