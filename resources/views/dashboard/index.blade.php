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

    <div id="tableVehicle">
        @include('dashboard/partials/tablevehicle')
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
