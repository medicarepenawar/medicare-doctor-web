<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class HnService
 * 
 * @property int $id
 * @property string $name
 * @property string $description
 * @property float $price
 * @property int|null $duration
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|HnOrderServiceDetail[] $hn_order_service_details
 * @property Collection|HnServiceDetail[] $hn_service_details
 *
 * @package App\Models
 */
class HnService extends Model
{
	protected $table = 'hn_services';

	protected $casts = [
		'price' => 'float',
		'duration' => 'int'
	];

	protected $fillable = [
		'name',
		'description',
		'price',
		'duration'
	];

	public function hn_order_service_details()
	{
		return $this->hasMany(HnOrderServiceDetail::class);
	}

	public function hn_service_details()
	{
		return $this->hasMany(HnServiceDetail::class);
	}
}
