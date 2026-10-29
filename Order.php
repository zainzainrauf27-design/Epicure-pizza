<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Order extends Model { protected $fillable=['reference','user_id','customer_name','phone','fulfillment','address','notes','payment_method','subtotal','total','status','payment_status']; protected function casts():array{return ['subtotal'=>'decimal:2','total'=>'decimal:2'];} public function items(){return $this->hasMany(OrderItem::class);} public function customer(){return $this->belongsTo(User::class,'user_id');} public function history(){return $this->hasMany(OrderStatusHistory::class);} public function payments(){return $this->hasMany(PaymentSubmission::class);} }
