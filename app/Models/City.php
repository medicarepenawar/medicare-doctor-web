<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class City
 * 
 * @property int $id
 * @property int $country_id
 * @property int $state_id
 * @property string $name
 * @property string $country_code
 *
 * @package App\Models
 */
class City extends Model
{
	protected $table = 'cities';
	public $timestamps = false;

	protected $casts = [
		'country_id' => 'int',
		'state_id' => 'int'
	];

	protected $fillable = [
		'country_id',
		'state_id',
		'name',
		'country_code'
	];
}
