@extends('layouts.app')

@section('title', 'My Vendors')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">My Vendors</h6>
            <!-- Add Vendor Button -->
            <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#addVendorModal">
                <i class="fas fa-plus"></i> Add Vendor
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable2" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Logo</th>
                            <th>Name</th>
                            <th>Background</th>
                            <th>Foreground</th>  
                            <th>Action</th>                        
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($vendors as $vendor)
                             <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><img src="{{ asset('/public/storage/' . $vendor->logo) }}" alt="Vendor Logo" width="100"></td>
                                <td>{{$vendor->name}}</td>
                               <td>
                    <div style="display:flex; align-items:center; gap:8px;">
                        <span style="display:inline-block; width:30px; height:20px; border:1px solid #ccc; background: {{ $vendor->theme_background }};"></span>
                        {{ $vendor->theme_background }}
                    </div>
                </td
                                <!-- Foreground Color -->
                <td>
                    <div style="display:flex; align-items:center; gap:8px;">
                        <span style="display:inline-block; width:30px; height:20px; border:1px solid #ccc; background: {{ $vendor->theme_foreground }};"></span>
                        {{ $vendor->theme_foreground }}
                    </div>
                </td>
                                <td><a href="">Delete</td>           
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>



    <!-- Add Vendor Modal -->
    <div class="modal fade" id="addVendorModal" tabindex="-1" role="dialog" aria-labelledby="addVendorModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form action="{{ route('vendor.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addVendorModalLabel">Add New Vendor</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="vendorName">Vendor Name</label>
                            <input type="text" name="name" class="form-control" id="vendorName"
                                placeholder="Enter vendor name" required>
                        </div>
                        <div class="row">
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label for="vendorTheme">Theme Background</label>
                                    <input type="color" class="form-control" name="theme_background">
                                </div>
                            </div>

                            <div class="col-sm-2">
                              <div class="form-group">
                            <label for="vendorTheme">Theme Foreground</label>
                            <input type="color" name="theme_foreground" class="form-control" id="vendorTheme"
                                placeholder="Enter theme" required>
                        </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="vendorLogo">Logo</label>
                            <input type="file" name="logo" class="form-control-file" id="vendorLogo" accept="image/*">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Vendor</button>
                    </div>
                </form>

                
            </div>
        </div>
    </div>
@endsection
