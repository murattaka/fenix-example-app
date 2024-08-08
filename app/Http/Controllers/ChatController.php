<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreChatRequest;
use App\Models\Chat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Faker;

class ChatController extends Controller
{
    public function store(StoreChatRequest $request)
    {
        $request->validated();

        $user = auth('sanctum')->user();

        if (empty($request->chat_id)) {
            $chat = Chat::create([
                'user_id' => $user->id,
                'name' => Str::limit(strip_tags($request->message), 50),
            ]);
        } else {
            $chat = Chat::find($request->chat_id);
        }


        $chat->messages()->create(
            [
                'content' => $request->message,
                'status' => 'sent',
            ]
        );

        $faker = Faker\Factory::create();

        $bootResponse = [
            'chat_id' => $chat->id,
            'message' => $faker->sentences(3, true),
        ];

        return response()->json($bootResponse);
    }
}
