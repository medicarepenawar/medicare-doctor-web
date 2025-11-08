<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TcSpecialist
 * 
 * @property int $id
 * @property string $name
 * @property string $icon
 * @property float $price
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|TcDoctorDetail[] $tc_doctor_details
 *
 * @package App\Models
 */
class TcSpecialist extends Model
{
	protected $table = 'tc_specialists';

	protected $casts = [
		'price' => 'float'
	];

	protected $fillable = [
		'name',
		'icon',
		'price'
	];

	public function tc_doctor_details()
	{
		return $this->hasMany(TcDoctorDetail::class);
	}
}
