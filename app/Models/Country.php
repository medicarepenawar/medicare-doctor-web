<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Country
 * 
 * @property int $id
 * @property string $iso2
 * @property string $name
 * @property int $status
 * @property string $phone_code
 * @property string $iso3
 * @property string $region
 * @property string $subregion
 *
 * @package App\Models
 */
class Country extends Model
{
	protected $table = 'countries';
	public $timestamps = false;

	protected $casts = [
		'status' => 'int'
	];

	protected $fillable = [
		'iso2',
		'name',
		'status',
		'phone_code',
		'iso3',
		'region',
		'subregion'
	];
}
