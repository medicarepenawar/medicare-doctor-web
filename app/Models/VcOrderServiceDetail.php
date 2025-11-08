<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class VcOrderServiceDetail
 * 
 * @property int $id
 * @property int $vc_order_id
 * @property string $remarks
 * @property string $known_allergies
 * @property string $doctor_diagnosis
 * @property string $clinical_notes
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property VcOrder $vc_order
 *
 * @package App\Models
 */
class VcOrderServiceDetail extends Model
{
	protected $table = 'vc_order_service_details';

	protected $casts = [
		'vc_order_id' => 'int'
	];

	protected $fillable = [
		'vc_order_id',
		'remarks',
		'known_allergies',
		'doctor_diagnosis',
		'clinical_notes'
	];

	public function vc_order()
	{
		return $this->belongsTo(VcOrder::class);
	}
}
