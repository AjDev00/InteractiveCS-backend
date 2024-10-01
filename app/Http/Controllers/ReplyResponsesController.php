<?php

namespace App\Http\Controllers;

use App\Models\ReplyResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReplyResponsesController extends Controller
{
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'reply_id' => 'required|exists:replies,id',
            'comment_id' => 'required|exists:comments,id',
            'reply_response' => 'required|min:3'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => 'Please fix all the errors!',
                'errors' => $validator->errors()
            ]);
        }

        $replyResponse = new ReplyResponses();
        $replyResponse->reply_id = $request->reply_id;
        $replyResponse->comment_id = $request->comment_id;
        $replyResponse->reply_response = $request->reply_response;
        $replyResponse->save();

        return response()->json([
            'status' => true,
            'message' => 'Replied successfully!',
            'data' => $replyResponse
        ]);
    }


    //update reply.
    public function update($id, Request $request){
        $replyResponse = ReplyResponses::find($id);

        if($replyResponse === null){
            return response()->json([
                'status' => false,
                'message' => 'Cannot find reply!'
            ]);
        }

        $validator = Validator::make($request->all(), [
            'reply_id' => 'required|exists:replies,id',
            'comment_id' => 'required|exists:comments,id',
            'reply_response' => 'required|min:3'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => 'Please fix the errors',
                'errors' => $validator->errors()
            ]);
        }

        $replyResponse->reply_id = $request->reply_id;
        $replyResponse->comment_id = $request->comment_id;
        $replyResponse->reply_response = $request->reply_response;
        $replyResponse->save();

        return response()->json([
            'status' => true,
            'message' => "Reply updated",
            'data' => $replyResponse
        ]);
    }


    //show a single reply
    public function show($id){
        $replyResponse = ReplyResponses::find($id);

        if($replyResponse === null){
            return response()->json([
                'status' => false,
                'message' => 'Reply not found!'
            ]);
        }

        return response()->json([
            'status' => true,
            'data' => $replyResponse
        ]);
    }


    //delete replies.
    public function destroy($id){
        $replyResponse = ReplyResponses::find($id);

        if($replyResponse === null){
            return response()->json([
                'status' => false,
                'message' => 'Cannot find reply!'
            ]);
        }

        $replyResponse->delete();

        return response()->json([
            'status' => true,
            'message' => 'Deleted Successfully!'
        ]);
    }
}
