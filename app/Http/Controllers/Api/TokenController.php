<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Token\CreateTokenRequest;
use App\Models\User;
use App\Traits\JsonifyResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class TokenController extends Controller
{
    use JsonifyResponse;

    public function __invoke(CreateTokenRequest $request)
    {
        if (!Auth::validate($request->validated()))
            throw ValidationException::withMessages([
                'message' => ['The provided credentials are incorrect.'],
            ]);

        $token = $this->getToken();

        return $this->success(['token' => $token->plainTextToken], message: 'Token success');
    }

    public static function getToken($user = null)
    {
        $user = User::where('email', $user['email'] ?? request()->get('email'))->first();

        return $user->createToken('admin-fetch');
    }
}
