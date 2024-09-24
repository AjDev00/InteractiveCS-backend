<?php

namespace App\Http\Controllers;

use App\Models\RepliesOfReplies;
use Illuminate\Http\Request;

class ReplyOfReplyController extends Controller
{
    //show all reply of reply.
    public function index(){
        $replyOfReply = RepliesOfReplies::all();

        return response()->json([
            'status' => true,
            'data' => $replyOfReply,
        ]);
    }
}
