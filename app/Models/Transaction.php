<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Transaction
 * 
 * @property int $id
 * @property int $order_id
 * @property int $payment_method_id
 * @property string $status_transaction
 * @property string $status_payment
 * @property float $total_amount
 * @property float $platform_fee
 * @property float $payout_amount
 * @property float $delivery_fee
 * @property string|null $bill_code
 * @property Carbon|null $expired_date
 * @property string|null $reference
 * @property Carbon|null $completed_date
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Order $order
 * @property PaymentMethod $payment_method
 *
 * @package App\Models
 */
class Transaction extends Model
{
	protected $table = 'transactions';

	protected $casts = [
		'order_id' => 'int',
		'payment_method_id' => 'int',
		'total_amount' => 'float',
		'platform_fee' => 'float',
		'payout_amount' => 'float',
		'delivery_fee' => 'float',
		'expired_date' => 'datetime',
		'completed_date' => 'datetime'
	];

	protected $fillable = [
		'order_id',
		'payment_method_id',
		'status_transaction',
		'status_payment',
		'total_amount',
		'platform_fee',
		'payout_amount',
		'delivery_fee',
		'bill_code',
		'expired_date',
		'reference',
		'completed_date'
	];

	public function order()
	{
		return $this->belongsTo(Order::class);
	}

	public function payment_method()
	{
		return $this->belongsTo(PaymentMethod::class);
	}
}
