<?php
namespace Tests\Feature;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
class AccessControlTest extends TestCase {
 use RefreshDatabase;
 public function test_public_menu_is_available_without_login():void {$this->get('/menu')->assertOk();}
 public function test_staff_cannot_open_admin_management_routes():void {$staff=User::create(['name'=>'Staff','email'=>'staff@example.test','password'=>'long-password-for-test','role'=>'staff','is_active'=>true]);$this->actingAs($staff)->get('/manage/orders')->assertForbidden();}
 public function test_customer_cannot_open_admin_management_routes():void {$customer=User::create(['name'=>'Customer','email'=>'customer@example.test','password'=>'long-password-for-test','role'=>'customer','is_active'=>true]);$this->actingAs($customer)->get('/manage/products')->assertForbidden();}
 public function test_login_role_choice_does_not_override_assigned_role():void {$customer=User::create(['name'=>'Customer','email'=>'customer@example.test','password'=>'long-password-for-test','role'=>'customer','is_active'=>true]);$this->post('/login',['email'=>$customer->email,'password'=>'long-password-for-test','role'=>'admin'])->assertSessionHasErrors('email');$this->assertGuest();}
}
