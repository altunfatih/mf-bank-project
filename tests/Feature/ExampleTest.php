<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class ExampleTest extends TestCase
{
    public function test_succsess_login()
    {
        $this->post('/api/login', [
            'email' => 'a@a.com',
            'password' => 'a',
        ])->assertStatus(200);
    }

    public function test_wrong_login()
    {
        $this->post('/api/login', [
            'email' => 'a@aa.com',
            'password' => 'a',
        ])->assertStatus(302);
    }

    public function test_create_user()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get('/')
            ->assertOk();
    }

    public function test_already_user()
    {
        $this->post('api/users', [
            'name' => 'a',
            'email' => 'a@a.com',
            'password' => 'a',
            'balance' => 100
        ])->assertStatus(500);
    }

    public function test_delete_user() 
    {
        $user = User::factory()->create();

        $this->deleteJson('api/users')
            ->assertUnauthorized();

        $this->actingAs($user)
            ->deleteJson('api/users')
            ->assertOk();
    }

    public function test_get_user() 
    {
        $user = User::factory()->create();
        
        $this->getJson('api/users')->assertUnauthorized();

        $this->actingAs($user)->getJson('api/users')->assertOk();
    }

    public function test_amount_operations()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->putJson('api/amountOperations', ['amount' => 10, 'received_user_email' => 'everest@everest.com'])
            ->assertOk();
    }

    public function test_get_history_balance() 
    {
        $user = User::factory()->create();
        
        $this->getJson('api/historyBalance')->assertUnauthorized();

        $this->actingAs($user)->getJson('api/historyBalance')->assertOk();
    }

    public function test_send_negative_money() 
    {
        $user = User::factory()->create();

        $this->actingAs($user)
        ->putJson('api/amountOperations', ['amount' => -10, 'received_user_email' => 'everest@everest.com'])
        ->assertStatus(422);
    }

    public function test_insufficient_balance() 
    {
        $user = User::factory()->create();

        $this->actingAs($user)
        ->putJson('api/amountOperations', ['amount' => 1000, 'received_user_email' => 'everest@everest.com'])
        ->assertStatus(500);
    }
    
    public function test_send_money_to_yourself() 
    {
        $user = User::factory()->create();

        $this->actingAs($user)
        ->putJson('api/amountOperations', ['amount' => 10, 'received_user_email' => $user->email])
        ->assertStatus(500);
    }
}
