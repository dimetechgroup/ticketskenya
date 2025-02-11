@extends('layouts.app')

@section('styles')
    <!-- Include Bootstrap Datepicker & Custom Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <style>
        .required::after {
            content: "*";
            color: red;
            margin-left: 5px;
        }
    </style>
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <h4 class="page-title">Create User</h4>

            <div class="row">
                <div class="col-md-8 mx-auto">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h4 class="card-title mb-0 text-white font-weight-bold">User Details</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('users.store') }}" method="POST" class="row"
                                enctype="multipart/form-data">
                                @csrf
                                <!-- User Name, password, email -->
                                <div class="form-group col-md-6">
                                    <label class="required">User Name</label>
                                    <input type="text" name="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        placeholder="Enter User name" value="{{ old('name') }}">
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group col-md-12">
                                    <label class="required">Password</label>
                                    <textarea name="password" class="form-control @error('password') is-invalid @enderror" rows="3"
                                        placeholder="Enter User details">{{ old('password') }}</textarea>
                                    @error('password')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- Contact Number, Email, Image Upload -->
                                <div class="form-group col-md-6">
                                    <label>Contact Number</label>
                                    <input type="text" name="contact_number" class="form-control"
                                        placeholder="Enter contact number" value="{{ old('contact_number') }}">
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Contact Email</label>
                                    <input type="email" name="contact_email" class="form-control"
                                        placeholder="Enter contact email" value="{{ old('contact_email') }}">
                                </div>

                                <div class="form-group col-md-6">
                                    <label>User Image</label>
                                    <input type="file" name="image" class="form-control-file">
                                </div>


                                <!-- Submit Button -->
                                <button type="submit" class="btn btn-success">Create User</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.datepicker').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                todayHighlight: true
            });

            // Show meeting link field if online is selected
            $('select[name="location"]').on('change', function() {
                $('#meeting-link-group').toggleClass('d-none', $(this).val() !== 'online');
            });
        });
    </script>
@endsection
