
@if ($errors->any())
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <i class="fa fa-exclamation-triangle"></i>&nbsp;&nbsp;<strong>Erro!</strong> {{ $error }}.
        </div>
    @endforeach
@endif
