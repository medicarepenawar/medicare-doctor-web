<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Customer
 * 
 * @property int $id
 * @property string $name
 * @property string|null $nric
 * @property string|null $passport_number
 * @property string|null $other_id
 * @property string $gender
 * @property string $nationality
 * @property Carbon $birth_date
 * @property string $phone_number
 * @property string $photo_card
 * @property string $address
 * @property string|null $postcode
 * @property string $city
 * @property string $state
 * @property string|null $photo
 * @property bool $verified
 * @property int|null $customer_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Customer|null $customer
 * @property Collection|CustomerAddress[] $customer_addresses
 * @property Collection|Customer[] $customers
 * @property Collection|Order[] $orders
 * @property Collection|TcOrder[] $tc_orders
 * @property Collection|VcOrder[] $vc_orders
 *
 * @package App\Models
 */
class Customer extends Model
{
	protected $table = 'customers';

	protected $casts = [
		'birth_date' => 'datetime',
		'verified' => 'bool',
		'customer_id' => 'int'
	];

	protected $fillable = [
		'name',
		'nric',
		'passport_number',
		'other_id',
		'gender',
		'nationality',
		'birth_date',
		'phone_number',
		'photo_card',
		'address',
		'postcode',
		'city',
		'state',
		'photo',
		'verified',
		'customer_id'
	];

	public function customer()
	{
		return $this->belongsTo(Customer::class);
	}

	public function customer_addresses()
	{
		return $this->hasMany(CustomerAddress::class);
	}

	public function customers()
	{
		return $this->hasMany(Customer::class);
	}

	public function orders()
	{
		return $this->hasMany(Order::class);
	}

	public function tc_orders()
	{
		return $this->hasMany(TcOrder::class, 'patient_id');
	}

	public function vc_orders()
	{
		return $this->hasMany(VcOrder::class, 'patient_id');
	}
}
