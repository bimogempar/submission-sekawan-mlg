<div class="row mt-4">
    <div class="col-md-12">
        <h1>Rent Vehicle</h1>
        <table class="table">
            <thead>
                <tr>
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
                        <td>{{ $rent->rent_date }}</td>
                        <td>{{ $rent->vehicle->merk }}</td>
                        <td>{{ $rent->fuel }} liter</td>
                        <td>{{ $rent->vehicle->owner }}</td>
                        <td>{{ $rent->driver()->first()->name }}</td>
                        <td>{{ $rent->approval()->first()->name }}</td>
                        <td>{{ $rent->vehicle->history_used }}</td>
                        <td>{{ $rent->status == 0 ? 'Pending' : 'Approved' }}</td>
                        @if (auth()->user()->role == 3)
                            <td>
                                <div class="d-flex gap-3">
                                    <form method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Reject</button>
                                    </form>
                                    <form method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-success">Approve</button>
                                    </form>
                                </div>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
