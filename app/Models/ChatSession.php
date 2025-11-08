<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ChatSession
 * 
 * @property int $id
 * @property int $order_id
 * @property string $user1_id
 * @property string $user2_id
 * @property string $user1_token
 * @property string $user2_token
 * @property string $user1_token_rtm
 * @property string $user2_token_rtm
 * @property int $user1_expired_at
 * @property int $user2_expired_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Order $order
 *
 * @package App\Models
 */
class ChatSession extends Model
{
	protected $table = 'chat_sessions';

	protected $casts = [
		'order_id' => 'int',
		'user1_expired_at' => 'int',
		'user2_expired_at' => 'int'
	];

	protected $hidden = [
		'user1_token',
		'user2_token'
	];

	protected $fillable = [
		'order_id',
		'user1_id',
		'user2_id',
		'user1_token',
		'user2_token',
		'user1_token_rtm',
		'user2_token_rtm',
		'user1_expired_at',
		'user2_expired_at'
	];

	public function order()
	{
		return $this->belongsTo(Order::class);
	}
}
