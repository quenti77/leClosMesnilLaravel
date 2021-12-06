@extends('layouts.app')
@section('title', '| Show Season ')

@section('content')
    <div class="container">
        <div class="row">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <th scope="col">id</th>
                        <th scope="col">started_at</th>
                        <th scope="col">finished_at</th>
                        <th scope="col">prix</th>
                        <th scope="col">created_at</th>
                        <th scope="col">updated_at</th>
                        <th scope="col"></th>
                    </thead>
                    <tbody>
                        @foreach($seasons as $season)
                        <tr>
                            <td>{{ $season->id }}</td>
                            <td>{{ $season->started_at }}</}</td>
                            <td>{{ $season->finished_at }}</}</td>
                            <td>{{ $season->price }}</td>
                            <td>{{ $season->created_at->format('d-m-Y H:m:s') }}</td>
                            <td>{{ $season->updated_at->format('d-m-Y H:m:s') }}</td>
                            <td>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
