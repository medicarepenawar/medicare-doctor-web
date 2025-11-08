<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PhViewPopularCategoriesView
 * 
 * @property int $id
 * @property string $name
 * @property string|null $icon
 * @property float|null $total_quantity_sold
 *
 * @package App\Models
 */
class PhViewPopularCategoriesView extends Model
{
	protected $table = 'ph_view_popular_categories_view';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'total_quantity_sold' => 'float'
	];

	protected $fillable = [
		'id',
		'name',
		'icon',
		'total_quantity_sold'
	];
}
