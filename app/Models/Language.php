<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Language
 * 
 * @property int $id
 * @property string $code
 * @property string $name
 * @property string $name_native
 * @property string $dir
 *
 * @package App\Models
 */
class Language extends Model
{
	protected $table = 'languages';
	public $timestamps = false;

	protected $fillable = [
		'code',
		'name',
		'name_native',
		'dir'
	];
}
