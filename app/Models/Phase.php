<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phase extends Model
{
    use HasFactory;

    public static string $BACKLOG = 'Backlog';
    public static string $TODO = 'To Do';
    public static string $DOING = 'Doing';
    public static string $DONE = 'Done';
    public static string $ARCHIVED = 'Archived';

    protected $fillable = [
        'name',
    ];

    function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
