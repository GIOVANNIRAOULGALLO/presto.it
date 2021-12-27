<?php

namespace App\Http\Controllers;

use App\Models\Announce;
use Illuminate\Http\Request;

class RevisorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.revisor');
    }
    public function index(){
        $announce = Announce::where('is_accepted', null)->orderBy('created_at', 'DESC')->first();
        return view('revisor.home', compact('announce')); 
    }

    private function setAccepted($announce_id, $value){
        $announce = Announce::find($announce_id);
        $announce->is_accepted = $value;
        $announce->save();
        return redirect(route('revisor.home'));
    }

    public function accept($announce_id){
        return $this->setAccepted($announce_id, true);
    }

    public function reject($announce_id){
        return $this->setAccepted($announce_id, false);
    }

    public function destroy(Announce $announce){
        foreach($announce->announceimages as $image){
            $image->announce()->dissociate();
            $image->announce_id=null;
            $image->save();
        }
       $announce->delete();
        return redirect(route('revisor.home'));
    }
    public function basket(){
        $announce = Announce::where('is_accepted', false)->orderBy('created_at', 'DESC')->first();
        return view('revisor.basket', compact('announce')); 
    }
    public function restore($announce_id){
        return $this->setAccepted($announce_id, null);
    }
}
