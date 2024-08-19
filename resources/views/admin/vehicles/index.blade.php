
<h1>Vehicle List</h1>

<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Rental Price</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($vehicles as $vehicle)
        <tr>
            <td>{{ $vehicle->name }}</td>
            <td>{{ $vehicle->rental_price }}</td>
            <td>
                <a href="{{ route('vehicles.edit', $vehicle->id) }}">Edit</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
