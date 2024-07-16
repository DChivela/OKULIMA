@if(session('error'))
    <div class="col-12">
        <div class="callout callout-error">
            &nbsp;&nbsp; <strong>Erro! </strong> {{ session('error') }}.
            {{-- <a href="https://getbootstrap.com/docs/5.3/forms/overview/" target="_blank" rel="noopener noreferrer" class="callout-link"> Bootstrap Form </a> --}}
        </div>
    </div>
@endif
@if(session('success'))
    <div class="col-12">
        <div class="callout callout-success">
            &nbsp;&nbsp; <strong>Sucesso! </strong> {{ session('success') }}.
            {{-- <a href="https://getbootstrap.com/docs/5.3/forms/overview/" target="_blank" rel="noopener noreferrer" class="callout-link"> Bootstrap Form </a> --}}
        </div>
    </div>
@endif
@if(session('warning'))
    <div class="col-12">
        <div class="callout callout-warning">
            &nbsp;&nbsp; <strong>Aviso! </strong> {{ session('warning') }}.
            {{-- <a href="https://getbootstrap.com/docs/5.3/forms/overview/" target="_blank" rel="noopener noreferrer" class="callout-link"> Bootstrap Form </a> --}}
        </div>
    </div>
@endif
@if(session('info'))
    <div class="col-12">
        <div class="callout callout-info">
            &nbsp;&nbsp; <strong>Info! </strong> {{ session('info') }}.
            {{-- <a href="https://getbootstrap.com/docs/5.3/forms/overview/" target="_blank" rel="noopener noreferrer" class="callout-link"> Bootstrap Form </a> --}}
        </div>
    </div>
@endif
