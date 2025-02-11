@extends('layouts.app')

@section('styles')
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <h4 class="page-title">Events</h4>
            <div class="row">
                {{-- showing events statis by status --}}
                @foreach ($statistics as $statistic)
                    <x-admins.info-card :color="$statistic['color']" :icon="$statistic['icon']" :category="$statistic['category']" :count="$statistic['count']"
                        :route="$statistic['route']" />
                @endforeach
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Events</h4>

                            <a href="{{ route('events.create') }}" class="btn btn-primary btn-round text-white pull-right">
                                <i class="fa fa-plus"></i>
                                Add Event
                            </a>

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
                                            Description
                                        </th>
                                        <th>
                                            Location
                                        </th>
                                        <th>
                                            Date
                                        </th>
                                        <th>
                                            Time
                                        </th>
                                        <th>
                                            Actions
                                        </th>
                                    </thead>
                                    <tbody>
                                        @foreach ($events as $event)
                                            <tr>
                                                <td>
                                                    {{ $event->id }}
                                                </td>
                                                <td>
                                                    {{ $event->name }}
                                                </td>
                                                <td>
                                                    {{ $event->description }}
                                                </td>
                                                <td>
                                                    {{ $event->location }}
                                                </td>
                                                <td>
                                                    {{ $event->date }}
                                                </td>
                                                <td>
                                                    {{ $event->time }}
                                                </td>
                                                <td>
                                                    <a href="{{ route('events.edit', $event->id) }}"
                                                        class="btn btn-warning btn-round text-white">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('events.destroy', $event->id) }}" method="POST"
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
