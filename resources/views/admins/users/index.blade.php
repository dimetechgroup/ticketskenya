@extends('layouts.app')

@section('styles')
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <h4 class="page-title">Users List</h4>


            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4 class="card-title">User</h4>

                            <a href="{{ route('users.create') }}" class="btn btn-primary btn-round text-white pull-right">
                                <i class="fa fa-plus"></i>
                                Add User
                            </a>

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead class=" text-primary">

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
                                        @foreach ($users as $user)
                                            <tr>

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
                                                    {{ ucfirst($user->role) }}
                                                </td>
                                                <td>
                                                    <a href="{{ route('users.show', $user->id) }}"
                                                        class="btn btn-info btn-round text-white">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('users.edit', $user->id) }}"
                                                        class="btn btn-warning btn-round text-white">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                                        onsubmit="return confirm('Are you sure you want to delete this user?')"
                                                        style="display: inline-block">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-round">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
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
