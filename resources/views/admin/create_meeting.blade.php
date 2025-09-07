@extends('layouts.app')

@section('title', 'Create Meeting')

@section('content')
<div class="card shadow mb-4">
    <div class="card-body">
        <h2 class="text-2xl font-semibold mb-4 text-gray-800">Create a New Meeting</h2>
        <form action="{{route('store-meeting')}}" method="POST" class="space-y-4">
            @csrf
            <div class="form-group w-25">
                <label for="topic" class="block text-sm font-medium text-gray-700 mb-1">Meeting Topic</label>
                <input type="text" name="topic" id="topic" required
                       class="form-control">
            </div>

            
                <div class="form-group w-25">
                    <label for="start_time" class="block text-sm font-medium text-gray-700 mb-1">Start Time</label>
                    <input type="datetime-local" name="start_time" id="start_time" required
                           class="form-control">
                </div>
                <div class="form-group w-25">
                    <label for="duration" class="block text-sm font-medium text-gray-700 mb-1">Duration (minutes)</label>
                    <input type="number" name="duration" id="duration" required min="1" max="1440"
                           class="form-control">
                </div>
            

            <div class="form-group w-25">
                <label for="timezone" class="block text-sm font-medium text-gray-700 mb-1">Timezone</label>
                <select name="timezone" id="timezone"
                        class="form-control">
                    <option value="Asia/Kolkata">Asia/Kolkata</option>
                    <option value="America/New_York">America/New York</option>
                    <option value="Europe/London">Europe/London</option>
                    <option value="Asia/Tokyo">Asia/Tokyo</option>
                </select>
            </div>

            <button type="submit"
                    class="btn btn-success">
                Create Meeting
            </button>

           

        </form>
    </div>
</div>




@endsection
