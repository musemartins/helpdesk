<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

/**
 * App\Models\Project
 *
 * @property integer $id
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $slug
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Issue[] $issues
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Project whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Project whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Project whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Project whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Project whereSlug($value)
 * @mixin \Eloquent
 */
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
