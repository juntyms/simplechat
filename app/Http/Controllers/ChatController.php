<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function index(Request $request, $id=null)
    {
        //Auth::loginUsingId(env('user_id'));

        $messages = [];
        $otherUser = null;
        $user_id = Auth::user()->id;

        if ($id) {
            $otherUser = User::findOrFail($id);

            $group_id = (Auth::user()->id > $id) ? Auth::user()->id.$id : $id.Auth::user()->id;

            $messages = Chat::where('group_id',$group_id)->get();

            Chat::where('user_id',$id)
                ->where('other_user_id',$user_id)
                ->where('is_read',0)
                ->update([
                    'is_read'=>1
                ]);
        }

        $friends = User::where('id','!=', Auth::user()->id)
                    ->select('*', \DB::raw("(SELECT count(id) FROM chats where chats.other_user_id=$user_id and chats.user_id= users.id and chats.is_read=0) as unread_messages"))
                    ->get();

        return view('chat')
                    ->with('friends',$friends)
                    ->with('messages',$messages)
                    ->with('otherUser',$otherUser)
                    ->with('id',$id);
    }
}