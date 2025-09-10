@extends('layouts.app')

@section('title', 'My Leads')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h5 class="m-0 font-weight-bold text-theme">My Leads</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table" id="dataTable2" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Firstname</th>
                        <th>Lastname</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>City</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($leads as $lead)
                        <tr>
                            <td>{{ $lead->id }}</td>
                            <td>{{ $lead->firstname }}</td>
                            <td>{{ $lead->lastname }}</td>
                            <td>{{ $lead->emailid }}</td>
                            <td>{{ $lead->phone }}</td>
                            <td>{{ $lead->city }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
