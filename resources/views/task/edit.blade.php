<!-- resources/views/products/edit.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Edit task</h1>

    <form action="{{ route('task.update', $task->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" value="{{ old('title', $task->title) }}" id="title" name="title" placeholder="Enter title" autofocus="autofocus">
            @error('title')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" required>{{ old('description', $task->description) }}</textarea>
            @error('description')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="image">Old Image</label>
            @if($task->image)
                <img src="{{ $task->image }}" alt="Task Image" class="img-thumbnail" style="max-width: 100px; max-height: 100px;">
                <img id="preview" src="#" alt="Preview" class="img-thumbnail" style="max-width: 100px; max-height: 100px; display: none;">
            @endif
            <input type="file" class="form-control" id="image" name="image" accept="image/*">
          
            @error('image')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
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
        
        <button type="submit" class="btn btn-warning mt-3">Update</button>
    </form>

    
{{-- <script src="https://cdn.ckeditor.com/ckeditor5/38.1.1/classic/ckeditor.js"></script>
<script>

  ClassicEditor
    .create(document.querySelector('#description'))
    .then(editor => {

      editor.ui.view.editable.element.style.height = '200px';
    })
    .catch(error => {
      console.error(error);
    });
</script> --}}
@endsection
