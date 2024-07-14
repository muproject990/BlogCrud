<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <style>
        /* Optional: Custom styles */
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-color: #f8f9fa;
        }

        .form-signin {
            width: 100%;
            max-width: 400px;
            padding: 15px;
            margin: auto;
            background-color: #ffffff;
            border: 1px solid #ced4da;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-floating {
            margin-bottom: 1rem;
        }
    </style>
</head>

<body>

    <main class="form-signin">
        <form method="POST" action="{{ route('register.post') }}" class="p-4 rounded shadow-sm">
            @csrf

            <h2 class="mb-4 text-center">User Registration</h2>

            <div class="form-floating mb-3">
                <input type="text" id="name" name="name" class="form-control " placeholder="Name"
                    value="{{ old('name') }}" required autofocus>
                <label for="name">Name</label>

            </div>

            <div class="form-floating mb-3">
                <input type="email" id="email" name="email" class="form-control " placeholder="Email address"
                    value="{{ old('email') }}" required>
                <label for="email">Email address</label>

            </div>

            <div class="form-floating mb-3">
                <input type="password" id="password" name="password" class="form-control " placeholder="Password"
                    required>
                <label for="password">Password</label>

            </div>

            <div class="form-floating mb-3">
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control"
                    placeholder="Confirm Password" required>
                <label for="password_confirmation">Confirm Password</label>
            </div>

            <button class="w-100 btn btn-lg btn-primary" type="submit">Register</button>
        </form>

        <div class="mt-3 text-center">
            <p class="mb-0">Already have an account? <a href="{{ route('api.login') }}">Login here</a></p>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
</body>

</html>
