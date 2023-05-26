<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/tailwinds.min.css">
    <title>Login Page</title>
</head>

<div class="flex py-10 md:py-20 px-5 md:px-32 bg-gray-900 min-h-screen">
    <div class="flex shadow w-full flex-col-reverse lg:flex-row">
        <div class="w-full lg:w-1/2 bg-white p-10 px-5 md:px-20">
            <h1 class="font-bold text-xl text-gray-700">Login Page</h1>
            <p class="text-gray-600">Please login to start your session!</p><br>

            @if (Session::has('errors'))
            <ul class="text-red-600">
               @foreach (Session::get('errors') as $error)
                   <li style="color: red">{{$error[0]}}</li>
               @endforeach
            </ul>
            @endif

            @if (Session::has('success'))
                <p style="color: green">{{Session::get('success')}}</p>
            @endif

            @if (Session::has('failed'))
                <p style="color: red">{{Session::get('failed')}}</p>
            @endif

            <form action="/login_member" method="POST" class="mt-10">
                @csrf
                <div class="my-3">
                    <label class="font-semibold" for="email">E-mail</label>
                    <input required type="text" placeholder="yourmail@example.com" name="email" id="email"
                        class="block border-2 rounded-full mt-2 py-2 px-5 w-full">
                </div>
                <div class="my-3">
                    <label class="font-semibold" for="password">Password</label>
                    <input required type="password" placeholder="password" name="password" id="password"
                        class="block border-2 rounded-full mt-2 py-2 px-5 w-full">
                </div>
                <div class="my-5">
                    <button type="submit"
                        class="w-full rounded-full bg-blue-500 hover:bg-blue-800 text-white py-2">LOGIN</button>
                </div>
            </form>
            <span>Dont have an account? <a href="/register_member" class="text-blue-400 hover:text-blue-600">Create
                    here.</a></span>
        </div>
        <div class="w-full lg:w-1/2 bg-blue-800 flex justify-center items-center">
            <img src="assets/Register_Member1.jpeg" alt="Login Image" class="w-full h-full">
        </div>
    </div>
</div>

<body>

</body>

</html>
