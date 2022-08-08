<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Twitch;

use App\HelperTraits\Serializer;
use App\Http\Controllers\Controller;
use App\Http\Resources\StreamResource;
use App\Http\Resources\V1\DataCollector as SQLDataCollector;
use Illuminate\Http\Request;

class TwitchController extends Controller
{
    use Serializer;


    public function __construct(
        private StreamResource   $streamResource,
        private SQLDataCollector $sqlDataCollector,
    )
    {
    }

    /**
     * @param Request $request
     * @return bool|string
     */
    public function getStreams(Request $request): bool|string
    {
        $data = $this->sqlDataCollector->totalStreamsPerGame();
        return $this->serialize($data);
    }

    /**
     * @param Request $request
     * @return bool|string
     */
    public function getViewers(Request $request): bool|string
    {
        $data = $this->sqlDataCollector->highestViewerCountPerGame();
        return $this->serialize($data);
    }

    /**
     * @param Request $request
     * @return bool|string
     */
    public function getMedians(Request $request): bool|string
    {
        $data = $this->toArray($this->sqlDataCollector->medianAmountViewersPerGame());
        return array_pop($data)['median_val'];
    }

    public function getEvenStreams()
    {
        $data = $this->sqlDataCollector->streamsWithEvenViewers();
        return $this->serialize($data);
    }

    public function getOddStreams(): bool|string
    {
        $data = $this->sqlDataCollector->streamsWithOddViewers();
        return $this->serialize($data);
    }

    public function getSameStreams(): bool|string
    {
        $data = $this->sqlDataCollector->sameAmountViewersStreams();
        return $this->serialize($data);
    }

    public function getTopStreams(Request $request): bool|string
    {
        $data = $this->sqlDataCollector->top100Streams(sort: $request->get('sort'));
        return $this->serialize($data);
    }
}
