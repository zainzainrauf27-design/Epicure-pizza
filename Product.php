<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Product extends Model { protected $fillable=['category_id','name','slug','description','price','image_path','is_available','is_featured','sort_order']; protected function casts():array{return ['price'=>'decimal:2','is_available'=>'boolean','is_featured'=>'boolean'];} public function category(){return $this->belongsTo(Category::class);} }
