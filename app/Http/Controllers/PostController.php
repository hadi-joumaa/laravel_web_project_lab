<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function CreatePost(Request $request){
        $validated = $request->validate([
            'content' => ['required','min:10'],
            'image_url' => ['mimes:jpg,jpeg,png','image','nullable','max:2048']
        ]);
        $imageUrl = null;
        if($request->hasFile('image_url')){
            $imageUrl = $request->file('image_url')->store('posts', 'public');

        }
       $post = Post::create([
            'content' => $validated['content'],
             'image_url' => $imageUrl,
            'user_id' => Auth::id(),
        ]);
       if($post){
            return redirect()->route('index')->with("success","Post Created Successfully");
       }
       return redirect()->route('index')->with("error","something went wrong");

    }
    public function deletePost($id){
        $post = Post::findOrFail($id);
        if($post->delete()){
            return redirect()->route('index')->with("success","post deleted successfully");
        }
        return back()->with("error","something went wrong");
    }
    public function logout(){
       if(Auth::logout()){
         return redirect()->route('login');
       }
       return back();


    }
    public function comment(Request $request){
        $validated = $request->validate([
            'post_id' => ['required'],
            'commentContent' => ['required']
        ]);
        $post = Post::findOrFail($validated['post_id']);
        $receiverId = $post->user->id;
        $senderId = Auth::user()->id;
        $commentContent = $validated['commentsContent'];
        $comment = Comment::create([
            'sender_id' => $senderId,
            'receiver_id' => $receiverId,
            'post_id' => $post->id,
            'parent_id' => null,
            'content' => $commentContent
        ]);
        if($comment){
             return response()->json([
            'comments' => '<div class="d-flex gap-2">
                                    <div class="bg-light rounded p-2 w-100">
                                        <strong>' .$post->user->name . '</strong>
                                        <p class="mb-1">' . $commentContent . '</p>
                                        <small class="text-muted">
                                            2 minutes ago · <a href="#" class="reply-btn">Reply</a>
                                        </small>
                                    </div>
                                </div>'
        ]);


        }

        return response()->json(['error' => 'err']);

    }
}
