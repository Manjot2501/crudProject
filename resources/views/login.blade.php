<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel Assignment</title>
    <!-- bootstrap cdn -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<style>
    .mj-login_form {
        width: 350px;
    }

</style>

<body>
    <div class="container">
        @if (session('error'))
            <div class="alert alert-danger text-center" role="alert">
                {{ session('error') }}
            </div>
        @endif
        <div class="d-flex justify-content-center mt-5">
            <form class="border px-4 py-3 shadow mj-login_form" method="post" action="{{ route('loginSubmit') }}">
                <h1 class="text-uppercase text-center mb-3">Login</h1>
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="floatingInput" name="email"
                        placeholder="name@example.com">
                    <label for="floatingInput">Email address</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="floatingPassword" name="password"
                        placeholder="Password">
                    <label for="floatingPassword">Password</label>
                </div>
                @csrf
                <input type="submit" value="Login" class="w-100 btn btn-lg btn-primary mb-3">
                <hr>
                <span class="lead"><b>Note:</b></span>
                <p class="m-0">
                    <b>Email - </b><u>admin@gmail.com</u>
                    <br>
                    <b>Password - </b><u>admin@123</u>
                </p>
            </form>
        </div>
    </div>
</body>

</html>
