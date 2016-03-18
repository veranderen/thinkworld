<!DOCTYPE html>
<html>
    <head>
        @include('layouts.header')
    </head>
    <body>
        @include('layouts.navbar')
        <div class="container">
            @section('content')
            @show
        </div>
    </body>
</html>
