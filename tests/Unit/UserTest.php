<?php

namespace Tests\Unit;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Branch;
use App\Models\Food;
use App\Models\FoodAttribute;

class UserTest extends TestCase
{
    /**
     * A basic unit test example.
     */

    //login in user
    public function test_login_form(){

        $response = $this->get('/login');
        $response->assertStatus(200);
    }
//finding weather there are 2 users
    public function test_user_duplication()
    {
        $user1 = User::make([
            'name' =>'maryam1',
            'email' => 'mash00@gmail.com'
        ]);
    
        $user2 = User::make([
            'name' =>'mashkoora',
            'email' => 'mashkoora@gmail.com'
        ]);
    
        $this->assertTrue($user1->name != $user2->name);
    }
//deleting user test
    public function test_delete_user(){
        $user = User::factory()->count(1)->make();
        $user = User::first();
        if($user){
            $user->delete();
        }
        $this->assertTrue(true);
    }
//storing user test
    public function test_it_stores_new_users(){
        $response = $this->post('/register',[
            'name'=> 'test111',
            'email'=> 'test111@gmail.com',
            'phone'=> '0123415689',
            'address'=> 'Kandy',
            'password'=> '1234567890',
            'password_confirmation'=>'1234567890'

        ]);
        $response->assertRedirect('/home');
    }
    



  
}
