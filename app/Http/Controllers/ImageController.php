<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreImage;
use App\Traits\fileTrait;
use Exception;

class ImageController extends Controller
{
    use fileTrait;


    public function getImages()
    {

        $images = Storage::disk('s3')->files('/images');
         

        // $storage = Storage::disk('s3');
        // $client = $storage->getAdapter()->getClient();
      
        // $result = $client->listObjectsV2([
        //     'Bucket'  => $storage->getAdapter()->getBucket(),
        //     'Prefix'  => 'images/',
        // ]);       
     
 
      
        // $images = $result['Contents'] ?  $result['Contents'] : [];
 
        $array = [];
        foreach ($images as $key => $img) {
        //    $img = $img['Key'];
            $array[$key] = [
                'name' => substr($img, strlen('images/')),
                'url' =>  $this->fileUrl($img),
                'path' =>   $img,

            ];
        }

        return view('images')->with(['s3array' => $array]);
    }

    public function postUpload(Request $request)
    {
        // dd($request->all());
       
        $request->merge([  
            'name' => is_array($request->file) ? $request->file['name'] : $request->file->getClientOriginalName(),
        ]);
 

        if (!$this->fileCheck($request->file,true)) {
        
            $path = Storage::disk('s3')->putFileAs('/images', $request->file, $request->name, 'public');
            return back()->with('success', 'Image Successfully Saved');
        }

        return back()->with('error', 'Image exists before');
    }

    public function find()
    {
        return view('find');
    }


    public function findFile(Request $request)
    {
        $field = $request->title;

        if (!$this->fileCheck($field)) {
            return back()->with('error', 'Image Can\'t be found');
        }

        try {
            $file_url = "images/" . $field;
            $file_name  = $field; //"VoteMix-Event-Entry-Ticket.pdf";

            $mime = $this->getMime($file_url);
            $size = $this->getSize($file_url);

            $response =  [
                'Content-Type' => $mime,
                'Content-Length' => $size,
                'Content-Description' => 'File Transfer',
                'Content-Disposition' => "attachment; filename={$file_name}",
                'Content-Transfer-Encoding' => 'binary',
            ];

            ob_end_clean();

            return \Response::make(Storage::disk('s3')->get($file_url), 200, $response);
        } catch (Exception $e) {
            // return back()->with('error', $e->getMessage());

            return $this->respondInternalError($e->getMessage(), 'object', 500);
        }
        // return back()->with('success', 'Image Successfully Saved');
    }



    public function delete()
    {
        return view('delete');
    }

    public function deleteFile(Request $request)
    {

        $field = $request->title;

        if (!$this->fileCheck($field)) {
            return back()->with('error', 'Image Can\'t be found');
        }

        Storage::disk('s3')->delete("images/".$field);


        return back()->with('success', 'Image Deleted Successfully ');
    }
}
