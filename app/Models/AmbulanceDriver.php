<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AmbulanceDriver
 * 
 * @property int $id
 * @property int $vendor_ambulance_id
 * @property string $name
 * @property string $nric
 * @property Carbon $birth_date
 * @property string $gender
 * @property string $phone_number
 * @property string $address
 * @property string $driver_license_number
 * @property Carbon $driver_license_expired
 * @property string $driver_license_document
 * @property string $psv_document
 * @property string $photo
 * @property bool $verified
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property VendorsCallAmbulance $vendors_call_ambulance
 * @property Collection|AmbulanceDriverDetail[] $ambulance_driver_details
 * @property Collection|AmbulanceOrder[] $ambulance_orders
 *
 * @package App\Models
 */
class AmbulanceDriver extends Model
{
	protected $table = 'ambulance_drivers';

	protected $casts = [
		'vendor_ambulance_id' => 'int',
		'birth_date' => 'datetime',
		'driver_license_expired' => 'datetime',
		'verified' => 'bool'
	];

	protected $fillable = [
		'vendor_ambulance_id',
		'name',
		'nric',
		'birth_date',
		'gender',
		'phone_number',
		'address',
		'driver_license_number',
		'driver_license_expired',
		'driver_license_document',
		'psv_document',
		'photo',
		'verified'
	];

	public function vendors_call_ambulance()
	{
		return $this->belongsTo(VendorsCallAmbulance::class, 'vendor_ambulance_id');
	}

	public function ambulance_driver_details()
	{
		return $this->hasMany(AmbulanceDriverDetail::class, 'driver_ambulance_id');
	}

	public function ambulance_orders()
	{
		return $this->hasMany(AmbulanceOrder::class);
	}
}
