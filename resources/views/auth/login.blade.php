<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Đăng nhap</title>
</head>

<body>
    <div style="width: 200px; ">
        <form action="" method="POST" role="form">
            @csrf
            <h2>Dang nhap</h2>
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email" require>
                @error('email')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="Password" require>
                @error('password')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
            <button id="dang-nhap" type="submit" class="btn btn-primary">Dang nhap</button>
            {{Auth::user()}}
            <a href="{{ route('google.login') }}" class="btn btn-google btn-user btn-block">
                <i class="fab fa-google fa-fw"></i> Login with Google
            </a>
            <a href="{{ route('facebook.login') }}" class="btn btn-facebook btn-user btn-block">
                <i class="fab fa-facebook-f fa-fw"></i>
                Login with Facebook
            </a>
        </form>
    </div>
</body>
<script>
    $(function() {
        $('#dang-nhap').click(function(e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                'url': '{{route("login")}}',
                'data': {
                    'email': $('#email').val(),
                    'password': $('#password').val(),

                },
                'type': 'POST',
                success: function(data) {
                    console.log(data);
                    if (data.error == true) {
                        $('.error').show();
                        if (data.message.email != undefined) {
                            $('.errorEmail').show().text(data.message.email[0]);
                        }
                        if (data.message.password != undefined) {
                            $('.errorPassword').show().text(data.message.password[0]);
                        }
                    } else {
                        window.location.href = "http://127.0.0.1:8000/";
                    }
                }
            });
        })
    });
</script>

</html>