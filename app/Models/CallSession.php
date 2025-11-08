<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CallSession
 * 
 * @property int $id
 * @property int $order_id
 * @property string $channel_name
 * @property int $user1_uid
 * @property int $user2_uid
 * @property string $user1_token
 * @property string $user2_token
 * @property int $user1_expired_at
 * @property int $user2_expired_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Order $order
 *
 * @package App\Models
 */
class CallSession extends Model
{
	protected $table = 'call_sessions';

	protected $casts = [
		'order_id' => 'int',
		'user1_uid' => 'int',
		'user2_uid' => 'int',
		'user1_expired_at' => 'int',
		'user2_expired_at' => 'int'
	];

	protected $hidden = [
		'user1_token',
		'user2_token'
	];

	protected $fillable = [
		'order_id',
		'channel_name',
		'user1_uid',
		'user2_uid',
		'user1_token',
		'user2_token',
		'user1_expired_at',
		'user2_expired_at'
	];

	public function order()
	{
		return $this->belongsTo(Order::class);
	}
}
