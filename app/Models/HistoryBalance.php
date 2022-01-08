<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryBalance extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function sender() {
        return $this->belongsTo(User::class, 'sender_user_id')->select('id', 'name', 'email');

    }

    public function receiver() {
        return $this->belongsTo(User::class, 'received_user_id')->select('id', 'name', 'email');
    }
}
