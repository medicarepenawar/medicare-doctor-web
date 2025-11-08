<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class NurseStatus
 * 
 * @property int $id
 * @property int $nurse_id
 * @property bool $is_active
 * @property float|null $latitude
 * @property float|null $longitude
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Nurse $nurse
 *
 * @package App\Models
 */
class NurseStatus extends Model
{
	protected $table = 'nurse_statuses';

	protected $casts = [
		'nurse_id' => 'int',
		'is_active' => 'bool',
		'latitude' => 'float',
		'longitude' => 'float'
	];

	protected $fillable = [
		'nurse_id',
		'is_active',
		'latitude',
		'longitude'
	];

	public function nurse()
	{
		return $this->belongsTo(Nurse::class);
	}
}
