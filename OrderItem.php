<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class OrderItem extends Model { public $timestamps=false; protected $fillable=['product_id','name_snapshot','unit_price','quantity','line_total']; protected function casts():array{return ['unit_price'=>'decimal:2','line_total'=>'decimal:2'];} }
