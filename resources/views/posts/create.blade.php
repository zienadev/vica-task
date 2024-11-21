@extends('layouts.app')

@section('title', 'create post')

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
                        <h3 class="text-white">Add New Post</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="formGroupExampleInput" class="form-label h6">Title</label>
                                <input type="text" name="title" value="{{ old('title') }}" class="form-control"
                                    id="formGroupExampleInput" placeholder="Enter Post Title" required>
                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="floatingTextarea2" class="form-label h6">Description</label>
                                <textarea class="form-control" placeholder="Leave a Descriprion here" id="floatingTextarea2" name="description"
                                    style="height: 100px" required>{{ old('description') }}</textarea>
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="formGroupExampleInput3" class="form-label h6">Image</label>
                                <input type="file" name="image" value="{{ old('image') }}" class="form-control"
                                    id="formGroupExampleInput3" placeholder="Choose Image" required>
                                @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Send</button>

                        </form>

                    </div>
                </div>
            </div>


        @endsection
