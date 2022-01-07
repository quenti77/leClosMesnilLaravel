@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="row">
            <div class="col-12">
                <table class="table table-striped table-hover">
                    <thead>
                        <th>Booker</th>
                        <th class="d-none">Numéro de téléphone</th>
                        <th>Arrivée</th>
                        <th>Départ</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                    @foreach($bookings as $booking)
                        <tr>
                            <td>{{ $booking->user->name . " " . $booking->user->last_name }}</td>
                            <td class="d-none">{{ $booking->user->phone }}</td>
                            <td>{{ $booking->started_at }}</td>
                            <td>{{ $booking->finished_at }}</td>
                            <td><a href="{{ route('admin.booking.show', $booking->id) }}"
                                   class="btn btn-outline-primary">View</a>
                                <form method="POST"
                                      action="{{ route('admin.booking.destroy', ['booking' => $booking->id]) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-secondary-action col-4 col-lg-12">Supprimer
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
@endsection
