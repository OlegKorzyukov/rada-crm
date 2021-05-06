@extends ('layout')

@section ('content')
<div class="groups__wrapper wrapper">
   @can ('create', App\Models\Group::class)
   <div class="group__new_group create_new_button">
      <a href="{{ route('groups.create') }}">
         <img src="{{ asset('/images/icons/addTaskUser.svg') }}" alt="Створити заявку">Створити групу
      </a>
   </div>
   @endcan
   <table id="group-table">
      <thead>
         <tr>
            <th>№</th>
            <th>Ім'я</th>
            <th>Користувачів</th>
            <th></th>
         </tr>
      </thead>
      <tbody>
         @foreach ($groups as $key => $group)
         <tr>
            <td>{{ ++$key }}</td>
            <td>{{ $group->gName }}</td>
            <td>{{ $Group::getCountUserGroup($group->idGroup) }}</td>
            <td>
               <div class="group__action row-action">
                  @can ('view', App\Models\Group::class)
                  <a class="group__action-view row-action-view" href="{{ route('groups.show', $group) }}" title="Переглянути"><img src="{{ asset('images/icons/user_table_view.svg') }}" alt="Переглянути"></a>
                  @endcan
                  @if($group->gName !== 'superuser' && $group->gName !== 'undefined')
                  @can ('update', App\Models\Group::class)
                  <a class="group__action-edit row-action-edit" href="{{ route('groups.edit', $group) }}" title="Редагувати"><img src="{{ asset('images/icons/user_table_edit.svg') }}" alt="Редагувати"></a>
                  @endcan
                  @can ('delete', App\Models\Group::class)
                  <form id="group__action-delete" method="POST" action="{{ route('groups.destroy') }}">
                     @csrf
                     @method('DELETE')
                     <input type="hidden" name="groupId" value="{{ $group->idGroup }}">
                     <a class="group__action-remove row-action-remove" onclick="this.closest('#group__action-delete').submit();return false;" title="Видалити"><img src="{{ asset('images/icons/user_table_delete.svg') }}" alt="Видалити"></a>
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