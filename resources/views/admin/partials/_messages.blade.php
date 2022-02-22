@if (session('success'))
    <div class="alert alert-success alert-dismissible" role="alert">
        <button class="close" type="button" data-dismiss="alert">x</button>
        <strong>{{ session('success') }}</strong>
    </div>
@endif
