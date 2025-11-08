<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class WalletTransaction
 * 
 * @property int $id
 * @property int $wallet_id
 * @property string $code
 * @property float $amount
 * @property string $type
 * @property string $status
 * @property string|null $description
 * @property string|null $bill_code
 * @property string|null $payment_reference
 * @property Carbon|null $bill_expiry_at
 * @property Carbon|null $success_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Wallet $wallet
 * @property Collection|WalletRequestPayback[] $wallet_request_paybacks
 *
 * @package App\Models
 */
class WalletTransaction extends Model
{
	protected $table = 'wallet_transactions';

	protected $casts = [
		'wallet_id' => 'int',
		'amount' => 'float',
		'bill_expiry_at' => 'datetime',
		'success_at' => 'datetime'
	];

	protected $fillable = [
		'wallet_id',
		'code',
		'amount',
		'type',
		'status',
		'description',
		'bill_code',
		'payment_reference',
		'bill_expiry_at',
		'success_at'
	];

	public function wallet()
	{
		return $this->belongsTo(Wallet::class);
	}

	public function wallet_request_paybacks()
	{
		return $this->hasMany(WalletRequestPayback::class);
	}
}
