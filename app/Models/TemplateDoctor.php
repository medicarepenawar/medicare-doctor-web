<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TemplateDoctor
 * 
 * @property int $id
 * @property string|null $name
 * @property string|null $nric
 * @property string|null $gender
 * @property string|null $photo
 * @property string|null $front_nric_image
 * @property string|null $back_nric_image
 * @property Carbon|null $dob
 * @property string|null $nationality
 * @property string|null $passport_number
 * @property string|null $qualification
 * @property string|null $first_graduate_from
 * @property Carbon|null $first_graduate_year
 * @property string|null $specialist_graduate_from
 * @property Carbon|null $specialist_graduate_year
 * @property string|null $mmc_full_reg_no
 * @property string|null $apc_number
 * @property Carbon|null $apc_expired
 * @property string|null $apc_link
 * @property string|null $apc_image
 * @property string|null $place_of_practice
 * @property string|null $contact_email
 * @property string|null $phone_number
 * @property string|null $home_address
 * @property string|null $home_state
 * @property string|null $home_city
 * @property string|null $home_postcode
 * @property string|null $admin_remark
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class TemplateDoctor extends Model
{
	protected $table = 'template_doctors';

	protected $casts = [
		'dob' => 'datetime',
		'first_graduate_year' => 'datetime',
		'specialist_graduate_year' => 'datetime',
		'apc_expired' => 'datetime'
	];

	protected $fillable = [
		'name',
		'nric',
		'gender',
		'photo',
		'front_nric_image',
		'back_nric_image',
		'dob',
		'nationality',
		'passport_number',
		'qualification',
		'first_graduate_from',
		'first_graduate_year',
		'specialist_graduate_from',
		'specialist_graduate_year',
		'mmc_full_reg_no',
		'apc_number',
		'apc_expired',
		'apc_link',
		'apc_image',
		'place_of_practice',
		'contact_email',
		'phone_number',
		'home_address',
		'home_state',
		'home_city',
		'home_postcode',
		'admin_remark'
	];
}
