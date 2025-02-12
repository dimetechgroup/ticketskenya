@extends('layouts.app')

@section('styles')
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
            <h4 class="page-title">Update Event</h4>

            <div class="row">
                <div class="col-md-8 mx-auto">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h4 class="card-title mb-0 text-white font-weight-bold">Event Details</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('events.update', $event->id) }}" method="POST"
                                enctype="multipart/form-data" class="row">
                                @csrf
                                @method('PUT')

                                <!-- Event Name -->
                                <div class="form-group col-md-6">
                                    <label class="required">Event Name</label>
                                    <input type="text" name="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name', $event->name) }}" placeholder="Enter event name">
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- Currency -->
                                <div class="form-group col-md-6">
                                    <label class="required">Currency</label>
                                    <select name="currency" class="form-control @error('currency') is-invalid @enderror">
                                        <option value="KES"
                                            {{ old('currency', $event->currency) == 'KES' ? 'selected' : '' }}>KES</option>
                                        <option value="USD"
                                            {{ old('currency', $event->currency) == 'USD' ? 'selected' : '' }}>USD</option>
                                    </select>
                                    @error('currency')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- Venue -->
                                <div class="form-group col-md-6">
                                    <label class="required">Venue</label>
                                    <input type="text" name="venue"
                                        class="form-control @error('venue') is-invalid @enderror"
                                        value="{{ old('venue', $event->venue) }}" placeholder="Enter event venue">
                                    @error('venue')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- Location -->
                                <div class="form-group col-md-6">
                                    <label class="required">Location</label>
                                    <select name="location" id="location"
                                        class="form-control @error('location') is-invalid @enderror">
                                        <option value="offline"
                                            {{ old('location', $event->location) == 'offline' ? 'selected' : '' }}>Offline
                                        </option>
                                        <option value="online"
                                            {{ old('location', $event->location) == 'online' ? 'selected' : '' }}>Online
                                        </option>
                                    </select>
                                    @error('location')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- Meeting Link (Visible if Online is selected) -->
                                <div class="form-group col-md-12 {{ $event->location == 'online' ? '' : 'd-none' }}"
                                    id="meeting-link-group">
                                    <label>Meeting Link</label>
                                    <input type="url" name="meeting_link"
                                        class="form-control @error('meeting_link') is-invalid @enderror"
                                        value="{{ old('meeting_link', $event->meeting_link) }}"
                                        placeholder="Enter meeting link">
                                    @error('meeting_link')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- Description -->
                                <div class="form-group col-md-12">
                                    <label class="required">Description</label>
                                    <textarea name="description" id="editor" class="form-control @error('description') is-invalid @enderror"
                                        rows="3">{{ old('description', $event->description) }}</textarea>
                                    @error('description')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- Start & End Dates -->
                                <div class="row col-md-12">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="required">Start Date</label>
                                            <input type="text" name="start_date"
                                                class="form-control datepicker @error('start_date') is-invalid @enderror"
                                                value="{{ old('start_date', $event->start_date) }}"
                                                placeholder="Select start date">
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
                                                value="{{ old('end_date', $event->end_date) }}"
                                                placeholder="Select end date">
                                            @error('end_date')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Contact Details -->
                                <div class="form-group col-md-6">
                                    <label class="required">Contact Number</label>
                                    <input type="text" name="contact_number"
                                        class="form-control @error('contact_number') is-invalid @enderror"
                                        value="{{ old('contact_number', $event->contact_number) }}"
                                        placeholder="Enter contact number">
                                    @error('contact_number')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="required">Contact Email</label>
                                    <input type="email" name="contact_email"
                                        class="form-control @error('contact_email') is-invalid @enderror"
                                        value="{{ old('contact_email', $event->contact_email) }}"
                                        placeholder="Enter contact email">
                                    @error('contact_email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- Image Upload -->
                                <div class="form-group col-md-6">
                                    <label class="required">Event Image</label>
                                    <input type="file" name="image"
                                        class="form-control-file @error('image') is-invalid @enderror">
                                    @if ($event->image)
                                        <img src="{{ asset('storage/' . $event->image) }}" class="img-thumbnail mt-2"
                                            width="100">
                                    @endif
                                    @error('image')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- Private Event Toggle -->
                                <div class="form-check col-md-6">
                                    <label class="form-check-label">
                                        <input type="checkbox" name="is_private" class="form-check-input"
                                            {{ old('is_private', $event->is_private) ? 'checked' : '' }}>
                                        <span class="form-check-sign">Is Private Event?</span>
                                    </label>
                                    @error('is_private')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- Submit Button -->
                                <div class="form-group col-md-6 offset-md-3 text-center mt-4">
                                    <button type="submit" class="btn btn-success btn-lg">Update Event</button>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/34.1.0/classic/ckeditor.js"></script>
    <script>
        $(document).ready(function() {
            $('.datepicker').datepicker({
                format: "yyyy-mm-dd",
                autoclose: true
            });
            ClassicEditor.create(document.querySelector('#editor')).catch(error => console.error(error));

            $('#location').on('change', function() {
                $('#meeting-link-group').toggleClass('d-none', $(this).val() !== 'online');
            });
        });
    </script>
@endsection
