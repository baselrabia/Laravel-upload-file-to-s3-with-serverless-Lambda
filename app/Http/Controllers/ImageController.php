<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreImage;
use Exception;

class ImageController extends Controller
{
    private $image;
    public function __construct(Image $image)
    {
        $this->image = $image;
    }

    public function getImages()
    {

        $images = Storage::disk('s3')->files('images/originals');
        $array =[];
        foreach ($images as $key => $img) {
            $array[$key] =[
                'name' => substr($img, strlen('images/originals/')),
                'url' =>  Storage::disk('s3')->url($img),
                'path' =>   $img,
            ];
        }

        return view('images')->with(['images'=> auth()->user()->images ,'s3array' => $array]);
    }

    public function postUpload(StoreImage $request)
    {
        $request->merge([
            'size' => $request->file->getSize(),
            'name' => $request->file->getClientOriginalName(),
        ]);

        $img= Image::where('name',$request->name)->where('size',$request->size)->first();
        if(!$img){
            $path = Storage::disk('s3')->put('images/originals', $request->file);
            $request->merge(['path' => $path]);
        }else {
            $request->merge(['path' => $img->path]);
        }

        
        $this->image->create($request->only('path', 'title', 'size' , 'name'));
        return back()->with('success', 'Image Successfully Saved');
    }

    public function find()
    {
        return view('find');
    }


    public function findFile(Request $request)
    {
        $field = $request->title;

        $img = Image::where('name', $field)->orWhere('title', $field)->first();
        if (!$img) {
            return back()->with('error', 'Image Can\'t be found');
        }

        try {
            $file_url = $img->path;
            $file_name  = $img->name;; //"VoteMix-Event-Entry-Ticket.pdf";

            $mime = Storage::disk('s3')->getDriver()->getMimetype($file_url);
            $size = Storage::disk('s3')->getDriver()->getSize($file_url);

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
            return back()->with('error', $e->getMessage());

            // return $this->respondInternalError($e->getMessage(), 'object', 500);
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

        $img = Image::where('name', $field)->orWhere('title', $field)->first();
        if (!$img) {
            return back()->with('error', 'Image Can\'t be found');
        }

        $path = $img->path;

        $img->delete();


        if(Storage::disk('s3')->exists($path) && Image::where('path',$path)->count() == 0) {
            Storage::disk('s3')->delete($path);
        }



        return back()->with('success', 'Image Deleted Successfully ');
    }

    public function deleteByPath(Request $request)
    {
        $path = $request->path;
        
        if (Storage::disk('s3')->exists($path) && Image::where('path', $path)->count() == 0) {
            Storage::disk('s3')->delete($path);
            return back()->with('success', 'Image Deleted Successfully ');
        }

        return back()->with('error', 'Image should still be exists Cus Of Dependencies');

    } 
}
