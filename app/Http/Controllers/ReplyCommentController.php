<?php

namespace App\Http\Controllers;

use App\Models\Replies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReplyCommentController extends Controller
{
    //show all comments.
    public function index(){
        $replyComment = Replies::all();

        return response()->json([
            'status' => true,
            'data' => $replyComment,
        ]);
    }

    //insert replies.
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'comment_id' => 'required|exists:comments,id',
            'reply_comment' => 'required|min:3',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => 'Please fix the errors',
                'errors' => $validator->errors()
            ]);
        }

        $replyComment = new Replies();

        $replyComment->comment_id = $request->comment_id;
        $replyComment->reply_comment = $request->reply_comment;
        $replyComment->save();

        return response()->json([
            'status' => true,
            'message' => "Reply successfull",
            'data' => $replyComment
        ]);
    }


    //update reply.
    public function update($id, Request $request){
        $replyComment = Replies::find($id);

        if($replyComment === null){
            return response()->json([
                'status' => false,
                'message' => 'Cannot find reply!'
            ]);
        }

        $validator = Validator::make($request->all(), [
            'comment_id' => 'required|exists:comments,id',
            'reply_comment' => 'required|min:3',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => 'Please fix the errors',
                'errors' => $validator->errors()
            ]);
        }

        $replyComment->comment_id = $request->comment_id;
        $replyComment->reply_comment = $request->reply_comment;
        $replyComment->save();

        return response()->json([
            'status' => true,
            'message' => "Reply updated",
            'data' => $replyComment
        ]);
    }


    //show a single reply
    public function show($id){
        $replyComment = Replies::find($id);

        if($replyComment === null){
            return response()->json([
                'status' => false,
                'message' => 'Reply not found!'
            ]);
        }

        return response()->json([
            'status' => true,
            'data' => $replyComment
        ]);
    }


    //delete replies.
    public function destroy($id){
        $replyComment = Replies::find($id);

        if($replyComment === null){
            return response()->json([
                'status' => false,
                'message' => 'Cannot find reply!'
            ]);
        }

        $replyComment->delete();

        return response()->json([
            'status' => true,
            'message' => 'Deleted Successfully!'
        ]);
    }
}
