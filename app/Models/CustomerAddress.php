<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CustomerAddress
 * 
 * @property int $id
 * @property int $customer_id
 * @property string $label
 * @property string $street
 * @property string|null $description
 * @property string $latitude
 * @property string $longitude
 * @property bool $is_selected
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Customer $customer
 *
 * @package App\Models
 */
class CustomerAddress extends Model
{
	protected $table = 'customer_addresses';

	protected $casts = [
		'customer_id' => 'int',
		'is_selected' => 'bool'
	];

	protected $fillable = [
		'customer_id',
		'label',
		'street',
		'description',
		'latitude',
		'longitude',
		'is_selected'
	];

	public function customer()
	{
		return $this->belongsTo(Customer::class);
	}
}
