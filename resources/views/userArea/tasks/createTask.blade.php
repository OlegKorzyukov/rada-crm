@extends ('layout')

@section ('content')
<div class="task__create-wrapper">
   <div id="menu-wrapper"></div>
   <form method="POST" id="formCreateTask" name="taskForm" action="{{ route('tasks.store') }}" enctype='multipart/form-data'>
      @csrf
      <div class="task__create--body">
         <div id="task-form">
            <div class="task-form__header">
               <p>Замовлення № <input class="n-task" value="{{$taskNumber}}" readonly type="number" name="taskNumber" required autocomplete="off"></p>
               <p>на розміщення інформаційних матеріалів та документів</p>
               <p>на офіційному Веб-сайті обласної ради</p>
            </div>

            <div class="task-form__body">
               <div class="task-form__body--block">
                  <div class="task-form__text">1. Структурний підрозділ, посадова особа, яка ініціює розміщення інформаційних матеріалів, документів</div>
                  <input class="task-input-text department-select" value="{{$classObj->getDepartmentName(Auth::id())}}" readonly type="text" placeholder="Оберіть структурний підрозділ" name="taskDepartment" required autocomplete="off" maxlength="300">
               </div>
               <div class="task-form__body--block">
                  <div class="task-form__text">2. Розділ, підрозділ меню</div>
                  <input class="task-input-text menu-select" value="{{old('taskMenu')}}" readonly type="text" placeholder="Оберіть розділ меню" name="taskMenu" required autocomplete="off" maxlength="800">
                  <input class="task-menu-link" type="hidden" name="taskMenuLink" maxlength="2000">
               </div>
               <div class="task-form__body--block">
                  <div class="task-form__text">3. Назва матеріалу</div>
                  <input class="task-input-text" value="{{old('taskMaterial')}}" type="text" placeholder="Введіть назву матеріалу" name="taskMaterial" required autocomplete="off" maxlength="800">
               </div>
               @can ('page', App\Models\Task::class)
               <div class="task-form__body--block">
                  <div class="task-form__text">4. Кількість сторінок</div>
                  <input class="task-form__page" value="{{old('taskPage')}}" type="number" name="taskPage" min="1" max="999" required autocomplete="off">
               </div>
               @endcan
               <div class="task-form__body--block">
                  <div class="task-form__text">5. Запланована дата розміщення матеріалу</div>
                  <input class="task-form__date" value="{{$todayDate}}" type="date" name="taskDateMaterial" min={{$todayDate}} max={{$futureDate}} required autocomplete="off">
               </div>
               <div class="task-form__body--block">
                  <div class="task-form__text">6. Відповідальний за своєчасне надання інформації для розміщення на сайті</div>
                  <div class="task-form__initiator">
                     <input class="task-input-text task-form__initiator-name" value="{{ Auth::user()->uName }}" type="text" name="taskInitiatorName" required autocomplete="off" readonly maxlength="200">
                     <div class="task-add-new-initiator">
                        <img src="{{ asset('/images/icons/addTaskUser.svg') }}" alt="Додати відповідального">
                        Додати відповідальних за розміщення (додатково)
                     </div>
                  </div>
               </div>
               @can ('description', App\Models\Task::class)
               <div class="task-form__body--block">
                  <div class="task-form__text">7. Додаткова інформація</div>
                  <textarea class="task-form__textarea task-desription" value="{{old('taskDescriptionField')}}" name="taskDescriptionField" placeholder="Введіть додаткову інформацію (за потреби)" autocomplete="off" maxlength="800"></textarea>
               </div>
               @endcan
            </div>
         </div>
         @can ('createFile', App\Models\File::class)
         <div class="task-upload-file-wrapper">
            <div class="task-title">Завантажити файли <span>(Перетяніть або натисніть)</span></div>
            <progress id="task-load-file-progress" max=100 value=0></progress>
            <div id="task-load-file-icons"></div>
            <input type="file" name="taskFileUpload[]" id="taskFiles" accept=".doc, .docx, .rtf, .zip, .rar, .txt, .pdf, .xls, .xlsx, .jpg, .png" multiple>
            <div id="task-upload-reset-file">Відмінити завантаження</div>>
         </div>
         @endcan
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
      <input name="taskCreateSend" type="submit" value="Створити заявку" class="send-button task-create-send-button">
   </form>
</div>
@endsection