@extends('layouts/app')

@section('title', $data)

@section('content')
    <form action={{ route('logout') }} method="post">
        @csrf
        <button class="btn btn-danger mb-4" type="submit">Logout</button>
    </form>

    <h1>This is {{ $data }}</h1>

    @if (auth()->user()->role == 2)
        <h1 class="mt-5">Add Vehicle</h1>
        <div class="row">
            <div class="col-md-4">
                <form>
                    <div class="form">
                        <label for="type">Type</label>
                        <input type="text" name="type" id="type" class="form-control">
                    </div>
                    <div class="form">
                        <label for="merk">Merk</label>
                        <input type="text" name="merk" id="merk" class="form-control">
                    </div>
                    <div class="form">
                        <label for="fuel">Fuel Consumtion</label>
                        <input type="text" name="fuel" id="fuel" class="form-control">
                    </div>
                    <div class="form">
                        <label for="maintenance">Maintenance</label>
                        <input type="date" name="maintenance" id="maintenance" class="form-control">
                    </div>
                    <div class="form">
                        <label for="history_used">History Used</label>
                        <input type="date" name="history_used" id="history_used" class="form-control">
                    </div>
                    <div class="form">
                        <label for="owner">Owner</label>
                        <input type="text" name="owner" id="owner" class="form-control">
                    </div>
                    <label for="driver">Driver</label>
                    <select class="form-select" aria-label="Default select example">
                        <option selected>Open this select menu</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                    <button type="submit" class="mt-2 btn btn-primary">
                        Add
                    </button>
                </form>
            </div>
        </div>
    @endif

    <div class="row mt-4">
        <div class="col-md-12">
            <h1>Rent Vehicle</h1>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Type</th>
                        <th scope="col">Merk</th>
                        <th scope="col">Fuel Consumtion</th>
                        <th scope="col">Owner</th>
                        <th scope="col">Driver</th>
                        <th scope="col">Approval</th>
                        <th scope="col">History Used</th>
                        <th scope="col">Status</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rents as $rent)
                        <tr>
                            <td>{{ $rent->vehicle->type }}</td>
                            <td>{{ $rent->vehicle->merk }}</td>
                            <td>{{ $rent->vehicle->fuel }}</td>
                            <td>{{ $rent->vehicle->owner }}</td>
                            <td>{{ $rent->driver()->first()->name }}</td>
                            <td>{{ $rent->approval()->first()->name }}</td>
                            <td>{{ $rent->vehicle->history_used }}</td>
                            <td>{{ $rent->status == 0 ? 'Pending' : 'Approved' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-12">
            <table class="table">
                <h1>All Vehicles</h1>
                <thead>
                    <tr>
                        <th scope="col">Type</th>
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
                            <td>{{ $vehicle->type }}</td>
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

@endsection
