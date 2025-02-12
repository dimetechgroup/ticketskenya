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
            <h4 class="page-title text-center">Create Ticket For {{ $event->name }}</h4>

            <div class="row">
                <div class="col-md-8 mx-auto">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h4 class="card-title mb-0 text-white font-weight-bold">Ticket Details</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('events.tickets.store', ['event' => $event->id]) }}" method="POST"
                                class="row" enctype="multipart/form-data">
                                @csrf



                                <!-- ticket Name -->
                                <div class="form-group col-md-6">
                                    <label class="required">Ticket Name</label>
                                    <input type="text" name="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        placeholder="Enter Ticket name" value="{{ old('name') }}">
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="required">Ticket Price</label>
                                    <input type="number" name="price"
                                        class="form-control @error('price') is-invalid @enderror"
                                        placeholder="Enter Ticket Price" value="{{ old('price') }}">
                                    @error('price')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                {{-- <div class="form-group col-md-6">
                                    <label class="required">Discount in Amount</label>
                                    <input type="number" name="price"
                                        class="form-control @error('price') is-invalid @enderror"
                                        placeholder="Enter Ticket Price" value="{{ old('price') }}">
                                    @error('price')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div> --}}

                                <div class="form-group col-md-4">
                                    <label class="required">Quantity</label>
                                    <input type="number" name="quantity"
                                        class="form-control @error('quantity') is-invalid @enderror"
                                        placeholder="Total number of tickets available" value="{{ old('quantity') }}">
                                    @error('quantity')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group col-md-4">
                                    <label class="required">Min Per User</label>
                                    <input type="number" name="min_per_user"
                                        class="form-control @error('min_per_user') is-invalid @enderror"
                                        placeholder=" Minimum tickets a user can buy." min="0"
                                        value="{{ old('min_per_user', 1) }}">
                                    @error('min_per_user')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="required">Max Per User</label>
                                    <input type="number" name="max_per_user"
                                        class="form-control @error('max_per_user') is-invalid @enderror"
                                        placeholder="Maximum tickets a user can buy" value="{{ old('max_per_user') }}">
                                    @error('max_per_user')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group col-md-12">
                                    <label class="required">Description</label>
                                    <textarea name="description" id="editor" class="form-control @error('description') is-invalid @enderror"
                                        placeholder="Enter Ticket Description">{{ old('description') }}</textarea>
                                    @error('description')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>


                                <div
                                    class="form-group col-md-6 mt-2 offset-md-3  rounded d-flex align-items-center justify-content-center">

                                    <!-- Submit Button -->
                                    <button type="submit" class="btn btn-success btn-lg">Create Ticket</button>
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
    <script src="https://cdn.ckeditor.com/ckeditor5/34.1.0/classic/ckeditor.js"></script>

    <script>
        $(document).ready(function() {

            ClassicEditor
                .create(document.querySelector('#editor'))
                .catch(error => {
                    console.error(error);
                });


        });
    </script>
@endsection
