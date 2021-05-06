<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        return view('userArea.dashboard', [
            'title' => 'Статистика',
            'taskStatisticDashboard' => $this->getTaskUserStatistic(new User),
        ]);
    }

    public function getTaskUserStatistic($user)
    {
        $task = $user->find(Auth::id())->tasks->groupBy('tCreateTime');
        return json_encode($task->all());
    }
}
