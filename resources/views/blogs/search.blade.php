<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Search</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form class="d-flex" action="{{ route('blogs.search') }}" method="GET">
                    <input class="form-control me-2" type="search" placeholder="Search blogs" aria-label="Search"
                        name="search" value="{{ request()->input('search') }}">
                    <button class="btn btn-outline-primary" type="submit">Search</button>
                </form>
            </div>
        </div>

        <!-- Display search results -->
        @if (isset($blogs))
            <div class="row mt-4">
                @foreach ($blogs as $blog)
                    <form action="{{ route('blogs.open', $blog->id) }}">
                        <div class="col-md-6 mb-4">
                            <div class="card">
                                <img src="{{ asset('uploads/blogs/' . $blog->image) }}" class="card-img-top"
                                    alt="{{ $blog->title }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $blog->title }}</h5>
                                    <p class="card-text">{{ Str::limit($blog->content, 150) }}</p>
                                </div>
                            </div>
                            <button href="{{ route('blogs.open', $blog->id) }}" class="btn btn-sm btn-outline-primary">
                                View Details
                            </button>
                        </div>
                    </form>
                @endforeach
            </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
