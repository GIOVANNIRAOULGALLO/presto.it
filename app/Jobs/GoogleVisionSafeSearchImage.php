<?php

namespace App\Jobs;

use App\Models\Announce;
use App\Models\AnnounceImage;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Google\Cloud\Vision\V1\ImageAnnotatorClient;

class GoogleVisionSafeSearchImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $announce_image_id;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($announce_image_id)
    {
        $this->announce_image_id=$announce_image_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $i=AnnounceImage::find($this->announce_image_id);
        if(!$i){
            return;
        }
        $image=file_get_contents(storage_path('/app/' . $i->file));
        putenv('GOOGLE_APPLICATION_CREDENTIALS=' . base_path('google_credential.json'));
        
        $imageAnnotator=new ImageAnnotatorClient();
        $response=$imageAnnotator->safeSearchDetection($image);
        $imageAnnotator->close();
        $safe=$response->getSafeSearchAnnotation();
        $adult=$safe->getAdult();
        $medical=$safe->getMedical();
        $spoof=$safe->getSpoof();
        $violence=$safe->getViolence();
        $racy=$safe->getRacy();
        //echo json_encode([$adult,$medical,$spoof,$violence,$racy]);
        $likelihoodName=['UNKNOWN','VERY_UNLIKELY','POSSIBLE','LIKELY','VERY_LIKELY'];
        $i->adult=$likelihoodName[$adult];
        $i->medical=$likelihoodName[$medical];
        $i->spoof=$likelihoodName[$spoof];
        $i->violence=$likelihoodName[$violence];
        $i->racy=$likelihoodName[$racy];
        $i->save();
    }
}
