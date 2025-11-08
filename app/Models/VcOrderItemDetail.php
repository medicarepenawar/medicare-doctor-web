<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class VcOrderItemDetail
 * 
 * @property int $id
 * @property int $vc_order_id
 * @property int $vc_item_id
 * @property int $quantity
 * @property float $price
 * @property float $total_price
 * @property string $description
 * @property string|null $extra_info
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property VcItem $vc_item
 * @property VcOrder $vc_order
 *
 * @package App\Models
 */
class VcOrderItemDetail extends Model
{
	protected $table = 'vc_order_item_details';

	protected $casts = [
		'vc_order_id' => 'int',
		'vc_item_id' => 'int',
		'quantity' => 'int',
		'price' => 'float',
		'total_price' => 'float'
	];

	protected $fillable = [
		'vc_order_id',
		'vc_item_id',
		'quantity',
		'price',
		'total_price',
		'description',
		'extra_info'
	];

	public function vc_item()
	{
		return $this->belongsTo(VcItem::class);
	}

	public function vc_order()
	{
		return $this->belongsTo(VcOrder::class);
	}
}
