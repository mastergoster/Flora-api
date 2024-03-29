<?php

namespace Tests\Unit\Models;

use App\Models\Invoice;
use App\Models\Message;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_user()
    {
        $userToCreate = [
          'first_name' => 'John',
          'last_name' => 'Doe',
          'email' => 'john@example.com',
          'profile_picture_path' => '/path/to/image.jpg',
          'attendance_pin' => '1234',
          'phone_number' => '1234567890',
          'postal_code' => '12345',
          'street' => 'Street 1',
          'city' => 'City',
          'society' => 'Society',
          'biography' => 'Biography',
          'is_hidden' => false,
        ];

        $user = User::factory()->create($userToCreate);

        $this->assertDatabaseHas('users', $userToCreate);
    }

    /** @test */
    public function it_has_non_editable_invoices()
    {
        $user = User::factory()->create();
        $editableInvoice = Invoice::factory()->create(['user_id' => $user->id, 'is_editable' => true]);
        $nonEditableInvoice = Invoice::factory()->create(['user_id' => $user->id, 'is_editable' => false]);

        $this->assertFalse($user->invoices->contains($editableInvoice));
        $this->assertTrue($user->invoices->contains($nonEditableInvoice));
    }

    /** @test */
    public function it_has_messages_for_user_and_roles()
    {
        $user = User::factory()->create();
        $role = Role::create(['name' => 'writer']);
        
        $user->assignRole('writer');

        $messageForUser = Message::factory()->create(['to_user_id' => $user->id]);
        $messageForRole = Message::factory()->create(['to_role_id' => $role->id]);
        $messageForRole2 = Message::factory()->create(['to_role_id' => $role->id]);
        $messageForOtherUser = Message::factory()->create();

        $this->assertTrue($user->messages->contains($messageForUser));
        $this->assertTrue($user->messages->contains($messageForRole));
        $this->assertTrue($user->messages->contains($messageForRole2));
        $this->assertFalse($user->messages->contains($messageForOtherUser));
    }
}