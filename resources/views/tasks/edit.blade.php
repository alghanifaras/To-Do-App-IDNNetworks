@extends('layouts.app')

@section('title', 'Edit Task')

@section('content')
    <div class="max-w-2xl mx-auto pb-24">
        <form action="{{ route('tasks.update', $task) }}" method="POST">
            @csrf
            @method('PUT')
            @include('tasks.form')
        </form>
    </div>
@endsection