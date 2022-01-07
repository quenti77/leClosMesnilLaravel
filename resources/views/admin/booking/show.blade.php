@extends('layouts.app')

@section('content')
    <div class="booking container py-5">
        <div class="row justify-content-center align-items-center">
            <div class="col-12 col-lg-6">
                <h3 class="m-0 fw-bold">Réservation de M/Mme {{ $booking['user']['name'] }}</h3>
                <p class="created-at fst-italic">
                    du <span class="fw-bold">{{ $booking['started_at'] }}</span> au
                    <span class="fw-bold">{{ $booking['finished_at'] }}</span></p>
                <p>Adulte(s): {{ $booking['nb_adult'] }}</p>
                <p class="col-6">Enfant(s): {{ $booking['nb_children'] }}</p>
                <p>Numéro de téléphone: <a href="tel:{{ $booking['user']['phone'] }}">{{ $booking['user']['phone'] }}</a></p>
                <p>Option(s):
                    <span class="badge rounded-pill bg-info">linge de lit</span>
                    <span class="badge rounded-pill bg-info">ménage</span>
                </p>
                @if($booking['payment_at'] === null)
                    <p>La réservation n'a pas encore été payer</p>
                @else
                <p>Payé le {{ $booking['payment_at'] }}</p>
                @endif
                <p class="text-end">{{ $booking['price'] . " €" }}</p>
            </div>
        </div>
    </div>
@endsection
