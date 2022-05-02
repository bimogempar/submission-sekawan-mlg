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
                        <td>
                            @if (auth()->user()->role == 2)
                                <div class="d-flex gap-3">
                                    <button onclick="edit({{ $vehicle->id }})"
                                        class="btn btn-info text-white">Edit</button>
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
        Swal.fire({
            title: 'Are you sure to delete this vehicle?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                const url = '{{ route('destroyVehicle', ':id') }}';
                const newUrl = url.replace(':id', idVehicle);

                $.ajax({
                    url: newUrl,
                    type: 'DELETE',
                    data: {
                        '_token': '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        $('.btn-close').click();
                        Swal.fire(
                            'Deleted!',
                            'Vehicle has been deleted.',
                            'success'
                        )
                        reloadTable()
                    }
                });
            }
        })
    }

    function reloadTable() {
        $.get('{{ route('reloadRent') }}', function(data) {
            $('#tableRent').html(data)
        })
        $.get('{{ route('reloadVehicle') }}', function(data) {
            $('#tableVehicle').html(data)
        })
    }
</script>
