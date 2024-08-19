<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use app\Models\Booking;
use app\Models\Customer;
use app\Models\Models\Vehicle;




class BookingController extends Controller
{
    
public function index()
        {
            return view('frontend.booking.index');
        }
    
        public function getAvailableVehicles(Request $request)
        {
            $pickupDate = $request->input('pickup_date');
            $dropoffDate = $request->input('dropoff_date');
    
            $availableVehicles = Vehicle::whereDoesntHave('bookings', function ($query) use ($pickupDate, $dropoffDate) {
            $query->where(function ($query) use ($pickupDate, $dropoffDate) {
            $query->whereBetween('pickup_date', [$pickupDate, $dropoffDate])
                ->orWhereBetween('dropoff_date', [$pickupDate, $dropoffDate])
                ->orWhere(function ($query) use ($pickupDate, $dropoffDate) {
            $query->where('pickup_date', '<=', $pickupDate)
                    ->where('dropoff_date', '>=', $dropoffDate);
                          });
                });

            })->get();
    
            return response()->json($availableVehicles);
        }
    
public function store(Request $request)
        {
            $validatedData = $request->validate([
                'pickup_date' => 'required|date',
                'dropoff_date' => 'required|date|after:pickup_date',
                'vehicle_id' => 'required|exists:vehicles,id',
                'full_name' => 'required|string',
                'contact_number' => 'required|string',
                'email_address' => 'required|email',
                'postal_address' => 'required|string',
            ]);
    
            $vehicle = Vehicle::findOrFail($validatedData['vehicle_id']);
    
            $booking = Booking::create([
                'pickup_date' => $validatedData['pickup_date'],
                'dropoff_date' => $validatedData['dropoff_date'],
                'total_amount' => $vehicle->rental_price * (strtotime($validatedData['dropoff_date']) - strtotime($validatedData['pickup_date'])) / (24 * 60 * 60),
                'vehicle_id' => $validatedData['vehicle_id'],
            ]);
    
            $customer = Customer::create([
                'full_name' => $validatedData['full_name'],
                'contact_number' => $validatedData['contact_number'],
                'email_address' => $validatedData['email_address'],
                'postal_address' => $validatedData['postal_address'],
            ]);
    
            $booking->customer()->associate($customer);
            $booking->save();
    
            $vehicle->bookings()->save($booking);
    
            return redirect()->back()->with('success', 'Booking successful!');
        }
    }
    

