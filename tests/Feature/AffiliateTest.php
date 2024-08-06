<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Sale;


class AffiliateTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function it_can_add_a_new_user()
    {
        $response = $this->post('/add-user', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password',
            'parent_id' => null,
        ]);

        $response->assertRedirect('/');
        $this->assertDatabaseHas('users', ['email' => 'john@example.com']);
    }

    /** @test */
    public function it_can_record_a_sale_and_distribute_commission()
    {
        $parentUser = User::factory()->create([
            'email_verified_at' => now(), // Make sure this field is set
        ]);
        $user = User::factory()->create([
            'parent_id' => $parentUser->id,
            'email_verified_at' => now(),
        ]);
    
        $response = $this->post('/record-sale', [
            'user_id' => $user->id,
            'amount' => 100,
        ]);
    
        $response->assertRedirect('/');
        // Verify the commission distribution
        // e.g., Check commissions or logs
    }
}
