<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

/**
 * 
 */
trait fileTrait
{
    
    public function fileCheck($file)
    {
        return Storage::disk('s3')->has($file);
    }

    public function fileUrl($file)
    {
        return Storage::disk('s3')->url($file);
    }

    public function getMime($file)
    {
        return Storage::disk('s3')->getDriver()->getMimetype($file);
    }

    public function getSize($file)
    {
        return Storage::disk('s3')->getDriver()->getSize($file);
    }



       
}