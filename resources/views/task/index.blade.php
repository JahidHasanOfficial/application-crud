@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-4">All Tasks</h1>
        <!-- Button to create a new task -->
        <a href="{{ route('task.create') }}" class="btn btn-primary mb-3">
            <i class="bi bi-plus-circle"></i> Create New Task
        </a>
        <!-- Task Table -->
        <div class="table-responsive">
            <div>
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
            </div>
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tasks as $task)
                        <tr>
                            <td>{{ $task->title }}</td>
                            <td>{{ $task->description }}</td>
                            <td>
                                <img src="{{ $task->image }}" alt="" height="100" width="100">
                            </td>
                            <td>
                                <!-- Edit Button -->
                                <a href="{{ route('task.edit', $task->id) }}" class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>

                                <!-- Delete Button -->
                                <form action="{{ route('task.destroy', $task->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="bi bi-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
