@extends('layouts.app')

@section('styles')
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
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
                                <div class="form-group col-md-4">
                                    <label class="required">User Name</label>
                                    <input type="text" name="name" autocomplete="off"
                                        class="form-control @error('name') is-invalid @enderror"
                                        placeholder="Enter User name" value="{{ old('name', $user->name) }}">
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group col-md-4">
                                    <label class="required">Contact Email</label>
                                    <input type="email" name="email"
                                        class="form-control  @error('email') is-invalid @enderror"
                                        placeholder="Enter contact email" value="{{ old('email', $user->email) }}">
                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Phone Number</label>
                                    <input type="text" name="phone_number"
                                        class="form-control  @error('name') is-invalid @enderror" autocomplete="off"
                                        placeholder="Enter Phone number"
                                        value="{{ old('phone_number', $user->phone_number) }}">
                                    @error('phone_number')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>


                                <div class="form-group col-md-6">
                                    <label>User Image</label>
                                    <input type="file" name="image"
                                        class="form-control-file @error('image') is-invalid @enderror">
                                    @error('image')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                {{-- role:admin,organizer  --}}
                                <div class="form-group col-md-6">
                                    <label class="required">Role</label>
                                    <select name="role" class="form-control">
                                        <option value="">Select Role</option>
                                        <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>
                                            Admin
                                        </option>
                                        <option value="organizer"
                                            {{ old('role', $user->role) === 'organizer' ? 'selected' : '' }}>
                                            Organizer
                                        </option>
                                    </select>
                                </div>

                                <div class="col-md-12">
                                    <!-- Submit Button -->
                                    <button type="submit" class="btn btn-success">Update User</button>
                                </div>



                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
