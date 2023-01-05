<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;

class FileController extends Controller
{
    // Set files
    private function setFileInfo($file, $path) {
        // Set file name
        $filterFile = explode(".", basename($file));
        $readableName = $filterFile[1] . "." . $filterFile[2];
        // Set file path
        $filePath = $path;
        // Set file size
        $fileSize = round(filesize($path . "/" . basename($file)));
        $editedFileSize = "";
        if ($fileSize <= 1024.4 * 1000) {
            $editedFileSize = round($fileSize / 1024.4) . " " . "KB";
        }
        if ($fileSize <= (1024.4 * 1000) * 1000 && $fileSize > 1024.4 * 1000) {
            $editedFileSize = round($fileSize / 1024.4 / 1024.4) . " " . "MB";
        }
        if ($fileSize > (1024.4 * 1000) * 1000) {
            $editedFileSize = round($fileSize / 1024.4 / 1024.4 / 1024.4) . " " . "GB";
        }
        // Set file extension
        $filterFileExtension = explode(".", basename($file));
        $fileExtension = $filterFileExtension[2];
        
        // Check if the file entry has already been created
        $fileRecord = File::where('name', "=", $readableName)->first();

        if ($fileRecord === null) {
            File::create([
                "realName" => basename($file),
                "name" => $readableName,
                "location" => $filePath,
                "size" => $editedFileSize,
                "format" => $fileExtension,
            ]);
        }
    }

    // Route to confirmation page
    public function toConfirmation() {
        return view('confirmation');
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
            return redirect("/confirmation")->with('createSuccess', 'Folder created successfully and file uploaded
            to the same path.');
        } else {
            return redirect("/confirmation")->with('createError', 'The folder already exists!');
        }
    }

    // Upload file after folder creation
    private function fileUpload($file, $path) {
        //Storage::disk('files')->put($path, $file);
        $file->storeAs($path, md5_file($file->getRealPath()) . "." . $file->getClientOriginalName(), 'files');
    }

    // Stand alone upload file
    public function uploadFile(Request $request) {
        if ($request->input('subfolderPath') == 'choose' && $request->input('folderPath') != 'choose') {
            $path = $request->input('folderPath');
        } 
        else if ($request->input('subfolderPath') != 'choose' && $request->input('folderPath') != 'choose') {
            $path = $request->input('folderPath') . "/" . $request->input('subfolderPath');
        }
        else if ($request->input('folderPath') == 'choose') {
            $path = "";
        }

        if (!file_exists($path)) {
            $file = $request->file('file');
            $file->storeAs($path, md5_file($file->getRealPath()) . "." . $file->getClientOriginalName(), 'files');
            return redirect("/confirmation")->with('uploadSuccess', 'File uploaded successfully.');
        } else {
            return redirect("/confirmation")->with('uploadError', 'The file already exists!');
        }
    }
}
