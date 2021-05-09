<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    protected $table = 'todo'; //table name is ems_entries
    protected $primaryKey = 'id';
    protected $fillable = ['task','description','complete_by'];

}
