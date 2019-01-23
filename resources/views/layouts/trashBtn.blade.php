<button class="btn btn-sm btn-danger" data-toggle="confirmation"
        data-btn-ok-label="Sim" data-btn-ok-class="btn-success"
        data-btn-cancel-label="Não!" data-btn-cancel-class="btn-danger"
        data-title="Deseja excluir?">
        <i class="fas fa-trash"></i>
</button>

@section('script')
<script>
    var route = "{{ $route }}"
    $('[data-toggle=confirmation]').confirmation({
        rootSelector: '[data-toggle=confirmation]',
        onConfirm: function(value) {
            destroyData(route);
        }
    });

    function destroyData(route){
        var token = $("meta[name='csrf-token']").attr("content");
        $.ajax({
            url: route,
            method: 'DELETE',
            data: {
                "_token": token,
            },
        })
        .done(function( data ) {
            console.log(data);
        });
    }
</script>
@endsection