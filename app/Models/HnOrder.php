<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class HnOrder
 * 
 * @property int $id
 * @property int $order_id
 * @property int $nurse_id
 * @property Carbon $reservation_date
 * @property Carbon $reservation_time
 * @property string $patient_name
 * @property string $patient_gender
 * @property int $patient_age
 * @property int $duration
 * @property string $status
 * @property string|null $notes
 * @property array|null $pictures
 * @property string|null $video
 * @property string|null $reject_reason
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Nurse $nurse
 * @property Order $order
 * @property Collection|HnOrderServiceDetail[] $hn_order_service_details
 *
 * @package App\Models
 */
class HnOrder extends Model
{
	protected $table = 'hn_orders';

	protected $casts = [
		'order_id' => 'int',
		'nurse_id' => 'int',
		'reservation_date' => 'datetime',
		'reservation_time' => 'datetime',
		'patient_age' => 'int',
		'duration' => 'int',
		'pictures' => 'json'
	];

	protected $fillable = [
		'order_id',
		'nurse_id',
		'reservation_date',
		'reservation_time',
		'patient_name',
		'patient_gender',
		'patient_age',
		'duration',
		'status',
		'notes',
		'pictures',
		'video',
		'reject_reason'
	];

	public function nurse()
	{
		return $this->belongsTo(Nurse::class);
	}

	public function order()
	{
		return $this->belongsTo(Order::class);
	}

	public function hn_order_service_details()
	{
		return $this->hasMany(HnOrderServiceDetail::class);
	}
}
