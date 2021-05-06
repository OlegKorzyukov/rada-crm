@extends ('layout')

@section ('content')
<div class="user__create-wrapper create-wrapper">
   <form method="POST" action="{{ route('users.store') }}" enctype='multipart/form-data'>
      @csrf
      <div class="user__create-avatar-wrapper">
         <img src="{{ asset('/images/icons/add.svg') }}" alt="">
         <input value="{{ old('uAvatar') }}" id="user__create-avatar" type="file" accept="image/x-png,image/gif,image/jpeg" class="login_input" name="uAvatar" autofocus />
      </div>
      <label>
         <span>Ім'я</span>
         <input value="{{ old('uName') }}" id="user__create-name" placeholder="ПІБ" type="text" class="login_input" name="uName" required autofocus />
      </label>
      <label>
         <span>Логін</span>
         <input value="{{ old('uLogin') }}" id="user__create-login" placeholder="Логін" type="text" class="login_input" name="uLogin" required autofocus />
      </label>
      <label class='user__create-password-wrapper'>
         <span>Пароль</span>
         <input id="user__create-password" placeholder="Пароль" type="password" class="login_input" name="uPassword" required />
         <img class="user__create-password--random" src="{{ asset('images/icons/refresh.svg')}}" alt="" />
      </label>
      <label>
         <span>Посада</span>
         <input value="{{ old('uPosition') }}" id="user__create-position" placeholder="Посада" type="text" class="login_input" name="uPosition" autofocus />
      </label>
      <label>
         <span>Департамент</span>
         <select class="user__create-department" name="uDepartment" required>
            @foreach ($department as $value)
            <option value="{{ $value->idDepartment }}">{{ $value->dTitle }}</option>
            @endforeach
         </select>
      </label>
      <label>
         <span>Група</span>
         <select class="user__create-group" name="uGroup" required>
            @foreach ($group as $value)
            <option value="{{ $value->idGroup }}">{{ $value->gName }}</option>
            @endforeach
         </select>
      </label>
      @if ($errors->any())
      <div class="alert alert-danger">
         <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
         </ul>
      </div>
      @endif
      <input name="userCreateSend" type="submit" value="Створити" class="login_send send-button">
   </form>
</div>
@endsection