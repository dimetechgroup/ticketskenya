{{-- resources/views/admins/events/index.blade.php --}}
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
                                <i class="la la-plus"></i>
                                Add Event
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
                                            Status
                                        </th>

                                        <th>
                                            Location
                                        </th>
                                        <th>
                                            Start Date
                                        </th>
                                        <th>
                                            End Date
                                        </th>
                                        <th>
                                            Actions
                                        </th>
                                    </thead>
                                    <tbody>
                                        @foreach ($events as $event)
                                            <tr>

                                                <td>
                                                    {{ $event->name }}
                                                </td>
                                                <td>
                                                    <x-admins.events.status-badge :status="$event->status" />


                                                </td>

                                                <td>
                                                    {{ $event->location }}
                                                </td>
                                                <td>
                                                    {{ $event->start_date->format('d M, Y H:s') }}
                                                </td>
                                                <td>
                                                    {{ $event->end_date->format('d M, Y H:s') }}
                                                </td>
                                                <td>
                                                    <a href="{{ route('events.show', $event->id) }}"
                                                        class="btn btn-info btn-round text-white">
                                                        <i class="la la-eye"></i>
                                                    </a>
                                                    <form action="{{ route('events.destroy', $event->id) }}" method="POST"
                                                        style="display: inline-block">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-round">
                                                            <i class="la la-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="5" class= "">
                                                {{ $events->links('pagination::bootstrap-5') }}
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>



                    </div>
                </div>
            </div>
        @endsection

        @section('scripts')
        @endsection
