<?php
return [
    'active' => env('TWITCH_ACTIVE', false),
    'id' => env('TWITCH_CLIENT_ID', ''),
    'secret' => env('TWITCH_CLIENT_SECRET', ''),
    'redirect_url' => env('TWITCH_REDIRECT_URL', '${APP_URL}/login/twitch/callback'),
    'api_url' => env('TWITCH_API_URL', 'https://api.twitch.tv/helix')
];
