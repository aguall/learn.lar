<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
</head>
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">WebSiteName</a>
        </div>
        <ul class="nav navbar-nav" style="float: right">
            <!--li class="active"><a href="#">Home</a></li-->
            <li><a href="/">Users</a></li>
            <li><a href="/create">Create User</a></li>
        </ul>

    </div>
</nav>
<div class="container">
    <form method="post" action="/createUser">
    <table class="table table-bordered">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <thead>
        <tr>
            <th>Имя</th>
            <th>Фамилия</th>
            <th>Телефон</th>
            <th>Город</th>
            <th>Активность</th>
            <th>Роль</th>
            <th>Действие</th>
        </tr>
        </thead>
        <tr>
            <td>
                <input type="text" name="name[]" class="name form-control" value=""/>
            </td>
            <td>
                <input type="text" name="firstname[]" class="firstname form-control" value=""/>
            </td>
            <td>
                <input type="text" name="Phone[]" class="Phone form-control" value=""/>
            </td>
            <td>
                <input type="text" name="City[]" class="City form-control" value=""/>
            </td>
            <td style="text-align: center;">
                <input type="hidden" name="activity[]" class="activity" value="0">
                <input type="checkbox" class="activity_check">
            </td>
            <td>
                <select name="role[]" class="form-control role" >
                    @foreach($roles as $role)
                        <option value="{{$role->id}}">
                            {{ $role->name }}
                        </option>
                    @endforeach
                </select>
            </td>
            <td style="text-align: center;">
                <i style="color:red;" class="glyphicon glyphicon-remove btn removeTr"></i>
            </td>

        </tr>

    </table>
        <input type="submit" class="btn" style="float: right; position: relative; top: 50px;">
    </form>
    <i style="color:white; background-color: green; float:right; margin-right: -68px;" class="glyphicon glyphicon-plus btn" onclick="addRow()"></i>
</div>
<div id="myModalDelete" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Заголовок модального окна -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Подтвердите действие</h4>
            </div>
            <div class="modal-body">Удаление пользователя</div>
            <div class="modal-body">
                Вы действиткльно хотите удалить пользователя?
            </div>
            <!-- Футер модального окна -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default cans" data-dismiss="modal" style="background-color: green;">Нет</button>
                <button type="button" class="btn btn-primary conf" style="background-color: red;">Да</button>
            </div>
        </div>
    </div>
<script>

    $('body').on('change','.activity_check',function(){
            if($(this).prop('checked')) {
                $(this).closest('tr').find('.activity').val(1);
            } else {
                $(this).closest('tr').find('.activity').val(0);
            }
        }
    );
    function addRow(){
        $('.table tr:last').after(
            '<tr>' +
                '<td>' +
                    '<input type="text" name="name[]" class="name form-control" value="">' +
                '</td>' +
                '<td>' +
                    '<input type="text" name="firstname[]" class="firstname form-control" value="">' +
                '</td>' +
                '<td>' +
                    '<input type="text" name="Phone[]" class="Phone form-control" value="">' +
                '</td>' +
                '<td>' +
                    '<input type="text" name="City[]" class="City form-control" value="">' +
                '</td>' +
                '<td style="text-align: center;">' +
                    '<input type="hidden" name="activity[]" class="activity" value="0">' +
                    '<input type="checkbox" class="activity_check">' +
                '</td>'+
                '<td>' +
                    '<select name="role[]" class="form-control role">' +
                        '@foreach($roles as $role)' +
                            '<option value="{{$role->id}}"> {{ $role->name }} </option>' +
                        '@endforeach'+
                    '</select>' +
                '</td>' +
                '<td style="text-align: center;">' +
                    '<i style="color:red;" class="glyphicon glyphicon-remove btn removeTr"></i>' +
                '</td>' +
            '</tr>'
        );
    }
    $('body').on('click','.removeTr',function(){
        $(this).closest('tr').remove();
    });

</script>