<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
/**
 * Class User
 * 
 * @property int $id
 * @property string $email
 * @property string $password
 * @property string $userable_type
 * @property int $userable_id
 * @property string|null $fcm_id
 * @property Carbon|null $email_verified_at
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Appointment[] $appointments
 * @property Collection|Item[] $items
 * @property Collection|Wallet[] $wallets
 *
 * @package App\Models
 */
class User extends Authenticatable implements MustVerifyEmail
{
	use HasFactory, Notifiable;

	protected $fillable = [
		'email',
		'password',
		'userable_id',
		'userable_type',
		'fcm_id',
		'email_verified_at',
		'remember_token'
	];

	protected $hidden = [
		'password',
		'remember_token',
	];


	// public static function newFactory()
	// {
	// 	return \Modules\Auth\Database\Factories\UserFactory::new();
	// }

	protected function casts(): array
	{
		return [
			'email_verified_at' => 'datetime',
			'password' => 'hashed',
		];
	}

	public function getJWTIdentifier()
	{
		return $this->getKey();
	}

	public function getJWTCustomClaims(): array
	{
		$userable = $this->userable;

		if (!$userable) {
			return [
				"data" => null,
			];
		}

		$userableData = [
			"name" => $userable->name ?? null,
			"email" => $this->email,
			"userable_type" => class_basename($userable),
		];

		if (isset($userable->verified)) {
			$userableData["verified"] = $userable->verified;
		}

		return [
			"data" => $userableData,
		];
	}

	public function userable(): MorphTo
	{
		return $this->morphTo();
	}

	public function wallet()
	{
		return $this->hasOne(Wallet::class);
	}

	public function items()
	{
		return $this->hasMany(Item::class, 'created_by');
	}
}
