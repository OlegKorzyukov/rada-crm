@extends ('layout')

@section ('content')
<div class="task__create-wrapper">
   <div class="task__create--body">
      <div id="task-form">
         @if(gettype($task->tAcceptChief) === 'integer' && gettype($task->tCancelInitiator) !== 'integer')
         <div class="task-form__sign-chief task-form__body--block">
            <p class="task-form__sign-chief-title">Погоджено</p>
            <p>{{$classObj->getDepartmentName($task->tAcceptChief)}}</p>
            <p class="task-form__sign-chief-name">{{$classObj->getUserName($task->tAcceptChief)}}</p>
            <div>{{$task->tChiefAcceptTime}}</div>
         </div>
         @endif
         @if(gettype($task->tCancelInitiator) === 'integer')
         <div class="task-form__sign-chief task-form__body--block">
            <p class="task-form__sign-chief-title">Відмінено</p>
            <p>{{$classObj->getDepartmentName($task->tCancelInitiator)}}</p>
            <p class="task-form__sign-chief-name">{{$classObj->getUserName($task->tCancelInitiator)}}</p>
            <div>{{$task->tChiefAcceptTime}}</div>
         </div>
         @endif
         <div class="task-form__header">
            <p>Замовлення №
               @if(isset($task->tLink))
               <a class="task-download" id="task-number" data-number="{{$task->tNumber}}" href="{{ $task->tLink }}">{{ $task->tNumber }} <img src="{{ asset('images/icons/download.svg') }}" alt="Завантажити"></a>
               @else
               <span id="task-number" data-number="{{$task->tNumber}}">{{$task->tNumber}}</span>
               @endif
            </p>
            <p>на розміщення інформаційних матеріалів та документів</p>
            <p>на офіційному Веб-сайті обласної ради</p>
         </div>
         <div class=" task-form__body">
            <div class="task-form__body--block">
               <div class="task-form__text">1. Структурний підрозділ, посадова особа, яка ініціює розміщення інформаційних матеріалів, документів</div>
               <div class="text-bold">{{$classObj->getDepartmentName($task->tInitiator)}}</div>
            </div>
            <div class="task-form__body--block">
               <div class="task-form__text">2. Розділ, підрозділ меню</div>
               <div class="text-bold">{{$task->tSitePath}}</div>
            </div>
            <div class="task-form__body--block">
               <div class="task-form__text">3. Назва матеріалу</div>
               <div class="text-bold">{{$task->tSignName}}</div>
            </div>
            <div class="task-form__body--block">
               <div class="task-form__text">4. Кількість сторінок</div>
               <div class="text-bold">{{$task->tPage}}</div>
            </div>
            <div class="task-form__body--block">
               <div class="task-form__text">5. Запланована дата розміщення матеріалу</div>
               <div class="text-bold">{{$task->tCreateTime}}</div>
            </div>
            <div class="task-form__body--block">
               <div class="task-form__text">6. Відповідальний за своєчасне надання інформації для розміщення на сайті</div>
               <div class="task-form__initiator">
                  <div class="text-bold">{{$classObj->getUserName($task->tInitiator)}}</div>
                  @if(isset($task->tInitiatorAdditional))
                  <div class="text-bold">{{$classObj->getUserName($task->tInitiatorAdditional)}}</div>
                  @endif
               </div>
            </div>
            <div class="task-form__body--block">
               <div class="task-form__text">7. Додаткова інформація</div>
               <div class="text-bold">{{$task->tDescription}}</div>
            </div>
         </div>

         <div class="task-form__executor">
            @if(gettype($task->tExecutor) === 'integer')
            <div class="task-form__body--block">
               <div class="task-form__text">Замовлення прийнято до виконання
                  <span class="task-form__body--date text-bold">{{$task->tExecutorGetDate}}</span>
               </div>
            </div>
            <div class="task-form__body--block">
               <div class="task-form__text">Посадова особа Виконавця
                  <span class="task-form__executor-name text-bold">{{$classObj->getUserName($task->tExecutor)}}</span>
                  <span>({{$classObj->getDepartmentName($task->tExecutor)}})</span>
               </div>
            </div>

            @endif
            @if($task->tStatus === 1 && !isset($task->tCancelInitiator))
            <div class="task-form__body--block">
               <div class="task-form__text">Замовлення виконано
                  <span class="task-form__body--date text-bold">{{$task->tCloseTime}}</span>
               </div>
            </div>

            <div class="task-form__body--block">
               <div class="task-form__text">Посадова особа Виконавця</div>
               <span class="task-form__executor-name text-bold">{{$classObj->getUserName($task->tExecutor)}}</span>
               <span>({{$classObj->getDepartmentName($task->tExecutor)}})</span>
            </div>
            @endif
         </div>
      </div>
      @can('readFile', App\Models\File::class)
      @if($classFileObj->getAllFileForTask($task->idTask)->count() !== 0)
      <div class="task-show-file-wrapper">
         <div>
            @foreach($classFileObj->getAllFileForTask($task->idTask) as $key => $file)
            <a class="task-file-row" href="{{$file->fLink}}" title="{{$file->fOriginName}}">
               <div class="task-file-row__k">{{++$key}}</div>
               <div class="task-file-row__file">{{sliceString($file->fOriginName, 30)}}</div>
               <div class="task-file-row__link"><img src="{{ asset('/images/icons/external-link.svg') }}" alt="Переглянути"></div>
            </a>
            @endforeach
         </div>
         <div class="task-file-active-bar">
            <div class="task-file-active-bar__count">Файлів: <span>{{$classFileObj->getAllFileForTask($task->idTask)->count()}}</span></div>
            <div class="task-file-active-bar__download"><img src="{{ asset('/images/icons/download.svg') }}" alt="Переглянути"></div>
            <a class="insert_download_link" download style="display:none" href=""></a>
         </div>
      </div>
      @endif
      @endcan
   </div>

   <form method="POST" class="task_active_button" name="taskAcceptForm" action="{{ route('tasks.update', $task) }}">
      @csrf
      @method('PUT')
      @if ($errors->any())
      <div class="alert alert-danger">
         <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
         </ul>
      </div>
      @endif
    
      @if(is_null($task->tAcceptChief) && (int)$task->tStatus === 0)
      @can('accept', App\Models\Task::class)
      <input name="taskAcceptSend" type="submit" value="Підтвердити заявку" class="send-button">
      @endcan
      @can('cancel', App\Models\Task::class)
      <input name="taskDeclineSend" type="submit" value="Відмінити заявку" class="decline-button">
      @endcan
      @elseif(!is_null($task->tAcceptChief) && (int)$task->tStatus === 0 && !isset($task->tExecutor))
      @can('perform', App\Models\Task::class)
      <input name="taskTakeWork" type="submit" value="Взяти заявку" class="send-button">
      @endcan
      @can('cancel', App\Models\Task::class)
      <input name="taskDeclineSend" type="submit" value="Відмінити заявку" class="decline-button">
      @endcan
      @endif
      @if(!is_null($task->tAcceptChief) && (int)$task->tStatus === 0 && !is_null($task->tExecutor))
      @can('perform', App\Models\Task::class)
      <input name="taskEndSend" type="submit" value="Заявка виконана" class="send-button">
      @endcan
      @endif
   </form>
</div>
@endsection