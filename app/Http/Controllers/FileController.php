<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;

class FileController extends Controller
{
    // Get folders list
    public function index() {
        $path = 'assets/files';
        $folderNameList = [];
        $subFolderNameList = [];
        $hasSubDir = false;
        $folderList = scandir($path);

        foreach($folderList as $folder) {
            if (basename($folder) != '.' && basename($folder) != '..') {
                array_push($folderNameList, basename($folder));
            }
        }

        return view('main', [
            "folders" => $folderNameList,
        ]);
    }

    // Get sub folders
    public function getSubDir(Request $request) {
        $subFolderList = [];

        if ($request->input('parent') != "choose") {
            $path = "assets/files/" . $request->input('parent');
            $parentDir = scandir($path);

            foreach ($parentDir as $sub) {
                if (basename($sub) != "." && basename($sub) != ".." 
                && is_dir($path . "/" . $sub)) {
                    array_push($subFolderList, basename($sub));
                }
            }

            return Response()->json($subFolderList);
        } else {
            return Response()->json('nope');
        }
    } 

    // Create new folder
    public function createFolder(Request $request) {
        if ($request->input('foldersubPath') == 'choose') {
            $path = "assets/files/" . $request->input('folderPath') .
            "/" . $request->input('folderName');
            $simplePath = $request->input('folderPath') .
            "/" . $request->input('folderName');
        } else {
            $path = "assets/files/" . $request->input('folderPath') .
            "/" . $request->input('foldersubPath') . "/" . $request->input('folderName');
            $simplePath = $request->input('folderPath') .
            "/" . $request->input('foldersubPath') . "/" . $request->input('folderName');
        }
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
            $this->fileUpload($request->file('file'), $simplePath);
            return view('confirmation');
        } else {
            return view('confirmation');
        }
    }

    // Upload file after folder creation
    private function fileUpload($file, $path) {
        $file->name('test');
        Storage::disk('files')->put($path, $file);
    }

    // Stand alone upload file
    public function uploadFile(Request $request) {

    }
}
