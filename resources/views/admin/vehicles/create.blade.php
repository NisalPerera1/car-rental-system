<!-- resources/views/admin/vehicles/create.blade.php -->

<h1>Add Vehicle</h1>

<form method="POST" action="{{ route('vehicles.store') }}">
    @csrf

    <div>
        <label for="name">Name</label>
        <input type="text" name="name" id="name" required>
    </div>

    <div>
        <label for="rental_price">Rental Price</label>
        <input type="number" name="rental_price" id="rental_price" required>
    </div>

    <button type="submit">Add Vehicle</button>
</
