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
                    @if (auth()->user()->role == 2)
                        <th scope="col">Action</th>
                    @endif
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
                        <td>
                            @if (auth()->user()->role == 2)
                                <div class="d-flex gap-3">
                                    <button onclick="edit({{ $vehicle->id }})" class="btn btn-warning">Edit</button>
                                    <button onclick="destroy({{ $vehicle->id }})"
                                        class="btn btn-danger">Delete</button>
                                </div>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    function edit(id) {
        const idVehicle = id;
        const url = '{{ route('modalEditVehicle', ':id') }}';
        const newUrl = url.replace(':id', idVehicle);

        $.get(newUrl, function(data) {
            $('#modalLabel').text('Edit Vehicle')
            $('#showBodyModal').html(data);
            $('#showModal').modal('show');
            $('#btnSubmmit').text('Update').attr('onclick', 'update(' + idVehicle + ')');
            $('#deleteButton').hide();
        });
    }

    function destroy(id) {
        const idVehicle = id;
    }
</script>
