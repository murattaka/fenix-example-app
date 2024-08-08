<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Http\Requests\LoginRequest;
use App\Models\Device;
use Illuminate\Http\JsonResponse;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function auth(AuthRequest $request): JsonResponse
    {
        $request->validated();

        $user = auth('sanctum')->user();

        $device = Device::firstOrCreate(
            ['uuid' => $request->input('device_uuid')],
            [
                'uuid' => $request->input('device_uuid'),
                'user_id' => $user->id,
                'name' => $request->input('device_name'),
                'user_agent' => $request->header('user_agent'),
                'platform' => $request->header('platform'),
            ]
        );

        $user->load(
            'subscription',
            'subscription.product',
            'chats'
        );

        return response()->json($user);
    }

    public function login(LoginRequest $request)
    {
        $request->validated();

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $device = Device::create(
            [
                'uuid' => Str::uuid(),
                'user_id' => $user->id,
                'name' => $request->device_name,
                'user_agent' => $request->header('user_agent'),
                'platform' => $request->header('platform'),
            ]
        );

        $response = [
            'token' => $user->createToken($request->device_name)->plainTextToken,
            'device_uuid' => $device->uuid,
            'user' => $user,
        ];

        return response()->json($response);
    }
}
