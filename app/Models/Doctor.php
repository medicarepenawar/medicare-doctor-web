<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Doctor
 * 
 * @property int $id
 * @property string $name
 * @property string $nric
 * @property string $specialist
 * @property string $gender
 * @property string $experience
 * @property string|null $passport_number
 * @property string $phone_number
 * @property string $medical_degree_university
 * @property string $mmc_number
 * @property string $apc_number
 * @property Carbon $apc_expired
 * @property string|null $photo
 * @property string $front_nric_photo
 * @property string $back_nric_photo
 * @property string $apc_certificate_file
 * @property string $mmc_certificate_file
 * @property bool $verified
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|EpOrder[] $ep_orders
 * @property Collection|TcDoctorDetail[] $tc_doctor_details
 * @property Collection|TcOrder[] $tc_orders
 * @property Collection|VcDoctorDetail[] $vc_doctor_details
 * @property Collection|VcOrder[] $vc_orders
 *
 * @package App\Models
 */
class Doctor extends Model
{
	protected $table = 'doctors';

	protected $casts = [
		'apc_expired' => 'datetime',
		'verified' => 'bool'
	];

	protected $fillable = [
		'name',
		'nric',
		'specialist',
		'gender',
		'experience',
		'passport_number',
		'phone_number',
		'medical_degree_university',
		'mmc_number',
		'apc_number',
		'apc_expired',
		'photo',
		'front_nric_photo',
		'back_nric_photo',
		'apc_certificate_file',
		'mmc_certificate_file',
		'verified'
	];

	public function ep_orders()
	{
		return $this->hasMany(EpOrder::class);
	}

	public function tc_doctor_details()
	{
		return $this->hasMany(TcDoctorDetail::class);
	}

	public function tc_orders()
	{
		return $this->hasMany(TcOrder::class);
	}

	public function vc_doctor_details()
	{
		return $this->hasMany(VcDoctorDetail::class);
	}

	public function vc_orders()
	{
		return $this->hasMany(VcOrder::class);
	}
}
