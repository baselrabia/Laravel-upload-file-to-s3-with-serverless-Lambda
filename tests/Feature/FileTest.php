<?php

namespace Tests\Feature;

use App\Traits\fileTrait;
use Illuminate\Foundation\Testing\RefreshDatabase;
 use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;

class FileTest extends TestCase
{ 
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_file_can_upload()
    {
        $this->withoutExceptionHandling();

        Storage::fake('s3');

 
 
        $this->post(route('uploadfile', [ 
            'file' =>
            UploadedFile::fake()->image('photo.jpeg'),
        ]));

        // $this->assertTrue( );

        Storage::disk('s3')->assertExists('photo.jpeg');
    }
}
