<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TcPrescriptionPatient
 * 
 * @property int $id
 * @property int $tc_prescription_id
 * @property string $name
 * @property Carbon $birth_date
 * @property string $nric
 * @property string $address
 * @property string $allergies
 * @property string $height
 * @property string $weight
 * @property string $diagnosis
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property TcPrescription $tc_prescription
 *
 * @package App\Models
 */
class TcPrescriptionPatient extends Model
{
	protected $table = 'tc_prescription_patients';

	protected $casts = [
		'tc_prescription_id' => 'int',
		'birth_date' => 'datetime'
	];

	protected $fillable = [
		'tc_prescription_id',
		'name',
		'birth_date',
		'nric',
		'address',
		'allergies',
		'height',
		'weight',
		'diagnosis'
	];

	public function tc_prescription()
	{
		return $this->belongsTo(TcPrescription::class);
	}
}
