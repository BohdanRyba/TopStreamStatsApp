<?php

declare(strict_types=1);
namespace App\Console\Commands;

use App\Http\Services\Twitch\TwitchService;
use App\Models\Stream;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Console\Command;


class UpdateStreams extends Command
{
    const LOAD_PAGES = 10;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'twitch:streams:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Loading the latest twitch streams.';


    public function __construct(private TwitchService $twitchService)
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     * @throws GuzzleException
     */
    public function handle()
    {
        $this->twitchService->clearStreamsTable();
        $streams = $this->getStreamsList();
        $shuffledData = $this->twitchService->shuffleData($streams);
        foreach ($shuffledData as $stream) {
            Stream::factory()->make($stream)->save();
        }
        return 0;
    }

    /**
     * @return array
     * @throws GuzzleException
     */
    public function getStreamsList(): array
    {
        $streams = [];
        $after = null;
        for ($page = 0; $page < self::LOAD_PAGES; $page++) {
            $streamList = $this->twitchService->getStreamList($after);
            $streamListData = $this->twitchService->filterStreams($streamList['data'], 'tag_ids');
            $after = $streamList['pagination']['cursor'];
            $streams = array_merge($streams, $streamListData);
        }
        return $streams;
    }


}
