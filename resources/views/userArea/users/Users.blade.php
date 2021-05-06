@extends ('layout')

@section ('content')
<div class="users__wrapper wrapper">
   @can ('create', App\Models\User::class)
   <div class="user__new_user create_new_button">
      <a href="{{ route('users.create') }}">
         <img src="{{ asset('/images/icons/addTaskUser.svg') }}" alt="Створити користувача">Створити користувача
      </a>
   </div>
   @endcan
   <table id="user-table">
      <thead>
         <tr>
            <th>№</th>
            <th>Ім'я</th>
            <th>Логін</th>
            <th>Група</th>
            <th>Онлайн</th>
            <th>Активний</th>
            <th>Посада</th>
            <th>Департамент</th>
            <th></th>
         </tr>
      </thead>
      <tbody>
         @foreach ($users as $key=>$user)
         <tr>
            <td>{{ ++$key }}</td>
            <td>{{ $user->uName }}</td>
            <td>{{ $user->uLogin }}</td>
            <td>{{ App\Http\Controllers\GroupController::getNameGroup($user->uGroup) }}</td>
            <td>{{ $user->uStatus }}</td>
            <td>{{ $user->uActive }}</td>
            <td>{{ $user->uPosition }}</td>
            <td>{{ App\Http\Controllers\DepartmentController::getNameDepartament($user->uDepartment) }}</td>
            <td>
               <div class="user__action row-action">
                  @can ('view', App\Models\User::class)
                  <a class="user__action-view row-action-view" href="{{ route('users.show', $user) }}" title="Переглянути"><img src="{{ asset('images/icons/user_table_view.svg') }}" alt="Переглянути"></a>
                  @endcan
                  @if($user->uLogin !== 'justdoit')
                  @can ('update', App\Models\User::class)
                  <a class="user__action-edit row-action-edit" href="{{ route('users.edit', $user) }}" title="Редагувати"><img src="{{ asset('images/icons/user_table_edit.svg') }}" alt="Редагувати"></a>
                  @endcan
                  @can ('delete', App\Models\User::class)
                  <form id="user__action-delete" method="POST" action="{{ route('users.destroy') }}">
                     @csrf
                     @method('DELETE')
                     <input type="hidden" name="userId" value="{{ $user->idUser }}">
                     <a class="user__action-remove row-action-remove" onclick="this.closest('#user__action-delete').submit();return false;" title="Видалити"><img src="{{ asset('images/icons/user_table_delete.svg') }}" alt="Видалити"></a>
                  </form>
                  @endcan
                  @endif
               </div>
            </td>
         </tr>
         @endforeach
      </tbody>
   </table>
</div>
@endsection