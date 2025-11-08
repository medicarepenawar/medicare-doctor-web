<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AmbulanceDriverDetail
 * 
 * @property int $id
 * @property int|null $driver_ambulance_id
 * @property int|null $car_ambulance_id
 * @property bool $on_duty
 * @property bool $is_active
 * @property bool $ready
 * @property string|null $latitude
 * @property string|null $longitude
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property AmbulanceCar|null $ambulance_car
 * @property AmbulanceDriver|null $ambulance_driver
 *
 * @package App\Models
 */
class AmbulanceDriverDetail extends Model
{
	protected $table = 'ambulance_driver_details';

	protected $casts = [
		'driver_ambulance_id' => 'int',
		'car_ambulance_id' => 'int',
		'on_duty' => 'bool',
		'is_active' => 'bool',
		'ready' => 'bool'
	];

	protected $fillable = [
		'driver_ambulance_id',
		'car_ambulance_id',
		'on_duty',
		'is_active',
		'ready',
		'latitude',
		'longitude'
	];

	public function ambulance_car()
	{
		return $this->belongsTo(AmbulanceCar::class, 'car_ambulance_id');
	}

	public function ambulance_driver()
	{
		return $this->belongsTo(AmbulanceDriver::class, 'driver_ambulance_id');
	}
}
