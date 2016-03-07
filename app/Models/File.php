<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $table = 'files';

    protected $fillable = ['path', 'user_id', 'issue_id'];

    public function issue()
    {
    	return $this->belongsTo('App\Models\Issue');
    }
}
