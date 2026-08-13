<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Event extends Model {
    use HasFactory;
    protected $fillable=['title','category','description','event_date','event_time','venue','capacity'];
    protected function casts(): array { return ['event_date'=>'date']; }
    public function registrations(){ return $this->hasMany(Registration::class); }
    public function students(){ return $this->belongsToMany(User::class,'registrations')->withTimestamps(); }
    public function announcements(){ return $this->hasMany(Announcement::class); }
}
