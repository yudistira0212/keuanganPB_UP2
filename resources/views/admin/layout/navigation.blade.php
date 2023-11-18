<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">

        <div class="navbar-header">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" href="{{ route('Home') }}"><img src="{{ asset('RGS/images/logo.png') }}" alt="Logo"></a>
            <a class="navbar-brand hidden" href="{{ route('Home') }}"><img src="{{ asset('RGS/images/logo2.png') }}" alt="Logo"></a>
        </div>

        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                @if (Auth::user()->role == 'superuser')
                <li class="active">
                    <a href="{{ route('Home') }}"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
                </li>
                <h3 class="menu-title">Administrator</h3><!-- /.menu-title -->
                <li>
                    <a href="{{ route('Administrator') }}" class="menu-icon"> <i class="menu-icon fa fa-users"></i>Users</a>
                </li>
                <li>
                    <a href="{{ route('skpd-view') }}" class="menu-icon"> <i class="menu-icon fa fa-wrench"></i>SKPD</a>
                </li>
                <h3 class="menu-title">Arsip</h3><!-- /.menu-title -->
                <li>
                    <a href="{{ route('arsp2d') }}" class="menu-icon"> <i class="menu-icon fa fa-cloud"></i>Arsip
                        SP2D</a>
                </li>
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-cloud"></i>Arsip SPM</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="menu-icon fa fa-inbox"></i><a href="{{ route('arspm-all') }}">SPM All</a>
                        </li>
                        <li><i class="menu-icon fa fa-inbox"></i><a href="{{ route('arspm-gu') }}">SPM gu</a></li>
                        <li><i class="menu-icon fa fa-inbox"></i><a href="{{ route('arspm-tu') }}">SPM tu</a></li>
                        <li><i class="menu-icon fa fa-inbox"></i><a href="{{ route('arspm-up') }}">SPM up</a></li>
                        <li><i class="menu-icon fa fa-inbox"></i><a href="{{ route('arspm-ls') }}">SPM ls</a></li>
                    </ul>
                </li>
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-cloud"></i>Arsip SPP</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="menu-icon fa fa-inbox"></i><a href="{{ route('arspp-up') }}">SPP Up</a></li>
                        <li><i class="menu-icon fa fa-inbox"></i><a href="{{ route('arspp-tup') }}">SPP TUP</a>
                        </li>
                        <li><i class="menu-icon fa fa-inbox"></i><a href="{{ route('arspp-ls') }}">SPP Ls</a></li>
                    </ul>
                </li>
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-cloud"></i>Arsip Lainnya</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="menu-icon fa fa-inbox"></i><a href="{{ route('lain') }}">Pajak</a></li>
                    </ul>
                </li>
                @endif

                @if (Auth::user()->role == 'keuangan')
                <h3 class="menu-title">Keuangan</h3><!-- /.menu-title -->

                <li>
                    <a href="{{ route('SP2D') }}" class="menu-icon"> <i class="menu-icon fa fa-envelope"></i>SP2D</a>
                </li>
                <li>
                    <a href="{{route('listPermintaanSP2D')}}" class="menu-icon"> <i class="menu-icon fa fa-envelope"></i>Permintaan SP2D</a>
                </li>

                <h3 class="menu-title">Arsip</h3><!-- /.menu-title -->
                <li>
                    <a href="{{ route('arsp2d') }}" class="menu-icon"> <i class="menu-icon fa fa-cloud"></i>Arsip
                        SP2D</a>
                </li>
                
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-cloud"></i>Arsip SPM</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="menu-icon fa fa-inbox"></i><a href="{{ route('arspm-all') }}">SPM All</a>
                        </li>
                        <li><i class="menu-icon fa fa-inbox"></i><a href="{{ route('arspm-gu') }}">SPM gu</a></li>
                        <li><i class="menu-icon fa fa-inbox"></i><a href="{{ route('arspm-tu') }}">SPM tu</a></li>
                        <li><i class="menu-icon fa fa-inbox"></i><a href="{{ route('arspm-up') }}">SPM up</a></li>
                        <li><i class="menu-icon fa fa-inbox"></i><a href="{{ route('arspm-ls') }}">SPM ls</a></li>
                    </ul>
                </li>
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-cloud"></i>Arsip SPP</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="menu-icon fa fa-inbox"></i><a href="{{ route('arspp-up') }}">SPP Up</a></li>
                        <li><i class="menu-icon fa fa-inbox"></i><a href="{{ route('arspp-tup') }}">SPP TUP</a>
                        </li>
                        <li><i class="menu-icon fa fa-inbox"></i><a href="{{ route('arspp-ls') }}">SPP Ls</a></li>
                    </ul>
                </li>
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-cloud"></i>Arsip Lainnya</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="menu-icon fa fa-inbox"></i><a href="{{ route('lain') }}">Pajak</a></li>
                    </ul>
                </li>
                @endif

                @if (Auth::user()->role == 'dinas')
                <li>
                    <a href="{{route('listPermintaanSP2D')}}" class="menu-icon"> <i class="menu-icon fa fa-envelope"></i>Permintaan SP2D</a>
                </li>

                <h3 class="menu-title">Arsip</h3><!-- /.menu-title -->
                <li>
                    <a href="{{ route('arsp2d') }}" class="menu-icon"> <i class="menu-icon fa fa-cloud"></i>Arsip
                        SP2D</a>
                </li>
                
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-cloud"></i>Arsip SPM</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="menu-icon fa fa-inbox"></i><a href="{{ route('arspm-all') }}">SPM All</a>
                        </li>
                        <li><i class="menu-icon fa fa-inbox"></i><a href="{{ route('arspm-gu') }}">SPM gu</a></li>
                        <li><i class="menu-icon fa fa-inbox"></i><a href="{{ route('arspm-tu') }}">SPM tu</a></li>
                        <li><i class="menu-icon fa fa-inbox"></i><a href="{{ route('arspm-up') }}">SPM up</a></li>
                        <li><i class="menu-icon fa fa-inbox"></i><a href="{{ route('arspm-ls') }}">SPM ls</a></li>
                    </ul>
                </li>
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-cloud"></i>Arsip SPP</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="menu-icon fa fa-inbox"></i><a href="{{ route('arspp-up') }}">SPP Up</a></li>
                        <li><i class="menu-icon fa fa-inbox"></i><a href="{{ route('arspp-tup') }}">SPP TUP</a>
                        </li>
                        <li><i class="menu-icon fa fa-inbox"></i><a href="{{ route('arspp-ls') }}">SPP Ls</a></li>
                    </ul>
                </li>
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-cloud"></i>Arsip Lainnya</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="menu-icon fa fa-inbox"></i><a href="{{ route('lain') }}">Pajak</a></li>
                    </ul>
                </li>
                @endif
            </ul>

        </div><!-- /.navbar-collapse -->
    </nav>
</aside>