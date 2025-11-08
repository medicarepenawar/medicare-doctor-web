<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class EpViewPopularClinic
 * 
 * @property int|null $id
 * @property string $name
 * @property string $photo
 * @property string $description
 * @property bool $verified
 * @property bool $is_available
 * @property string $street
 * @property int $orders_count
 *
 * @package App\Models
 */
class EpViewPopularClinic extends Model
{
	protected $table = 'ep_view_popular_clinics';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'verified' => 'bool',
		'is_available' => 'bool',
		'orders_count' => 'int'
	];

	protected $fillable = [
		'id',
		'name',
		'photo',
		'description',
		'verified',
		'is_available',
		'street',
		'orders_count'
	];
}
