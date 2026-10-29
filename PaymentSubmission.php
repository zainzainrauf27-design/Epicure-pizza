<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class PaymentSubmission extends Model { protected $fillable=['user_id','method','transaction_id','amount_claimed','paid_at','evidence_path','note','status','reviewed_by','review_reason','reviewed_at']; protected function casts():array{return ['amount_claimed'=>'decimal:2','paid_at'=>'datetime','reviewed_at'=>'datetime'];} public function order(){return $this->belongsTo(Order::class);} public function customer(){return $this->belongsTo(User::class,'user_id');} }
