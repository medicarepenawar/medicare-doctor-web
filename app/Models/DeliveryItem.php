<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class DeliveryItem
 * 
 * @property int $id
 * @property int $delivery_id
 * @property string $name
 * @property int $quantity
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Delivery $delivery
 *
 * @package App\Models
 */
class DeliveryItem extends Model
{
	protected $table = 'delivery_items';

	protected $casts = [
		'delivery_id' => 'int',
		'quantity' => 'int'
	];

	protected $fillable = [
		'delivery_id',
		'name',
		'quantity'
	];

	public function delivery()
	{
		return $this->belongsTo(Delivery::class);
	}
}
