<!doctype html>
<html lang="fr">

<head>
    <title>S'inscrire</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="assets/login/css/style.css">

</head>

<body>
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-7 col-lg-5">
                    <div class="login-wrap p-4 p-md-5">
                        <div style="background-color:#9a8067;"
                        class="icon d-flex align-items-center justify-content-center">
                            <span 
                            class="fa fa-user-o"></span>
                        </div>
                        <h3 class="text-center mb-4">Inscrivez-vous</h3>
                        <form action="{{route('utilisateurs.register')}}" method="POST" class="login-form">
                            @csrf
                            @method('POST')
                            <div class="form-group">
                                <input type="text" class="form-control rounded-left" placeholder="Prenom" name="prenom" required>
                            </div>
                            @error('prenom')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="form-group">
                                <input type="text" class="form-control rounded-left" placeholder="Nom" name="nom" required>
                            </div>
                            @error('nom')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="form-group">
                                <input type="text" class="form-control rounded-left" placeholder="Email" name="email" required>
                            </div>
                            @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="form-group d-flex">
                                <input type="password" class="form-control rounded-left" name="password" placeholder="Password"
                                    required>
                            </div>
                            @error('password')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="form-group">
                                <button type="submit" style="background-color:#9a8067; color: #fff"
                                    class="form-control btn rounded submit px-3">S'inscrire</button>
                            </div>
                            <div class="text-center">
                                <a href="/login">Vous avez un compte ? Connectez-vous.</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="assets/login/js/jquery.min.js"></script>
    <script src="assets/login/js/popper.js"></script>
    <script src="assets/login/js/bootstrap.min.js"></script>
    <script src="assets/login/js/main.js"></script>

</body>

</html>
