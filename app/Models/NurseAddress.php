<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class NurseAddress
 * 
 * @property int $id
 * @property int $nurse_id
 * @property string $address
 * @property string $city
 * @property string $state
 * @property string $country
 * @property string $postcode
 * @property string|null $latitude
 * @property string|null $longitude
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Nurse $nurse
 *
 * @package App\Models
 */
class NurseAddress extends Model
{
	protected $table = 'nurse_addresses';

	protected $casts = [
		'nurse_id' => 'int'
	];

	protected $fillable = [
		'nurse_id',
		'address',
		'city',
		'state',
		'country',
		'postcode',
		'latitude',
		'longitude'
	];

	public function nurse()
	{
		return $this->belongsTo(Nurse::class);
	}
}
