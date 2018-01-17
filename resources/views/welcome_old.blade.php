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
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
    </head>
    <body>
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">WebSiteName</a>
            </div>
            <ul class="nav navbar-nav create" style="float: right">
                <!--li class="active"><a href="#">Home</a></li-->
                <li><a href="#">Users</a></li>
                <li><a href="/create">Create User</a></li>
            </ul>
            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    &nbsp;
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                    <li><a href="{{ route('login') }}">Login</a></li>
                    <li><a href="{{ route('register') }}">Register</a></li>
                    @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} {{ Auth::user()->role }}  <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href=""
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                    @endif
                </ul>
            </div>
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
                    <th>Действие</th>
                    <th>Image</th>
                </tr>
            </thead>
            @foreach($users as $num => $res)
            <tr class="form_row">
                <td><input type="text" name="rrr" class="name form-control" value="{{$res->name}}"/></td>
                <td><input type="text" class="firstname form-control" value="{{$res->firstname}}"/></td>
                <td><input type="text" class="Phone form-control" value="{{$res->Phone}}"/> </td>
                <td><input type="text" class="City form-control" value="{{$res->City}}"/> </td>
                <td style="text-align: center;"><input name="fdfdfd0" type="checkbox" class="activity" {{ $res -> activity == 1?'checked':'' }}/> </td>
                <td><select class="form-control role">
                        @foreach($roles as $role)
                            <option value="{{$role->id}}" {{ $role -> id == $res -> role?'selected':'' }}>
                                {{ $role->name }}

                            </option>
                        @endforeach
                </select>
                </td>
                <td style="text-align: center;">
                    <i style="cursor:pointer;margin-right:10px;color:gray;" class="glyphicon glyphicon-ok updateBtn btn" active="false" onclick="updateRow($(this).closest('tr'),'{{$res -> id}}','{{$res -> activity}}','{{ Auth::user()->role }}')"></i>
                    <i style="color:red;" class="glyphicon glyphicon-remove btn" onclick="modalDelete('{{$res -> id}}','{{ Auth::user()->role }}')"></i>
                </td>
                <td>
                    <div class="btn img_Btn" style="background-color: green"></div>
                </td>
            </tr>
            @endforeach
        </table>
        <form id="update_form" action="" method="post" style="display: none;" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="text" name="name" value="">
            <input type="text" name="firstname" value="">
            <input type="text" name="Phone" value="">
            <input type="text" name="City" value="">
            <input type="text" name="activity" value="">
            <input type="text" name="role" value="">
            <input type="text" name="image" value="">
        </form>


        <form id="update_form" action="/update/55" method="post" style="" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input class="tryN" type="file" name="image" value="">
            <input type="submit">
        </form>
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
    </div>

    <script>


        $(document).ready(function(){
            $('.updateBtn').on('submit', function(e){
                e.preventDefault();

                $.ajax({
                    type: 'POST',
                    url: 'update_form',
                    data: $('#contactform').serialize(),
                    success: function(result){
                        console.log(result);
                    }
                });
            });
        });


        function updateRow(tr,$id,act, actRole){
            console.log(tr.find('input, select').serialize());
            if(actRole==0){
            if(tr.find('.updateBtn').attr('active') == 'false') {
                return false;
            }
            var name = tr.find('.name').val();
            var firstname = tr.find('.firstname').val();
            var Phone = tr.find('.Phone').val();
            var City = tr.find('.City').val();
            var activity = tr.find('.activity');
            if(activity.prop('checked')){act=1;} else {act=0;}
            var role = tr.find('.role').val();
            var img = ('.tryN')[0].files[0].name;

            setForm($id,name,firstname,Phone,City,act,role,img);
            }
            else{
                alert("You are not admin, sorry.");
            }
        }

        function setForm($id, name, firstname, Phone, City, act, role,img){
            $('#update_form').attr('action','/update/' + $id);
            $('#update_form').find('input[name=name]').val(name);
            $('#update_form').find('input[name=firstname]').val(firstname);
            $('#update_form').find('input[name=Phone]').val(Phone);
            $('#update_form').find('input[name=City]').val(City);
            $('#update_form').find('input[name=activity]').val(act);
            $('#update_form').find('input[name=role]').val(role);
            $('#update_form').find('input[name=image]').val(img);
            $('#update_form').submit();
        }

        $('input, select').change(function(){
            $(this).closest('tr').find('.updateBtn').css('color','green');
            $(this).closest('tr').find('.updateBtn').attr('active','true');
        });

        function modalDelete(id,actRole){
            if(actRole==0){
            $("#myModalDelete").modal('show');
            $(".conf").click(function(){
                location.href = "/delete/"+id;
            })
            }
            else{
                alert("You are not admin, sorry");
            }
        }

        $(document).ready(
        function hideLink(){
            var actRole = "{{ Auth::user()->role }}";
            if(actRole!='0'){
                $('.create').css('display','none');
            }
            console.log(actRole);
        });

    </script>
    </body>
</html>
