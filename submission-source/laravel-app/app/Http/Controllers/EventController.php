<?php
namespace App\Http\Controllers;
use App\Models\Announcement;
use App\Models\Event;
use Illuminate\Http\Request;
class EventController extends Controller {
    public function index(Request $request){
        $events=Event::query()->withCount('registrations')->when($request->q,fn($q,$term)=>$q->where(fn($inner)=>$inner->where('title','like',"%$term%")->orWhere('venue','like',"%$term%")))->orderBy('event_date')->get();
        $latestAnnouncement=Announcement::latest()->with('event')->first();
        return view('home',compact('events','latestAnnouncement'));
    }
    public function store(Request $request){ Event::create($this->validated($request)); return back()->with('success','Event created successfully.'); }
    public function update(Request $request, Event $event){ $event->update($this->validated($request)); return back()->with('success','Event updated successfully.'); }
    public function destroy(Event $event){ $event->delete(); return back()->with('success','Event deleted.'); }
    private function validated(Request $request): array { return $request->validate(['title'=>'required|max:150','category'=>'required|max:50','description'=>'nullable|max:1000','event_date'=>'required|date','event_time'=>'required','venue'=>'required|max:150','capacity'=>'required|integer|min:1|max:5000']); }
}
