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
 * Class Item
 * 
 * @property int $id
 * @property int $category_id
 * @property string $name
 * @property string|null $description
 * @property string|null $code
 * @property string $unit
 * @property string|null $packing
 * @property string|null $composition
 * @property string|null $side_effect
 * @property string|null $dose
 * @property string|null $usage
 * @property string|null $attention
 * @property string|null $item_reg_no
 * @property string|null $image
 * @property bool $is_approved
 * @property bool $is_poison
 * @property int|null $created_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * 
 * @property ItemCategory $item_category
 * @property User|null $user
 * @property Collection|EpOrder[] $ep_orders
 * @property Collection|PhItem[] $ph_items
 * @property Collection|VcItem[] $vc_items
 *
 * @package App\Models
 */
class Item extends Model
{
	use SoftDeletes;
	protected $table = 'items';

	protected $casts = [
		'category_id' => 'int',
		'is_approved' => 'bool',
		'is_poison' => 'bool',
		'created_by' => 'int'
	];

	protected $fillable = [
		'category_id',
		'name',
		'description',
		'code',
		'unit',
		'packing',
		'composition',
		'side_effect',
		'dose',
		'usage',
		'attention',
		'item_reg_no',
		'image',
		'is_approved',
		'is_poison',
		'created_by'
	];

	public function item_category()
	{
		return $this->belongsTo(ItemCategory::class, 'category_id');
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'created_by');
	}

	public function ep_orders()
	{
		return $this->belongsToMany(EpOrder::class, 'ep_order_items')
					->withPivot('id', 'drug', 'dosage', 'route', 'frequency', 'amount', 'unit', 'duration', 'supplied_amount')
					->withTimestamps();
	}

	public function ph_items()
	{
		return $this->hasMany(PhItem::class);
	}

	public function vc_items()
	{
		return $this->hasMany(VcItem::class);
	}
}
