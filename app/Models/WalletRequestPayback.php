<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class WalletRequestPayback
 * 
 * @property int $id
 * @property int $wallet_transaction_id
 * @property string $status
 * @property string|null $invoice_id
 * @property string|null $invoice_photo
 * @property string|null $user_message
 * @property string|null $admin_message
 * @property Carbon $request_at
 * @property Carbon|null $completed_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property WalletTransaction $wallet_transaction
 *
 * @package App\Models
 */
class WalletRequestPayback extends Model
{
	protected $table = 'wallet_request_paybacks';

	protected $casts = [
		'wallet_transaction_id' => 'int',
		'request_at' => 'datetime',
		'completed_at' => 'datetime'
	];

	protected $fillable = [
		'wallet_transaction_id',
		'status',
		'invoice_id',
		'invoice_photo',
		'user_message',
		'admin_message',
		'request_at',
		'completed_at'
	];

	public function wallet_transaction()
	{
		return $this->belongsTo(WalletTransaction::class);
	}
}
