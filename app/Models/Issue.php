<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Issue
 *
 * @property integer $id
 * @property integer $assigned_to
 * @property string $title
 * @property string $question
 * @property integer $user_id
 * @property integer $status
 * @property integer $priority
 * @property integer $project_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\Project $project
 * @property-read \App\Models\User $user
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\File[] $files
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Comment[] $comments
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Issue whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Issue whereAssignedTo($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Issue whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Issue whereQuestion($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Issue whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Issue whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Issue wherePriority($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Issue whereProjectId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Issue whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Issue whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
