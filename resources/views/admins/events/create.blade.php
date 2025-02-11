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
            <h4 class="page-title">Create Event</h4>

            <div class="row">
                <div class="col-md-8 mx-auto">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h4 class="card-title mb-0 text-white font-weight-bold">Event Details</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('events.store') }}" method="POST" class="row"
                                enctype="multipart/form-data">
                                @csrf



                                <!-- Event Name, Description, Venue -->
                                <div class="form-group col-md-6">
                                    <label class="required">Event Name</label>
                                    <input type="text" name="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        placeholder="Enter event name" value="{{ old('name') }}">
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="required">Venue</label>
                                    <input type="text" name="venue"
                                        class="form-control @error('venue') is-invalid @enderror"
                                        placeholder="Enter event venue" value="{{ old('venue') }}">
                                    @error('venue')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group col-md-12">
                                    <label class="required">Description</label>
                                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="3"
                                        placeholder="Enter event details">{{ old('description') }}</textarea>
                                    @error('description')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>



                                <!-- Location Type and Meeting Link (conditional visibility for online) -->
                                <div class="form-group col-md-6">
                                    <label class="required">Location</label>
                                    <select name="location" class="form-control @error('location') is-invalid @enderror">
                                        <option value="offline" {{ old('location') == 'offline' ? 'selected' : '' }}>Offline
                                        </option>
                                        <option value="online" {{ old('location') == 'online' ? 'selected' : '' }}>Online
                                        </option>
                                    </select>
                                    @error('location')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group d-none col-md-6" id="meeting-link-group">
                                    <label>Meeting Link</label>
                                    <input type="url" name="meeting_link" class="form-control"
                                        placeholder="Enter meeting link" value="{{ old('meeting_link') }}">
                                </div>

                                <!-- Start Date and End Date -->
                                <div class="row col-md-12">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="required">Start Date</label>
                                            <input type="text" name="start_date"
                                                class="form-control datepicker @error('start_date') is-invalid @enderror"
                                                placeholder="Select start date" value="{{ old('start_date') }}">
                                            @error('start_date')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="required">End Date</label>
                                            <input type="text" name="end_date"
                                                class="form-control datepicker @error('end_date') is-invalid @enderror"
                                                placeholder="Select end date" value="{{ old('end_date') }}">
                                            @error('end_date')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
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
                                    <label>Event Image</label>
                                    <input type="file" name="image" class="form-control-file">
                                </div>

                                <!-- Private Event Toggle -->
                                <div class="form-group col-md-6">
                                    <label>Is Private?</label>
                                    <input type="checkbox" name="is_private" class="ml-2">
                                </div>

                                <!-- Submit Button -->
                                <button type="submit" class="btn btn-success">Create Event</button>
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
