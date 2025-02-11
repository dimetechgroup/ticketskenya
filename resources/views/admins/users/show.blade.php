@extends('layouts.app')

@section('styles')
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <h4 class="page-title">Users</h4>


            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{$user->name}}</h4>

                            {{-- <a href="{{ route('users.create') }}" class="btn btn-primary btn-round text-white pull-right">
                                <i class="fa fa-plus"></i>
                                Add User
                            </a> --}}

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead class=" text-primary">
                                        <th>
                                            ID
                                        </th>
                                        <th>
                                            Name
                                        </th>
                                        <th>
                                            Email
                                        </th>
                                        <th>
                                            Phone Number
                                        </th>
                                        <th>
                                            Role
                                        </th>
                                    </thead>
                                    <tbody>

                                            <tr>
                                                <td>
                                                    {{ $user->id }}
                                                </td>
                                                <td>
                                                    {{ $user->name }}
                                                </td>
                                                <td>
                                                    {{ $user->email }}
                                                </td>
                                                <td>
                                                    {{ $user->phone_number }}
                                                </td>
                                                <td>
                                                    {{ $user->role }}
                                                </td>
                                                <td>
                                                    <a href="{{ route('users.edit', $user->id) }}"
                                                        class="btn btn-warning btn-round text-white">
                                                        <i class="fa fa-edit">Edit User</i>
                                                    </a>
                                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                                        style="display: inline-block">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-round">
                                                            <i class="fa fa-trash">Delete User</i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>



                    </div>
                </div>
            </div>
        @endsection

        @section('scripts')
        @endsection
