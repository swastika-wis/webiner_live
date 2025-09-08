@extends('layouts.app')

@section('title', 'Register For Meeting')

@section('content')
<div class="card shadow mb-4">
    <div class="card-body">
        <h2 class="text-2xl font-semibold mb-4 text-gray-800">Book your seat for <strong>{{$record->topic}}</strong></h2>
        <form action="{{route('store-participent')}}" method="POST" class="space-y-4">
            @csrf
            <input type="hidden" name="meeting_id" value="{{$meeting_id}}">
            <div class="form-group w-25">
                <label for="topic" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                <input type="text" name="name" required
                       class="form-control">
            </div>

            
                <div class="form-group w-25">
                    <label for="start_time" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="text" name="email" required
                           class="form-control">
                </div>
                <div class="form-group w-25">
                    <label for="duration" class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                    <input type="text" name="phone" class="form-control">
                </div>
        

            <button type="submit" class="btn btn-success">
               Register
            </button>
        </form>
    </div>
</div>

@endsection
