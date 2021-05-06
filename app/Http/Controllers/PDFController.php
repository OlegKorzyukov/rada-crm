<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use Mpdf\Mpdf;
use App\Http\Controllers\TaskController;

class PDFController extends Controller
{
    public function PDFConstructor($task)
    {
        $html = (string) view('pdf-construct', [
            'task' => $task,
            'classObj' => new TaskController(),
        ]); //view('pdf-construct')->render();
        $stylesheet = file_get_contents(public_path('/css/pdf-view.css'));
        $tmpDir = ['tempDir' => storage_path('app/public')];
        $userLogin = User::find($task->tInitiator)->uLogin;
        $link = asset('/storage/tasks') . '/' . $userLogin . '/' . $task->tNumber . '/' . $task->tNumber . '_task.pdf';
        $path = public_path('/storage/tasks') . '/' . $userLogin . '/' . $task->tNumber . '/' . $task->tNumber . '_task.pdf';

        $mpdf = new Mpdf($tmpDir);
        $mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
        $mpdf->WriteHTML($html);
        $mpdf->Output($path, \Mpdf\Output\Destination::FILE);

        return $link;
    }
}
