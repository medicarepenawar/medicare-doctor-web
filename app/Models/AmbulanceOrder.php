<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AmbulanceOrder
 * 
 * @property int $id
 * @property int $order_id
 * @property int|null $ambulance_driver_id
 * @property int|null $ambulance_car_id
 * @property string $status
 * @property Carbon $order_date
 * @property string $patient_name
 * @property string $nric_photo
 * @property string|null $condition
 * @property string|null $condition_photo
 * @property Carbon|null $pickup_date
 * @property Carbon|null $completed_date
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property AmbulanceCar|null $ambulance_car
 * @property AmbulanceDriver|null $ambulance_driver
 * @property Order $order
 * @property Collection|AmbulanceAddressDestination[] $ambulance_address_destinations
 * @property Collection|AmbulanceAddressPickup[] $ambulance_address_pickups
 *
 * @package App\Models
 */
class AmbulanceOrder extends Model
{
	protected $table = 'ambulance_orders';

	protected $casts = [
		'order_id' => 'int',
		'ambulance_driver_id' => 'int',
		'ambulance_car_id' => 'int',
		'order_date' => 'datetime',
		'pickup_date' => 'datetime',
		'completed_date' => 'datetime'
	];

	protected $fillable = [
		'order_id',
		'ambulance_driver_id',
		'ambulance_car_id',
		'status',
		'order_date',
		'patient_name',
		'nric_photo',
		'condition',
		'condition_photo',
		'pickup_date',
		'completed_date'
	];

	public function ambulance_car()
	{
		return $this->belongsTo(AmbulanceCar::class);
	}

	public function ambulance_driver()
	{
		return $this->belongsTo(AmbulanceDriver::class);
	}

	public function order()
	{
		return $this->belongsTo(Order::class);
	}

	public function ambulance_address_destinations()
	{
		return $this->hasMany(AmbulanceAddressDestination::class);
	}

	public function ambulance_address_pickups()
	{
		return $this->hasMany(AmbulanceAddressPickup::class);
	}
}
