<?php
namespace App\Http\Controllers;
use App\Models\Event;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
class RegistrationController extends Controller {
    public function store(Request $request, Event $event){
        DB::transaction(function() use($request,$event){
            $locked=Event::whereKey($event->id)->lockForUpdate()->firstOrFail();
            if(Registration::where('user_id',$request->user()->id)->where('event_id',$locked->id)->exists()) throw ValidationException::withMessages(['registration'=>'You are already registered for this event.']);
            if($locked->registrations()->count()>=$locked->capacity) throw ValidationException::withMessages(['registration'=>'This event is full.']);
            Registration::create(['user_id'=>$request->user()->id,'event_id'=>$locked->id,'status'=>'confirmed']);
        });
        return back()->with('success','Registration confirmed.');
    }
}
