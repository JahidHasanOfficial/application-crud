<!-- resources/views/products/create.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Create New Product</h1>

    <div>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    </div>
    
    <form action="{{ route('task.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" value="{{ old('title') }}" id="title" name="title" placeholder="Enter title" autofocus="autofocus">
            @error('title')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" required>{{ old('description') }}</textarea>
            @error('description')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*">
            <img id="preview" src="#" alt="Preview" class="img-thumbnail" style="max-width: 100px; max-height: 100px; display: none;">
            @error('image')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <script>
                document.getElementById('image').addEventListener('change', function (event) {
                    const reader = new FileReader();
                    reader.onload = function () {
                        const preview = document.getElementById('preview');
                        preview.src = reader.result;
                        preview.style.display = 'block';
                    };
                    reader.readAsDataURL(event.target.files[0]);
                });
            </script>
        </div>
        <button type="submit" class="btn btn-success mt-3">Create</button>
    </form>
    
@endsection
