<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Appointment
 * 
 * @property int $id
 * @property int $created_by
 * @property int $appointed_by
 * @property string $created_by_name
 * @property string $appointed_by_name
 * @property Carbon $appointment_date
 * @property string $location
 * @property string|null $notes
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property User $user
 *
 * @package App\Models
 */
class Appointment extends Model
{
	protected $table = 'appointments';

	protected $casts = [
		'created_by' => 'int',
		'appointed_by' => 'int',
		'appointment_date' => 'datetime'
	];

	protected $fillable = [
		'created_by',
		'appointed_by',
		'created_by_name',
		'appointed_by_name',
		'appointment_date',
		'location',
		'notes'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'created_by');
	}
}
