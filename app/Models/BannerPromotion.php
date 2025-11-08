<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class BannerPromotion
 * 
 * @property int $id
 * @property string $title
 * @property string $content
 * @property bool $is_active
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class BannerPromotion extends Model
{
	protected $table = 'banner_promotions';

	protected $casts = [
		'is_active' => 'bool'
	];

	protected $fillable = [
		'title',
		'content',
		'is_active'
	];
}
