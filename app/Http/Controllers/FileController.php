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

            if (empty($subFolderList)) {
                return Response()->json('nope');
            } else {
                return Response()->json($subFolderList);
            }
        } else {
            return Response()->json('nope');
        }
    } 

    // Create new folder
    public function createFolder(Request $request) {
        if ($request->input('subfolderPath') == 'choose' && $request->input('folderPath') != 'choose') {
            $path = "assets/files/" . $request->input('folderPath') .
            "/" . $request->input('folderName');
            $simplePath = $request->input('folderPath') .
            "/" . $request->input('folderName');
        } 
        else if ($request->input('subfolderPath') != 'choose' && $request->input('folderPath') != 'choose') {
            $path = "assets/files/" . $request->input('folderPath') .
            "/" . $request->input('subfolderPath') . "/" . $request->input('folderName');
            $simplePath = $request->input('folderPath') .
            "/" . $request->input('subfolderPath') . "/" . $request->input('folderName');
        }
        else if ($request->input('folderPath') == 'choose') {
            $path = "assets/files/" . $request->input('folderName');
            $simplePath = $request->input('folderName');
        }

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
            $this->fileUpload($request->file('file'), $simplePath);
            return view('confirmation')->with('success', 'Folder created successfully and file uploaded
            to the same path.');
        } else {
            return view('confirmation')->with('createError', 'The folder already exists!');
        }
    }

    // Upload file after folder creation
    private function fileUpload($file, $path) {
        Storage::disk('files')->put($path, $file);
    }

    // Stand alone upload file
    public function uploadFile(Request $request) {

    }
}
