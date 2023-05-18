<?php

namespace App\Http\Controllers;

use App\Models\User;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\JsonResponse;
use Laravel\Socialite\Facades\Socialite;
use Nette\Utils\Random;

class LoginController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        config([
            'services.github.redirect' => route('oauth.callback', 'github'),
        ]);
    }
    /**
     * Redirect the user to the Provider authentication page.
     *
     * @param $provider
     * @return JsonResponse
     */
    public function redirectToProvider($provider)
    {
        $validated = $this->validateProvider($provider);
        if (!is_null($validated)) {
            return $validated;
        }
        return response()->json([
            'url' => Socialite::driver($provider)->stateless()->redirect()->getTargetUrl(),
        ]);
    }

    /**
     * Obtain the user information from Provider.
     *
     * @param $provider
     * @return \Illuminate\Contracts\View\View|JsonResponse
     */
    public function handleProviderCallback($provider)
    {
        $validated = $this->validateProvider($provider);
        if (!is_null($validated)) {
            return $validated;
        }
        try {
            $user = Socialite::driver('google')->stateless()->user();
        } catch (RequestException $exception) {
            dd("DEBUG", $exception);
            return response()->json(['error' => 'Invalid credentials provided.'], 422);
        }
       

        $userCreated = User::firstOrCreate(
            [
                'email' => $user->getEmail()
            ],
            [
                'email_verified_at' => now(),
                'name' => $user->getName(),
                'password' => bcrypt(Random::generate()),
                'status' => true,
            ]
        );
        $userCreated->providers()->updateOrCreate(
            [
                'provider' => $provider,
                'provider_id' => $user->getId(),
            ],
            [
                'avatar' => $user->getAvatar()
            ]
        );
        $token = $userCreated->createToken('Api Token')->plainTextToken;

        return view('callback', [
            'name' => $user["name"],
            'email' => $user["email"],
            'id' => $user["id"],
            'token' => $token,
        ]);
    }

    /**
     * @param $provider
     * @return JsonResponse|null
     */
    protected function validateProvider($provider)
    {
        if (!in_array($provider, ['google'])) {
            return response()->json(['error' => 'Please login using google'], 422);
        }

        return null;
    }

    public function success($data, $headers = [])
    {
        return response()->json([
            'status' => 'success',
            'data' => $data
        ], 200, $headers);
    }

    public function error($message, $code)
    {
        return response()->json([
            'status' => 'error',
            'message' => $message
        ], $code);
    }
}