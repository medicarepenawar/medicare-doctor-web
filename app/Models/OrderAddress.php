<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class OrderAddress
 * 
 * @property int $id
 * @property int $order_id
 * @property string|null $label
 * @property string $street
 * @property string|null $description
 * @property string $latitude
 * @property string $longitude
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Order $order
 *
 * @package App\Models
 */
class OrderAddress extends Model
{
	protected $table = 'order_addresses';

	protected $casts = [
		'order_id' => 'int'
	];

	protected $fillable = [
		'order_id',
		'label',
		'street',
		'description',
		'latitude',
		'longitude'
	];

	public function order()
	{
		return $this->belongsTo(Order::class);
	}
}
