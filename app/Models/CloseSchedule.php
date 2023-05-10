<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CloseSchedule extends Model
{
    use HasFactory;

    protected $guarded = [
        "id",
    ];

    public function expired() {
        $now = time();
        return $now > strtotime($this->end);
    }

    public static function nearests() {
        $closed_schedules = static::all();
        return $closed_schedules->filter(function($schedule){
            return !$schedule->expired();
        });
    }

    public static function nearest() {
        $closed_schedules = static::all()->filter(function($schedule){
            return !$schedule->expired();
        });
        return $closed_schedules->count() > 0 ? $closed_schedules->first() : null;
    }

    public function clash_with(string $start, string $end) {
        return $start >= $this->start && $end <= $this->end;
    }
}
