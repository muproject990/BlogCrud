<?php
if (Auth::check()) {
    $userId = Auth::id(); // Get authenticated user's ID
    echo 'Authenticated User ID: ' . $userId;
} else {
    echo 'User not authenticated.';
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blog Posts</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>


    <div class="bg-dark py-3">
        <h3 class="text-white text-center">Blog Posts</h3>
        <!-- resources/views/blogs/list.blade.php -->

    </div>

    {{-- Check if user is authenticated --}}
    @auth
        <p>Welcome, {{ auth()->user()->name }}</p>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-danger al">Logout</button>
        </form>
    @endauth

    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="col-md-10 d-flex justify-content-end">
                <a href="{{ route('blogs.create') }}" class="btn btn-dark">Create</a>
            </div>
        </div>
    </div>


    <div class="container">
        <div class="row d-flex justify-content-center ">
            @if (Session::has('success'))
                <div class="col-md-10">
                    <div class="alert alert-success">

                        {{ Session::get('success') }}

                    </div>
                </div>
        </div>
        @endif
        <div class="col-md-10">
            <div class="card borde-0 shadow-lg my-4">
                <div class="card-header bg-dark">
                    <h3 class="text-white">Blogs</h3>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th>Posted By</th>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Content</th>
                            <th>Created at</th>
                            <th>Action</th>
                            <th>Open</th>
                        </tr>
                        @if ($blogs->isNotEmpty())
                            @foreach ($blogs as $blog)
                                <tr>
                                    <td>{{ $blog->author->name }}</td>
                                    <td>{{ $blog->title }}</td>
                                    <td>
                                        @if ($blog->image != '')
                                            <img width="90" height="70"
                                                src="{{ asset('uploads/blogs/' . $blog->image) }}" alt="">
                                        @endif
                                    </td>

                                    <td>{{ $blog->content }}</td>
                                    <td>{{ \Carbon\Carbon::parse($blog->created_at)->format('d M,Y') }}</td>



                                    <td>
                                        <a href="{{ route('blogs.edit', $blog->id) }}" class="btn btn-dark">Edit</a>



                                        <button onclick="deleteBlog({{ $blog->id }})"
                                            class="btn btn-danger">Delete</button>

                                        <form id="delete-blog-form-{{ $blog->id }}"
                                            action="{{ route('blogs.destroy', $blog->id) }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>

                                    <td>
                                        <a href="{{ route('blogs.open', $blog->id) }}"
                                            class="btn btn-outline-primary">Open</a>
                                    </td>

                                </tr>
                            @endforeach
                        @endif
                    </table>
                </div>

            </div>
        </div>
    </div>

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

</body>

</html>
