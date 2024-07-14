<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Post</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="bg-dark py-3">
        <h3 class="text-white text-center">Single Blog Posts</h3>
    </div>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card h-100">
                    <!-- Blog post image -->
                    <img src="{{ asset('uploads/blogs/' . $blog->image) }}" class="card-img-top"
                        alt="{{ $blog->title }}">
                    <!-- Blog post content -->
                    <div class="card-body text-center">
                        <h5 class="card-title">{{ $blog->title }}</h5>
                        <p class="card-text">{{ $blog->content }}</p>
                    </div>
                    <!-- Blog post footer with author name -->
                    <div class="card-footer text-center">
                        <small class="text-muted">By {{ $blog->author->name }}</small>
                    </div>
                    <!-- Comments section -->
                    <div class="card-footer">
                        <h6 class="text-center">Comments</h6>
                        <ul class="list-unstyled">
                            {{-- @foreach ($blog->comments as $comment)
                                <li class="border-top pt-2 mt-2 text-center">
                                    <p>{{ $comment->content }}</p>
                                    <small class="text-muted">By {{ $comment->user->name }}</small>
                                </li>
                            @endforeach --}}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
