<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>Billet-TER</title>

    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Alegreya:700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400" rel="stylesheet">

    <!-- Bootstrap -->
    <link type="text/css" rel="stylesheet" href="assets/front-office/css/bootstrap.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- Custom stlylesheet -->
    <link type="text/css" rel="stylesheet" href="assets/front-office/css/style.css" />

    {{-- Font awesome --}}
    <script src="https://kit.fontawesome.com/845e4e8471.js" crossorigin="anonymous"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

</head>

<body>

    @if (Session::get('utilisateur'))
        @include('share.navbar')
        <div id="booking" class="section">
            <div class="section-center">
                <div class="container">
                    <div class="row">
                        <div class="booking-form">
                            <form method="POST" action="{{ route('recu-billet') }}">
                                @csrf
                                <div class="row no-margin">
                                    <div class="col-md-3">
                                        <div class="form-header">
                                            <h2><a href="#">Billet TER</a></h2>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="row no-margin">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <span class="form-label">D'où partez-vous ? </span>
                                                    <select id="depart" name="depart" class="form-control">
                                                        <option value="">départ</option>
                                                        @foreach ($gares as $gare)
                                                            <option value="{{ $gare->id }}">{{ $gare->nom }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <span class="form-label">Où allez-vous ?</span>
                                                    <select id="destination" name="destination" class="form-control">
                                                        <option value="">destination</option>
                                                        @foreach ($garesdest as $gare)
                                                            <option value="{{ $gare->id }}">{{ $gare->nom }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <span class="form-label">Prix en FCFA</span>
                                                    <input id="prix" name="prix" class="form-control" readonly
                                                        value="0">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-btn">
                                            <button class="submit-btn" type="submit" name="book"
                                                id="book">Reserver</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Bouton pour voir ses reservations --}}
        <form action="{{ route('mes_reservations', [Session::get('utilisateur')['id']]) }}" method="get">
            <button type="submit" class="btn-reserve col-6 offset-3 mt-4" style="font-size: 18px ">Voir mes
                reservations</button>
        </form>

        <div style="background:#9a8067c9;text-align:center;color:#fff; font-weight: bold;padding:30px;font-size:18px; margin-top:20px">
            <p>Plan de la ligne</p>
            <p>Accédez au plan dynamique de la ligne pour vous orienter tout au long de votre voyage. Naviguez en toute
                liberté sur la carte pour découvrir le plan de la ligne, la localisation des différentes gares et les
                communes traversées par le TER. </p>
            <iframe class="rich-datocms-content-module--embeddedIframe--d3471" title="Accéder au plan de la ligne"
                src="https://umap.openstreetmap.fr/fr/map/reseau-ter_556411?scaleControl=false&amp;miniMap=false&amp;scrollWheelZoom=false&amp;zoomControl=true&amp;allowEdit=false&amp;moreControl=true&amp;searchControl=null&amp;tilelayersControl=null&amp;embedControl=null&amp;datalayersControl=true&amp;onLoadPanel=undefined&amp;captionBar=false"
                sandbox="allow-forms allow-popups allow-pointer-lock allow-same-origin allow-scripts allow-downloads"
                style="width: 90%; height: 400px;margin:10px 5%"></iframe>
        </div>
    @else
        <a href="{{ route('login') }}" id="log"></a>
        <script>
            btn = document.querySelector('#log');
            btn.click();
        </script>
    @endif

    <script>
        const bookBtn = document.querySelector('#book');

        const depart = document.querySelector('#depart');
        const destination = document.querySelector('#destination');
        const prix = document.querySelector('#prix');

        let listeGares = {!! json_encode($gares->toArray()) !!};

        var tab_gares = listeGares.map((element) => ({
            id: element.id,
            nom: element.nom,
            zone: element.zone_id
        }));

        depart.addEventListener('change', () => {
            let garedepart = tab_gares.find((element) => element.id == +depart.value);
            let garedestination = tab_gares.find((element) => element.id == +destination.value);

            if (garedepart.id != garedestination.id) {
                switch (Math.abs(garedepart.zone - garedestination.zone)) {
                    case 0:
                        prix.value = "500";
                        break;
                    case 1:
                        prix.value = "1000";
                        break;
                    case 2:
                        prix.value = "1500";
                        break;
                }
            } else {
                alert('Choisissez deux gares différents !');
                depart.value = '';
                depart.innerHTML = `<option value="">départ</option>`;
                tab_gares.forEach(element => {
                    depart.innerHTML += `
                        <option value='${element.id}'>${element.nom}</option>
                    `;
                });
                prix.value = '0';
            }
        });

        destination.addEventListener('change', () => {

            let garedepart = tab_gares.find((element) => element.id == +depart.value);
            let garedestination = tab_gares.find((element) => element.id == +destination.value);

            if (garedepart.id != garedestination.id) {
                switch (Math.abs(garedepart.zone - garedestination.zone)) {
                    case 0:
                        prix.value = "500";
                        break;
                    case 1:
                        prix.value = "1000";
                        break;
                    case 2:
                        prix.value = "1500";
                        break;
                }
            } else {
                alert('Choisissez deux gares différents !');
                destination.value = '';
                destination.innerHTML = `<option value="">destination</option>`;
                tab_gares.forEach(element => {
                    destination.innerHTML += `
                        <option value='${element.id}'>${element.nom}</option>
                    `;
                });
                prix.value = '0';
            }
        });

        bookBtn.addEventListener('click', (e) => {
            // e.preventDefault();
            if (prix.value == '' || depart.value == '' || destination.value == '') {
                bookBtn.setAttribute('type', 'button');
                alert('Veuillez choisir des gares appropriés svp !');
            } else {
                bookBtn.setAttribute('type', 'submit');
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>
