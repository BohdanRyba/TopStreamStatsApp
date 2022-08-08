<?php

declare(strict_types=1);
namespace App\Http\Controllers\Oauth;

use App\Models\User as UserModel;
use Illuminate\Http\RedirectResponse as RedirectResponseAlias;
use Laravel\Socialite\Contracts\Provider;
use Laravel\Socialite\Contracts\User;
use Laravel\Socialite\Facades\Socialite;

class Twitch implements Provider
{
    const DRIVER = 'twitch';
    const TABLE_PREFIX = 'twitch_';

    /**
     * @inheritdoc
     */
    public function user(): User
    {
        return Socialite::driver(self::DRIVER)->user();
    }

    /**
     * @inheritdoc
     */
    public function redirect(): RedirectResponseAlias
    {
        return Socialite::driver(self::DRIVER)->redirect();
    }

    /**
     * @return string
     */
    public function getTablePrefix(): string
    {
        return self::TABLE_PREFIX;
    }

    /**
     * @param object $user
     * @return mixed
     */
    public function createUser(object $user): mixed
    {
        return UserModel::updateOrCreate([
            self::TABLE_PREFIX . 'id' => $user->id,], [
            'avatar' => $user->avatar,
            'name' => $user->name,
            'email' => $user->email,
            self::TABLE_PREFIX . 'token' => $user->token,
            self::TABLE_PREFIX . 'refresh_token' => $user->refreshToken,
        ]);
    }
}
