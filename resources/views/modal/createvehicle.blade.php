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
</div>

<script>
    function store() {
        // console.log('send')
        var merk = $('#merk').val()
        var fuel = $('#fuel').val()
        var maintenance = $('#maintenance').val()
        var history_used = $('#history_used').val()
        var owner = $('#owner').val()
        $.ajax({
            url: '{{ route('storeVehicle') }}',
            type: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                "merk": merk,
                "fuel": fuel,
                "maintenance": maintenance,
                "history_used": history_used,
                "owner": owner
            },
            dataType: 'json',
            success: function(data) {
                $('.btn-close').click();
            }
        });
    }
</script>
