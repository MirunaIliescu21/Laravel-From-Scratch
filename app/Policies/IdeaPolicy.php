<?php

namespace App\Policies;

use App\Models\Idea;
use App\Models\User;
use Illuminate\Auth\Access\Response;

/**
 * We create a policy - Authorization using Policy
 * (base) miruna@pink:~/Documents/INFOLOGICA/Laravel/project$ php artisan make:policy
 *
 * ┌ What should the policy be named? ────────────────────────────┐
 * │ IdeaPolicy                                                   │
 * └──────────────────────────────────────────────────────────────┘
 *
 * ┌ What model should this policy apply to? (Optional) ──────────┐
 * │ Idea                                                         │
 * └──────────────────────────────────────────────────────────────┘
 *
 * INFO  Policy [app/Policies/IdeaPolicy.php] created successfully.
 */

class IdeaPolicy
{
    /**
     * Verify if the user logged in is the user who created the idea.
     * $idea->user it gives us the object of the user who created it
     */
    public function update(User $user, Idea $idea)
    {
        //  return $user->id === $idea->user_id ? Response::allow() : Response::denyAsNotFound();
        return $user->is($idea->user);
    }

//    /**
//     * Determine whether the user can create the model.
//     */
//    public function create(User $user)
//    {
//        return $user->isAdmin();
//    }
}
