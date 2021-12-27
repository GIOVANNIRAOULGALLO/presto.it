<?php

namespace App\Models;

use App\Models\User;
use App\Models\Category;
use App\Models\AnnounceImage;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Announce extends Model
{
    use Searchable;
    use HasFactory;


    protected $fillable=[
        'name',
        'description',
        'price',
        'user_id',
        'category_id'
    ];

    public function toSearchableArray(){
        $array =[
            'id'=>$this->id,
            'name'=>$this->name,
            'description'=>$this->description,
            'category'=>$this->category->name,
            'altro'=>'annunci annuncio'
        ];
        return $array;
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function announceimages(){
        return $this->hasMany(AnnounceImage::class);
    }

    static public function ToBeRevisionedCount(){
        return Announce::where('is_accepted', null)->count();
    }

}
    

