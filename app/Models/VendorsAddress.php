<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class VendorsAddress
 * 
 * @property int $id
 * @property int $vendor_id
 * @property string $street
 * @property string $latitude
 * @property string $longitude
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Vendor $vendor
 *
 * @package App\Models
 */
class VendorsAddress extends Model
{
	protected $table = 'vendors_addresses';

	protected $casts = [
		'vendor_id' => 'int'
	];

	protected $fillable = [
		'vendor_id',
		'street',
		'latitude',
		'longitude'
	];

	public function vendor()
	{
		return $this->belongsTo(Vendor::class);
	}
}
