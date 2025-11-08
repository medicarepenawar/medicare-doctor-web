<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class VendorsPerson
 * 
 * @property int $id
 * @property string $name
 * @property string $nric
 * @property string $email
 * @property string $phone_number
 * @property string $mmc_number
 * @property string $apc_number
 * @property Carbon $apc_expired
 * @property string $address
 * @property string $type
 * @property string $front_nric_photo
 * @property string $back_nric_photo
 * @property string $apc_certificate_file
 * @property string $mmc_certificate_file
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|VendorsPersonDetail[] $vendors_person_details
 *
 * @package App\Models
 */
class VendorsPerson extends Model
{
	protected $table = 'vendors_person';

	protected $casts = [
		'apc_expired' => 'datetime'
	];

	protected $fillable = [
		'name',
		'nric',
		'email',
		'phone_number',
		'mmc_number',
		'apc_number',
		'apc_expired',
		'address',
		'type',
		'front_nric_photo',
		'back_nric_photo',
		'apc_certificate_file',
		'mmc_certificate_file'
	];

	public function vendors_person_details()
	{
		return $this->hasMany(VendorsPersonDetail::class, 'vendor_person_id');
	}
}
