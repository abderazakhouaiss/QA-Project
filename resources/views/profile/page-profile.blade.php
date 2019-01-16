<!doctype html>
<html lang="en">

<head>
    <title>Profile</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <!-- VENDOR CSS -->
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
<!-- WRAPPER -->
<div id="wrapper">
    <!-- NAVBAR -->
@include('header')
<!-- END LEFT SIDEBAR -->
    <!-- MAIN -->
    <div class="main">
        <!-- MAIN CONTENT -->
        <div class="main-content">
            <div class="container-fluid">
                <div class="panel panel-profile">
                    <div class="clearfix">
                        <!-- LEFT COLUMN -->
                        <div class="profile-left">
                            <!-- PROFILE HEADER -->
                            <div class="profile-header">
                                <div class="overlay"></div>
                                <div class="profile-main"
                                     style="background-image: url('{{ asset("assets/img/bg.png") }}'); background-position: center;">
                                    @if(isset($user->avatar))
                                        <img src="{{ $user->avatar }}" class="img-circle" alt="Avatar">
                                    @elseif(isset($user->gender))
                                        @if($user->gender == 'homme')
                                            <img src="{{ asset('assets/img/avatar_man.png') }}" class="img-circle"
                                                 alt="Avatar" width="80" height="80"/>
                                        @else
                                            <img src="{{ asset('assets/img/avatar_woman.png') }}" class="img-circle"
                                                 alt="Avatar" width="80" height="80"/>
                                        @endif
                                    @endif
                                    <h3 class="text-monospace name">{{ $user->name }}</h3>
                                </div>
                                <div class="profile-stat">
                                    <div class="row">
                                        <div class="col-md-4 stat-item">
                                            {{ count($questions) }} <span>Questions</span>
                                        </div>
                                        <div class="col-md-4 stat-item">
                                            -- <span>Réponses</span>
                                        </div>
                                        <div class="col-md-4 stat-item">
                                            @if(isset($user->tags))
                                                {{ $user->tags }}<span>intérêts</span>
                                            @else
                                                -- <span>intérêts</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="profile-detail" style="background: white;padding: 5px;">
                                <div class="profile-info">
                                    <h4 class="heading">Informations</h4>
                                    <ul class="list-unstyled list-justify">
                                        <li>Anniversaire <span>
													@if(isset($user->birthday))
                                                    {{ $user->birthday }}
                                                @else
                                                    --
                                                @endif
												</span>
                                        </li>
                                        <li>Telephone <span>
													@if(isset($user->phone))
                                                    {{ $user->phone_indicatif }} {{ $user->phone }}
                                                @else
                                                    --
                                                @endif
												</span>
                                        </li>
                                        <li>Email <span>{{ $user->email }}</span></li>
                                    </ul>
                                </div>
                                @if(isset($user->about))
                                    <div class="profile-info">
                                        <h4 class="heading">A propos de vous:</h4>
                                        <p>{{ $user->about }}</p>
                                    </div>
                                @endif
                                @if(isset($user->tags))
                                    <div class="profile-info">
                                        <h4 class="heading">Vos intérets:</h4>
                                        @foreach($tags as $tag)
                                            <span class="badge badge-pill badge-secondary">{{ $tag->name }}</span>
                                        @endforeach
                                    </div>
                                @endif
                                <div class="modal" tabindex="-1" role="dialog" id="myModal">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                <h5 class="modal-title">Complétez votre inscription</h5>
                                            </div>
                                            <div class="modal-body">
                                                @if(isset($msg))
                                                    <div class="alert alert-info" role="alert">
                                                        <strong>Message d'information:</strong>
                                                        {{ $msg }}
                                                    </div>
                                                @endif
                                                <form class="form" action="{{ url('/continue_register') }}" method="GET">
                                                    @if(!isset($user->birthday))
                                                        <div class="form-group">
                                                        <span class="text-monospace">
                                                            Date de naissance:
                                                        </span>
                                                            <input type="date" class="form-control" name="birthday"
                                                                   placeholder="Date de naissance" required/>
                                                        </div>
                                                    @endif

                                                    @if(!isset($user->avatar))
                                                        <div class="form-group">
                                                        <span class="text-monospace">
                                                            Image de profil:
                                                        </span>
                                                            <input type="text" class="form-control" name="avatar"
                                                                   placeholder="lien image" required/>
                                                        </div>
                                                    @endif

                                                    @if(!isset($user->phone))
                                                        <div class="form-group">
                                                            <div class="row">
                                                            <span class="text-monospace col-md-12">
                                                                    Numéro de téléphone:
                                                                </span>
                                                                <div class="col-md-3 col-sm-3 col-xl-3 col-xs-3">
                                                                    <select class="selectpicker form-control"
                                                                            data-live-search="true"
                                                                            name="phone_indicatif" required>
                                                                        @foreach($pi as $p)
                                                                            <option value="{{ $p->dial_code }}"
                                                                                    data-tokens="{{ $p->dial_code }}">
                                                                                @php echo str_replace('+','',$p->dial_code) @endphp
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-9 col-sm-9 col-xl-9 col-xs-9">
                                                                    <input type="phone" class="form-control"
                                                                           name="phone"
                                                                           placeholder="Numéro de téléphone" required/>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    @endif
                                                    <div class="form-group">
                                                        <span class="text-monospace">
                                                            Choisir Quelques intérets:
                                                        </span>
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
                                                    </div>
                                                    @if(!isset($user->birthday))
                                                        <div class="form-group">
                                                            <span class="text-monospace">A propos de vous:</span>
                                                            <textarea class="form-control" name="about" required
                                                                      rows="3"></textarea>
                                                        </div>
                                                    @endif
                                                    <input type="submit" class="btn btn-primary" value="Sauvegarder"/>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                    Fermer
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center"><a data-toggle="modal" data-target="#editer"
                                                            class="btn btn-primary">Editer votre Profil</a>
                                </div>
                            </div>
                            <!-- END PROFILE DETAIL -->
                        </div>
                        <!-- END LEFT COLUMN -->
                        <!-- RIGHT COLUMN -->
                        <div class="profile-right">
                            <h4 class="heading">Vos Questions:</h4>
                            <div class="awards">
                                <table class="table table-condensed">
                                    <thead>
                                    <tr>
                                        <th>Question</th>
                                        <th>Date de création</th>
                                        <th>Description</th>
                                        <th>Tags</th>
                                        <th>Opérations</th>
                                    </tr>
                                    <tbody>
                                    @foreach($questions as $key=>$question)
                                        <tr>
                                            <td>{{ $question->question }}</td>
                                            <td class="el">{{ $question->description }}</td>
                                            <td>{{ date('d-m-Y H:i', strtotime($question->date)) }}</td>
                                            <td>
                                                @foreach($question->tags as $tag)
                                                    <span class="badge badge-pill badge-primary">{{ $tag->name }}</span>
                                                @endforeach
                                            </td>
                                            <td><a class="btn btn-danger btn-sm" data-toggle="modal"
                                                   data-target="#modal{{ $key }}"><i class="fa fa-eye"></i> Voir</a>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="modal{{ $key }}" tabindex="-1" role="dialog"
                                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                            <h5 class="modal-title" id="exampleModalLabel">Consultation
                                                                de question</h5>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="panel ask">
                                                            <div class="panel-heading" style="padding: 0px;">
                                                                <div class="form-inline">
                                                                    @if(isset($user->avatar))
                                                                        <img src="{{ $user->avatar }}" alt="Avatar"
                                                                             class="img-circle pull-left avatar mini-avatar"
                                                                             style="margin-top: 3px;width: 40px;height: 40px;">
                                                                    @elseif(isset($user->gender))
                                                                        @if($user->gender == 'homme')
                                                                            <img src="{{ asset('assets/img/avatar-man.png') }}"
                                                                                 alt="Avatar"
                                                                                 class="img-circle pull-left avatar mini-avatar"
                                                                                 style="margin-top: 3px;width: 40px;height: 40px;">
                                                                        @else
                                                                            <img src="{{ asset('assets/img/avatar-woman.png') }}"
                                                                                 alt="Avatar"
                                                                                 class="img-circle pull-left avatar mini-avatar"
                                                                                 style="margin-top: 3px;width: 40px;height: 40px;">
                                                                        @endif
                                                                    @endif
                                                                    <p>
                                                                        {{ $user->name }}
                                                                        <br>
                                                                        <small align="">{{ $question->date }}</small>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <hr>
                                                            <div class="panel-body"
                                                                 style="overflow-y: scroll;max-height: 300px;">
                                                                <div>
                                                                    <p style='font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;font-size: large;color: #000;'>
                                                                        {{ $question->question }}</p>
                                                                    <p class="text-monospace">{{ $question->description }}</p>
                                                                </div>
                                                                @if(isset($question->video))
                                                                    <div class="row">
                                                                        @foreach($question->video as $video)
                                                                            <div class="col-md-6">
                                                                                <div class="thumbnail">
                                                                                    <video controls
                                                                                           style="width: 100%;">
                                                                                        <source src="{{ $video }}"
                                                                                                type="video/mp4"/>
                                                                                        Not found
                                                                                    </video>
                                                                                </div>
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                @endif
                                                                @if(isset($question->image))
                                                                    <div class="row">
                                                                        @foreach($question->image as $img)
                                                                            <div class="col-md-4">
                                                                                <div class="thumbnail">
                                                                                    <a href="{{ $img }}"
                                                                                       target="_blank">
                                                                                        <img src="{{ $img }}"
                                                                                             alt="Lights"
                                                                                             style="width:100%;height: 100%;">
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                @endif
                                                                @if(isset($question->link))
                                                                    <div class="">
                                                                        <a href="{{ $question->link }}"
                                                                           class="text-lg-left">Lien {{($key+1)}}</a>
                                                                    </div>
                                                                @endif
                                                                <br>
                                                                <div style="float: right;">
                                                                    @foreach($question->tags as $tag)
                                                                        <span class="badge badge-pill badge-primary">#{{ $tag->name }}</span>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Fermer
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    </tbody>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                        <div class="modal" tabindex="-1" role="dialog" id="editer">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <h5 class="modal-title">Editer Votre Profil</h5>
                                    </div>
                                    <div class="modal-body">

                                        @if(isset($msg))
                                            <div class="alert alert-info" role="alert">
                                                <strong>Message d'information:</strong>
                                                {{ $msg }}
                                            </div>
                                        @endif
                                        <form class="form" action="{{ url('account/update',['id'=>$user->_id]) }}"
                                              method="GET">
                                            <div class="form-group">
                                                        <span class="text-monospace">
                                                            Date de naissance:
                                                        </span>
                                                <input type="date" class="form-control" name="birthday"
                                                       placeholder="Date de naissance" required/>
                                            </div>
                                            <div class="form-group">
                                                        <span class="text-monospace">
                                                            Image de profil:
                                                        </span>
                                                <input type="text" class="form-control" name="avatar"
                                                       placeholder="lien image" required/>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                            <span class="text-monospace col-md-12">
                                                                    Numéro de téléphone:
                                                                </span>
                                                    <div class="col-md-3 col-sm-3 col-xl-3 col-xs-3">
                                                        <select class="selectpicker form-control"
                                                                data-live-search="true"
                                                                name="phone_indicatif" required>
                                                            @foreach($pi as $p)
                                                                <option value="{{ $p->dial_code }}"
                                                                        data-tokens="{{ $p->dial_code }}">
                                                                    @php echo str_replace('+','',$p->dial_code) @endphp
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-9 col-sm-9 col-xl-9 col-xs-9">
                                                        <input type="phone" class="form-control"
                                                               name="phone"
                                                               placeholder="Numéro de téléphone" required/>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <span class="text-monospace">A propos de vous:</span>
                                                <textarea class="form-control" name="about" required
                                                          rows="3"></textarea>
                                            </div>
                                            <input type="submit" class="btn btn-primary" value="Editer"/>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END RIGHT COLUMN -->
                    </div>
                </div>
            </div>
        </div>
        <!-- END MAIN CONTENT -->
    </div>
    <!-- END MAIN -->
    <div class="clearfix"></div>
</div>
<!-- END WRAPPER -->
<!-- Javascript -->
<script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('assets/scripts/klorofil-common.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/js/i18n/defaults-*.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/js/bootstrap-select.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        @if(!isset($user->tags))
        $(window).on('load', function () {
            $('#myModal').modal('show');
        });
        @endif
        $('select').selectpicker();
    })

</script>
</body>

</html>
