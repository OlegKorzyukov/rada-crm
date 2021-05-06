@extends ('layout')

@section ('content')

<div class="groups__wrapper wrapper">
   @can ('create', App\Models\Group::class)
   <div class="group__new_group create_new_button">
      <a href="{{ route('departments.create') }}">
         <img src="{{ asset('/images/icons/addTaskUser.svg') }}" alt="Створити заявку">Створити департамент
      </a>
   </div>
   @endcan

   <table id="group-table">
      <thead>
         <tr>
            <th>№</th>
            <th>Назва департаменту</th>
            <th>Користувачів</th>
            <th></th>
         </tr>
      </thead>
      <tbody>
         @foreach($departments as $key => $department)
         <tr>
            <td>{{ ++$key }}</td>
            <td>{{$department->dTitle}}</td>
            <td>{{ $Department::getCountUserDepartment($department->idDepartment) }}</td>
            <td>
               <div class="department__action row-action">
                  @can ('viewAny', App\Models\Department::class)
                  <a class="department__action-view row-action-view" href="{{ route('departments.show', $department) }}" title="Переглянути"><img src="{{ asset('images/icons/user_table_view.svg') }}" alt="Переглянути"></a>
                  @endcan
                  @if($department->dTitle !== 'KP CES' && $department->dTitle !== 'undefined')
                  @can ('update', App\Models\Department::class)
                  <a class="department__action-edit row-action-edit" href="{{ route('departments.edit', $department) }}" title="Редагувати"><img src="{{ asset('images/icons/user_table_edit.svg') }}" alt="Редагувати"></a>
                  @endcan
                  @can ('delete', App\Models\Department::class)
                  <form id="department__action-delete" method="POST" action="{{ route('departments.destroy') }}">
                     @csrf
                     @method('DELETE')
                     <input type="hidden" name="departmentId" value="{{ $department->idDepartment }}">
                     <a class="department__action-remove row-action-remove" onclick="this.closest('#department__action-delete').submit();return false;" title="Видалити"><img src="{{ asset('images/icons/user_table_delete.svg') }}" alt="Видалити"></a>
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