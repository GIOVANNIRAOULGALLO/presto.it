<?php

namespace App\Http\Controllers;

use App\Models\Announce;
use App\Models\Category;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index (){
        $announces=Announce::where('is_accepted',true)->take(5)->orderBy('id','DESC')->get();
        $categories=Category::all();
        return view('welcome',compact('announces','categories'));
    }

    public function announcesByCategory($name, $category_id){
        $category = Category::find($category_id);
        $announces = Announce::where('category_id', $category_id)->where('is_accepted',true)->orderBy('id','DESC')->paginate(5);
        return view('announce.categories', compact('category','announces'));

    }

    public function search(Request $req){
        $q = $req->q;
        $announces = Announce::search($q)->where('is_accepted',true)->get();
        return view('search.result', compact('q', 'announces'));
    }

    public function locale($locale){
        session()->put('locale', $locale);
        return redirect()->back();
    }
}