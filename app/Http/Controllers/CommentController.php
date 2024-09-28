<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    //show all comments.
    public function index(){
       $comments = Comment::with("replies")->get();

        return response()->json([
            'status' => true,
            'data' => $comments,
        ]);
    }



    //insert comments.
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'user_comment' => 'required|min:3',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => 'Please fix errors',
                'errors' => $validator->errors(),
            ]);
        }

        $comment = new Comment();
        $comment->user_comment = $request->user_comment;
        $comment->save();

        return response()->json([
            'status' => true,
            'message' => 'Comment Inserted Successfully',
            'data' => $comment,
            'comment_id' => $comment->id,
        ]);
    }


    //update a comment.
    public function update($id, Request $request){
        $comment = Comment::find($id);

        if($comment === null){
            return response()->json([
                'status' => false,
                'message' => 'Comment not found!'
            ]);
        }

        $validator = Validator::make($request->all(), [
            'user_comment' => 'required|min:3',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => 'Please fix the errors',
                'errors' => $validator->errors()
            ]);
        }

        $comment->user_comment = $request->user_comment;
        $comment->save();

        return response()->json([
            'status' => true,
            'message' => 'Comment Updated Successfully',
            'data' => $comment,
        ]);
    }


    //get a single comment.
    public function show($id){
        $comment = Comment::find($id);

        if($comment === null){
            return response()->json([
                'status' => false,
                'message' => 'Comment not found!'
            ]);
        }

        return response()->json([
            'status' => true,
            'data' => $comment
        ]);
    }


    //delete a comment.
    public function destroy($id){
        $comment = Comment::find($id);

        if($comment === null){
            return response()->json([
                'status' => false,
                'message' => 'Comment not found!',
            ]);
        }

        $comment->delete();
        return response()->json([
            'status' => true,
            'message' => 'Comment deleted!'
        ]);
    }

    //add likes.
    // public function addLike($id, Request $request){
    //     $comment = Comment::find($id);

    //     if($comment === null){
    //         return response()->json([
    //             'status' => false,
    //             'message' => 'This comment cannot be found'
    //         ]);
    //     }

    //     $comment->likes = $request->likes;


    //     return response()->json([
    //         'status' => true,
    //         'data' => $like
    //     ]);
    // }
}
