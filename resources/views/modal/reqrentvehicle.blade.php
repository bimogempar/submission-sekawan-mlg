<div class="row">
    <div class="col-md-12">
        <div class="form">
            <label for="merk">Merk</label>
            <select name="vehicle_id" class="form-select" id="merk">
                @foreach ($vehicles as $vehicle)
                    <option value="{{ $vehicle->id }}">{{ $vehicle->merk }}</option>
                @endforeach
            </select>
        </div>
        <div class="form">
            <label for="fuel">Amount Fuel</label>
            <input type="number" name="fuel" id="fuel" class="form-control">
        </div>
        <div class="form">
            <label for="rent_date">Rent Date</label>
            <input type="date" name="rent_date" id="rent_date" class="form-control">
        </div>
        <label for="driver">Driver</label>
        <select name="driver" id="driver" class="form-select" aria-label="Default select example">
            <option selected disabled>Open this select menu</option>
            @foreach ($drivers as $driver)
                <option value="{{ $driver->id }}">{{ $driver->name }}</option>
            @endforeach
        </select>

        <label for="driver">Approval</label>
        <select name="approval" id="approval" class="form-select" aria-label="Default select example">
            <option selected disabled>Open this select menu</option>
            @foreach ($approvals as $approval)
                <option value="{{ $approval->id }}">{{ $approval->name }}</option>
            @endforeach
        </select>
        </form>
    </div>
</div>

<script>
    function store() {
        // console.log('send')
        var merk = $('#merk').val();
        var fuel = $('#fuel').val()
        var rent_date = $('#rent_date').val()
        var driver = $('#driver').val()
        var approval = $('#approval').val()
        $.ajax({
            url: '{{ route('storeRent') }}',
            type: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                "vehicle_id": merk,
                "fuel": fuel,
                "rent_date": rent_date,
                "driver": driver,
                "approval": approval
            },
            success: function(data) {
                $('.btn-close').click();
                reloadRent();
            }
        });
    }

    function reloadRent() {
        $.get('{{ route('reloadRent') }}', function(data) {
            $('#tableRent').html(data)
        })
    }
</script>
