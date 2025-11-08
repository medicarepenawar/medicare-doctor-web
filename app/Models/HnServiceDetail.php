<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class HnServiceDetail
 * 
 * @property int $id
 * @property int $nurse_id
 * @property int $hn_service_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property HnService $hn_service
 * @property Nurse $nurse
 *
 * @package App\Models
 */
class HnServiceDetail extends Model
{
	protected $table = 'hn_service_details';

	protected $casts = [
		'nurse_id' => 'int',
		'hn_service_id' => 'int'
	];

	protected $fillable = [
		'nurse_id',
		'hn_service_id'
	];

	public function hn_service()
	{
		return $this->belongsTo(HnService::class);
	}

	public function nurse()
	{
		return $this->belongsTo(Nurse::class);
	}
}
