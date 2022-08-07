<?php

namespace App\Http\Services\Twitch;

use App\HelperTraits\Serializer;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\DB;
use TwitchApi\HelixGuzzleClient;
use TwitchApi\Resources\StreamsApi;
use TwitchApi\TwitchApi;

class TwitchService
{
    use Serializer;

    /**
     * @var TwitchApi $twitchApi
     */
    private TwitchApi $twitchApi;
    /**
     * @var mixed $token
     */
    private mixed $token;

    public function __construct()
    {
        $this->getTwitchApi();
        $oauth = $this->twitchApi->getOauthApi();
        $access_token = $oauth->getAppAccessToken($twitch_scopes ?? '');
        $this->token = json_decode($access_token->getBody()->getContents());
    }

    /**
     * @return void
     */
    private function getTwitchApi(): void
    {
        $this->twitchApi = new TwitchApi((new HelixGuzzleClient(config('twitch.id'))), config('twitch.id'), config('twitch.secret'));
    }

    /**
     * @return array
     * @throws GuzzleException
     */
    public function getStreamsList(): array
    {
        $streams = [];
        $after = null;
        for ($page = 0; $page < 10; $page++) {
            $streamList = $this->getStreamList($after);
            $after = $streamList['pagination']['cursor'];
            $streams = array_merge($streams, $streamList['data']);
        }
        return $streams;
    }

    /**
     * According to Twitch documentation:
     * The maximum limit of streams in response is 100 rows.
     * All data are sorted by viewers
     *
     * @param string|null $after
     * @return array
     * @throws GuzzleException
     */
    public function getStreamList(string $after = null): array
    {
        $streams = $this->stream()->getStreams(bearer: $this->token->access_token, first: 100, after: $after);
        return $this->unserialize($streams->getBody()->getContents());

    }

    private function stream(): StreamsApi
    {
        return $this->twitchApi->getStreamsApi();
    }

    /**
     * @param array $data
     * @return array
     */
    public function shuffleData(array $data = []): array
    {
        $randArr = [];
        $arrLength = count($data);
        while (count($data)) {
            $randPos = mt_rand(0, --$arrLength);
            $randArr[] = $data[$randPos];

            array_splice($data, $randPos, ($randPos == $arrLength ? 1 : $randPos - $arrLength));
        }
        return $randArr;

    }

    /**
     * @param array $streamList
     * @param string $index
     * @return array
     */
    public function filterStreams(array $streamList, string $index = ''): array
    {
        $array = [];
        foreach ($streamList as $stream) {
            unset($stream[$index]);
            $array[] = $stream;
        }
        return $array;
    }

    /**
     * @return void
     */
    public function clearStreamsTable(): void
    {
        DB::statement("SET foreign_key_checks=0");
        DB::table('streams')->truncate();
        DB::statement("SET foreign_key_checks=1");
    }


}
