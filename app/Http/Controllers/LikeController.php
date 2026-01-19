<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function likeToggle(Request $request)
    {
        $userId = Auth::id();
        $post = Post::findOrFail($request->post_id);

        $like = Like::where('sender_id', $userId)
            ->where('post_id', $post->id)
            ->first();

        if ($like) {
            $like->delete();
            $liked = false;
        } else {
            Like::create([
                'sender_id' => $userId,
                'receiver_id' => $post->user_id,
                'post_id' => $post->id
            ]);
            $liked = true;
        }
        $likedCount = $post->likes()->count();

        return response()->json([
            'liked' => $liked,
            'likes_count' => $likedCount
        ]);
    }
}
