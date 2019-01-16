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
                    <div class="panel-heading">
                        <h3 class="panel-title">Vos questions</h3>
                    </div>
                    <div class="panel-body">
                        @if(isset($msg))
                            <div class="alert alert-info alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                            aria-hidden="true">&times;</span></button>
                                <i class="fa fa-info-circle"></i> {{ $msg }}
                            </div>
                        @endif
                        <table class="table table-condensed">
                            <thead>
                            <tr>
                                <th>Question</th>
                                <th>Date de création</th>
                                <th>Description</th>
                                <th>Tags</th>
                                <th class="text-center">Opérations</th>
                            </tr>
                            <tbody>
                            @foreach($questions as $question)
                                <tr>
                                    <td>{{ $question->question }}</td>
                                    <td>{{ date('d-m-Y H:i', strtotime($question->date)) }}</td>
                                    <td>{{ $question->description }}</td>
                                    <td>
                                        @foreach($question->tags as $tag)
                                            <span class="badge badge-pill badge-primary">{{ $tag->name }}</span>
                                        @endforeach
                                    </td>
                                    <td class="text-center">
                                        {{--<a href="{{ url('/question/view') }}"><i class="fa fa-eye"></i> </a>&nbsp;&nbsp;--}}
                                        <a href="{{ url('/question/delete',['id'=>$question->_id]) }}"><i
                                                    class="fa fa-remove"></i> </a>&nbsp;
                                    </td>
                                </tr>

                            @endforeach
                            </tbody>
                        </table>
                    </div>
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