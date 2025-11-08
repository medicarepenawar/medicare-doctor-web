<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class VendorsCallAmbulance
 * 
 * @property int $id
 * @property int $vendor_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Vendor $vendor
 * @property Collection|AmbulanceCar[] $ambulance_cars
 * @property Collection|AmbulanceDriver[] $ambulance_drivers
 *
 * @package App\Models
 */
class VendorsCallAmbulance extends Model
{
	protected $table = 'vendors_call_ambulance';

	protected $casts = [
		'vendor_id' => 'int'
	];

	protected $fillable = [
		'vendor_id'
	];

	public function vendor()
	{
		return $this->belongsTo(Vendor::class);
	}

	public function ambulance_cars()
	{
		return $this->hasMany(AmbulanceCar::class, 'vendor_ambulance_id');
	}

	public function ambulance_drivers()
	{
		return $this->hasMany(AmbulanceDriver::class, 'vendor_ambulance_id');
	}
}
