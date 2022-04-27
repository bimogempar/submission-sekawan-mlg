<div class="row mt-4">
    <div class="col-md-12">
        <table class="table">
            <h1>All Vehicles</h1>
            <thead>
                <tr>
                    <th scope="col">Merk</th>
                    <th scope="col">Fuel Consumtion</th>
                    <th scope="col">Maintenance</th>
                    <th scope="col">History Used</th>
                    <th scope="col">Owner</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($vehicles as $vehicle)
                    <tr>
                        <td>{{ $vehicle->merk }}</td>
                        <td>{{ $vehicle->fuel }}</td>
                        <td>{{ $vehicle->maintenance }}</td>
                        <td>{{ $vehicle->history_used }}</td>
                        <td>{{ $vehicle->owner }}</td>
                        <td>{{ $vehicle->driver }}</td>
                        <td>{{ $vehicle->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
