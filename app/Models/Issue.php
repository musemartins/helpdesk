<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    protected $table = 'issue';

    protected $fillable = ['assigned_to', 'title', 'question', 'user_id', 'status', 'priority', 'project_id'];

    public function project()
    {
        return $this->belongsTo('App\Models\Project');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function files()
    {
        return $this->hasMany('App\Models\File');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }
}
