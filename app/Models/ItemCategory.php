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
 * Class ItemCategory
 * 
 * @property int $id
 * @property string $name
 * @property string $code
 * @property string|null $icon
 * @property string $status
 * @property int $item_main_category_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * 
 * @property ItemMainCategory $item_main_category
 * @property Collection|Item[] $items
 * @property Collection|PhItem[] $ph_items
 *
 * @package App\Models
 */
class ItemCategory extends Model
{
	use SoftDeletes;
	protected $table = 'item_categories';

	protected $casts = [
		'item_main_category_id' => 'int'
	];

	protected $fillable = [
		'name',
		'code',
		'icon',
		'status',
		'item_main_category_id'
	];

	public function item_main_category()
	{
		return $this->belongsTo(ItemMainCategory::class);
	}

	public function items()
	{
		return $this->hasMany(Item::class, 'category_id');
	}

	public function ph_items()
	{
		return $this->hasMany(PhItem::class, 'category_id');
	}
}
