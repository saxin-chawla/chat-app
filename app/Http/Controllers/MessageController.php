<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    //
    public function messageStore(Request $request , $sid , $rid , $message ){

        $msg = new Message();
        $msg->sendersId = $sid ;
        $msg->receiversId = $rid ;
        $msg->messages = $message ;
        $msg->save();
        return response()->json(['status'=>true]);
    }
    
    public function fetchMessages(Request $request, $sid, $rid)
{
  $messages = Message::where(function ($query) use ($rid, $sid) {
    $query->where('receiversId', $rid)
          ->orWhere('sendersId', $rid);
  })->where(function ($query) use ($rid, $sid) {
    $query->where('receiversId', $sid)
          ->orWhere('sendersId', $sid);
  })->get();

  $user = User::where('id', $rid)->first();

  if ($request->ajax()) {
    return view('chat_list', ['messages' => $messages, 'user' => $user]);
  } else {
    return view('chat', ['messages' => $messages, 'user' => $user]);
  }
}



  public function checkNewMessages(Request $request , $sid, $rid)
  {
    $lastCheckedTimestamp = $request->input('lastCheckedTimestamp', 0);

  $hasNewMessages = Message::where(function ($query) use ($rid, $sid, $lastCheckedTimestamp) {
    $query->where('receiversId', $rid)
          ->orWhere('sendersId', $rid);
  })->where(function ($query) use ($rid, $sid, $lastCheckedTimestamp) {
    $query->where('receiversId', $sid)
          ->orWhere('sendersId', $sid);
  })->where('created_at', '>', date('Y-m-d H:i:s', $lastCheckedTimestamp))->exists();

  return response()->json(['hasNewMessages' => $hasNewMessages]);
  }

    
    
}
