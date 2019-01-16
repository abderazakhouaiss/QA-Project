<nav class="navbar navbar-default navbar-fixed-top">
    {{--<div class="brand row" style="padding: 3px;">
        --}}{{--<a href="{{ url('timeline') }}" class="col-md-9">

        </a>--}}{{--
        <div class="navbar-btn row" style="margin-left: 20px;">
            <img src="{{ asset('assets/img/logo-dark.png') }}" alt="Klorofil Logo"
                 class="img-responsive logo col-md-1" style="height: 60px;">
            <button type="button" class="btn-toggle-fullwidth col-md-3"><i class="lnr lnr-arrow-left-circle"></i></button>
        </div>
    </div>
    <div class="container-fluid">
        <ul class="nav navbar-nav navbar-right">
            <li>
                <a href="{{ url('logout') }}"><i class="fa fa-sign-out"></i>Déconnexion</a>
            </li>
        </ul>
        <div id="navbar-menu">
            <ul class="nav navbar-nav navbar-right">

                <!-- <li>
                    <a class="update-pro" href="https://www.themeineed.com/downloads/klorofil-pro-bootstrap-admin-dashboard-template/?utm_source=klorofil&utm_medium=template&utm_campaign=KlorofilPro" title="Upgrade to Pro" target="_blank"><i class="fa fa-rocket"></i> <span>UPGRADE TO PRO</span></a>
                </li> -->
            </ul>
        </div>
    </div>--}}
    <div class="form-inline" style="padding: 12px;">
        <div style="padding: 10px;margin-left: 10px;" class="form-group">
            <a href="{{ url('timeline') }}">
                <img src="{{ asset('assets/img/logo-dark.png') }}" alt="Klorofil Logo"
                     class="img-responsive logo" style="height: 60px;">
            </a>
        </div>
        <div class="navbar-btn form-group" style="padding: 10px;margin-left: 30px;float: none!important;">
            <button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-arrow-left-circle"></i></button>
        </div>
        <div class="form-group pull-right" style="padding: 12px;">
            <a href="{{ url('logout') }}"><i class="fa fa-sign-out"></i>Déconnexion</a>
        </div>
    </div>
</nav>
<div id="sidebar-nav" class="sidebar">
    <div class="sidebar-scroll">
        <nav>
            <ul class="nav">
                <li><a href="{{ url('account') }}" class=""><i class="lnr lnr-home"></i> <span>Profil</span></a>
                </li>
                <li><a href="{{ url('timeline') }}" class=""><i class="lnr lnr-arrow-up"></i>
                        <span>Actualités</span></a></li>
                <li>
                    <a href="#subPages" data-toggle="collapse"><i class="lnr lnr-tag"></i> <span>Statistiques</span> <i
                                class="icon-submenu lnr lnr-chevron-left"></i></a>
                    <div id="subPages" class="collapse">
                        <ul class="nav">
                            <li><a href="">Questions</a></li>
                            <li><a href="" class="">Réponses</a></li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#subQuestion" data-toggle="collapse"><i class="lnr lnr-question-circle"></i> <span>Questions</span>
                        <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                    <div id="subQuestion" class="collapse">
                        <ul class="nav">
                            <li><a href="{{ url('/question') }}">Ajouter</a></li>
                            <li><a href="{{url('/question/update')}}" class="">Supprimer</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </nav>
    </div>
</div>
