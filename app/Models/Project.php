<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class Project extends Model implements SluggableInterface
{

	use SluggableTrait;

	protected $sluggable = [
		'build_from'	=> 	'name',
		'save_to'		=>	'slug'
	];

    protected $table = 'projects';

    protected $fillable = ['name', 'slug'];

    public function issues()
    {
        return $this->hasMany('App\Models\Issue');
    }
}
