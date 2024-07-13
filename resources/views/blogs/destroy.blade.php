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
                {{-- <a href="{{ route('products.index') }}" class="btn btn-dark">Back</a> --}}
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-10">
                <div class="card borde-0 shadow-lg my-4">
                    <div class="card-header bg-dark">
                        <h3 class="text-white">Edit Product</h3>
                    </div>
                    <form enctype="multipart/form-data" action="{{ route('blogs.update', $blog->id) }}" method="post">
                        @method('put')
                        @csrf
                        {{-- title --}}
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="" class="form-label h5">Title</label>
                                <input value="{{ old('title', $blog->title) }}" type="text"
                                    class="@error('title') is-invalid @enderror form-control-lg form-control"
                                    placeholder="Name" name="title">
                                @error('title')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Content --}}
                            <div class="mb-3">
                                <label for="" class="form-label h5">Content</label>
                                <textarea placeholder="Content" class=" @error('content') is-invalid @enderror form-control" name="content"
                                    cols="30" rows="5">{{ old('content', $blog->content) }}</textarea>

                                @error('content')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>



                            {{-- Image --}}
                            <div class="mb-3">
                                <label for="" class="form-label h5">Image</label>

                                <input type="file" class="  form-control form-control-lg" placeholder="image"
                                    name="image">

                                @if ($blog->image != '')
                                    <img class="w-50" src="{{ asset('uploads/blogs/' . $blog->image) }}">
                                @endif
                            </div>

                            <div class="d-grid">
                                <button class="btn btn-lg btn-primary">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
