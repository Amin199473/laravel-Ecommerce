 <!-- Preloader -->
 <div class="preloader flex-column justify-content-center align-items-center">
     <img class="animation__shake" src="{{ asset('backend/dist/img/AdminLTELogo.png') }}" alt="AdminLTELogo" height="60" width="60">
 </div>

 <!-- Navbar -->
 <nav class="main-header navbar navbar-expand navbar-white navbar-light">
     <!-- Left navbar links -->
     <ul class="navbar-nav">
         <li class="nav-item">
             <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
         </li>
         <li class="nav-item d-none d-sm-inline-block">
             <a href="{{ route('welcome') }}" class="nav-link">Home</a>
         </li>
         <li class="nav-item d-none d-sm-inline-block">
             <a href="{{ route('contact.index') }}" class="nav-link">Contacts</a>
         </li>
         @if(!Auth::user()->profile->avatar && Auth::user()->profile->gender =="male" )
         <img src="{{ asset('backend/dist/img/avatar5.png') }}" alt="" width="50px" class="rounded-circle">
         @elseif(!Auth::user()->profile->avatar && Auth::user()->profile->gender =="female")
         <img src="{{ asset('backend/dist/img/avatar3.png') }}" alt="" width="50px" class="rounded-circle">
         @else
         <img src="{{ asset('avatar-image/'.Auth::user()->profile->avatar) }}" alt="" width="50px" class="rounded-circle">
         @endif
         <li class="nav-item dropdown">
             <a class="nav-link dropdown-toggle text-dark" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                 {{ Auth::user()->name}}
             </a>
             <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">
                 <a class="dropdown-item text-light hover" href="{{ route('userProfile') }}">My Porfile</a>
                 <a class="dropdown-item text-light hover" href="{{ route('logout') }}" onclick="event.preventDefault();
                 document.getElementById('logout-form').submit();">{{ _('Logout') }}</a>
                 <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                     @csrf
                 </form>
             </div>
         </li>
     </ul>

     <!-- Right navbar links -->
     <ul class="navbar-nav ml-auto">
         <!-- Notifications Dropdown Menu -->
         <li class="nav-item dropdown">
             <a class="nav-link" data-toggle="dropdown" href="#">
                 <i class="far fa-bell"></i>
                 <span class="badge badge-warning navbar-badge">{{ Auth::user()->unreadNotifications->count()  }}</span>
             </a>
             <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                 <span class="dropdown-item dropdown-header">{{ Auth::user()->notifications->count() }} Notifications</span>
                 <div class="dropdown-divider"></div>
                 @forelse(Auth::user()->unreadNotifications->take(3) as $notification )
                 <a href="#" class="dropdown-item">
                     <i class="fas fa-envelope mr-2"></i> notifications
                     <span class="float-right text-muted text-sm">{{ $notification->created_at->diffForhumans() }}</span>
                 </a>
                 @empty
                 <a href="#" class="dropdown-item">
                     <i class="fas fa-envelope mr-2"></i>There is no unread notifications!
                     <span class="float-right text-muted text-sm"></span>
                 </a>
                 @endforelse
                 <div class="dropdown-divider"></div>
                 <a href="{{ route('notification.index') }}" class="dropdown-item dropdown-footer">See All Notifications</a>
             </div>
         </li>
         <li class="nav-item">
             <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                 <i class="fas fa-expand-arrows-alt"></i>
             </a>
         </li>
         <li class="nav-item">
             <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                 <i class="fas fa-th-large"></i>
             </a>
         </li>
     </ul>
 </nav>
 <!-- /.navbar -->
