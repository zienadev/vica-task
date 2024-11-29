@extends('layouts.app')

@section('title', 'Post')

@section('content')

    <body>
        {{-- <div class="bg-dark py-3">
            <h3 class="text-white text-center">Blog</h3>
        </div> --}}
        <div class="container">
            <div class="row justify-content-center mt-4">
                <div class="col-md-10 d-flex justify-content-end">
                    <a href={{ route('posts.create') }} class="btn btn-primary">Add New Post</a>
                </div>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-md-16">
                    <div class="card borde-0 shadow-lg my-4">
                        <div class="card-header bg-dark">
                            <h3 class="text-white">Posts</h3>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <tr>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                                @if ($posts->isNotEmpty())
                                    @foreach ($posts as $post)
                                        <tr>
                                            <td>{{ $post->title }}</td>
                                            <td>{{ $post->description }}</td>
                                            <td>
                                                @if (is_array($post->images))
                                                    @foreach (json_decode($post->images) as $image)
                                                        <img width="50" height="50"
                                                            src="{{ asset('/images/posts/' . $image) }} " alt="">
                                                    @endforeach
                                                @endif
                                            </td>
                                            <td>

                                                <a href="{{ route('posts.edit', $post) }}"
                                                    class="btn btn-secondary">Edit</a>
                                                <a href="{{ route('posts.show', $post) }}" class="btn btn-dark">Show</a>
                                                <a href="#" onclick="deletePost({{ $post->id }});"
                                                    class="btn btn-danger">Delete</a>
                                                <form id="delete-post-from-{{ $post->id }}"
                                                    action="{{ route('posts.destroy', $post) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach

                                @endif

                            </table>
                        </div>

                    </div>

                </div>
            </div>
    </body>
@endsection

</html>

<script>
    function deletePost(id) {
        if (confirm("Are you sure you want to delete Post?")) {
            document.getElementById("delete-post-from-" + id).submit();
        }
    }
</script>
