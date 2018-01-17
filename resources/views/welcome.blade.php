<!doctype html>
<html lang="{{ app()->getLocale() }}">
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
                <a class="navbar-brand" href="#">WebSiteName</a>
            </div>
            @if($user -> role == '1')
                <ul class="nav navbar-nav create" style="float: right">
                    <li><a href="#">Users</a></li>
                    <li><a href="/create">Create User</a></li>
                    <li><a href="/view">Roles</a></li>
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
            <thead>
                <tr>
                    <th>Имя</th>
                    <th>Фамилия</th>
                    <th>Телефон</th>
                    <th>Город</th>
                    <th>Активность</th>
                    <th>Роль</th>
                    <th>Аватар</th>
                    <th>Действие</th>
                </tr>
            </thead>
            @foreach($users as $num => $res)

            <tr class="form_row">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <td>
                    <input type="text" name="name" class="name form-control" value="{{$res->name}}"/>
                </td>
                <td>
                    <input type="text" name="firstname" class="firstname form-control" value="{{$res->firstname}}"/>
                </td>
                <td>
                    <input type="text" name="Phone" class="Phone form-control" value="{{$res->Phone}}"/>
                </td>
                <td>
                    <input type="text" name="City" class="City form-control" value="{{$res->City}}"/>
                </td>
                <td style="text-align: center;">
                    <input name="activity" type="checkbox" class="activity" {{ $res -> activity == 1?'checked':'' }}/>
                </td>
                <td>
                    <select name="role" class="form-control role">
                        @foreach($roles as $role)
                            <option value="{{$role->id}}" {{ $role -> id == $res -> role?'selected':'' }}>
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </select>
                </td>
                <td>
                    @if($res -> image_url)
                    <div class="file-upload" style="background-image: url('{{$res -> image_url}}');">
                        <label>
                            <input type="file" name="image" src="{{$res -> image_url}}" class="image" >
                        </label>
                    </div>
                    <input type="text" id="filename" class="filename" disabled>
                    @else
                        <div class="file-upload" style="background-image: url('{{$res -> image_url}}');">
                            <label>
                                <input type="file" name="image" src="avatars/default_avatar.jpg" class="image" >
                            </label>
                        </div>
                        <input type="text" id="filename" class="filename" disabled>
                    @endif
                </td>
                <td style="text-align: center;">
                    <i style="cursor:pointer;margin-right:10px;color:gray;" class="glyphicon glyphicon-ok updateBtn btn" active="false" onclick="updateRow($(this).closest('tr'),'{{$res -> id}}')"></i>
                    <i style="color:red;" class="glyphicon glyphicon-remove btn" onclick="modalDelete('{{$res -> id}}','{{ Auth::user()->role }}')"></i>
                </td>
            </tr>

            @endforeach
        </table>
    </div>

    <div id="myModalDelete" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
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
    </div>

    <script>
        $(document).ready(function(){
            $('input, select').change(function(){
                $(this).closest('tr').find('.updateBtn').css('color','green');
                $(this).closest('tr').find('.updateBtn').attr('active','true');
            });

            $(".file-upload input[type=file]").change(function(){
                $(this).closest('tr').find('.file-upload').css('background-image','');
                $(this).closest('tr').find('.file-upload').addClass('file-upload-noactive');
                $(this).closest('tr').find('.file-upload').removeClass('file-upload');
            });
        });

        function getData(row) {
            var act = 0;
            if($(row).find('input[name=activity]').prop('checked')){
                act = 1;
            }

            var data = new FormData;

            if($(row).find('.image').length > 0) {
                data.append('image',$(row).find('.image').prop('files')[0]);
            }
            data.append('_token',$(row).find('input[name=_token]').val());
            data.append('name',$(row).find('input[name=name]').val());
            data.append('firstname',$(row).find('input[name=firstname]').val());
            data.append('Phone',$(row).find('input[name=Phone]').val());
            data.append('City',$(row).find('input[name=City]').val());
            data.append('activity',act);
            data.append('role',$(row).find('select[name=role]').val());


            return data;
        }

        function updateRow(row, id) {
            var data = getData(row);
            $.ajax({
                type: "POST",
                url: "/update/" + id,
                data: data,
                processData: false,
                contentType: false,
                dataType: "json",
                success: function (response) {
                    $(row).find(".file-upload-noactive").addClass('file-upload');
                    $(row).find(".file-upload").css('background-image', 'url(' + response + ')');
                    $(row).find(".file-upload-noactive").removeClass('file-upload-noactive');


                    $(row).find(".file-upload").fadeOut(800, function(){
                        $(row).find(".file-upload").fadeIn().delay(2000);
                    });
                    //$(".file-upload").css('background-image', response);
                }
            });
        }

      /*  var name = 'VOVA';
        $.ajax({
            type: "POST",
            url: "/update/" + id,
            data: {
                number : '2312321',
                name : name
            },
            dataType: "json",
            success: function (response) {
                alert(response);
            }
        });*/

        function modalDelete(id,actRole){
            if(actRole==1){
            $("#myModalDelete").modal('show');
            $(".conf").click(function(){
                location.href = "/delete/"+id;
            })
            }
            else{
                alert("You are not admin, sorry");
            }
        }
    </script>
    </body>
</html>
