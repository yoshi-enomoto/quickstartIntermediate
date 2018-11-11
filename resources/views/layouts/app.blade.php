<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Laravel Quickstart - Intermediate</title>

        <!-- CSSとJavaScript -->
        <!-- Fonts -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>

        <!-- Styles -->
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    </head>

    <body>
        <nav class="navbar navbar-default">
            <div class="container">
                <!-- ナビバーの内容 -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="{{ url('/')  }}">
                    Task List
                    </a>
                </div>
            </div>
        </nav>
        <!-- 下記の箇所に子のviewが挿入される -->
        @yield('content')

        <!-- JavaScripts -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    </body>
</html>
