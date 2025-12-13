<?php

namespace App\Services\v1;

use App\Models\Follow;
use App\Models\User;
use App\Models\UserBlock;
use Illuminate\Support\Facades\DB;

class FollowService
{

    public function follow(User $user, $username)
    {
        $followed_user = User::where('username', $username)->firstOrFail();

        // Prevent users from following themselves
        if ($user->id === $followed_user->id) {
            throw new \Exception("You cannot follow yourself.");
        }

        $existing_follow = Follow::where('follower_id', $user->id)
            ->where('followed_id', $followed_user->id)
            ->first();

        if ($existing_follow) {
            throw new \Exception("You are already following this user.");
        }

        Follow::create([
            'follower_id' => $user->id,
            'followed_id' => $followed_user->id,
        ]);
    }


    public function unfollow(User $user, $username)
    {
        $followed_user = User::where('username', $username)->firstOrFail();

        $follow = Follow::where('follower_id', $user->id)
            ->where('followed_id', $followed_user->id)
            ->first();

        if (!$follow) {
            throw new \Exception("You are not following this user.");
        }

        $follow->delete();
    }

    public function block(User $user, $blocked_username)
    {
        $blocked_user = User::where('username', $blocked_username)->firstOrFail();

        if ($user->hasBlocked($blocked_user)) {
            throw new \Exception("User is already blocked.");
        }
        //! DELETE EXISTING FOLLOWS WHEN BLOCKING
        // $this->unfollow($user, $blocked_username);
        // $this->unfollow($blocked_user, $user->username);
        UserBlock::create([
            'blocker_id' => $user->id,
            'blocked_id' => $blocked_user->id,
        ]);
    }
}
