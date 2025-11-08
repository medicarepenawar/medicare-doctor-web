<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class VendorsPersonDetail
 * 
 * @property int $id
 * @property int $vendor_id
 * @property int $vendor_person_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Vendor $vendor
 * @property VendorsPerson $vendors_person
 *
 * @package App\Models
 */
class VendorsPersonDetail extends Model
{
	protected $table = 'vendors_person_detail';

	protected $casts = [
		'vendor_id' => 'int',
		'vendor_person_id' => 'int'
	];

	protected $fillable = [
		'vendor_id',
		'vendor_person_id'
	];

	public function vendor()
	{
		return $this->belongsTo(Vendor::class);
	}

	public function vendors_person()
	{
		return $this->belongsTo(VendorsPerson::class, 'vendor_person_id');
	}
}
