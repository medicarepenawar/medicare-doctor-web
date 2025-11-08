<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Order
 * 
 * @property int $id
 * @property string $order_code
 * @property int $customer_id
 * @property int|null $vendor_id
 * @property int $order_type_id
 * @property string $status_order
 * @property Carbon $order_date
 * @property Carbon|null $completed_date
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Customer $customer
 * @property OrderType $order_type
 * @property Vendor|null $vendor
 * @property Collection|AmbulanceOrder[] $ambulance_orders
 * @property Collection|CallSession[] $call_sessions
 * @property Collection|ChatSession[] $chat_sessions
 * @property Collection|Delivery[] $deliveries
 * @property Collection|EpOrder[] $ep_orders
 * @property Collection|HnOrder[] $hn_orders
 * @property Collection|OrderAddress[] $order_addresses
 * @property Collection|PhOrder[] $ph_orders
 * @property Collection|TcOrder[] $tc_orders
 * @property Collection|Transaction[] $transactions
 * @property Collection|VcOrder[] $vc_orders
 *
 * @package App\Models
 */
class Order extends Model
{
	protected $table = 'orders';

	protected $casts = [
		'customer_id' => 'int',
		'vendor_id' => 'int',
		'order_type_id' => 'int',
		'order_date' => 'datetime',
		'completed_date' => 'datetime'
	];

	protected $fillable = [
		'order_code',
		'customer_id',
		'vendor_id',
		'order_type_id',
		'status_order',
		'order_date',
		'completed_date'
	];

	public function customer()
	{
		return $this->belongsTo(Customer::class);
	}

	public function order_type()
	{
		return $this->belongsTo(OrderType::class);
	}

	public function vendor()
	{
		return $this->belongsTo(Vendor::class);
	}

	public function ambulance_orders()
	{
		return $this->hasMany(AmbulanceOrder::class);
	}

	public function call_sessions()
	{
		return $this->hasMany(CallSession::class);
	}

	public function chat_sessions()
	{
		return $this->hasMany(ChatSession::class);
	}

	public function deliveries()
	{
		return $this->hasMany(Delivery::class);
	}

	public function ep_orders()
	{
		return $this->hasMany(EpOrder::class);
	}

	public function hn_orders()
	{
		return $this->hasMany(HnOrder::class);
	}

	public function order_addresses()
	{
		return $this->hasMany(OrderAddress::class);
	}

	public function ph_orders()
	{
		return $this->hasMany(PhOrder::class);
	}

	public function tc_orders()
	{
		return $this->hasMany(TcOrder::class);
	}

	public function transactions()
	{
		return $this->hasMany(Transaction::class);
	}

	public function vc_orders()
	{
		return $this->hasMany(VcOrder::class);
	}
}
