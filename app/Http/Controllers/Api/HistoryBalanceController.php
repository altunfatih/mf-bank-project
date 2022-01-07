<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HistoryBalance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HistoryBalanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userAuth = auth()->user();
        //$receivedUserId = $request->received_user_email;
        //$receivedUser = User::where('email', $receivedUserId)->first();
        
        //$user = HistoryBalance::find($userAuth);

        //$user = HistoryBalance::where('sender_user_id', $userAuth->id)->get();

        $user = DB::table('history_balances')->where('sender_user_id', '=', $userAuth->id)->get(); 

        return response($user, 200);
    }
}
