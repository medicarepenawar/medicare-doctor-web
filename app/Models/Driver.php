<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Driver
 * 
 * @property int $id
 * @property string $name
 * @property string $nric
 * @property string $phone
 * @property string $vehicle_number
 * @property string|null $photo
 * @property string $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Delivery[] $deliveries
 *
 * @package App\Models
 */
class Driver extends Model
{
	protected $table = 'drivers';

	protected $fillable = [
		'name',
		'nric',
		'phone',
		'vehicle_number',
		'photo',
		'status'
	];

	public function deliveries()
	{
		return $this->hasMany(Delivery::class);
	}
}
