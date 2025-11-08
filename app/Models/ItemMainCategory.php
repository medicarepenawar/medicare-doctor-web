<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ItemMainCategory
 * 
 * @property int $id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * 
 * @property Collection|ItemCategory[] $item_categories
 *
 * @package App\Models
 */
class ItemMainCategory extends Model
{
	use SoftDeletes;
	protected $table = 'item_main_categories';

	protected $fillable = [
		'name'
	];

	public function item_categories()
	{
		return $this->hasMany(ItemCategory::class);
	}
}
