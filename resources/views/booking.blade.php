@extends('layouts.app')
@section('scripts')
    <script>
        window.bookings = {!! json_encode($bookings->toArray()) !!};
    </script>
    <script type="text/javascript" src="{{ asset('js/datePicker.js') }}" defer></script>
@endsection
@section('content')
    <div class="container">
        <div class="img-wrapper">
            <div
                class="first-image"
                style="background-image: url('https://images.pexels.com/photos/4507715/pexels-photo-4507715.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940')"
            >
            </div>
            <div class="second-image"
                 style="background-image: url('https://images.pexels.com/photos/4507715/pexels-photo-4507715.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940')"
            ></div>
            <div class="three-image"
                 style="background-image: url('https://images.pexels.com/photos/4507715/pexels-photo-4507715.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940')"
            ></div>
            <div class="five-image"
                 style="background-image: url('https://images.pexels.com/photos/4507715/pexels-photo-4507715.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940')"
            ></div>
            <div class="six-image"
                 style="background-image: url('https://images.pexels.com/photos/4507715/pexels-photo-4507715.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940')"
            ></div>
        </div>
        <h2>Titre</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias aut commodi, cumque doloribus
            id iusto laboriosam minima molestiae nam nesciunt officia quaerat qui, quo rem repellat, sint tempore
            voluptatem voluptates!
        </p>
        <h2>Equipement</h2>
        <div id="range" class="my-5">
            <input type="text" id="start" name="started_at" placeholder="Arrivée">
            <span>To</span>
            <input type="text" id="end" name="finished_at" placeholder="Départ">
        </div>
    </div>
@endsection
