<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TcOrder
 * 
 * @property int $id
 * @property int $order_id
 * @property int $doctor_id
 * @property int $patient_id
 * @property string $status
 * @property string|null $issue
 * @property string|null $reject_reason
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Doctor $doctor
 * @property Order $order
 * @property Customer $customer
 * @property Collection|TcMedicalNote[] $tc_medical_notes
 * @property Collection|TcPrescription[] $tc_prescriptions
 * @property Collection|TcVideoCall[] $tc_video_calls
 *
 * @package App\Models
 */
class TcOrder extends Model
{
	protected $table = 'tc_orders';

	protected $casts = [
		'order_id' => 'int',
		'doctor_id' => 'int',
		'patient_id' => 'int'
	];

	protected $fillable = [
		'order_id',
		'doctor_id',
		'patient_id',
		'status',
		'issue',
		'reject_reason'
	];

	public function doctor()
	{
		return $this->belongsTo(Doctor::class);
	}

	public function order()
	{
		return $this->belongsTo(Order::class);
	}

	public function customer()
	{
		return $this->belongsTo(Customer::class, 'patient_id');
	}

	public function tc_medical_notes()
	{
		return $this->hasMany(TcMedicalNote::class);
	}

	public function tc_prescriptions()
	{
		return $this->hasMany(TcPrescription::class);
	}

	public function tc_video_calls()
	{
		return $this->hasMany(TcVideoCall::class);
	}
}
