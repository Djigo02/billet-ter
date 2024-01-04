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
    .<div class="alert alert-success col-4 offset-4 h5 text-center ">Reçu Billet-TER</div>
    <div class="container mt-3 d-flex align-items-center justify-content-center">
        <div class="card" style="width: 18rem;">
            <div class="text-center mt-2"><img src="{{$info['image']}}" alt="Qr Code reçu"></div>
            <br>
            <ul class="list-group list-group-flush">
                @foreach ($info as $key => $item)
                    @if ($key!='image')
                        <li class="list-group-item text-center text-center">{{$item}}</li>
                    @endif
                @endforeach
            </ul>
            <div class="card-body d-flex justify-content-around">
                <a href="{{url('/')}}" class="btn btn-dark card-link">Retour</a>
                <a href="#" class="btn btn-success card-link">Imprimer</a>
            </div>
        </div>

    </div>
</body>

</html>
