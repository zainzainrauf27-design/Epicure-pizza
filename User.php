<?php
namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
class User extends Authenticatable {
 use HasFactory, Notifiable;
 protected $fillable=['name','email','phone','password','role','is_active'];
 protected $hidden=['password','remember_token'];
 protected function casts(): array { return ['email_verified_at'=>'datetime','password'=>'hashed','is_active'=>'boolean']; }
 public function orders(){return $this->hasMany(Order::class);}
 public function reservations(){return $this->hasMany(Reservation::class);}
 public function isPrivileged(): bool {return in_array($this->role,['super_admin','admin'],true);}
}
