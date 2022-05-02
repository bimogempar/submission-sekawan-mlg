<div class="form">
    <label for="merk">Merk</label>
    <input type="text" name="merk" id="merk" class="form-control" value="{{ $vehicle->merk }}">
</div>
<div class="form">
    <label for="fuel">Fuel Consumtion</label>
    <input type="text" name="fuel" id="fuel" class="form-control" value="{{ $vehicle->fuel }}">
</div>
<div class="form">
    <label for="maintenance">Maintenance</label>
    <input type="date" name="maintenance" id="maintenance" class="form-control" value="{{ $vehicle->maintenance }}">
</div>
<div class="form">
    <label for="history_used">History Used</label>
    <input type="date" name="history_used" id="history_used" class="form-control"
        value="{{ $vehicle->history_used }}">
</div>
<div class="form">
    <label for="owner">Owner</label>
    <input type="text" name="owner" id="owner" class="form-control" value="{{ $vehicle->owner }}">
</div>
</div>

<script>
    function update(id) {
        const idVehicle = id;
        const url = '{{ route('updateVehicle', ':id') }}';
        const newUrl = url.replace(':id', idVehicle);

        $.ajax({
            url: newUrl,
            type: 'PATCH',
            data: {
                id: idVehicle,
                merk: $('#merk').val(),
                fuel: $('#fuel').val(),
                maintenance: $('#maintenance').val(),
                history_used: $('#history_used').val(),
                owner: $('#owner').val(),
                _token: '{{ csrf_token() }}'
            },
            success: function(data) {
                $('.btn-close').click();
                Swal.fire(
                    'Success',
                    'Vehicle has been updated',
                    'success'
                )
                reloadVehicle();
            }
        });
    }

    function reloadVehicle() {
        $.get('{{ route('reloadVehicle') }}', function(data) {
            $('#tableVehicle').html(data)
        })
    }
</script>
