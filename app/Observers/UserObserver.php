<?php

namespace App\Observers;

use App\Models\User;
use Ramsey\Uuid\Uuid;

class UserObserver
{
    public function creating(User $user): void
    {
        $user->uuid = Uuid::uuid4();
    }
}
