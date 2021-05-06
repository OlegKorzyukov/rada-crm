@extends ('layout')

@section ('content')
<div class="department__edit-wrapper edit-wrapper">
   <form method="POST" action="{{ route('departments.update', $department) }}">
      @csrf
      @method ('PUT')
      <input value="{{ $department->dTitle }}" id="department__edit-title" placeholder="Назва департамента" type="text" class="departament_input" name="dTitle" required autofocus />

      @if ($errors->any())
      <div class="alert alert-danger">
         <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
         </ul>
      </div>
      @endif
      <input name="departmentEditSend" type="submit" value="Змінити" class="login_send">
   </form>
</div>
@endsection