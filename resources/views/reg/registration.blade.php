<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap_4.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/css/reg_css.css') }}"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
    <script src="{{ asset('assets/scripts/jquery-3.3.1.min.js')}}"></script>
    <script src="{{ asset('assets/scripts/bootstrap.js')}}"></script>
    <script src="{{ asset('assets/scripts/registration_script.js')}}"></script>
    <title>Inscription</title>
</head>
<body class="m-5" style="background-image: url('https://columbiaairport.com/wp-content/uploads/2015/12/CAE-Website-Full-Background-Texture1902x1200-9.jpg')">
<div class="container col-md-5">
    <div class="card bg-light">
        <article class="card-body mx-auto" style="max-width: 400px;">
            @if(isset($msg))
                <div class="alert alert-danger text-center text-monospace" role="alert">
                    {{ $msg }}
                </div>
            @endif
            <div class="text-center">
                <img src="{{ asset('assets/img/logo-dark.png') }}" width="137" height="80">
            </div>
            <h4 class="card-title mt-3 text-center">Créer un compte</h4>
            <p class="text-center">S'inscrire pour voir les nouveautés</p>
            <p>
                <a href="{{ url('login/google') }}" class="btn btn-block btn-danger"> <i class="fab fa-google"></i>  
                    S'authentifier via Google+</a>
                <a href="{{ url('login/facebook') }}" class="btn btn-block btn-facebook"> <i
                            class="fab fa-facebook-f"></i>   S'authentifier via Facebook</a>
            </p>
            <p class="divider-text">
                <span class="bg-light">Ou</span>
            </p>
            <form method="GET">
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                    </div>
                    <input name="name" class="form-control" placeholder="Nom complet" type="text" required>
                </div> <!-- form-group// -->
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
                        </div>
                        <input name="email" class="form-control" placeholder="Email" type="email" id="email" required>
                    </div>
                    <small id="emailHelp" class="form-text text-warning"></small>
                </div> <!-- form-group// -->
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-phone"></i> </span>
                    </div>
                    <select class="custom-select" style="max-width: 120px;" name="phone_indicatif">
                        @foreach($pi as $p)
                            <option value="{{ $p->dial_code }}">
                                @php echo str_replace('+','',$p->dial_code) @endphp
                            </option>
                        @endforeach
                    </select>
                    <input name="phone" class="form-control" placeholder="Numéro de telephone" type="text">
                </div> <!-- form-group// -->
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-building"></i> </span>
                    </div>
                    <select class="form-control" name="job">
                        <option selected="">Choisir votre métier</option>
                        <option>Designer</option>
                        <option>Gérant</option>
                        <option>Professeur</option>
                        <option>Développeur</option>
                        <option>Etudiant</option>
                    </select>
                </div> <!-- form-group end.// -->
                <div class="form-group input-group">
                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-tag"></i> </span>
                        </div>
                        <label class="btn btn-info" style="border-right: 2px solid #f8f9fa;">
                            <input type="radio" name="gender" id="option1" autocomplete="off" value="homme"> Homme
                        </label>
                        <label class="btn btn-info">
                            <input type="radio" name="gender" id="option2" autocomplete="off" value="femme"> Femme
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                        </div>
                        <input class="form-control" placeholder="Saisir mot de passe" type="password" name="password"
                               id="pass" required>
                    </div>
                    <small id="passHelp" class="form-text text-warning"></small>
                </div> <!-- form-group// -->
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                        </div>
                        <input class="form-control" placeholder="Répéter mot de passe" type="password" name="pass1"
                               id="pass1" required>
                    </div>
                    <small id="pass1Help" class="form-text text-warning"></small>
                </div> <!-- form-group// -->
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block" id="register"> Créer le compte
                    </button>
                </div> <!-- form-group// -->
                <p class="text-center">Avez-vous déja un compte? <a href="{{ url('login') }}">S'authentifier</a></p>
            </form>
        </article>
    </div> <!-- card.// -->

</div>
</body>
</html>