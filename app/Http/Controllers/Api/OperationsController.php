<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HistoryBalance;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OperationsController extends Controller
{
    
/**
 * @OA\Schema(
 *      title="Amount Operations",
 *      description="Amount",
 *      type="object",
 *      schema="Amount",
 *      properties={
 *          @OA\Property(property="amount", type="integer"),
 *          @OA\Property(property="received_user_email", type="string")
 *      },
 *      required={"amount", "received_user_email"}
 * )
 */
    public function amountOperations(Request $request) {
        $receivedUserEmail = $request->received_user_email;
        $user = auth()->user();

        $receivedUser = User::where('email', $receivedUserEmail)->first();

        if($user->email == $receivedUserEmail)
            return response("Kendinize para yollayamazsınız!", 500);

        if(!$receivedUser)
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
                
                $this->saveHistory($user->id, $amount * -1, $receivedUser->id, $user->balance, $user->id);
                $this->saveHistory($user->id, $amount, $receivedUser->id, $receivedUser->balance, $receivedUser->id);
                //$this->saveHistory($receivedUser->id, $amount, $user->id, $receivedUser->balance);
            }
            else
                return response("Yetersiz Bakiye. Bakiyeniz: $user->balance", 500);
    }

    public function saveHistory($sender_id, $amount, $received_id, $balance, $user_id) {
        HistoryBalance::create([
            'sender_user_id' => $sender_id,
            'amount' => $amount,
            'received_user_id' => $received_id,
            'balance' => $balance,
            'user_id' =>$user_id,
        ]);
    }
}
