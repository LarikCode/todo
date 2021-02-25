<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'completed', 'position'];

    /**
     * Get the todoList that owns the todo.
     */
    public function todoList()
    {
        return $this->belongsTo(TodoList::class);
    }
}
