<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    public function replies(){
        return $this->hasMany(Replies::class)->orderBy("created_at", "desc");
    }

    public function replyResponses(){
        return $this->hasMany(ReplyResponses::class)->orderBy("created_at", "asc");
    }
}
