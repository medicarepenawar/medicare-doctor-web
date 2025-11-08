<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AmbulanceItem
 * 
 * @property int $id
 * @property int $vendor_ambulance_id
 * @property string $code
 * @property string $name
 * @property string $description
 * @property int $stock
 * @property float $price
 * @property string $image
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Vendor $vendor
 *
 * @package App\Models
 */
class AmbulanceItem extends Model
{
	protected $table = 'ambulance_items';

	protected $casts = [
		'vendor_ambulance_id' => 'int',
		'stock' => 'int',
		'price' => 'float'
	];

	protected $fillable = [
		'vendor_ambulance_id',
		'code',
		'name',
		'description',
		'stock',
		'price',
		'image'
	];

	public function vendor()
	{
		return $this->belongsTo(Vendor::class, 'vendor_ambulance_id');
	}
}
