<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class OrderType
 * 
 * @property int $id
 * @property string $name
 * @property string $code
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Order[] $orders
 *
 * @package App\Models
 */
class OrderType extends Model
{
	protected $table = 'order_types';

	protected $fillable = [
		'name',
		'code'
	];

	public function orders()
	{
		return $this->hasMany(Order::class);
	}
}
