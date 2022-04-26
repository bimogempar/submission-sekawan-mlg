@extends('layouts/app')

@section('title', $data)

@section('content')
    <form action={{ route('logout') }} method="post">
        @csrf
        <button class="btn btn-danger mb-4" type="submit">Logout</button>
    </form>

    <h1>This is {{ $data }}</h1>

    @if (auth()->user()->role == 2)
        <button class="btn btn-primary" onclick=createRent()>Req Rent Vehicle</button>
        <button class="btn btn-primary" onclick=createVehicle()>Create Vehicle</button>
    @endif

    <div id="tableRent">
        @include('dashboard/partials/tablerent')
    </div>

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

    {{-- modal --}}
    <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="showBodyModal">
                    {{-- dynamic modal --}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" id="deleteButton">Delete</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="btnSubmmit"></button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function createRent() {
            const url = '{{ route('modalCreateRent') }}';
            $.get(url, function(data) {
                $('#modalLabel').text('Add Rent Vehicle')
                $('#showBodyModal').html(data);
                $('#showModal').modal('show');
                $('#btnSubmmit').text('Create').attr('onclick', 'store()');
                $('#deleteButton').hide();
            });
        }

        function createVehicle() {
            const url = '{{ route('modalCreateVehicle') }}';
            $.get(url, function(data) {
                $('#modalLabel').text('Create New Vehicle')
                $('#showBodyModal').html(data);
                $('#showModal').modal('show');
                $('#btnSubmmit').text('Create').attr('onclick', 'store()');
                $('#deleteButton').hide();
            });
        }
    </script>

@endsection
