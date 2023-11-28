<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Food;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        Artisan::call('migrate'); // Run migrations
    }

    /** @test */
    public function it_can_access_admin_dashboard()
    {
        $admin = User::factory()->create(['usertype' => 1]); // Create an admin user
        $this->actingAs($admin)->get('/admin')->assertStatus(200); // Assuming '/admin' is the URL for the admin dashboard
    }

    /** @test */
    public function it_can_view_food_menu()
    {
        $admin = User::factory()->create(['usertype' => 1]); // Create an admin user
        $this->actingAs($admin)->get('/foodmenu')->assertStatus(200); // Assuming '/admin/foodmenu' is the URL for viewing the food menu
    }

    // Add more test cases for other methods here

    /** @test */
    
public function it_can_delete_food()
{
    $admin = User::factory()->create(['usertype' => 1]); // Create an admin user
    $food = Food::factory()->create(); // Create a food item

    // Update the URL to match your application's route for deleting food
    $response = $this->actingAs($admin)->delete('/deleteFood/' . $food->id);

    // Check if the response status code is 302 (redirect)
    $response->assertStatus(302);

    // Assuming you redirect after deleting, check the redirected URL
    $response->assertRedirect('/');

    // Check if the food item is deleted from the database
    $this->assertDatabaseMissing('food', ['id' => $food->id]);
}


}