<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TcPrescription
 * 
 * @property int $id
 * @property int $tc_order_id
 * @property string|null $pdf_path
 * @property string|null $prescription_code
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property TcOrder $tc_order
 * @property Collection|PhOrder[] $ph_orders
 * @property Collection|TcPrescriptionItem[] $tc_prescription_items
 * @property Collection|TcPrescriptionPatient[] $tc_prescription_patients
 *
 * @package App\Models
 */
class TcPrescription extends Model
{
	protected $table = 'tc_prescriptions';

	protected $casts = [
		'tc_order_id' => 'int'
	];

	protected $fillable = [
		'tc_order_id',
		'pdf_path',
		'prescription_code'
	];

	public function tc_order()
	{
		return $this->belongsTo(TcOrder::class);
	}

	public function ph_orders()
	{
		return $this->hasMany(PhOrder::class);
	}

	public function tc_prescription_items()
	{
		return $this->hasMany(TcPrescriptionItem::class);
	}

	public function tc_prescription_patients()
	{
		return $this->hasMany(TcPrescriptionPatient::class);
	}
}
