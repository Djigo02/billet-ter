<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Tableau de bord </title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="assets/back-office/css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        @if (Session::has('utilisateur') and Session::get('utilisateur')['role']=='admin')
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3 h2" href="index.html">ADMIN BILLET-TER</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <div class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">

            </div>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">  
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item">{{Session::get('utilisateur')['prenom']}} {{Session::get('utilisateur')['nom']}}</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="{{route('deconnexion')}}">Deconnexion</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Principal</div>
                            <a class="nav-link" href="{{url('admin')}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Tableau de bord
                            </a>

                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Connecté en tant que: </div>
                        <span class="text-success h5">admin laravel</span>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4 text-center">
                        <h1 class="mt-4">Tableau de bord</h1>
                        <div class="row">
                            <div class="col-xl-3 col-md-6 offset-xl-3">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">Nombre d'utilisateurs</div>
                                    <div class="card-footer d-flex align-items-center justify-content-center">
                                        <i class="fa-solid fa-users"></i> &nbsp;
                                        <span class=" text-center small text-white stretched-link fw-bold"> {{$utilisateurs}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body">Chiffre d'affaires totals</div>
                                    <div class="card-footer d-flex align-items-center justify-content-center">
                                        <i class="fa-solid fa-coins"></i> &nbsp;
                                        <span class=" text-center small text-white stretched-link fw-bold"> {{$ca}} Francs CFA</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h2 class="h2">Plan de la ligne</h2>
                        <h5 class="h5">Découvrez notre carte dynamique à consulter en ligne, et une carte en PDF à emporter partout dans votre téléphone. </h5>
                        <p>Accédez au plan dynamique de la ligne pour vous orienter tout au long de votre voyage. Naviguez en toute liberté sur la carte pour découvrir le plan de la ligne, la localisation des différentes gares et les communes traversées par le TER.  </p>
                        <iframe class="rich-datocms-content-module--embeddedIframe--d3471" title="Accéder au plan de la ligne" src="https://umap.openstreetmap.fr/fr/map/reseau-ter_556411?scaleControl=false&amp;miniMap=false&amp;scrollWheelZoom=false&amp;zoomControl=true&amp;allowEdit=false&amp;moreControl=true&amp;searchControl=null&amp;tilelayersControl=null&amp;embedControl=null&amp;datalayersControl=true&amp;onLoadPanel=undefined&amp;captionBar=false" sandbox="allow-forms allow-popups allow-pointer-lock allow-same-origin allow-scripts allow-downloads" style="width: 90%; height: 400px;margin:10px 5%"></iframe>
                        
                    </div>
                </main>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="assets/back-office/js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/back-office/assets/demo/chart-area-demo.js"></script>
        <script src="assets/back-office/assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="assets/back-office/js/datatables-simple-demo.js"></script>

        @else
            @if (Session::has('utilisateur'))
            <a href="{{ route('reserver') }}" id="log"></a>
            @else
                <a href="{{ route('login') }}" id="log"></a>
            @endif
            <script>
                btn = document.querySelector('#log');
                btn.click();
            </script>
        @endif
       
    </body>
</html>
