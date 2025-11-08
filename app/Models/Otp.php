<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Otp
 * 
 * @property int $id
 * @property string $identifier
 * @property string $token
 * @property int $validity
 * @property bool $valid
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Otp extends Model
{
	protected $table = 'otps';

	protected $casts = [
		'validity' => 'int',
		'valid' => 'bool'
	];

	protected $hidden = [
		'token'
	];

	protected $fillable = [
		'identifier',
		'token',
		'validity',
		'valid'
	];
}
