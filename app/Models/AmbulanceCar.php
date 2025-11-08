<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AmbulanceCar
 * 
 * @property int $id
 * @property int $vendor_ambulance_id
 * @property string $vehicle_number
 * @property string $vehicle_manufacture
 * @property string $vehicle_model
 * @property string $vehicle_color
 * @property string $vehicle_photo
 * @property string $roadtax_document
 * @property string $insurance_document
 * @property string $puspakom_document
 * @property Carbon $roadtax_expired
 * @property Carbon $insurance_expired
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
class AmbulanceCar extends Model
{
	protected $table = 'ambulance_cars';

	protected $casts = [
		'vendor_ambulance_id' => 'int',
		'roadtax_expired' => 'datetime',
		'insurance_expired' => 'datetime',
		'verified' => 'bool'
	];

	protected $fillable = [
		'vendor_ambulance_id',
		'vehicle_number',
		'vehicle_manufacture',
		'vehicle_model',
		'vehicle_color',
		'vehicle_photo',
		'roadtax_document',
		'insurance_document',
		'puspakom_document',
		'roadtax_expired',
		'insurance_expired',
		'verified'
	];

	public function vendors_call_ambulance()
	{
		return $this->belongsTo(VendorsCallAmbulance::class, 'vendor_ambulance_id');
	}

	public function ambulance_driver_details()
	{
		return $this->hasMany(AmbulanceDriverDetail::class, 'car_ambulance_id');
	}

	public function ambulance_orders()
	{
		return $this->hasMany(AmbulanceOrder::class);
	}
}
