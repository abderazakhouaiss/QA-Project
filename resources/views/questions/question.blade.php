<!DOCTYPE html>
<html>
<head>
    <title>Composer une question</title>
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/linearicons/style.css') }}">
    <!-- MAIN CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}">
    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
    <!-- ICONS -->
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('assets/img/favicon.png') }}">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/css/bootstrap-select.min.css">
</head>
<body>
<div id="wrapper">
    <!-- NAVBAR -->
    @include('header')
    <div class="main">
        <div class="main-content">
            <div class="col-12">
                <div class="panel">
                    @if(isset($msg))
                    <div class="alert alert-warning alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <i class="fa fa-warning"></i> {{ $msg }}
                    </div>
                    @endif
                    <div class="panel-heading">
                        <h3 class="panel-title"><h4>Composer une question:</h4></h3>
                    </div>
                    <form  action="{{ url('question/add') }}" method="POST">
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                        <div class="panel-body">
                            <span>Question:<strong class="text-danger">*</strong></span>
                            <input type="text" class="form-control" placeholder="Composer votre question"
                                   name="question">
                            <br>
                            <span>Description:<strong class="text-danger">*</strong></span>
                            <textarea class="form-control" placeholder="Donner d'autres informations" name="description"
                                      rows="4"></textarea>
                            <br>
                            <span>Tags:<strong class="text-danger">*</strong></span>
                            <select required multiple class="form-control select-picker"
                                    data-live-search="true" name="tags[]"
                                    data-show-icon="true" data-max-options="6"
                                    title="Choisir vos intérets">
                                <option data-tokens="Langages"
                                        data-icon='fa fa-1x fa-language'>Langages
                                </option>
                                <option data-tokens="Biologie" data-icon='lnr lnr-funnel'>
                                    Biologie
                                </option>
                                <option data-tokens="Programmation"
                                        data-icon='fa fa-1x fa-code'>Programmation
                                </option>
                                <option data-tokens="Musqiue" data-icon='fa fa-1x fa-music'>
                                    Musqiue
                                </option>
                                <option data-tokens="Alimentation"
                                        data-icon='lnr lnr-dinner'>Alimentation
                                </option>
                                <option data-tokens="Romans" data-icon='fa fa-1x fa-book'>
                                    Romans
                                </option>
                                <option data-tokens="Cinématographie"
                                        data-icon='fa fa-1x fa-film'>Cinématographie
                                </option>
                                <option data-tokens="Constructions"
                                        data-icon='fa fa-1x fa-building'>Constructions
                                </option>
                            </select>
                            <br>
                            <div class="row">
                                <div class="col-md-9">
                                    <span>Liens videos:</span>
                                    <input type="text" class="form-control" placeholder="Composer un lien video"
                                           name="video[]">
                                </div><br>
                                <div class="col-md-2">
                                    <button id="add-video" class="btn btn-info" type="button">Ajouter</button>
                                </div>
                            </div>
                            <br>
                            <div id="content-video" class="row"></div>
                            <br>
                            <div class="row">
                                <div class="col-md-9">
                                    <span>Liens images:</span>
                                    <input type="text" class="form-control" placeholder="Composer un lien image"
                                           name="image[]">
                                </div><br>
                                <div class="col-md-2">
                                    <button id="add-image" class="btn btn-info" type="button">Ajouter</button>
                                </div>
                            </div>
                            <br>
                            <div id="content-image" class="row"></div>
                            <br>
                            <span>Liens utiles:</span>
                            <input type="text" class="form-control" placeholder="Composer un lien utile" name="link">
                            <br>
                            <input type="submit" class="btn btn-lg btn-info" value="Ajouter"/>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
<script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('assets/scripts/klorofil-common.js') }}"></script>
<script src="{{ asset('assets/scripts/add-question.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/js/i18n/defaults-*.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/js/bootstrap-select.min.js"></script>
</body>
</html>