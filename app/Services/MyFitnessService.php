<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class MyFitnessService
{
    /**
     * @var string[]
     */
    protected array $headers;

    /**
     * @param User $user
     *
     * @return Response
     */
    public function login(User $user): Response
    {
        $this->prepareHeaders();
        $credentials = [
            'client_id' => config('myfitness.client_id'),
            'client_secret' => config('myfitness.client_secret'),
            'grant_type' => 'password',
            'username' => $user->email,
            'password' => $user->password,
            'push_token' => config('myfitness.push_token'),
        ];
        return Http::withHeaders($this->headers)->asForm()->post('https://api.myfitness.ee/oauth/token', $credentials);
    }

    /**
     * @param array $headers
     *
     * @return void
     */
    protected function prepareHeaders(array $headers = []): void
    {
        $this->headers = array_merge([
            'Content-Type' => 'application/x-www-form-urlencoded',
            'User-Agent' => 'MyFitness/26 CFNetwork/1399 Darwin/22.1.0',
            'Connection' => 'keep-alive',
            'language-Id' => 'ru',
            'Accept' => '*/*',
            'Accept-Language' => 'ru',
            'country-Id' => 'lv',
        ], $headers);
    }
}
