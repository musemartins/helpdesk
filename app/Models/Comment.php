<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';

    protected $fillable = ['comment', 'issue_id', 'user_id'];

    public function issue()
    {
    	return $this->belongsTo('App\Models\Issue');
    }

    public function user()
    {
    	return $this->belongsTo('App\Models\User');
    }
}
