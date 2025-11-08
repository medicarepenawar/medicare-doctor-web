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
 * Class PhItem
 * 
 * @property int $id
 * @property int $category_id
 * @property int $vendor_pharmacy_id
 * @property int $item_id
 * @property string $name
 * @property string|null $description
 * @property string|null $code
 * @property float $price
 * @property string $unit
 * @property string|null $packing
 * @property string|null $composition
 * @property string|null $side_effect
 * @property string|null $dose
 * @property string|null $usage
 * @property string|null $attention
 * @property string|null $item_reg_no
 * @property int $balance
 * @property string|null $image
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * 
 * @property ItemCategory $item_category
 * @property Item $item
 * @property VendorPharmacy $vendor_pharmacy
 * @property Collection|PhOrderItemDetail[] $ph_order_item_details
 *
 * @package App\Models
 */
class PhItem extends Model
{
	use SoftDeletes;
	protected $table = 'ph_items';

	protected $casts = [
		'category_id' => 'int',
		'vendor_pharmacy_id' => 'int',
		'item_id' => 'int',
		'price' => 'float',
		'balance' => 'int'
	];

	protected $fillable = [
		'category_id',
		'vendor_pharmacy_id',
		'item_id',
		'name',
		'description',
		'code',
		'price',
		'unit',
		'packing',
		'composition',
		'side_effect',
		'dose',
		'usage',
		'attention',
		'item_reg_no',
		'balance',
		'image'
	];

	public function item_category()
	{
		return $this->belongsTo(ItemCategory::class, 'category_id');
	}

	public function item()
	{
		return $this->belongsTo(Item::class);
	}

	public function vendor_pharmacy()
	{
		return $this->belongsTo(VendorPharmacy::class);
	}

	public function ph_order_item_details()
	{
		return $this->hasMany(PhOrderItemDetail::class);
	}
}
