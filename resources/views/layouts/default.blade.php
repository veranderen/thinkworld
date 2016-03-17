<!DOCTYPE html>
<html>
    <head>
        @include('layouts.header')
    </head>
    <body>
        <div>
            @include('layouts.navbar')
        </div>
        <div class="container">
            @section('content')
            @show
        </div>
    </body>
</html>
