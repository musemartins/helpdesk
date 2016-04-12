<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\File
 *
 * @property integer $id
 * @property string $path
 * @property string $user_id
 * @property integer $issue_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\Issue $issue
 * @method static \Illuminate\Database\Query\Builder|\App\Models\File whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\File wherePath($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\File whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\File whereIssueId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\File whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\File whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class File extends Model
{
    protected $table = 'files';

    protected $fillable = ['path', 'user_id', 'issue_id'];

    public function issue()
    {
    	return $this->belongsTo('App\Models\Issue');
    }
}
