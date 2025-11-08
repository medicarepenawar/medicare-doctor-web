<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class VcVideoCall
 * 
 * @property int $id
 * @property int $vc_order_id
 * @property string $channel_name
 * @property int $customer_uid
 * @property int $doctor_uid
 * @property string $customer_token
 * @property string $doctor_token
 * @property int $customer_expired_at
 * @property int $doctor_expired_at
 * @property Carbon|null $start_time
 * @property Carbon|null $end_time
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property VcOrder $vc_order
 *
 * @package App\Models
 */
class VcVideoCall extends Model
{
	protected $table = 'vc_video_calls';

	protected $casts = [
		'vc_order_id' => 'int',
		'customer_uid' => 'int',
		'doctor_uid' => 'int',
		'customer_expired_at' => 'int',
		'doctor_expired_at' => 'int',
		'start_time' => 'datetime',
		'end_time' => 'datetime'
	];

	protected $hidden = [
		'customer_token',
		'doctor_token'
	];

	protected $fillable = [
		'vc_order_id',
		'channel_name',
		'customer_uid',
		'doctor_uid',
		'customer_token',
		'doctor_token',
		'customer_expired_at',
		'doctor_expired_at',
		'start_time',
		'end_time'
	];

	public function vc_order()
	{
		return $this->belongsTo(VcOrder::class);
	}
}
