<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style>
        /* Optional: Custom styles */
        .form-signin {
            max-width: 400px;
            margin: auto;
        }
    </style>
</head>

<body class="text-center">

    <main class="form-signin">
        <form method="POST" action="{{ route('register.post') }}" class="p-4 border rounded shadow-sm">
            @csrf

            <h1 class="h3 mb-3 fw-normal">User Registration</h1>

            <div class="form-floating mb-3">
                <input type="text" id="name" name="name"
                    class="form-control @error('name') is-invalid @enderror" placeholder="Name"
                    value="{{ old('name') }}" required autofocus>
                <label for="name">Name</label>
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-floating mb-3">
                <input type="email" id="email" name="email"
                    class="form-control @error('email') is-invalid @enderror" placeholder="Email address"
                    value="{{ old('email') }}" required>
                <label for="email">Email address</label>
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-floating mb-3">
                <input type="password" id="password" name="password"
                    class="form-control @error('password') is-invalid @enderror" placeholder="Password" required>
                <label for="password">Password</label>
                @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-floating mb-3">
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control"
                    placeholder="Confirm Password" required>
                <label for="password_confirmation">Confirm Password</label>
            </div>

            <button class="w-100 btn btn-lg btn-primary" type="submit">Register</button>
        </form>
    </main>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</body>

</html>
