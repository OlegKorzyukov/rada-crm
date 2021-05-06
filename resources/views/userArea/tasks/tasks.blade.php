@extends ('layout')

@section ('content')
<div class="tasks__wrapper wrapper">
   @can ('create', App\Models\Task::class)
   <div class="task__new_task create_new_button">
      <a href="{{ route('tasks.create') }}">
         <img src="{{ asset('/images/icons/addTaskUser.svg') }}" alt="Створити заявку">Створити заявку
      </a>
   </div>
   @endcan


   <div class="task-group-title-wrapper">
      @can ('accept', App\Models\Task::class)
      <span class="task-accept-queue__title task-title" data-table="task-table-accept-queue">Очікують підтвердження</span>
      @endcan
      <span class="task-actual__title task-title" data-table="task-table-actual">Активні заявки</span>
      @can ('history', App\Models\Task::class)
      <span class="task-history__title task-title" data-table="task-table-history">Історія заявок</span>
      @endcan
   </div>

   @can ('accept', App\Models\Task::class)
   <div class='tasks__table active'>
      <table id="task-table-accept-queue">
         <thead>
            <tr>
               <th></th>
               <th>№ Заявки</th>
               <th>Назва</th>
               <th>Ініціатори</th>
               <th>Дата розміщення</th>
               <th>Місце розміщення</th>
               <th>Створено</th>
               @can('status', App\Models\Task::class)
               <th>Статус</th>
               @endcan
               <th></th>
            </tr>
         </thead>
         <tbody>
            @foreach ($forAcceptTasks as $key => $task)
            <tr>
               <td>{{ ++$key }}</td>
               <td>{{ $task->tNumber }}</td>
               <td>{{ $task->tSignName }}</td>
               <td>{{ $classObj->getTaskInitiatorName($task->tInitiator) }}
                  {{ $task->tInitiatorAdditional }}
               </td>
               <td>{{ dateConverter($task->tCreateTime, 'date') }}</td>
               <td>
                  @if(isset($task->tSiteLink))
                  <a class='task-link-active' href="{{$task->tSiteLink}}" target="_blank">
                     {{ $task->tSitePath }}
                     <img src="{{asset('images/icons/external-link.svg')}}" alt="" />
                  </a>
                  @else
                  {{ $task->tSitePath }}
                  @endif
               </td>
               <td>
                  <div class="task-date-created">{{ dateConverter($task->created_at, 'date') }}</div>
                  <div class="time-date-created">{{ dateConverter($task->created_at, 'time') }}</div>
               </td>
               @can('status', App\Models\Task::class)
               <td>{!! App\Http\Controllers\TaskController::showStatusTask($task->tStatus, $task->tAcceptChief, $task->tExecutor, $task->tCancelInitiator) !!}</td>
               @endcan
               <td>
                  <div class="group__action">
                     <form method="POST" class="task_accept_form" name="taskAcceptForm" action="{{ route('tasks.update', $task) }}">
                        @csrf
                        @method('PUT')
                        <input name="taskAcceptSend" value="1" type="hidden">
                        <a class="task__action-accept" href="" onclick="this.closest('.task_accept_form').submit();return false;" title="Підтвердити"><img src="{{ asset('images/icons/accept_task.svg') }}" alt="Підтвердити"></a>
                     </form>
                     <form method="POST" class="task_decline_form" name="taskAcceptForm" action="{{ route('tasks.update', $task) }}">
                        @csrf
                        @method('PUT')
                        <input name="taskDeclineSend" value="1" type="hidden">
                        <a class="task__action-canel" href="" onclick="this.closest('.task_decline_form').submit();return false;" title="Відмінити"><img src="{{ asset('images/icons/close_task.svg') }}" alt="Відмінити"></a>
                     </form>
                     <a class="task__action-view" href="{{ route('tasks.show', $task) }}" title="Переглянути"><img src="{{ asset('images/icons/task_view.svg') }}" alt="Переглянути"></a>
                  </div>
               </td>
            </tr>
            @endforeach
         </tbody>
      </table>
   </div>
   @endcan


   <div class='tasks__table'>
      <table id="task-table-actual">
         <thead>
            <tr>
               <th></th>
               <th>№ Заявки</th>
               <th>Назва</th>
               <th>Ініціатори</th>
               <th>Дата розміщення</th>
               <th>Місце розміщення</th>
               <th>Створено</th>
               @can('status', App\Models\Task::class)
               <th>Статус</th>
               @endcan
               <th></th>
            </tr>
         </thead>
         <tbody>
            @foreach ($activeAllTasks as $key => $task)
            <tr>
               <td>{{ ++$key }}</td>
               <td>{{ $task->tNumber }}</td>
               <td>{{ $task->tSignName }}</td>
               <td>{{ $classObj->getTaskInitiatorName($task->tInitiator) }}
                  {{ $task->tInitiatorAdditional }}
               </td>
               <td>{{ dateConverter($task->tCreateTime, 'date') }}</td>
               <td>
                  @if(isset($task->tSiteLink))
                  <a class='task-link-active' href="{{$task->tSiteLink}}" target="_blank">
                     {{ $task->tSitePath }}
                     <img src="{{asset('images/icons/external-link.svg')}}" alt="" />
                  </a>
                  @else
                  {{ $task->tSitePath }}
                  @endif
               </td>
               <td>
                  <div class="task-date-created">{{ dateConverter($task->created_at, 'date') }}</div>
                  <div class="time-date-created">{{ dateConverter($task->created_at, 'time') }}</div>
               </td>
               @can('status', App\Models\Task::class)
               <td>{!! App\Http\Controllers\TaskController::showStatusTask($task->tStatus, $task->tAcceptChief, $task->tExecutor, $task->tCancelInitiator) !!}</td>
               @endcan
               <td>
                  <div class="group__action">
                     @can('perform', App\Models\Task::class)
                     @if(is_null($task->tExecutor))
                     <form method="POST" class="task_accept_form_executor" name="taskAcceptForm" action="{{ route('tasks.update', $task) }}">
                        @csrf
                        @method('PUT')
                        <input name="taskTakeWork" value="1" type="hidden">
                        <a class="task__action-canel" href="" onclick="this.closest('.task_accept_form_executor').submit();return false;" title="Виконати"><img src="{{ asset('images/icons/accept_task.svg') }}" alt="Виконати"></a>
                     </form>
                     @endif
                     @endcan
                     @can('cancel', App\Models\Task::class)
                     @if(is_null($task->tCancelInitiator) xor (int)$task->tStatus === 0 && !is_null($task->tExecutor))
                     <form method="POST" class="task_decline_form_executor" name="taskAcceptForm" action="{{ route('tasks.update', $task) }}">
                        @csrf
                        @method('PUT')
                        <input name="taskDeclineSend" value="1" type="hidden">
                        <a class="task__action-canel" href="" onclick="this.closest('.task_decline_form_executor').submit();return false;" title="Відмінити"><img src="{{ asset('images/icons/close_task.svg') }}" alt="Відмінити"></a>
                     </form>
                     @endif
                     @endcan
                     <a class="task__action-view" href="{{ route('tasks.show', $task) }}" title="Переглянути"><img src="{{ asset('images/icons/task_view.svg') }}" alt="Переглянути"></a>
                  </div>
               </td>
            </tr>
            @endforeach
         </tbody>
      </table>
   </div>


   @can ('history', App\Models\Task::class)
   <div class='tasks__table'>
      <table id="task-table-history">
         <thead>
            <tr>
               <th></th>
               <th>№ Заявки</th>
               <th>Назва</th>
               <th>Ініціатори</th>
               <th>Дата розміщення</th>
               <th>Місце розміщення</th>
               <th>Створено</th>
               @can('status', App\Models\Task::class)
               <th>Статус</th>
               @endcan
               <th></th>
            </tr>
         </thead>
         <tbody>
            @foreach ($historyTask as $key => $task)
            <tr>
               <td>{{ ++$key }}</td>
               <td>
                  @if(isset($task->tLink))
                  <a class="task-download" href="{{ $task->tLink }}">{{ $task->tNumber }} <img src="{{ asset('images/icons/download.svg') }}" alt="Завантажити"></a>
                  @else
                  {{ $task->tNumber }}
                  @endif
               </td>
               <td>{{ $task->tSignName }}</td>
               <td>{{ $classObj->getTaskInitiatorName($task->tInitiator) }}
                  {{ $task->tInitiatorAdditional }}
               </td>
               <td>{{ dateConverter($task->tCreateTime, 'date') }}</td>
               <td>
                  @if(isset($task->tSiteLink))
                  <a class='task-link-active' href="{{$task->tSiteLink}}" target="_blank">
                     {{ $task->tSitePath }}
                     <img src="{{asset('images/icons/external-link.svg')}}" alt="" />
                  </a>
                  @else
                  {{ $task->tSitePath }}
                  @endif
               </td>
               <td>
                  <div class="task-date-created">{{ dateConverter($task->created_at, 'date') }}</div>
                  <div class="time-date-created">{{ dateConverter($task->created_at, 'time') }}</div>
               </td>
               @can('status', App\Models\Task::class)
               <td>{!! App\Http\Controllers\TaskController::showStatusTask($task->tStatus, $task->tAcceptChief, $task->tExecutor, $task->tCancelInitiator) !!}</td>
               @endcan
               <td>
                  <div class="group__action">
                     <a class="task__action-view" href="{{ route('tasks.show', $task) }}" title="Переглянути"><img src="{{ asset('images/icons/task_view.svg') }}" alt="Переглянути"></a>
                  </div>
               </td>
            </tr>
            @endforeach
         </tbody>
      </table>
   </div>
   @endcan
</div>
@endsection