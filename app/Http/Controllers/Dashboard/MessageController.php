<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\SendMessageRequest;
use App\Models\Chat;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\Project;
use App\Models\User;
use App\Notifications\NewMessage;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function sms()
    {
        $messages = Chat::where('type', 'sms')->get();

        return view('dashboard.messages.index', compact('messages'));
    }

    public function email()
    {
        $messages = Chat::where('type', 'email')->with('sender', 'receiver')->get();

        return view('dashboard.messages.index', compact('messages'));
    }

    public function show(Message $message)
    {
        return view('dashboard.messages.show', compact('message'));
    }

    public function sendSMS(SendMessageRequest $request)
    {
        $data = $request->validated();
        $data['sender_id'] = auth()->id();

        Chat::create($data);

        // Send SMS
        // Notify
        $arMsg = ' لديك رسالة SMS جديدة  ';
        $enMsg = 'You have a new SMS Message';
        $user = User::find($request->receiver_id);

        $user->notify(new NewMessage($enMsg, $arMsg, '', 'messages.sms', '', false));

        return redirect()->route('dashboard.message.sms')->with('success', trans('site.Message Sent successfully'));
    }

    public function sendEmail(SendMessageRequest $request)
    {
        $data = $request->validated();
        $data['sender_id'] = auth()->id();

        Chat::create($data);

        // Send mail
        // Notify
        $arMsg = ' لديك رسالة ايميل جديدة  ';
        $enMsg = 'You have a new E-mail Message';
        $user = User::find($request->receiver_id);

        $user->notify(new NewMessage($enMsg, $arMsg, '', 'messages.email', '', false));


        return redirect()->route('dashboard.message.email')->with('success', trans('site.Message Sent successfully'));
    }

    public function makeAsRead($id)
    {
        $message = Message::find($id);
        $message->update(['replied_at' => Carbon::now()]);

        return back();
    }

    public function sendSMSForm()
    {
        $users = User::whereType('user')->get();

        return view('dashboard.messages.sendSMS', compact('users'));
    }

    public function sendEmailForm()
    {
        $users = User::whereType('user')->get();

        return view('dashboard.messages.sendEmail', compact('users'));
    }

    public function oldSystem($user_id = null)
    {
        // dd($user_id);
        if(!$user_id) {
            $avatar = '';
            $conversation = 0;
            $messages = [];
            $receiver_id = 0;

            return view('dashboard.messages.system', compact('messages', 'conversation', 'receiver_id', 'avatar'));
        }
        $user = User::find($user_id);
        $avatar = $user->image;
        // create Conversation if not exist
        if (!($conversation = Conversation::where(['user1' => $user->id])->first()->id)) {
            $conversation = new Conversation();
            $conversation->user1 = $user->id;
            $conversation->user2 = 0;
            $conversation->save();
        }
        $messages = Message::with('user')->where(['conversation_id' => $conversation])->orderBy('created_at', 'ASC')->get();
        $reader_id = $user->id;
        Message::makeMessagesAsRead($messages, $reader_id);
//        $otherUsers = User::where('id', '!=', auth()->id())
//            ->whereType('user')
//            ->where('id', '!=', $user->id)
//            ->get();
//        if($request->has('q')) {
//            $otherUsers = User::where('id', '!=', auth()->id())
//                ->whereType('user')
//                ->where('id', '!=', $user->id)
//                ->Where('name', 'like', '%' . $request->get('q') . '%')
//                ->get();
//         // return response()->json(successReturn($otherUsers));
//        }
        $receiver_id = $user->id;

        return view('dashboard.messages.system', compact('messages', 'conversation', 'receiver_id', 'avatar'));
    }

    public function system($user_id = null)
    {
        if(!$user_id) {
            $avatar = '';
            $conversation = 0;
            $messages = [];
            $receiver_id = 0;

            return view('dashboard.messages.system', compact('messages', 'conversation', 'receiver_id', 'avatar'));
        }
        $user = User::find($user_id);
        $avatar = $user->image;
        // create Conversation if not exist
        if (!($conversation = Conversation::where(['user1' => $user->id])->first())) {
            $conversation = new Conversation();
            $conversation->user1 = $user->id;
            $conversation->user2 = 0;
            $conversation->save();
        }
        $conversation = $conversation->id;
        $messages = Message::with('user')->where(['conversation_id' => $conversation])->orderBy('created_at', 'ASC')->get();
        $reader_id = $user->id;
        Message::makeMessagesAsRead($messages, $reader_id);

        $receiver_id = $user->id;
        $data['conversation'] = $conversation;
        $data['receiver_id'] = $receiver_id;
        $data['avatar'] = $user->image;
        $data['messages'] = $messages;


        if( \request()->ajax() ) {
            return successReturn($data);
        }

        return view('dashboard.messages.system', compact('messages', 'conversation', 'receiver_id', 'avatar'));
    }

}
