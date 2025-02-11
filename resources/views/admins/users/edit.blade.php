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
            <h4 class="page-title">Edit User</h4>

            <div class="row">
                <div class="col-md-8 mx-auto">
                    <div class="card shadow-sm">
                        <div class="card-header bg-success text-white">
                            <h4 class="card-title mb-0 text-white font-weight-bold">User Details</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('users.update', $user->id) }}" method="POST" class="row"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <!-- User Name, password, email -->
                                <div class="form-group col-md-6">
                                    <label class="required">User Name</label>
                                    <input type="text" name="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        placeholder="{{ $user->name ?? 'Enter User Name' }}" value="{{ old('name') }}">
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="required">Password</label>
                                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" rows="3"
                                        placeholder="Enter Password" value="{{ old('password') }}">{{ old('password') }}

                                    </input>
                                    @error('password')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- Contact Number, Email, Image Upload -->
                                <div class="form-group col-md-6">
                                    <label>Contact Number</label>
                                    <input type="text" name="phone_number" class="form-control"
                                        placeholder="Enter contact number" value="{{ $user->phone_number }}">
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Contact Email</label>
                                    <input type="email" name="email" class="form-control"
                                        placeholder="{{$user->email}}" value="{{ old('email') }}">
                                </div>

                                <div class="form-group col-md-6">
                                    <label>User Image</label>
                                    <input type="file" name="image" class="form-control-file" value="{{ old('image') }}">
                                </div>


                                <!-- Submit Button -->
                                <button type="submit" class="btn btn-success">Edit User</button>
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
