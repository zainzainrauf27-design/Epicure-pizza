<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Reservation extends Model { protected $fillable=['reference','user_id','name','phone','reservation_at','guests','notes','status','reviewed_by']; protected function casts():array{return ['reservation_at'=>'datetime'];} public function customer(){return $this->belongsTo(User::class,'user_id');} }
