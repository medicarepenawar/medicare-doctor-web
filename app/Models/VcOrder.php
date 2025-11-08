<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class VcOrder
 * 
 * @property int $id
 * @property int $order_id
 * @property int $patient_id
 * @property int $doctor_id
 * @property string|null $issue
 * @property int|null $shift
 * @property string $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Doctor $doctor
 * @property Order $order
 * @property Customer $customer
 * @property Collection|VcOrderItemDetail[] $vc_order_item_details
 * @property Collection|VcOrderServiceDetail[] $vc_order_service_details
 * @property Collection|VcVideoCall[] $vc_video_calls
 *
 * @package App\Models
 */
class VcOrder extends Model
{
	protected $table = 'vc_orders';

	protected $casts = [
		'order_id' => 'int',
		'patient_id' => 'int',
		'doctor_id' => 'int',
		'shift' => 'int'
	];

	protected $fillable = [
		'order_id',
		'patient_id',
		'doctor_id',
		'issue',
		'shift',
		'status'
	];

	public function doctor()
	{
		return $this->belongsTo(Doctor::class);
	}

	public function order()
	{
		return $this->belongsTo(Order::class);
	}

	public function customer()
	{
		return $this->belongsTo(Customer::class, 'patient_id');
	}

	public function vc_order_item_details()
	{
		return $this->hasMany(VcOrderItemDetail::class);
	}

	public function vc_order_service_details()
	{
		return $this->hasMany(VcOrderServiceDetail::class);
	}

	public function vc_video_calls()
	{
		return $this->hasMany(VcVideoCall::class);
	}
}
