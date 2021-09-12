<?php

namespace App\Http\Controllers\Api\Company\Conversations;

use App\Models\CompanyRepresentative;
use App\Models\User;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\Candidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Requests\Conversations\ConversationRequest;
class ConversationController extends Controller
{

    public function index()
    {
        $representative = CompanyRepresentative::where('id' , Auth::user()->userable_id)->first();
        $conversations = Conversation::where('representative_id' , $representative->id)->get();
        foreach($conversations as $conversation){
           $candidate = Candidate::where('id' , $conversation->candidate_id)->first();
           $conversation->candidate = $candidate;
           $conversation->token = User::where('userable_id' ,  $candidate->id)->where('userable_type' , 'App\Models\Candidate')->first()->token;
        }
        return response()->json([
            'conversations' => $conversations,
         
        ], 200);


    }

   

    public function store(ConversationRequest $request , $token)
    {

        try {
            
            $representative = CompanyRepresentative::where('id' , Auth::user()->userable_id)->first();
            $user = User::where('token', $token)->first();
            $candidate = Candidate::where('id' , $user->userable_id)->first();
            $conversation = Conversation::where('candidate_id' , $candidate->id)->where('representative_id' , $representative->id)->first();
            if (isset($conversation)) {
                $messages = Message::where('conversation_id' , $conversation->id)->get();
                $newMessage = Message::create([
                    'message' => $request->message,
                    'conversation_id' => $conversation->id,
                    'to_id' => $candidate->id,
                    'from_id' => $representative->id,
                ]);
                $messages->push($newMessage);
            }
            else{
                $newConversation = Conversation::create([
                    'candidate_id' => $candidate->id,
                    'representative_id' => $representative->id,
                   
                ]);
                $messages = Message::where('conversation_id' , $newConversation->id)->get();

                $newMessage = Message::create([
                    'message' => $request->message,
                    'conversation_id' => $newConversation->id,
                    'to_id' => $candidate->id,
                    'from_id' => $representative->id,
                ]);
                $messages->push($newMessage);
                
            }
            return response()->json([
                'message' => $newMessage,
                'messages' =>  $messages,
            ], 201);
            /* return redirect()->route('/get-conversation/98de74b5-a41a-4d11-afa0-837c64240ca8' ); */
           

        } catch (\Throwable $exception) {
          
            return $exception->getMessage();
        }
    }
    
    public function show($token)
    {
        try {
            $user = User::where('token', $token)->first();
            $candidate = Candidate::where('id' , $user->userable_id)->first();
            $representative = CompanyRepresentative::where('id' , Auth::user()->userable_id)->first();
            $conversation = Conversation::where('candidate_id' , $candidate->id)->where('representative_id' , $representative->id)->first();
            
            if (isset($conversation)) {
                $messages = Message::where('conversation_id' , $conversation->id)->get();
          
                foreach($messages as $message){
                    if($message->from_id == $representative->id)
                    {
                        $message->from = $representative;
                    }
                    else{
                        $message->from = Candidate::where('id' , from_id );
                    }
                }
                $conversation->messages = $messages;
          
                return response()->json([
                    'conversation' => $conversation,
                    'destinator' =>  $candidate,
                ], 200);
            }
            else{
                $newConversation = Conversation::create([
                    'candidate_id' => $candidate->id,
                    'representative_id' => $representative->id,
                   
                ]);
                return response()->json([
                    'conversation' => $newConversation,
                    'destinator' =>  $candidate,
                ], 200);
            }
           
           
           

        } catch (\Throwable $exception) {
          
            return $exception->getMessage();
        }
    }

   
    public function destroy($id)
    {

    }
}
