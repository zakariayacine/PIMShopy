<?php

namespace App\Jobs;

use App\Models\Image;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class TinypngJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
    public $originalName;
    public $path;
    public $key;
    public $userId;
    
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($path,$originalName,$key,$userId)
    {
        $this->path = $path;
        $this->originalName = $originalName;
        $this->key = $key;
        $this->userId = $userId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        \Tinify\setKey($this->key);
            $source = \Tinify\fromFile(public_path($this->path))
                ->resize(array(
                    "method" => "thumb",
                    "width" => 400,
                    "height" => 400
                ));
            $url = 'converted/'.$this->originalName;
            $source->toFile(public_path($url));
            $file = file_get_contents(public_path($url));
            Storage::cloud()->put($this->originalName , $file);
            $driveurl = Storage::cloud()->url($this->originalName);
            $image = new Image();
            $image->user_id = $this->userId;
            $image->localUrl =  $url;
            $image->cloudUrl =  $driveurl;
            $image->save();
    }
}
