@extends('layouts.app')

@section('title', 'Create Task')

@section('content')
    <div class="max-w-2xl mx-auto pb-24">
        <form action="{{ route('tasks.store') }}" method="POST">
            @csrf
            @include('tasks.form')
        </form>
    </div>
@endsection