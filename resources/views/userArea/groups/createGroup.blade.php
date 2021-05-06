@extends ('layout')

@section ('content')
<div class="group__create-wrapper">
   <form method="POST" action="{{ route('groups.store') }}">
      @csrf

      <input value="{{ old('uName') }}" id="group__create-name" placeholder="Назва групи" type="text" class="input-field" name="gName" required autofocus />

      <div class="group__create-category-wrapper">
         <div class="group__create-category">
            <h3>Керування файлами</h3>
            <div class="group__create-field">
               <input type="checkbox" id="createFile" name="createFile">
               <label for="createFile">Створювати файли</label>
            </div>
            <div class="group__create-field">
               <input type="checkbox" id="readFile" name="readFile">
               <label for="readFile">Переглядати файли</label>
            </div>
            <div class="group__create-field">
               <input type="checkbox" id="updateFile" name="updateFile">
               <label for="updateFile">Обновляти файли</label>
            </div>
            <div class="group__create-field">
               <input type="checkbox" id="deleteFile" name="deleteFile">
               <label for="deleteFile">Видаляти файли</label>
            </div>
         </div>

         <div class="group__create-category">
            <h3>Керування користувачами</h3>
            <div class="group__create-field">
               <input type="checkbox" id="createUser" name="createUser">
               <label for="createUser">Створювати користувачів</label>
            </div>
            <div class="group__create-field">
               <input type="checkbox" id="readUser" name="readUser">
               <label for="readUser">Переглядати користувачів</label>
            </div>
            <div class="group__create-field">
               <input type="checkbox" id="updateUser" name="updateUser">
               <label for="updateUser">Обновляти користувачів</label>
            </div>
            <div class="group__create-field">
               <input type="checkbox" id="deleteUser" name="deleteUser">
               <label for="deleteUser">Видаляти користувачів</label>
            </div>
         </div>

         <div class="group__create-category">
            <h3>Керування групами</h3>
            <div class="group__create-field">
               <input type="checkbox" id="createGroup" name="createGroup">
               <label for="createGroup">Створювати групи</label>
            </div>
            <div class="group__create-field">
               <input type="checkbox" id="readGroup" name="readGroup">
               <label for="readGroup">Переглядати групи</label>
            </div>
            <div class="group__create-field">
               <input type="checkbox" id="updateGroup" name="updateGroup">
               <label for="updateGroup">Обновляти групи</label>
            </div>
            <div class="group__create-field">
               <input type="checkbox" id="deleteGroup" name="deleteGroup">
               <label for="deleteGroup">Видаляти групи</label>
            </div>
         </div>

         <div class="group__create-category">
            <h3>Керування заявками</h3>
            <div class="group__create-field">
               <input type="checkbox" id="viewTask" name="viewTask">
               <label for="viewTask">Переглядати заявки</label>
            </div>
            <div class="group__create-field">
               <input type="checkbox" id="createTask" name="createTask">
               <label for="createTask">Створювати заявки</label>
            </div>
            <div class="group__create-field">
               <input type="checkbox" id="acceptTask" name="acceptTask">
               <label for="acceptTask">Підтверджувати заявки</label>
            </div>
            <div class="group__create-field">
               <input type="checkbox" id="cancelTask" name="cancelTask">
               <label for="cancelTask">Відміняти заявки</label>
            </div>
            <div class="group__create-field">
               <input type="checkbox" id="performTask" name="performTask">
               <label for="performTask">Виконувати заявки</label>
            </div>
            <div class="group__create-field">
               <input type="checkbox" id="historyTask" name="historyTask">
               <label for="historyTask">Переглядати історію заявок</label>
            </div>
            <div class="group__create-field">
               <input type="checkbox" id="statusTask" name="statusTask">
               <label for="statusTask">Переглядати статус заявок</label>
            </div>
            <div class="group__create-field">
               <input type="checkbox" id="pageTask" name="pageTask">
               <label for="pageTask">Заповнювати сторінки заявок</label>
            </div>
            <div class="group__create-field">
               <input type="checkbox" id="descriptionTask" name="descriptionTask">
               <label for="descriptionTask">Додаткові примітки в заявках</label>
            </div>
         </div>

         <div class="group__create-category">
            <h3>Керування департаментами</h3>
            <div class="group__create-field">
               <input type="checkbox" id="createDepartment" name="createDepartment">
               <label for="createDepartment">Створювати департаменти</label>
            </div>
            <div class="group__create-field">
               <input type="checkbox" id="readDepartment" name="readDepartment">
               <label for="readDepartment">Переглядати департаменти</label>
            </div>
            <div class="group__create-field">
               <input type="checkbox" id="updateDepartment" name="updateDepartment">
               <label for="updateDepartment">Оновлювати департаменти</label>
            </div>
            <div class="group__create-field">
               <input type="checkbox" id="deleteDepartment" name="deleteDepartment">
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
      <input name="groupCreateSend" type="submit" value="Створити" class="send-button">
   </form>
</div>
@endsection