<!DOCTYPE html>
<html>
<head>
    <title>Actualités</title>
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/linearicons/style.css') }}">
    <!-- MAIN CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/timeline-css.css') }}">
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
        <!-- MAIN CONTENT -->
        <div class="main-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        @if(isset($msg))
                            <div class="alert alert-warning alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                            aria-hidden="true">&times;</span></button>
                                <i class="fa fa-warning"></i> {{ $msg }}
                            </div>
                        @endif
                    <!-- PANEL WITH FOOTER -->
                        @foreach($questions as $key=>$question)
                            <div class="panel ask">
                                <div class="panel-heading" style="padding-bottom: 0px;">
                                    <button type="button" class="btn-toggle-collapse right"><i
                                                class="lnr lnr-chevron-down"></i></button>
                                    <div class="form-inline">
                                        @if(isset($users[$key]->avatar))
                                            <img src="{{ $users[$key]->avatar }}" alt="Avatar"
                                                 class="img-circle pull-left avatar mini-avatar"
                                                 style="margin-top: 3px;width: 40px;height: 40px;">
                                        @elseif(isset($users[$key]->gender))
                                            @if($users[$key]->gender == 'homme')
                                                <img src="{{ asset('assets/img/avatar-man.png') }}" alt="Avatar"
                                                     class="img-circle pull-left avatar mini-avatar"
                                                     style="margin-top: 3px;width: 40px;height: 40px;">
                                            @else
                                                <img src="{{ asset('assets/img/avatar-woman.png') }}" alt="Avatar"
                                                     class="img-circle pull-left avatar mini-avatar"
                                                     style="margin-top: 3px;width: 40px;height: 40px;">
                                            @endif
                                        @endif
                                        <p>
                                            {{ $users[$key]->name }}
                                            @if(!in_array($users[$key]->_id,$abonnements) && (int) Session::get('_id') != (int) $users[$key]->_id)
                                                <a href="{{ url('/timeline/follow',['id'=>$users[$key]->_id]) }}">
                                                    <small align=""><i class="lnr lnr-link"></i>Suivre</small>
                                                </a>
                                            @endif
                                            <br>
                                            <small align="">{{ $question->date }}</small>
                                        </p>
                                        <span style='font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;font-size: large;color: #000;'>
                                            {{ $question->question }}</span>
                                    </div>
                                </div>
                                <hr>
                                <div class="panel-body collapse">
                                    <div>
                                        {{--<p style='font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;font-size: large;color: #000;'>
                                            {{ $question->question }}</p>--}}
                                        <p class="text-monospace">{{ $question->description }}</p>
                                    </div>
                                    @if(isset($question->video))
                                        <div class="row">
                                            @foreach($question->video as $video)
                                                <div class="col-md-6">
                                                    <div class="thumbnail">
                                                        <video controls style="width: 100%;min-height: 250px;">
                                                            <source src="{{ $video }}" type="video/mp4"/>
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
                                                        <a href="{{ $img }}" target="_blank">
                                                            <img src="{{ $img }}" alt="Lights"
                                                                 style="width:100%;height: 200px!important;min-height: 200px!important;">
                                                        </a>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                    @if(isset($question->link))
                                        <div class="">
                                            <a href="{{ $question->link }}"
                                               class="text-lg-left">{{ $question->link }}</a>
                                        </div>
                                    @endif
                                    <br>
                                    <div style="float: right;">
                                        @foreach($question->tags as $tag)
                                            <span class="badge badge-pill badge-primary">#{{ $tag->name }}</span>
                                        @endforeach
                                    </div>
                                    <div class="form-group">
                                        <hr>
                                        <a href="#"><i class="lnr lnr-thumbs-up"></i> </a>
                                        <a href="" data-toggle="modal" data-target="#responseModal{{$key}}"
                                           style="float: right;">Répondre</a>
                                    </div>
                                </div>
                                <div class="modal fade" id="responseModal{{ $key }}" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                <h5 class="modal-title" id="exampleModalLabel">Ajouter une réponse</h5>
                                            </div>
                                            <div class="modal-body" style="max-height: 300px;overflow-y: scroll;">
                                                <form action="{{ url('timeline/response',['id_user'=>Session::get('_id'),'id_question'=>$question->_id]) }}"
                                                      method="POST">
                                                    <input type="hidden" name="_token"
                                                           value="<?php echo csrf_token(); ?>">
                                                    <div class="panel-body">
                                                        <span>Titre de réponse:<strong
                                                                    class="text-danger">*</strong></span>
                                                        <input type="text" class="form-control"
                                                               placeholder="Composer votre réponse"
                                                               name="response">
                                                        <br>
                                                        <span>Description:<strong class="text-danger">*</strong></span>
                                                        <textarea class="form-control"
                                                                  placeholder="Donner d'autres informations"
                                                                  name="description"
                                                                  rows="4"></textarea>
                                                        <br>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-md-9">
                                                                <span>Liens videos:</span>
                                                                <input type="text" class="form-control"
                                                                       placeholder="Composer un lien video"
                                                                       name="video[]">
                                                            </div>
                                                            <br>
                                                            <div class="col-md-2">
                                                                <button id="add-video" class="btn btn-info"
                                                                        type="button">Ajouter
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div id="content-video" class="row"></div>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-md-9">
                                                                <span>Liens images:</span>
                                                                <input type="text" class="form-control"
                                                                       placeholder="Composer un lien image"
                                                                       name="image[]">
                                                            </div>
                                                            <br>
                                                            <div class="col-md-2">
                                                                <button id="add-image" class="btn btn-info"
                                                                        type="button">Ajouter
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div id="content-image" class="row"></div>
                                                        <br>
                                                        <span>Liens utiles:</span>
                                                        <input type="text" class="form-control"
                                                               placeholder="Composer un lien utile" name="link">
                                                        <br>
                                                        <input type="submit" class="btn btn-lg btn-info"
                                                               value="Ajouter"/>
                                                    </div>
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
                                <div class="panel-footer" style="margin: 20px;">
                                    @foreach($question->answers as $answer)
                                        <div class="message-item" id="m16">
                                            <div class="message-inner">
                                                <div class="message-head clearfix">
                                                    <div class="avatar pull-left"><a
                                                                href="#"><img
                                                                    src="{{ $answer->user->avatar }}"></a>
                                                    </div>
                                                    <div class="user-detail">
                                                        <h5 class="handle">{{ $answer->user->name }}</h5>
                                                        <div class="post-meta">
                                                            <div class="asker-meta">
                                                                <span class="qa-message-what"></span>
                                                                <span class="qa-message-when">
												<span class="qa-message-when-data">{{ $answer->date }}</span>
											</span>
                                                                <span class="qa-message-who">
												<span class="qa-message-who-pad">par </span>
												<span class="qa-message-who-data"><a
                                                            href="#">{{ $answer->user->name }}</a></span>
											</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="qa-message-content">
                                                    <span style='font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;font-size: large;color: #000;'>
                                                        {{ $answer->response}}
                                                    </span>
                                                    <div class="panel-body">
                                                        <div>
                                                            <p class="text-monospace">{{ $answer->description }}</p>
                                                        </div>
                                                        @if(isset($answer->video))
                                                            @if(!is_array($answer->video))
                                                                @php $ans = json_decode($answer->video) @endphp
                                                            @else
                                                                @php $ans = $answer->video @endphp
                                                            @endif
                                                            <div class="row">
                                                                @foreach($ans as $video)
                                                                    <div class="col-md-6">
                                                                        <div class="thumbnail">
                                                                            <video controls
                                                                                   style="width: 100%;min-height: 250px;">
                                                                                <source src="{{ $video }}"
                                                                                        type="video/mp4"/>
                                                                                Not found
                                                                            </video>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        @endif
                                                        @if(isset($answer->image))
                                                            @if(!is_array($answer->image))
                                                                @php $ans = json_decode($answer->image) @endphp
                                                            @else
                                                                @php $ans = $answer->image @endphp
                                                            @endif
                                                            <div class="row">
                                                                @foreach($ans as $img)
                                                                    <div class="col-md-4">
                                                                        <div class="thumbnail">
                                                                            <a href="{{ $img }}" target="_blank">
                                                                                <img src="{{ $img }}" alt="Lights"
                                                                                     style="width:100%;min-height: 200px!important;">
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        @endif
                                                        @if(isset($answer->link))
                                                            <div class="">
                                                                <a href="{{ $answer->link }}"
                                                                   class="text-lg-left">{{ $question->link }}</a>
                                                            </div>
                                                        @endif
                                                        <div class="form-group">
                                                            <hr>
                                                            @if(isset($answer->votes))
                                                                <span class="text-small text-warning text-sm-left">{{ $answer->votes }}
                                                                    UpVote(s)</span>
                                                            @endif
                                                            @if(isset($answer->userVotes))
                                                                @if(!in_array(Session::get('_id'),$answer->userVotes))
                                                                    <a href="{{ url('/timeline/response/vote',['idResponse'=>$answer->_id]) }}"><i
                                                                                class="lnr lnr-thumbs-up"></i> </a>
                                                                @endif
                                                            @else
                                                                <a href="{{ url('/timeline/response/vote',['idResponse'=>$answer->_id]) }}"><i
                                                                            class="lnr lnr-thumbs-up"></i> </a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                    @endforeach
                    <!-- END PANEL WITH FOOTER -->
                    </div>
                </div>
            </div>
        </div>
        <!-- END MAIN CONTENT -->
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
<script>

</script>
</body>
</html>