<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TcMedicalNote
 * 
 * @property int $id
 * @property int $tc_order_id
 * @property string $customer_name
 * @property string $symptoms
 * @property string $diagnosis
 * @property string $advice
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property TcOrder $tc_order
 *
 * @package App\Models
 */
class TcMedicalNote extends Model
{
	protected $table = 'tc_medical_notes';

	protected $casts = [
		'tc_order_id' => 'int'
	];

	protected $fillable = [
		'tc_order_id',
		'customer_name',
		'symptoms',
		'diagnosis',
		'advice'
	];

	public function tc_order()
	{
		return $this->belongsTo(TcOrder::class);
	}
}
