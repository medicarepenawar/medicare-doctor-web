<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Nurse
 * 
 * @property int $id
 * @property string $name
 * @property string $nric
 * @property string $gender
 * @property Carbon $birth_date
 * @property string $phone_number
 * @property int $year_experience
 * @property string|null $experience
 * @property string|null $courses_attended
 * @property string $nationality
 * @property Carbon $apc_expired
 * @property string $photo
 * @property string $front_nric_photo
 * @property string $back_nric_photo
 * @property string $nurse_certificate_id
 * @property string $nurse_certificate_file
 * @property string $apc_certificate_file
 * @property bool $verified
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|HnOrder[] $hn_orders
 * @property Collection|HnServiceDetail[] $hn_service_details
 * @property Collection|NurseAddress[] $nurse_addresses
 * @property Collection|NurseStatus[] $nurse_statuses
 *
 * @package App\Models
 */
class Nurse extends Model
{
	protected $table = 'nurses';

	protected $casts = [
		'birth_date' => 'datetime',
		'year_experience' => 'int',
		'apc_expired' => 'datetime',
		'verified' => 'bool'
	];

	protected $fillable = [
		'name',
		'nric',
		'gender',
		'birth_date',
		'phone_number',
		'year_experience',
		'experience',
		'courses_attended',
		'nationality',
		'apc_expired',
		'photo',
		'front_nric_photo',
		'back_nric_photo',
		'nurse_certificate_id',
		'nurse_certificate_file',
		'apc_certificate_file',
		'verified'
	];

	public function hn_orders()
	{
		return $this->hasMany(HnOrder::class);
	}

	public function hn_service_details()
	{
		return $this->hasMany(HnServiceDetail::class);
	}

	public function nurse_addresses()
	{
		return $this->hasMany(NurseAddress::class);
	}

	public function nurse_statuses()
	{
		return $this->hasMany(NurseStatus::class);
	}
}
