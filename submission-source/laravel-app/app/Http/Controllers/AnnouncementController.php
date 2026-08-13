<?php
namespace App\Http\Controllers;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
class AnnouncementController extends Controller {
    public function store(Request $request){
        $data=$request->validate(['event_id'=>'required|exists:events,id','message'=>'required|max:300']);
        $announcement=Announcement::create($data)->load('event');
        Http::withHeaders(['X-Broadcast-Key'=>config('services.notification.key')])->post(config('services.notification.url').'/broadcast',['id'=>$announcement->id,'event'=>$announcement->event->title,'message'=>$announcement->message,'sent_at'=>now()->toISOString()]);
        return back()->with('success','Announcement saved and broadcast in real time.');
    }
}
