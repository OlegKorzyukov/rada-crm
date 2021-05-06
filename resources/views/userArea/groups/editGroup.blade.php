@extends ('layout')

@section ('content')
<div class="group__create-wrapper">
   <form method="POST" action="{{ route('groups.update', $group) }}" enctype='multipart/form-data'>
      @csrf
      @method('PUT')
      <input value="{{ $group->gName }}" id="group__create-name" placeholder="Назва групи" type="text" class="input-field" name="gName" required autofocus />

      <div class="group__create-category-wrapper">
         <div class="group__create-category">
            <h3>Керування файлами</h3>
            <div class="group__create-field">
               <input value=0 type="hidden" id="createFile" name="gCreateFile">
               <input {{ ($group->gCreateFile) ? 'checked' : '' }} type="checkbox" id="createFile" name="gCreateFile">
               <label for="createFile">Створювати файли</label>
            </div>
            <div class="group__create-field">
               <input value=0 type="hidden" id="readFile" name="gReadFile">
               <input {{ ($group->gReadFile) ? 'checked' : '' }} type="checkbox" id="readFile" name="gReadFile">
               <label for="readFile">Переглядати файли</label>
            </div>
            <div class="group__create-field">
               <input value=0 type="hidden" id="updateFile" name="gUpdateFile">
               <input {{ ($group->gUpdateFile) ? 'checked' : '' }} type="checkbox" id="updateFile" name="gUpdateFile">
               <label for="updateFile">Обновляти файли</label>
            </div>
            <div class="group__create-field">
               <input value=0 type="hidden" id="deleteFile" name="gDeleteFile">
               <input {{ ($group->gDeleteFile) ? 'checked' : '' }} type="checkbox" id="deleteFile" name="gDeleteFile">
               <label for="deleteFile">Видаляти файли</label>
            </div>
         </div>

         <div class="group__create-category">
            <h3>Керування користувачами</h3>
            <div class="group__create-field">
               <input value=0 type="hidden" id="createUser" name="gCreateUser">
               <input {{ ($group->gCreateUser) ? 'checked' : '' }} type="checkbox" id="createUser" name="gCreateUser">
               <label for="createUser">Створювати користувачів</label>
            </div>
            <div class="group__create-field">
               <input value=0 type="hidden" id="readUser" name="gReadUser">
               <input {{ ($group->gReadUser) ? 'checked' : '' }} type="checkbox" id="readUser" name="gReadUser">
               <label for="readUser">Переглядати користувачів</label>
            </div>
            <div class="group__create-field">
               <input value=0 type="hidden" id="updateUser" name="gUpdateUser">
               <input {{ ($group->gUpdateUser) ? 'checked' : '' }} type="checkbox" id="updateUser" name="gUpdateUser">
               <label for="updateUser">Обновляти користувачів</label>
            </div>
            <div class="group__create-field">
               <input value=0 type="hidden" id="deleteUser" name="gDeleteUser">
               <input {{ ($group->gDeleteUser) ? 'checked' : '' }} type="checkbox" id="deleteUser" name="gDeleteUser">
               <label for="deleteUser">Видаляти користувачів</label>
            </div>
         </div>

         <div class="group__create-category">
            <h3>Керування групами</h3>
            <div class="group__create-field">
               <input value=0 type="hidden" id="createGroup" name="gCreateGroup">
               <input {{ ($group->gCreateGroup) ? 'checked' : '' }} type="checkbox" id="createGroup" name="gCreateGroup">
               <label for="createGroup">Створювати групи</label>
            </div>
            <div class="group__create-field">
               <input value=0 type="hidden" id="readGroup" name="gReadGroup">
               <input {{ ($group->gReadGroup) ? 'checked' : '' }} type="checkbox" id="readGroup" name="gReadGroup">
               <label for="readGroup">Переглядати групи</label>
            </div>
            <div class="group__create-field">
               <input value=0 type="hidden" id="updateGroup" name="gUpdateGroup">
               <input {{ ($group->gUpdateGroup) ? 'checked' : '' }} type="checkbox" id="updateGroup" name="gUpdateGroup">
               <label for="updateGroup">Обновляти групи</label>
            </div>
            <div class="group__create-field">
               <input value=0 type="hidden" id="deleteGroup" name="gDeleteGroup">
               <input {{ ($group->gDeleteGroup) ? 'checked' : '' }} type="checkbox" id="deleteGroup" name="gDeleteGroup">
               <label for="deleteGroup">Видаляти групи</label>
            </div>
         </div>

         <div class="group__create-category">
            <h3>Керування заявками</h3>
            <div class="group__create-field">
               <input value=0 type="hidden" name="gCanViewTask">
               <input {{ ($group->gCanViewTask) ? 'checked' : '' }} type="checkbox" id="viewTask" name="gCanViewTask">
               <label for="viewTask">Переглядати заявки</label>
            </div>
            <div class="group__create-field">
               <input value=0 type="hidden" name="gCanCreateTask">
               <input {{ ($group->gCanCreateTask) ? 'checked' : '' }} type="checkbox" id="createTask" name="gCanCreateTask">
               <label for="createTask">Створювати заявки</label>
            </div>
            <div class="group__create-field">
               <input value=0 type="hidden" name="gCanAcceptTask">
               <input {{ ($group->gCanAcceptTask) ? 'checked' : '' }} type="checkbox" id="acceptTask" name="gCanAcceptTask">
               <label for="acceptTask">Підтверджувати заявки</label>
            </div>
            <div class="group__create-field">
               <input value=0 type="hidden" name="gCanCancelTask">
               <input {{ ($group->gCanCancelTask) ? 'checked' : '' }} type="checkbox" id="cancelTask" name="gCanCancelTask">
               <label for="cancelTask">Відміняти заявки</label>
            </div>
            <div class="group__create-field">
               <input value=0 type="hidden" name="gCanPerformTask">
               <input {{ ($group->gCanPerformTask) ? 'checked' : '' }} type="checkbox" id="performTask" name="gCanPerformTask">
               <label for="performTask">Виконувати заявки</label>
            </div>
            <div class="group__create-field">
               <input value=0 type="hidden" name="gCanHistoryTask">
               <input {{ ($group->gCanHistoryTask) ? 'checked' : '' }} type="checkbox" id="historyTask" name="gCanHistoryTask">
               <label for="historyTask">Переглядати історію заявок</label>
            </div>
            <div class="group__create-field">
               <input value=0 type="hidden" name="gCanStatusTask">
               <input {{ ($group->gCanStatusTask) ? 'checked' : '' }} type="checkbox" id="statusTask" name="gCanStatusTask">
               <label for="statusTask">Переглядати статус заявок</label>
            </div>
            <div class="group__create-field">
               <input value=0 type="hidden" name="gCanPageTask">
               <input {{ ($group->gCanPageTask) ? 'checked' : '' }} type="checkbox" id="pageTask" name="gCanPageTask">
               <label for="pageTask">Заповнювати сторінки заявок</label>
            </div>
            <div class="group__create-field">
               <input value=0 type="hidden" name="gCanDescriptionTask">
               <input {{ ($group->gCanDescriptionTask) ? 'checked' : '' }} type="checkbox" id="descriptionTask" name="gCanDescriptionTask">
               <label for="descriptionTask">Додаткові примітки в заявках</label>
            </div>
         </div>

         <div class="group__create-category">
            <h3>Керування департаментами</h3>
            <div class="group__create-field">
               <input value=0 type="hidden" name="gCreateDepartment">
               <input {{ ($group->gCreateDepartment) ? 'checked' : '' }} type="checkbox" id="createDepartment" name="gCreateDepartment">
               <label for="createDepartment">Створювати департаменти</label>
            </div>
            <div class="group__create-field">
               <input value=0 type="hidden" name="gReadDepartment">
               <input {{ ($group->gReadDepartment) ? 'checked' : '' }} type="checkbox" id="readDepartment" name="gReadDepartment">
               <label for="readDepartment">Переглядати департаменти</label>
            </div>
            <div class="group__create-field">
               <input value=0 type="hidden" name="gUpdateDepartment">
               <input {{ ($group->gUpdateDepartment) ? 'checked' : '' }} type="checkbox" id="updateDepartment" name="gUpdateDepartment">
               <label for="updateDepartment">Оновлювати департаменти</label>
            </div>
            <div class="group__create-field">
               <input value=0 type="hidden" name="gDeleteDepartment">
               <input {{ ($group->gDeleteDepartment) ? 'checked' : '' }} type="checkbox" id="deleteDepartment" name="gDeleteDepartment">
               <label for="deleteDepartment">Видаляти департаменти</label>
            </div>
         </div>
      </div>

      @if ($errors->any())
      <div class="alert alert-danger">
         <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
         </ul>
      </div>
      @endif
      <input name="groupEditSend" type="submit" value="Зберегти" class="send-button">
   </form>
</div>
@endsection