<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class VendorsVisitClinic
 * 
 * @property int $id
 * @property int $vendor_id
 * @property string $registration_number
 * @property string $registration_document
 * @property string $vendor_type
 * @property array $images
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Vendor $vendor
 * @property Collection|VcDoctorDetail[] $vc_doctor_details
 * @property Collection|VcItem[] $vc_items
 *
 * @package App\Models
 */
class VendorsVisitClinic extends Model
{
	protected $table = 'vendors_visit_clinic';

	protected $casts = [
		'vendor_id' => 'int',
		'images' => 'json'
	];

	protected $fillable = [
		'vendor_id',
		'registration_number',
		'registration_document',
		'vendor_type',
		'images'
	];

	public function vendor()
	{
		return $this->belongsTo(Vendor::class);
	}

	public function vc_doctor_details()
	{
		return $this->hasMany(VcDoctorDetail::class, 'vendors_vc_id');
	}

	public function vc_items()
	{
		return $this->hasMany(VcItem::class, 'vendors_vc_id');
	}
}
