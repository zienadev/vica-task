@extends('layouts.app')

@section('title', 'edit post')

@section('content')
    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="col-md-10 d-flex justify-content-end">
                <a href="{{ route('posts.index') }}" class="btn btn-secondary">Back</a>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-10">
                <div class="card borde-0 shadow-lg my-4">
                    <div class="card-header bg-dark">
                        <h3 class="text-white">Edit Post</h3>
                    </div>
                    <form enctype="multipart/form-data" action="{{ route('posts.update', $post->id) }}" method="post"
                        enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="formGroupExampleInput" id="formGroupExampleInput"
                                    class="form-label h6 ">Title</label>
                                <input value="{{ old('title', $post->title) }}" type="text"
                                    class="@error('title') is-invalid
                        @enderror form-control-lg form-control"
                                    placeholder="Post Title" name="title">
                                @error('title')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="floatingTextarea2" class="form-label h6">Description</label>
                                {{-- <div class="form-floating"> --}}
                                <textarea class="form-control" placeholder="Leave a description here" id="floatingTextarea2" style="height: 90px"
                                    class="@error('description') is-invalid
                                        @enderror   form-control-lg form-control"
                                    name="description">{{ old('description', $post->description) }}</textarea>
                                {{-- </div> --}}
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="formGroupExampleInput3" class="form-label h6">Image</label>
                                <input type="file" id="formGroupExampleInput3" class="form-control form-control-sm"
                                    placeholder="image" name="image">
                                @if ($post->image != '')
                                    <img class="w-50 my-3" src="{{ asset('images/posts/' . $post->image) }}" alt="">
                                @endif
                            </div>
                            {{-- <div class="d-grid"> --}}
                            <button class="btn  btn-primary">Update</button>
                            {{-- </div> --}}
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <script>
        function deleteSkill(id) {
            if (confirm("Are you sure you want to delete skill?")) {
                document.getElementById("delete-skill-from-" + id).submit();
            }
        }
    </script>


@endsection
