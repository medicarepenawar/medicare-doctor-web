<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class VcDoctorDetail
 * 
 * @property int $id
 * @property int $doctor_id
 * @property int $vendors_vc_id
 * @property string $shift
 * @property bool $on_duty
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Doctor $doctor
 * @property VendorsVisitClinic $vendors_visit_clinic
 *
 * @package App\Models
 */
class VcDoctorDetail extends Model
{
	protected $table = 'vc_doctor_details';

	protected $casts = [
		'doctor_id' => 'int',
		'vendors_vc_id' => 'int',
		'on_duty' => 'bool'
	];

	protected $fillable = [
		'doctor_id',
		'vendors_vc_id',
		'shift',
		'on_duty'
	];

	public function doctor()
	{
		return $this->belongsTo(Doctor::class);
	}

	public function vendors_visit_clinic()
	{
		return $this->belongsTo(VendorsVisitClinic::class, 'vendors_vc_id');
	}
}
