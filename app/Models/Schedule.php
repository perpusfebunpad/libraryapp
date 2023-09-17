<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $guarded = [
        "id",
    ];

    public function owner() {
        return $this->belongsTo(User::class, "user_id");
    }

    public static function nearests() {
        $schedules = static::all();
        return $schedules->filter(fn($schedule) => !$schedule->expired());
    }

    public static function get_user_valid_schedules(int $user_id) {
        return static::where("user_id", $user_id)
            ->orderBy("start", "desc")
            ->get()
            ->filter(fn($schedule) => !($schedule->invalid()));
    }

    public function available() {
        $now = time();
        return $now < strtotime($this->start);
    }

    public function active() {
        $now = time();
        return strtotime($this->start) <= $now && $now <= strtotime($this->end);
    }

    public function expired() {
        $now = time();
        return $now > strtotime($this->end);
    }

    public function closed() {
        foreach(CloseSchedule::nearests() as $nearest_close_schedule) {
            if($nearest_close_schedule != null && $nearest_close_schedule->clash_with($this->start, $this->end)) {
                return true;
            }
        }
        return false;
    }

    public function in_range(int $start, int $end) {
        return $start < strtotime($this->start) && strtotime($this->end) < $end;
    }

    public function invalid() {
        $prev_week = strtotime("previous Sunday"); 
        $next_week = strtotime("next Sunday");
        if(($this->expired() && !$this->in_range($prev_week, $next_week)) || $this->closed())
            return true;
        return false;
    }
}
