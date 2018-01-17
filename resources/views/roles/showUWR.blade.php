<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="/css/main.css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="/">WebSiteName</a>
        </div>
        @if($user -> role == '1')
        <ul class="nav navbar-nav create" style="float: right">
            <li><a href="/">Users</a></li>
            <li><a href="/create">Create User</a></li>
        </ul>
        @endif
        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                &nbsp;
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        {{ $user->name }} {{ $user->role }}  <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu" role="menu">
                        <li>
                            <a href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container">
    <table class="table table-bordered">
        <tr>
            <th>
                id
            </th>
            <th>
                Имя
            </th>
            <th>
                Действие
            </th>
        </tr>
        @foreach($result as $res)
        <tr>
            <td>
                {{ $res->id }}
            </td>
            <td>
                {{ $res->name }}
            </td>
            <td style="width: 200px;">
                <div style="width: 200px;">
                    <a href="/user/{{ $res->id }}">Подробнее/редактировать</a>
                </div>
            </td>
        </tr>
        @endforeach
        </table>
</div>

