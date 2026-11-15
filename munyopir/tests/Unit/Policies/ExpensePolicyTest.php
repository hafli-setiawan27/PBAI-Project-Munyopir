<?php

namespace Tests\Unit\Policies;

use App\Models\Expense;
use App\Models\User;
use App\Policies\ExpensePolicy;
use PHPUnit\Framework\TestCase;

class ExpensePolicyTest extends TestCase
{
    public function test_owner_can_view_update_and_delete_but_another_user_cannot(): void
    {
        $policy = new ExpensePolicy;
        $owner = new User;
        $owner->id = 1;
        $otherUser = new User;
        $otherUser->id = 2;
        $expense = new Expense;
        $expense->user_id = 1;

        $this->assertTrue($policy->viewAny($owner));
        $this->assertTrue($policy->create($owner));
        $this->assertTrue($policy->view($owner, $expense));
        $this->assertTrue($policy->update($owner, $expense));
        $this->assertTrue($policy->delete($owner, $expense));
        $this->assertFalse($policy->view($otherUser, $expense));
        $this->assertFalse($policy->update($otherUser, $expense));
        $this->assertFalse($policy->delete($otherUser, $expense));
    }
}
