<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Models\User;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    private $followService;

    public function __construct(\App\Services\v1\FollowService $followService)
    {
        $this->followService = $followService;
    }


    public function follow(Request $request, $username)
    {
        $this->followService->follow($request->user(), $username);
        return ApiResponse::success('Followed successfully');
    }

    public function unfollow(Request $request, $username)
    {
        $this->followService->unfollow($request->user(), $username);
        return ApiResponse::success('Unfollowed successfully');
    }

    public function block(Request $request, $blocked_username)
    {
        $this->followService->block($request->user(), $blocked_username);
        return ApiResponse::success('User blocked successfully');
    }
}
