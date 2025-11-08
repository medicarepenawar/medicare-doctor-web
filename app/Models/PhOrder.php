<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PhOrder
 * 
 * @property int $id
 * @property int $order_id
 * @property string $status
 * @property string|null $delivery_type
 * @property string|null $note
 * @property int|null $tc_prescription_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Order $order
 * @property TcPrescription|null $tc_prescription
 * @property Collection|PhOrderItemDetail[] $ph_order_item_details
 *
 * @package App\Models
 */
class PhOrder extends Model
{
	protected $table = 'ph_orders';

	protected $casts = [
		'order_id' => 'int',
		'tc_prescription_id' => 'int'
	];

	protected $fillable = [
		'order_id',
		'status',
		'delivery_type',
		'note',
		'tc_prescription_id'
	];

	public function order()
	{
		return $this->belongsTo(Order::class);
	}

	public function tc_prescription()
	{
		return $this->belongsTo(TcPrescription::class);
	}

	public function ph_order_item_details()
	{
		return $this->hasMany(PhOrderItemDetail::class);
	}
}
