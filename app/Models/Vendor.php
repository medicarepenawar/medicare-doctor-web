<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Vendor
 * 
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $photo
 * @property bool $verified
 * @property bool $is_available
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|AmbulanceItem[] $ambulance_items
 * @property Collection|Order[] $orders
 * @property Collection|VendorPharmacy[] $vendor_pharmacies
 * @property Collection|VendorsAddress[] $vendors_addresses
 * @property Collection|VendorsCallAmbulance[] $vendors_call_ambulances
 * @property Collection|VendorsFeature[] $vendors_features
 * @property Collection|VendorsPersonDetail[] $vendors_person_details
 * @property Collection|VendorsVisitClinic[] $vendors_visit_clinics
 *
 * @package App\Models
 */
class Vendor extends Model
{
	protected $table = 'vendors';

	protected $casts = [
		'verified' => 'bool',
		'is_available' => 'bool'
	];

	protected $fillable = [
		'name',
		'description',
		'photo',
		'verified',
		'is_available'
	];

	public function ambulance_items()
	{
		return $this->hasMany(AmbulanceItem::class, 'vendor_ambulance_id');
	}

	public function orders()
	{
		return $this->hasMany(Order::class);
	}

	public function vendor_pharmacies()
	{
		return $this->hasMany(VendorPharmacy::class);
	}

	public function vendors_addresses()
	{
		return $this->hasMany(VendorsAddress::class);
	}

	public function vendors_call_ambulances()
	{
		return $this->hasMany(VendorsCallAmbulance::class);
	}

	public function vendors_features()
	{
		return $this->hasMany(VendorsFeature::class);
	}

	public function vendors_person_details()
	{
		return $this->hasMany(VendorsPersonDetail::class);
	}

	public function vendors_visit_clinics()
	{
		return $this->hasMany(VendorsVisitClinic::class);
	}
}
