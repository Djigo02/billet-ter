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

    <!-- Custom stlylesheet -->
    <link type="text/css" rel="stylesheet" href="assets/front-office/css/style.css" />

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

</head>

<body>
    <div id="booking" class="section">
        <div class="section-center">
            <div class="container">
                <div class="row">
                    <div class="booking-form">
                        <form method="POST" action="{{route('recu-billet')}}">
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
                                                        <option value="{{ $gare->id }}" >{{ $gare->nom }}</option>
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
                                                        <option value="{{ $gare->id }}">{{ $gare->nom }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
											<div class="form-group">
												<span class="form-label">Prix en FCFA</span>
												<input id="prix" name="prix" class="form-control" readonly value="0">
											</div>
										</div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-btn">
                                        <button class="submit-btn" type="submit" name="book" id="book">Reserver</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const bookBtn = document.querySelector('#book');
        const depart = document.querySelector('#depart');
        const destination = document.querySelector('#destination');
        const prix = document.querySelector('#prix');

        let listeGares = {!! json_encode($gares->toArray()) !!};

        var tab_gares = listeGares.map( (element) => ({
            id : element.id,
            nom : element.nom,
            zone : element.zone_id
        }));

        depart.addEventListener('change', ()=>{
            let garedepart = tab_gares.find( (element)=> element.id==+depart.value);
            let garedestination = tab_gares.find( (element)=> element.id==+destination.value);

            if(garedepart.id!=garedestination.id){
                switch(Math.abs(garedepart.zone-garedestination.zone)){
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
            }else{
                alert('Choisissez deux gares différents !');
                depart.value = '';
                depart.innerHTML = `<option value="">départ</option>`;
                tab_gares.forEach(element => {
                    depart.innerHTML +=`
                        <option value='${element.id}'>${element.nom}</option>
                    `;
                });
                prix.value = '0';
            }
        });
        
        destination.addEventListener('change', ()=>{
            
            let garedepart = tab_gares.find( (element)=> element.id==+depart.value);
            let garedestination = tab_gares.find( (element)=> element.id==+destination.value);

            if(garedepart.id!=garedestination.id){
                switch(Math.abs(garedepart.zone-garedestination.zone)){
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
            }else{
                alert('Choisissez deux gares différents !');
                destination.value = '';
                destination.innerHTML = `<option value="">destination</option>`;
                tab_gares.forEach(element => {
                    destination.innerHTML +=`
                        <option value='${element.id}'>${element.nom}</option>
                    `;
                });
                prix.value = '0';
            }
        });

        
    </script>
</body>

</html>
