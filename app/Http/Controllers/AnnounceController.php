<?php

namespace App\Http\Controllers;

use App\Models\Announce;
use App\Models\Category;
use App\Jobs\ResizeImage;
use Illuminate\Http\Request;
use App\Models\AnnounceImage;
use App\Jobs\AddWatermarkImage;
use App\Jobs\GoogleVisionLabelImage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Jobs\GoogleVisionRemoveFaces;
use Illuminate\Support\Facades\Redis;
use App\Http\Requests\AnnounceRequest;
use Illuminate\Support\Facades\Storage;
use App\Jobs\GoogleVisionSafeSearchImage;

class AnnounceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth')->except('show');
    }
    public function index()
    {
        //
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $req)
    {
        $uniqueSecret = $req->old('uniqueSecret',base_convert(sha1(uniqid(mt_rand())), 16, 36));
        $categories=Category::all();
        return view('announce.create',compact('categories', 'uniqueSecret'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AnnounceRequest $req)
    {
        $announce=Announce::create([
            'name'=>$req->name,
            'description'=>$req->description,
            'price'=>$req->price,
            'user_id'=>Auth::user()->id,
            'category_id'=>$req->category_id
        ]);
        $uniqueSecret = $req->uniqueSecret;
        $images=session()->get("images.{$uniqueSecret}",[]);
        $removedImages=session()->get("removedImages.{$uniqueSecret}",[]);
        $images=array_diff($images, $removedImages);
        foreach($images as $image){

            $i=new AnnounceImage();
            $fileName=basename($image);
            $newFileName="public/announces/{$announce->id}/{$fileName}";
            Storage::move($image,$newFileName);
            $i->file=$newFileName;
            $i->announce_id=$announce->id;
        
            $i->save();

            GoogleVisionSafeSearchImage::withChain([
                new GoogleVisionLabelImage($i->id),
                new GoogleVisionRemoveFaces($i->id),
                new ResizeImage($i->file, 300,150),
                new ResizeImage($i->file,400,300)
            ])->dispatch($i->id);

        }
        File::deleteDirectory(storage_path("/app/public/temp/{$uniqueSecret}"));
        return redirect(route('homepage'))->with('message','Hai inserito correttamente l\'annuncio , verrà revisionato appena possibile');
    }
    public function getImages(Request $req){
        $uniqueSecret=$req->uniqueSecret;
        $images=session()->get("images.{$uniqueSecret}",[]);
        $removedImages=session()->get("removedImages.{$uniqueSecret}",[]);
        $data=[];
        foreach($images as $image){
            $data[]=[
                'id'=>$image,
                'src'=>AnnounceImage::getUrlByFilePath($image, 120 , 120)
            ];
        }
        return response()->json($data);
    }

    public function uploadImages(Request $req){
        $uniqueSecret = $req->uniqueSecret;

        $fileName = $req->file->store("public/temp/{$uniqueSecret}");
        dispatch(new ResizeImage($fileName,
       120,
       120
        ));
        session()->push("images.{$uniqueSecret}", $fileName);
           
        return response()->json(
            [
                'id'=>$fileName
            ]
        );
    }
    
    public function removeImages(Request $req){
        $uniqueSecret=$req->uniqueSecret;
        $fileName=$req->id;
        session()->push("removedImages.{$uniqueSecret}",$fileName);
        Storage::delete($fileName);
        return response()->json('ok');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Announce  $announce
     * @return \Illuminate\Http\Response
     */
    public function show(Announce $announce)
    {
        return view('announce.detail',compact('announce'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Announce  $announce
     * @return \Illuminate\Http\Response
     */
    public function edit(Announce $announce)
    {
        $categories=Category::all();
        return view('announce.edit',compact('announce','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Announce  $announce
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, Announce $announce)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Announce  $announce
     * @return \Illuminate\Http\Response
     */
    public function destroy(Announce $announce)
    {  
        $announce->announceimages()->delete();
        $announce->delete();

        return redirect(route('homepage'))->with('message','Hai eliminato correttamente il tuo annuncio!');
    }

}
