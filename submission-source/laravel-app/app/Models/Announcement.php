<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Announcement extends Model {
    protected $fillable=['event_id','message'];
    public function event(){ return $this->belongsTo(Event::class); }
}
