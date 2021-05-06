<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use App\Http\Controllers\FileController;
use App\Http\Controllers\PDFController;
use App\Http\Requests\Task\CreateTaskRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;


class TaskController extends Controller
{

    /**
     * index
     *
     * @return void
     */
    public function index(Request $request)
    {
        if ($request->user()->cannot('viewAny', Task::class)) {
            abort(403, 'Unauthorized');
        }

        return view('userArea.tasks.tasks', [
            'forAcceptTasks' => $this->getForAcceptTasks(),
            'activeAllTasks' => $this->getActiveAllTask(),
            'historyTask' => $this->getHistoryAllTask(),
            'classObj' => $this,
            'title' => 'Заявки на роботу'
        ]);
    }

    /**
     * create
     *
     * @return void
     */
    public function create(Request $request)
    {
        if ($request->user()->cannot('create', Task::class)) {
            abort(403, 'Unauthorized');
        }

        return view('userArea.tasks.createTask', [
            'taskNumber' => $this->createUnicNoTask(),
            'currentTaskInitiator' => $this->getCurrentUser(),
            'todayDate' => todayDateTask(),
            'futureDate' => futureDateTask(),
            'classObj' => $this,
            'title' => 'Створити заявку'
        ]);
    }

    /**
     * store
     *
     * @return void
     */
    public function store(CreateTaskRequest $request, FileController $fileController)
    {

        $newTask = Task::create([
            'tNumber' => $request->taskNumber,
            'tSignName' => $request->taskMaterial,
            'tStatus' => 0,
            'tCreateTime' => $request->taskDateMaterial,
            'tInitiator' => Auth::id(),
            'tInitiatorAdditional' => $request->taskInitiatorAdditional,
            'tDescription' => $request->taskDescriptionField,
            'tPage' => $request->taskPage,
            'tSitePath' => $request->taskMenu,
            'tSiteLink' => $request->taskMenuLink,
        ]);
        Storage::makeDirectory('/tasks/' . Auth::user()->uLogin . '/' . $request->taskNumber);
        if ($request->hasFile('taskFileUpload')) {
            foreach ($request->file('taskFileUpload') as $file) {
                $fileController->saveTaskFiles($file, $request->taskNumber, $newTask->idTask);
            }
        }
        return  redirect(route('tasks'));
    }

    /**
     * show
     * @return void
     */
    public function show(Task $task, FileController $fileController)
    {
        if (Gate::denies('view-all-tasks', Task::class) and (int)$task->tInitiator !== Auth::id()) {
            abort(403, 'Unauthorized');
        } 
        
        return view('userArea.tasks.showTask', [
            'title' => 'Заявка №' . $task->tNumber,
            'task' => $task,
            'todayDate' => todayDateTask(),
            'classObj' => $this,
            'classFileObj' => $fileController,
        ]);
    }

    /**
     * update
     *
     * @return void
     */
    public function update(Request $request, Task $task)
    {
        if ($request->taskAcceptSend) {
            $task->tAcceptChief = Auth::id();
            $task->tChiefAcceptTime = date("Y-m-d H:i:s");
        }
        if ($request->taskDeclineSend) {
            $task->tStatus = 1;
            $task->tCancelInitiator = Auth::id();
            $task->tCancelTime =  date("Y-m-d H:i:s");
        }
        if ($request->taskTakeWork) {
            $task->tExecutor = Auth::id();
            $task->tExecutorGetDate =  date("Y-m-d H:i:s");
        }
        if ($request->taskEndSend) {
            $task->tCloseTime = date("Y-m-d H:i:s");
            $task->tStatus = 1;
            $task->tWorkTime = self::getWorkTime($task->tExecutorGetDate, $task->tCloseTime);
            $task->tLink = (new PDFController())->PDFConstructor($task);
        }
        $task->save();

        return redirect(route('tasks'));
    }




    public static function getWorkTime($startWork, $endWork)
    {
        $startWork = new \DateTime($startWork);
        $endWork = new \DateTime($endWork);
        $interval = $endWork->diff($startWork);
        return $interval->i;
    }

    public function getUserName(int $id)
    {
        return User::find($id)->uName;
    }

    public function getDepartmentName(int $idUser)
    {
        return User::find($idUser)->department->dTitle;
    }

    private function getForAcceptTasks()
    {
        if (Gate::denies('view-all-tasks', Task::class)) {
            return Task::all()->where('tStatus', '0')->whereNull('tAcceptChief')->where('tInitiator', Auth::id());
        }
        return Task::all()->where('tStatus', '0')->whereNull('tAcceptChief');
    }

    private function getActiveAllTask()
    {
       if (Gate::allows('execute-tasks', Task::class)) {
            return Task::all()->where('tStatus', '0')
                ->whereNotNull('tInitiator')
                ->whereNotNull('tAcceptChief')
                ->whereNull('tCancelInitiator');
        }
        if (Gate::denies('view-all-tasks', Task::class)) {
            return Task::all()->where('tStatus', '0')->where('tInitiator', Auth::id());
        }

        return Task::all()->where('tStatus', '0')->whereNotNull('tAcceptChief');
    }

    private function getHistoryAllTask()
    {
        if (Gate::allows('execute-tasks', Task::class)) {
            return Task::all()->where('tStatus', '1')->where('tExecutor', Auth::id());
        }
        if (Gate::denies('view-all-tasks', Task::class)) {
            return Task::all()->where('tStatus', '1')->where('tInitiator', Auth::id());
        }
        return Task::all()->where('tStatus', '1');
    }


    public static function showStatusTask($taskStatus = null, $chiefId = null, $executorId = null, $cancelId = null): string
    {
        $html = '<div class="tasks-table-status">';
        if ((int)$taskStatus === 0) {
            $html .= '<span class="task_status__open">Відкрита</span>';
        }
        if (is_null($chiefId)) {
            $html .= '<span class="task_status__wait">Очікує підтвердження</span>';
        }
        if (!is_null($chiefId)) {
            $html .= '<span class="task_status__accept">Підтверджена</span>';
        }
        if (!is_null($executorId)) {
            $html .= '<span class="task_status__inwork">В роботі</span>';
        }
        if ((int)$taskStatus === 1 && !is_null($cancelId)) {
            $html = '<div class="tasks-table-status">
            <span class="task_status__cancel">Відмінена</span>
            </div>';
        }
        if ((int)$taskStatus === 1 && is_null($cancelId)) {
            $html = '<div class="tasks-table-status">
            <span class="task_status__done">Виконана</span>
            </div>';
        }
        $html .= '</div>';
        return $html;
    }



    private function createUnicNoTask(): string
    {
        $digits = (string) time();
        $randomString = '';
        for ($i = 0; $i < 7; $i++) {
            $randomString .= $digits[mt_rand(0, strlen($digits) - 1)];
        }
        return substr($digits - $randomString * strlen($digits) - 1, 3) . Auth::id();
    }

    private function getCurrentUser()
    {
        return User::find(Auth::id())->uName;
    }
    public function getTaskInitiatorName(int $initiatorId)
    {
        return User::find($initiatorId)->uName;
    }
}
