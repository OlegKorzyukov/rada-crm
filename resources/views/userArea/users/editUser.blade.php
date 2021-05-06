@extends ('layout')

@section ('content')
<div class="user__edit-wrapper edit-wrapper">
   <form method="POST" action="{{ route('users.update', $user) }}" enctype='multipart/form-data'>
      @csrf
      @method('PUT')

      <div class="user__create-avatar-wrapper">
         <img src="{{ $user->uAvatar }}" alt="{{ $user->uName }}">
         <input value="{{ $user->uAvatar }}" id="user__create-avatar" type="file" accept="image/x-png,image/gif,image/jpeg" class="login_input" name="uAvatar" autofocus />
      </div>
      <div class="user__edit-info-wrapper">
         <label>
            <span>Ім'я</span>
            <input value="{{ $user->uName }}" id="user__edit-name" placeholder="ПІБ" type="text" class="login_input" name="uName" autofocus />
         </label>
         <label>
            <span>Логін</span>
            <input value="{{ $user->uLogin }}" id="user__edit-login" placeholder="Логін" type="text" class="login_input unactive" name="uLogin" autofocus readonly />
         </label>
         <label class="user__edit-password--wrapper">
            <span>Пароль</span>
            <input id="user__edit-password" placeholder="Пароль" type="password" class="login_input" name="uPassword" />
            <img class="user__create-password--random" src="{{ asset('images/icons/refresh.svg')}}" alt="" />
         </label>
         <label>
            <span>Посада</span>
            <input value="{{ $user->uPosition }}" id="user__edit-position" placeholder="Посада" type="text" class="login_input" name="uPosition" autofocus />
         </label>
         <label>
            <span>Департамент</span>
            <select class="user__create-department" name="uDepartment" required>
               @foreach ($department as $value)
               <option value="{{ $value->idDepartment }}" {{ ($value->idDepartment === $user->uDepartment) ? 'selected' : '' }}>{{ $value->dTitle }}</option>
               @endforeach
            </select>
         </label>
         <label>
            <span>Група</span>
            <select class="user__edit-group" name="uGroup">
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
         <input name="userEditSend" type="submit" value="Обновити" class="send_edit send-button">
      </div>
   </form>
</div>
@endsection