<div class="row mt-4">
    <div class="col-md-12">
        <h1>Rent Vehicle</h1>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Rent Date</th>
                    <th scope="col">Merk</th>
                    <th scope="col">Amount Fuel</th>
                    <th scope="col">Owner</th>
                    <th scope="col">Driver</th>
                    <th scope="col">Approval</th>
                    <th scope="col">History Used</th>
                    <th scope="col">Status</th>
                    @if (auth()->user()->role == 3)
                        <th scope="col">Action</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($rents as $rent)
                    <tr>
                        <td id="id">{{ $rent->id }}</td>
                        <td>{{ $rent->rent_date }}</td>
                        <td>{{ $rent->vehicle->merk }}</td>
                        <td>{{ $rent->fuel }} liter</td>
                        <td>{{ $rent->vehicle->owner }}</td>
                        <td>{{ $rent->driver()->first()->name }}</td>
                        <td>{{ $rent->approval()->first()->name }}</td>
                        <td>{{ $rent->vehicle->history_used }}</td>
                        {{-- <td>{{ $rent->status == 0 ? 'Pending' : 'Approved' }}</td> --}}
                        <td>
                            @if ($rent->status == 0)
                                Pending
                            @elseif ($rent->status == 1)
                                Approved
                            @elseif ($rent->status == 2)
                                Rejected
                            @endif
                        </td>
                        @if (auth()->user()->role == 3)
                            @if ($rent->status == 0)
                                <td>
                                    <div class="d-flex gap-3">
                                        <button onclick="reject({{ $rent->id }})"
                                            class="btn btn-danger">Reject</button>
                                        <button onclick="approve({{ $rent->id }})"
                                            class="btn btn-success">Approve</button>
                                    </div>
                                </td>
                            @endif
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    function approve(id) {
        const idRent = id;
        const url = '{{ route('approvalRent', ':id') }}';
        const newUrl = url.replace(':id', idRent);
        $.ajax({
            url: url,
            type: 'PATCH',
            data: {
                "_token": "{{ csrf_token() }}",
                "id": id,
                "status": 1
            },
            success: function(data) {
                reloadVehicle()
            }
        });
    }

    function reject(id) {
        const idRent = id;
        const url = '{{ route('approvalRent', ':id') }}';
        const newUrl = url.replace(':id', idRent);
        $.ajax({
            url: url,
            type: 'PATCH',
            data: {
                "_token": "{{ csrf_token() }}",
                "id": id,
                "status": 2
            },
            success: function(data) {
                reloadVehicle()
            }
        });
    }

    function reloadVehicle() {
        $.get('{{ route('reloadRent') }}', function(data) {
            $('#tableRent').html(data)
        })
    }
</script>
