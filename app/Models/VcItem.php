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
 * Class VcItem
 * 
 * @property int $id
 * @property int $vendors_vc_id
 * @property int $item_id
 * @property float $price
 * @property int $stock
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * 
 * @property Item $item
 * @property VendorsVisitClinic $vendors_visit_clinic
 * @property Collection|VcOrderItemDetail[] $vc_order_item_details
 *
 * @package App\Models
 */
class VcItem extends Model
{
	use SoftDeletes;
	protected $table = 'vc_items';

	protected $casts = [
		'vendors_vc_id' => 'int',
		'item_id' => 'int',
		'price' => 'float',
		'stock' => 'int'
	];

	protected $fillable = [
		'vendors_vc_id',
		'item_id',
		'price',
		'stock'
	];

	public function item()
	{
		return $this->belongsTo(Item::class);
	}

	public function vendors_visit_clinic()
	{
		return $this->belongsTo(VendorsVisitClinic::class, 'vendors_vc_id');
	}

	public function vc_order_item_details()
	{
		return $this->hasMany(VcOrderItemDetail::class);
	}
}
