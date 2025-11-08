<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TcDoctorDetail
 * 
 * @property int $id
 * @property int $doctor_id
 * @property int $tc_specialist_id
 * @property bool $is_online
 * @property bool $on_duty
 * @property string $signature_url
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Doctor $doctor
 * @property TcSpecialist $tc_specialist
 *
 * @package App\Models
 */
class TcDoctorDetail extends Model
{
	protected $table = 'tc_doctor_details';

	protected $casts = [
		'doctor_id' => 'int',
		'tc_specialist_id' => 'int',
		'is_online' => 'bool',
		'on_duty' => 'bool'
	];

	protected $fillable = [
		'doctor_id',
		'tc_specialist_id',
		'is_online',
		'on_duty',
		'signature_url'
	];

	public function doctor()
	{
		return $this->belongsTo(Doctor::class);
	}

	public function tc_specialist()
	{
		return $this->belongsTo(TcSpecialist::class);
	}
}
