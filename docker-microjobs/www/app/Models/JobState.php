<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class JobState extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $guarded = ['id'];

    public function jobs() {
        return $this->hasMany(Job::class);
    }
}
