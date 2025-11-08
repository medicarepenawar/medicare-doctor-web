<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Delivery
 * 
 * @property int $id
 * @property int $order_id
 * @property int|null $driver_id
 * @property string $status
 * @property Carbon|null $pickup_time
 * @property Carbon|null $arrived_time
 * @property string|null $evidance
 * @property bool $user_confirmation
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Driver|null $driver
 * @property Order $order
 * @property Collection|DeliveryItem[] $delivery_items
 *
 * @package App\Models
 */
class Delivery extends Model
{
	protected $table = 'deliveries';

	protected $casts = [
		'order_id' => 'int',
		'driver_id' => 'int',
		'pickup_time' => 'datetime',
		'arrived_time' => 'datetime',
		'user_confirmation' => 'bool'
	];

	protected $fillable = [
		'order_id',
		'driver_id',
		'status',
		'pickup_time',
		'arrived_time',
		'evidance',
		'user_confirmation'
	];

	public function driver()
	{
		return $this->belongsTo(Driver::class);
	}

	public function order()
	{
		return $this->belongsTo(Order::class);
	}

	public function delivery_items()
	{
		return $this->hasMany(DeliveryItem::class);
	}
}
