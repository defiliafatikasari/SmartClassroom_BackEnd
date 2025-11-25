<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = ['module_id', 'title', 'questions_json'];

    protected $casts = [
        'questions_json' => 'array',
    ];

    // Relationships
    public function module()
    {
        return $this->belongsTo(Module::class);
    }
}
