<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class VendorsFeature
 * 
 * @property int $id
 * @property int $vendor_id
 * @property string $feature_type
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Vendor $vendor
 *
 * @package App\Models
 */
class VendorsFeature extends Model
{
	protected $table = 'vendors_features';

	protected $casts = [
		'vendor_id' => 'int'
	];

	protected $fillable = [
		'vendor_id',
		'feature_type'
	];

	public function vendor()
	{
		return $this->belongsTo(Vendor::class);
	}
}
