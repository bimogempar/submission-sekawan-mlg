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
                    @if (auth()->user()->role == 2 || auth()->user()->role == 3)
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
                        <td>
                            @if ($rent->status == 0)
                                <h6><span class="badge bg-warning">Pending</span></h6>
                            @elseif ($rent->status == 1)
                                <h6><span class="badge bg-success">Approved</span></h6>
                            @elseif ($rent->status == 2)
                                <h6><span class="badge bg-danger">Rejected</span></h6>
                            @endif
                        </td>
                        @if ($rent->status == 0)
                            <td>
                                <div class="d-flex gap-3">
                                    @if (auth()->user()->role == 3 && auth()->user()->id == $rent->approval()->first()->id)
                                        <button onclick="reject({{ $rent->id }})"
                                            class="btn btn-danger">Reject</button>
                                        <button onclick="approve({{ $rent->id }})"
                                            class="btn btn-success">Approve</button>
                                        <button onclick="destroyRent({{ $rent->id }})"
                                            class="btn btn-secondary text-white">Delete</button>
                                    @elseif(auth()->user()->role == 2)
                                        <button onclick="destroyRent({{ $rent->id }})"
                                            class="btn btn-secondary text-white">Delete</button>
                                    @endif
                                </div>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    function destroyRent(params) {
        console.log("deleted id " +
            params)
    }

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
