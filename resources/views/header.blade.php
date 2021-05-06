<head>
   <div class="head_wrapper">
      <div class="head__text">
         <!--<a href="{{ url()->previous() }}">Arrow</a>-->
         <h1>{{$title}}</h1>
      </div>
      <div class="head__user">
         <div class="head__user_wrapper">
            <a class="head__user-name-avatar" href="{{ route('users.edit', Auth::id()) }}">
               <div class="head__user-name">
                  <div>{{ Auth::user()->uName }}</div>
                  <span>{{ Auth::user()->uPosition }}</span>
               </div>
               <img class="head__user-avatar" src="{{ Auth::user()->uAvatar }}" alt="user">
               <form class="head__user-logout-form" method="POST" action="{{ route('logout') }}">
                  @csrf
                  <a class="head__user-logout" href="{{ route('logout') }}" onclick="event.preventDefault();this.closest('form').submit();">
                     <img src="{{ asset('/images/icons/logout.svg') }}" alt="">
                  </a>
               </form>
            </a>
            <ul>
               <li><a href="{{ route('dashboard') }}" active="request()->routeIs('dashboard')"></a></li>
            </ul>
         </div>
      </div>
   </div>
</head>