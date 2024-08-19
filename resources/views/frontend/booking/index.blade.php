@extends('layouts.frontend')

@section('content')
<div class="container mt-5">
    <h1>Book a Vehicle</h1>

    @if (session('success'))
    <div class="alert alert-success mt-3">
        {{ session('success') }}
    </div>
    @endif

    <form method="post" action="{{ route('frontend.booking.store') }}">
        @csrf

        <div class="form-group">
            <label for="pickup_date">Pickup Date</label>
            <input type="date" name="pickup_date" id="pickup_date" class="form-control @error('pickup_date') is-invalid @enderror" value="{{ old('pickup_date') }}" required>
            @error('pickup_date')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="dropoff_date">Drop-off Date</label>
            <input type="date" name="dropoff_date" id="dropoff_date" class="form-control @error('dropoff_date') is-invalid @enderror" value="{{ old('dropoff_date') }}" required>
            @error('dropoff_date')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="vehicle_id">Vehicle</label>
            <select name="vehicle_id" id="vehicle_id" class="form-control @error('vehicle_id') is-invalid @enderror" required>
                <option value="">-- Select a Vehicle --</option>
            </select>
            @error('vehicle_id')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="full_name">Full Name</label>
            <input type="text" name="full_name" id="full_name" class="form-control @error('full_name') is-invalid @enderror" value="{{ old('full_name') }}" required>
            @error('full_name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="contact_number">Contact Number</label>
            <input type="text" name="contact_number" id="contact_number" class="form-control @error('contact_number') is-invalid @enderror" value="{{ old('contact_number') }}" required>
            @error('contact_number')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="email_address">Email Address</label>
            <input type="email" name="email_address" id="email_address" class="form-control @error('email_address') is-invalid @enderror" value="{{ old('email_address') }}" required>
            @error('email_address')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="postal_address">Postal Address</label>
            <textarea name="postal_address" id="postal_address" class="form-control @error('postal_address') is-invalid @enderror" required>{{ old('postal_address') }}</textarea>
            @error('postal_address')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Book Now</button>
        </form>
</div>
<script>
$(document).ready(function() {
    $('#pickup_date, #dropoff_date').change(function() {
        var pickupDate = $('#pickup_date').val();
        var dropoffDate = $('#dropoff_date').val();

        if (pickupDate && dropoffDate) {
            $.ajax({
                url: '{{ route("frontend.booking.get_available_vehicles") }}',
                type: 'GET',
                data: {
                    pickup_date: pickupDate,
                    dropoff_date: dropoffDate
                },
                success: function(response) {
                    $('#vehicle_id').html(response);
                }
            });
        }
    });
});
</script>
@endsection