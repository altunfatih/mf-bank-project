<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HistoryBalance;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OperationsController extends Controller
{
    public function amountOperations(Request $request) {
        $receivedUserId = $request->received_user_email;
        $user = auth()->user();

        $receivedUser = User::where('email', $receivedUserId)->first();

        if($user->email == $receivedUserId)
            return response("Kendinize para yollayamazsınız!", 500);

        if($user->email != $receivedUserId)
            return response("Böyle bir kullanıcı bulunamadı", 500);
        
        $amount = $request->amount;
        if ($amount < 1)
            return response("Gönderilecek para 1TL ve üzeri olmalı", 500);
        else
            if($user->balance > $amount) {                   
                $receivedUser->balance += $amount;

                $user->balance -= $amount;
                $user->save();
                $receivedUser->save();
                
                $this->saveHistory($user->id, $amount, $receivedUser);
                $this->saveHistory($receivedUser, $amount * -1, $user->id);
            }
            else
                return response("Yetersiz Bakiye. Bakiyeniz: $user->balance", 500);
    }

    public function saveHistory($sender_id, $amount, $received_id) {
        HistoryBalance::create([
            'sender_user_id' => $sender_id,
            'amount' => $amount,
            'received_user_id' => $received_id,
        ]);
    }
}
