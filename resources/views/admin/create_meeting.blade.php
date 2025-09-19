@extends('layouts.app')

@section('title', 'Create Meeting')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h5 class="m-0 font-weight-bold text-theme">Create a New Meeting</h5>
    </div>
    <div class="card-body">
        
        {{-- <h5 class="text-2xl font-semibold mb-4 text-gray-800">Create a New Meeting</h5> --}}
        <form action="{{route('store-meeting')}}" method="POST" class="space-y-4">
            @csrf
            <div class="row">
            <div class="form-group col-12 col-md-6 col-lg-4">
                <label for="topic" class="block text-sm font-medium text-gray-700 mb-1">Select Vendor</label>
                <select name="meeting_vendor" class="form-control" required>
                    <option value="">Select Vendor</option>
                    @foreach($vendors as $vendor)
                        <option value="{{$vendor->id}}">{{$vendor->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-12 col-md-6 col-lg-4">
                <label for="topic" class="block text-sm font-medium text-gray-700 mb-1">Meeting Topic</label>
                <input type="text" name="topic" id="topic" required
                       class="form-control">
            </div>

            
                <div class="form-group col-12 col-md-6 col-lg-4">
                    <label for="start_time" class="block text-sm font-medium text-gray-700 mb-1">Start Time</label>
                    <input type="datetime-local" name="start_time" id="start_time" required
                           class="form-control">
                </div>
                <div class="form-group col-12 col-md-6 col-lg-4">
                    <label for="duration" class="block text-sm font-medium text-gray-700 mb-1">Duration (minutes)</label>
                    <input type="number" name="duration" id="duration" required min="1" max="1440"
                           class="form-control">
                </div>
            

            <div class="form-group col-12 col-md-6 col-lg-4">
                <label for="timezone" class="block text-sm font-medium text-gray-700 mb-1">Timezone</label>
                <select name="timezone" id="timezone"
                        class="form-control">
                    <option value="Asia/Kolkata">Asia/Kolkata</option>
                    <option value="America/New_York">America/New York</option>
                    <option value="Europe/London">Europe/London</option>
                    <option value="Asia/Tokyo">Asia/Tokyo</option>
                </select>
            </div>
        

        <div class="form-group col-12 col-md-6 col-lg-4">
            <label for="topic" class="block text-sm font-medium text-gray-700 mb-1">Meeting URL</label>
            <input type="text" name="meeting_url" id="topic"
                   class="form-control">
        </div>

    </div>

            <button type="submit"
                    class="btn btn-primary py-2 py-lg-3 px-4 px-lg-5">
                    <i class="fas fa-plus mr-2"></i>
                Create Meeting
            </button>

           

        </form>
    </div>
</div>




@endsection
