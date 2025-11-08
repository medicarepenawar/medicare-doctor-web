<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class HnOrderServiceDetail
 * 
 * @property int $id
 * @property int $hn_order_id
 * @property int $hn_service_id
 * @property int $quantity
 * @property float $price
 * @property float $total_price
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property HnOrder $hn_order
 * @property HnService $hn_service
 *
 * @package App\Models
 */
class HnOrderServiceDetail extends Model
{
	protected $table = 'hn_order_service_details';

	protected $casts = [
		'hn_order_id' => 'int',
		'hn_service_id' => 'int',
		'quantity' => 'int',
		'price' => 'float',
		'total_price' => 'float'
	];

	protected $fillable = [
		'hn_order_id',
		'hn_service_id',
		'quantity',
		'price',
		'total_price'
	];

	public function hn_order()
	{
		return $this->belongsTo(HnOrder::class);
	}

	public function hn_service()
	{
		return $this->belongsTo(HnService::class);
	}
}
