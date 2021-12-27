<?php

namespace App\Jobs;

use Spatie\Image\Image;
use Illuminate\Bus\Queueable;
use Spatie\Image\Manipulations;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class ResizeImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     * 
     */
    private $path, $fileName ,$w, $h;

     public function __construct($filePath, $w, $h)
    {
        $this->path = dirName($filePath);
        $this->fileName = baseName($filePath);
        $this->w = $w;
        $this->h = $h;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $w = $this-> w;
        $h = $this-> h;
        $srcPath = storage_path().'/app/'.$this->path.'/'.$this->fileName;
        $destPath = storage_path().'/app/'.$this->path."/crop{$w}x{$h}_".$this->fileName;
        Image::load($srcPath)->watermark(base_path('resources/img/logopresto.png'))->watermarkPosition(Manipulations::POSITION_BOTTOM_RIGHT)->watermarkPadding(5, 10, Manipulations::UNIT_PERCENT)->watermarkOpacity(50)->crop(Manipulations::CROP_CENTER, $w, $h)->save($destPath);
    }
}
