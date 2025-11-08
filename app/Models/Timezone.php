<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Timezone
 * 
 * @property int $id
 * @property int $country_id
 * @property string $name
 *
 * @package App\Models
 */
class Timezone extends Model
{
	protected $table = 'timezones';
	public $timestamps = false;

	protected $casts = [
		'country_id' => 'int'
	];

	protected $fillable = [
		'country_id',
		'name'
	];
}
