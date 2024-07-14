<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blog Posts</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style>
        .blog-card {
            transition: transform 0.3s;
        }

        .blog-card:hover {
            transform: translateY(-5px);
            <form class="d-flex" action="{{ route('blogs.index') }}" method="GET"><input class="form-control me-2" type="search" placeholder="Search blogs" aria-label="Search" name="search"><button class="btn btn-outline-light" type="submit">Search</button></form>
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Blog Website</a>
            <div class="ml-auto">
                @auth
                    <span class="text-white mr-3">Welcome, {{ auth()->user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-outline-light">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-light">Login</a>
                @endauth
            </div>
        </div>

        /* Search UI */

        <div>
            <form class="d-flex" action="{{ route('blogs.search') }}" method="GET">
                <input class="form-control me-2" type="search" placeholder="Search blogs" aria-label="Search"
                    name="search">
                <button class="btn btn-outline-light" type="submit">Search</button>
            </form>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row justify-content-between align-items-center mb-4">
            <div class="col-auto">
                <h1>Blog Posts</h1>
            </div>
            <div class="col-auto">
                <a href="{{ route('blogs.create') }}" class="btn btn-primary">Create New Post</a>
            </div>
        </div>


        {{-- Search --}}





        <br>
        @if (Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif

        <div class="row">
            @if ($blogs->isNotEmpty())
                @foreach ($blogs as $blog)
                    <div class="col-md-4 mb-4">
                        <div class="card blog-card h-100">
                            @if ($blog->image != '')
                                <img src="{{ asset('uploads/blogs/' . $blog->image) }}" class="card-img-top"
                                    alt="{{ $blog->title }}">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $blog->title }}</h5>
                                <p class="card-text">{{ Str::limit($blog->content, 100) }}</p>
                                <p class="card-text"><small class="text-muted">By {{ $blog->author->name }} on
                                        {{ \Carbon\Carbon::parse($blog->created_at)->format('d M, Y') }}</small></p>
                            </div>
                            <div class="card-footer bg-transparent border-top-0">
                                <a href="{{ route('blogs.open', $blog->id) }}"
                                    class="btn btn-sm btn-outline-primary">Read More</a>
                                <a href="{{ route('blogs.edit', $blog->id) }}"
                                    class="btn btn-sm btn-outline-secondary">Edit</a>
                                <button onclick="deleteBlog({{ $blog->id }})"
                                    class="btn btn-sm btn-outline-danger">Delete</button>

                                <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                    data-bs-target="#commentModal{{ $blog->id }}">
                                    Comment Here
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-12">
                    <p class="text-center">No blog posts found.</p>
                </div>
            @endif
        </div>



        <!-- Comment Pop of model Modal -->

        @foreach ($blogs as $blog)
            <div class="modal fade" id="commentModal{{ $blog->id }}" tabindex="-1"
                aria-labelledby="commentModalLabel{{ $blog->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="commentModalLabel{{ $blog->id }}">Comment on
                                "{{ $blog->title }}"</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        {{-- {{ route('blogs.comment.store', $blog->id) }} --}}
                        <form action="{{ route('blogs.comment', $blog->id) }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="comment{{ $blog->id }}" class="form-label">Your Comment</label>
                                    <textarea class="form-control" id="comment{{ $blog->id }}" name="content" rows="3" required></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Submit Comment</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function deleteBlog(id) {
            if (confirm('Are you sure you want to delete this blog post?')) {
                var form = document.getElementById('delete-blog-form-' + id);
                if (form) {
                    form.submit();
                } else {
                    console.error('Delete form not found for blog ID: ' + id);
                }
            }
        }
    </script>

    @foreach ($blogs as $blog)
        <form id="delete-blog-form-{{ $blog->id }}" action="{{ route('blogs.destroy', $blog->id) }}"
            method="POST" style="display: none;">
            @csrf
            @method('DELETE')
        </form>
    @endforeach
</body>

</html>
