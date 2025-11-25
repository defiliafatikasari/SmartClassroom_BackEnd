<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    protected $fillable = ['class_id', 'title', 'type', 'content_url'];

    // Relationships
    public function classroom()
    {
        return $this->belongsTo(Classroom::class, 'class_id');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }

    public function progress()
    {
        return $this->hasMany(Progress::class);
    }
}
