<?php

namespace App\Http\Controllers;

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
                $folderOpen = scandir($path . "/" . basename($folder));
                foreach ($folderOpen as $subfolder) {
                    if (is_dir($path . "/" . basename($folder) . "/" . basename($subfolder)) 
                    && basename($subfolder) != '.' && basename($subfolder) != '..') {
                        $hasSubDir = true;
                        array_push($subFolderNameList, basename($subfolder));
                    }
                }
            }
        }

        return view('main', [
            "folders" => $folderNameList,
            "subfolders" => $subFolderNameList,
            "isSub" => $hasSubDir
        ]);
    }

    // Create new folder
    public function createFolder(Request $request) {
        dd($request);
    }
}
