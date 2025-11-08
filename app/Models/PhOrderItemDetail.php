<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PhOrderItemDetail
 * 
 * @property int $id
 * @property int $ph_order_id
 * @property string $name
 * @property string $code
 * @property string $status
 * @property string|null $declined_note
 * @property float $price
 * @property int $quantity
 * @property float $total
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $ph_item_id
 * 
 * @property PhItem $ph_item
 * @property PhOrder $ph_order
 *
 * @package App\Models
 */
class PhOrderItemDetail extends Model
{
	protected $table = 'ph_order_item_details';

	protected $casts = [
		'ph_order_id' => 'int',
		'price' => 'float',
		'quantity' => 'int',
		'total' => 'float',
		'ph_item_id' => 'int'
	];

	protected $fillable = [
		'ph_order_id',
		'name',
		'code',
		'status',
		'declined_note',
		'price',
		'quantity',
		'total',
		'ph_item_id'
	];

	public function ph_item()
	{
		return $this->belongsTo(PhItem::class);
	}

	public function ph_order()
	{
		return $this->belongsTo(PhOrder::class);
	}
}
