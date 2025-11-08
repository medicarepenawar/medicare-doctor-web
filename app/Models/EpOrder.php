<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EpOrder
 * 
 * @property int $id
 * @property string|null $notes
 * @property string $status
 * @property string|null $pdf_path
 * @property int $order_id
 * @property int $doctor_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Doctor $doctor
 * @property Order $order
 * @property Collection|Item[] $items
 *
 * @package App\Models
 */
class EpOrder extends Model
{
	protected $table = 'ep_orders';

	protected $casts = [
		'order_id' => 'int',
		'doctor_id' => 'int'
	];

	protected $fillable = [
		'notes',
		'status',
		'pdf_path',
		'order_id',
		'doctor_id'
	];

	public function doctor()
	{
		return $this->belongsTo(Doctor::class);
	}

	public function order()
	{
		return $this->belongsTo(Order::class);
	}

	public function items()
	{
		return $this->belongsToMany(Item::class, 'ep_order_items')
					->withPivot('id', 'drug', 'dosage', 'route', 'frequency', 'amount', 'unit', 'duration', 'supplied_amount')
					->withTimestamps();
	}
}
