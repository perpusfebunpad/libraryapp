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

    public function destroyable() {
        return strtotime("previous Sunday") > strtotime($this->start);
    }
}
