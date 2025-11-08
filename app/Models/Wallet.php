<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Wallet
 * 
 * @property int $id
 * @property int $user_id
 * @property string $bank_name
 * @property string $bank_account
 * @property float $balance
 * @property string $currency
 * @property string $pin
 * @property string $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property User $user
 * @property Collection|WalletTransaction[] $wallet_transactions
 *
 * @package App\Models
 */
class Wallet extends Model
{
	protected $table = 'wallets';

	protected $casts = [
		'user_id' => 'int',
		'balance' => 'float'
	];

	protected $fillable = [
		'user_id',
		'bank_name',
		'bank_account',
		'balance',
		'currency',
		'pin',
		'status'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function wallet_transactions()
	{
		return $this->hasMany(WalletTransaction::class);
	}
}
