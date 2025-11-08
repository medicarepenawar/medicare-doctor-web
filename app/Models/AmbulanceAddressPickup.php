<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AmbulanceAddressPickup
 * 
 * @property int $id
 * @property int $ambulance_order_id
 * @property string $label
 * @property string $street
 * @property string $latitude
 * @property string $longitude
 * @property string|null $notes
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property AmbulanceOrder $ambulance_order
 *
 * @package App\Models
 */
class AmbulanceAddressPickup extends Model
{
	protected $table = 'ambulance_address_pickups';

	protected $casts = [
		'ambulance_order_id' => 'int'
	];

	protected $fillable = [
		'ambulance_order_id',
		'label',
		'street',
		'latitude',
		'longitude',
		'notes'
	];

	public function ambulance_order()
	{
		return $this->belongsTo(AmbulanceOrder::class);
	}
}
