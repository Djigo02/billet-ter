<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Qrcode</title>
</head>

<body>
    @if (Session::has('utilisateur'))
        @include('share.navbar')
        <div class="alert alert-success col-4 offset-4 h5 text-center ">Reçu Billet-TER</div>
        <div class="container mt-3 d-flex align-items-center justify-content-center">
            <?php $diff = date_diff(new DateTime(date('d-M-Y')),new DateTime(explode(" ",$info['fin'])[4]));?>
            <div class="card {{$diff->format('%R%a') < 0 ? "bg-danger": "" }}" style="width: 18rem;">
                <div class="text-center mt-2"><img src="{{asset($info['image'])}}" alt="Qr Code reçu"></div>
                <br>
                <ul class="list-group list-group-flush">
                    @foreach ($info as $key => $item)
                        @if ($key!='image')
                            <li class="list-group-item text-center text-center">{{$item}}</li>
                        @endif
                    @endforeach
                    @if ($diff->format('%R%a') < 0)
                        <li class="list-group-item text-center text-center">Expiré depuis {{$diff->format('%R%a jours')}}</li>
                    @endif
                </ul>
                <div class="card-body d-flex justify-content-around">
                    <a href="{{url('/reserver')}}" class="btn btn-dark card-link">Retour</a>
                    <a href="{{route('mes_reservations', [Session::get('utilisateur')['id']])}}" class="btn btn-success card-link">Mes reservations</a>
                </div>
            </div>

        </div>
    @else
        <a href="{{route('login')}}" id="log"></a>
        <script>
            btn = document.querySelector('#log');
            btn.click();
        </script>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>
