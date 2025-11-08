<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EpOrderItem
 * 
 * @property int $id
 * @property int $ep_order_id
 * @property int $item_id
 * @property string $drug
 * @property string $dosage
 * @property string $route
 * @property string $frequency
 * @property string $amount
 * @property string $unit
 * @property string $duration
 * @property string $supplied_amount
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property EpOrder $ep_order
 * @property Item $item
 *
 * @package App\Models
 */
class EpOrderItem extends Model
{
	protected $table = 'ep_order_items';

	protected $casts = [
		'ep_order_id' => 'int',
		'item_id' => 'int'
	];

	protected $fillable = [
		'ep_order_id',
		'item_id',
		'drug',
		'dosage',
		'route',
		'frequency',
		'amount',
		'unit',
		'duration',
		'supplied_amount'
	];

	public function ep_order()
	{
		return $this->belongsTo(EpOrder::class);
	}

	public function item()
	{
		return $this->belongsTo(Item::class);
	}
}
