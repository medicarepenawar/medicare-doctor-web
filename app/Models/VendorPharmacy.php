<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class VendorPharmacy
 * 
 * @property int $id
 * @property string $pharmacy_license
 * @property string|null $license_photo
 * @property int $vendor_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Vendor $vendor
 * @property Collection|PhItem[] $ph_items
 *
 * @package App\Models
 */
class VendorPharmacy extends Model
{
	protected $table = 'vendor_pharmacies';

	protected $casts = [
		'vendor_id' => 'int'
	];

	protected $fillable = [
		'pharmacy_license',
		'license_photo',
		'vendor_id'
	];

	public function vendor()
	{
		return $this->belongsTo(Vendor::class);
	}

	public function ph_items()
	{
		return $this->hasMany(PhItem::class);
	}
}
