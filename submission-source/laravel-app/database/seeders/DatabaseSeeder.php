<?php
namespace Database\Seeders;
use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class DatabaseSeeder extends Seeder { public function run():void {
    User::create(['name'=>'System Administrator','email'=>'admin@unievent.test','password'=>Hash::make('admin123'),'role'=>'admin']);
    User::create(['name'=>'Demo Student','email'=>'student@unievent.test','password'=>Hash::make('student123'),'role'=>'student']);
    Event::insert([
      ['title'=>'AI & Future Careers','category'=>'Seminar','description'=>'Career-focused AI seminar.','event_date'=>'2026-08-18','event_time'=>'10:30:00','venue'=>'Lecture Gallery 01','capacity'=>180,'created_at'=>now(),'updated_at'=>now()],
      ['title'=>'Inter-University Hackathon','category'=>'Competition','description'=>'A full-day team programming challenge.','event_date'=>'2026-08-23','event_time'=>'09:00:00','venue'=>'Innovation Lab','capacity'=>120,'created_at'=>now(),'updated_at'=>now()],
      ['title'=>'Tech Career Fair 2026','category'=>'Career','description'=>'Meet technology employers and alumni.','event_date'=>'2026-08-29','event_time'=>'11:00:00','venue'=>'University Auditorium','capacity'=>300,'created_at'=>now(),'updated_at'=>now()]
    ]);
} }
