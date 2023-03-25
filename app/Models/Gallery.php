<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Gallery
 * 
 * @property int $id
 * @property string $title
 * @property string $name
 * @property string $image
 * @property string $description
 * @property string $type
 * @property string $visibility
 * @property string $status
 * @property Carbon $date
 *
 * @package App\Models
 */
class Gallery extends Model
{
	protected $table = 'gallery';
	public $timestamps = false;

	protected $dates = [
		'date'
	];

	protected $fillable = [
		'title',
		'name',
		'image',
		'description',
		'type',
		'visibility',
		'status',
		'date'
	];
}
