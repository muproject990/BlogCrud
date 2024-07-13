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
    </div>

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
                            <th>id</th>
                            <th>Title</th>
                            <th></th>
                            <th>Content</th>
                            <th>Created at</th>
                            <th>Action</th>
                        </tr>
                        @if ($blogs->isNotEmpty())
                            @foreach ($blogs as $blog)
                                <tr>
                                    <td>{{ $blog->id }}</td>
                                    <td>{{ $blog->title }}</td>
                                    <td>
                                        @if ($blog->image != '')
                                            <img width="50" height="80"
                                                src="{{ asset('uploads/blogs/' . $blog->image) }}" alt="">
                                        @endif
                                    </td>

                                    <td>{{ $blog->content }}</td>
                                    <td>{{ \Carbon\Carbon::parse($blog->created_at)->format('d M,Y') }}</td>



                                    <td>
                                        <a href="" class="btn btn-dark ">Edit</a>
                                        <a href="" class="btn btn-danger ">Delete</a>
                                    </td>
                                    <td></td>
                                </tr>
                            @endforeach
                        @endif
                    </table>
                </div>

            </div>
        </div>
    </div>

</body>

</html>
