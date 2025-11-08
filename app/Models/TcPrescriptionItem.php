<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TcPrescriptionItem
 * 
 * @property int $id
 * @property int $tc_prescription_id
 * @property string $drug
 * @property string $dosage
 * @property string $route
 * @property string $frequency
 * @property string $amount
 * @property string $unit
 * @property string $status
 * @property string $duration
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property TcPrescription $tc_prescription
 *
 * @package App\Models
 */
class TcPrescriptionItem extends Model
{
	protected $table = 'tc_prescription_items';

	protected $casts = [
		'tc_prescription_id' => 'int'
	];

	protected $fillable = [
		'tc_prescription_id',
		'drug',
		'dosage',
		'route',
		'frequency',
		'amount',
		'unit',
		'status',
		'duration'
	];

	public function tc_prescription()
	{
		return $this->belongsTo(TcPrescription::class);
	}
}
