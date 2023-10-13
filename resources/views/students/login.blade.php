<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <!-- Template Main CSS File -->
    <link href="{{ asset('/assets/css/style.css') }}" rel="stylesheet">
    <title>Laravel App - Login Form</title>
    <style>
        /* Center the form vertically and horizontally */
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            background-image: url('{{ asset('storage/images/login_background.jpg') }}');
            /* Add your background image URL here */
            background-size: cover;
        }

        .login-container {
            background-color: rgba(255, 255, 255, 0.8);
            /* Add a semi-transparent white background */
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
            /* Add a shadow for the container */
            max-width: 400px;
            /* Set the maximum width of the container */
        }
    </style>
</head>

<body>
    <div class="login-container">
        <h1 class="h3 ms-4 mb-3 fw-normal">Student Login Form</h1>
        <form class="col-lg-12 row" action="{{ route('students.login') }}" method="post">
            @csrf
            <div class="form-outline mb-4">
                <div class="form-floating mb-4">
                    <input type="email" name="email" class="form-control" id="floatingInput"
                        placeholder="name@example.com">
                    <label for="floatingInput">Email address</label>
                </div>
                <span>
                    @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </span>
                <div class="form-outline mb-4">
                    <div class="form-floating">
                        <input type="password" name="password" class="form-control" id="floatingPassword"
                            placeholder="Password">
                        <label for="floatingPassword">Password</label>
                    </div>
                    <span>
                        @error('password')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </span>
                </div>
            </div>
            {{-- Add button --}}
            <div class="row">
                <div class="mx-auto mb-3 col-lg-6 d-flex">
                    <button type="submit" class="btn btn-primary btn-block mb-4" value="">
                        Login
                    </button>
                </div>
            </div>
        </form>
    </div>
</body>

</html>
