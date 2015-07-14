<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{ elixir("css/app.css") }}">

{!! Toastr::render() !!}

@if (count($errors) > 0)
    <script>
        $(document).ready(function() {

            toastr.options.showEasing = 'swing';
            toastr.options.hideEasing = 'linear';
            toastr.options.progressBar = true;
            toastr.options.closeButton = true;

            @foreach ($errors->all() as $error)
                toastr.error('{{ $error }}');
            @endforeach
        });
    </script>
@endif
