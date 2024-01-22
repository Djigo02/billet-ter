<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mes reservations</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>

<body>
    @include('share.navbar')
    @if (count($reservations))
    <div class="alert alert-success col-4 offset-4 h5 text-center mb-4">Mes reservations Billet-TER</div>
    <div class="container row">
        @foreach ($reservations as $reservation)
        <?php $diff = date_diff(new DateTime(date('d-M-Y')),new DateTime(explode(" ",$reservation->fin_validite)[4])); ?>
            <div class="container mt-3 col-3 offset-1 mb-2 d-flex align-items-center justify-content-center">
                <div class="card {{$diff->format('%R%a') < 0 ? "bg-danger": "" }}" style="width: 18rem;">
                    <div class="text-center mt-2"><img src="{{ asset($reservation->image) }}" alt="Qr Code reçu"></div>
                    <br>
                    <ul class="list-group list-group-flush">
                        @foreach ($reservation as $key => $item)
                            @if (
                                $key != 'image' &&
                                    $key != 'id' &&
                                    $key != 'id_user' &&
                                    $key != 'created_at' &&
                                    $key != 'updated_at' &&
                                    $key != 'prix')
                                <li class="list-group-item text-center">{{ $item }}</li>
                            @endif
                        @endforeach
                        <li class="list-group-item text-center">Prix : {{ $reservation->prix }} FCFA</li>
                        @if ($diff->format('%R%a') < 0)
                            <li class="list-group-item  text-center">Expiré depuis {{$diff->format('%R%a jours')}}</li>
                        @else
                            <li class="list-group-item  text-center">Expire dans {{$diff->format('%R%a jours')}}</li>
                        @endif
                    </ul>
                    <div class="card-body d-flex justify-content-around">
                        {{-- <a href="{{ url('/') }}" class="btn btn-dark card-link">Retour</a> --}}
                        <a href="{{route('detailRecu',[$reservation->id])}}" class="btn btn-success card-link">Details</a>
                    </div>
                </div>

            </div>
        @endforeach
        @else
            <div class="text-center mt-4">
                <img src="{{asset('images/aucune-reservation.png')}}" alt="Anguished Face" />
                <p class="text-center fw-bold">Aucune réservation !</p>
            </div>
        @endif
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>
