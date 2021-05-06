<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;

use App\Models\File;

use App\Models\Task;

use App\Models\User;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Storage;







class FileController extends Controller

{

    private static $instance;

    public $files = [];



    public function uploadTaskFiles(Request $request)

    {

        return Response()->json([

            "success" => true

        ]);
    }



    public function saveTaskFiles($file, $taskNumber, $taskId)

    {

        $originNameFile = $file->getClientOriginalName();

        $mimeFile = $file->getMimeType();

        $sizeFile = $file->getSize();

        $extensionFile = $file->extension();



        Storage::makeDirectory('/tasks/' . Auth::user()->uLogin . '/' . $taskNumber);

        $saveFile = $file->store('/tasks/' . Auth::user()->uLogin . '/' . $taskNumber);

        $fileNameWithoutExt = pathinfo($saveFile, PATHINFO_FILENAME);

        $fileLink = asset('/storage/' . $saveFile);



        $this->saveTaskFilesToDB($fileNameWithoutExt, $originNameFile, $sizeFile, $mimeFile, $fileLink, $taskId);



        return $fileLink;
    }



    private function saveTaskFilesToDB($name, $originName, $size, $type, $link, $taskId)

    {

        $newUser = File::create([

            'fName' => $name,

            'fOriginName' => cyrillicToLatin($originName),

            'fCreator' => Auth::id(),

            'fTask' =>  $taskId,

            'fSize' => $size,

            'fType' => $type,

            'fLink' => $link

        ]);
    }



    public function getAllFileForTask($idTask)

    {

        return Task::find($idTask)->files;
    }



    public function compressFiles(Request $request)

    {

        if (!preg_match('/([0-9]{8})/', $request->task)) {

            die;
        };

        $noTask  = $request->task;

        $loginByNoTask = Task::firstWhere('tNumber', $noTask)->files;

        $userLogin = User::find($loginByNoTask[0]->fCreator)->uLogin;



        $path = public_path('/storage/tasks/' . $userLogin . '/' . $noTask . '/');

        $zip_name = $noTask . '_files.zip';

        $zipLink = asset('/storage/tasks/' . $userLogin . '/' . $noTask . '/' . $zip_name);



        if (count($loginByNoTask) !== 1) {

            $zip = new \ZipArchive();

            $zip->open($path . $zip_name, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);

            foreach ($loginByNoTask as $key => $file) {

                $zip->addFile($path . $file->fName . '.' . pathinfo($file->fOriginName, PATHINFO_EXTENSION), $file->fOriginName);
            }

            $zip->close();
        } else {

            $zipLink = asset('/storage/tasks/' . $userLogin . '/' . $noTask . '/' . $loginByNoTask[0]->fName . '.' . pathinfo($loginByNoTask[0]->fOriginName, PATHINFO_EXTENSION));
        }

        return $zipLink;
    }
}
