<?php

namespace App\Http\Controllers\Oauth;

use App\Http\Controllers\Controller;
use App\Models\User as UserModel;
use Exception;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\RedirectResponse as RedirectResponseAlias;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Contracts\User;
use Symfony\Component\HttpFoundation\RedirectResponse;

class Socialize extends Controller
{
    const TABLE_PREFIX = 'provider_';

    /**
     * @param Request $request
     * @param string|null $driver
     * @return Authenticatable
     * @throws Exception
     */
    public function callback(Request $request, string $driver = null): Authenticatable
    {
        $customer = $this->getSocializeProvider($driver)->user();
        if (!$customer->getId()) {
            throw new Exception('Customer not found.');
        }

        return $this->login($customer);
    }

    /**
     * @throws Exception
     */
    public function getSocializeProvider(string $driver = null)
    {
        return match ($driver) {
            'twitch' => new Twitch,
            default => $this,
        };
    }

    /**
     * @param User $customer
     * @param string|null $driver
     * @return Authenticatable|null
     * @throws Exception
     */
    private function login(User $customer, string $driver = null): ?Authenticatable
    {
        $provider = $this->getSocializeProvider($driver);

        $user = $provider->createUser($customer);

        Auth::login($user);

        return Auth::user();
    }

    /**
     * @param User $user
     * @return mixed
     */
    public function createUser(User $user): mixed
    {
        return UserModel::updateOrCreate([
            self::TABLE_PREFIX . 'id' => $user->id,], [
            'name' => $user->name,
            'email' => $user->email,
            self::TABLE_PREFIX . 'token' => $user->token,
            self::TABLE_PREFIX . 'refresh_token' => $user->refreshToken,
        ]);
    }

    /**
     * @param Request $request
     * @param string|null $driver
     * @return RedirectResponseAlias|RedirectResponse
     * @throws Exception
     */
    public function redirect(Request $request, string $driver = null): RedirectResponse|RedirectResponseAlias
    {
        return $this->getSocializeProvider($driver)->redirect();
    }

    /**
     * @return string
     */
    private function getTablePrefix(): string
    {
        return self::TABLE_PREFIX;
    }
}
