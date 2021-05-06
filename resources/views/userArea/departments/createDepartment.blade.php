@extends ('layout')

@section ('content')
<div class="department__create-wrapper create-wrapper">
   <form method="POST" action="{{ route('departments.store') }}">
      @csrf
      <input value="{{ old('dTitle') }}" id="department__create-title" placeholder="Назва департамента" type="text" class="departament_input" name="dTitle" required autofocus />

      @if ($errors->any())
      <div class="alert alert-danger">
         <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
         </ul>
      </div>
      @endif
      <input name="departmentCreateSend" type="submit" value="Створити" class="login_send send-button">
   </form>
</div>
@endsection