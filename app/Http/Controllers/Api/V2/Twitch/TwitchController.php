<?php

declare(strict_types=1);
namespace App\Http\Controllers\Api\V2\Twitch;

use App\HelperTraits\Serializer;
use App\Http\Controllers\Controller;
use App\Http\Resources\V2\DataCollector;
use Illuminate\Http\Request;

class TwitchController extends Controller
{
    use Serializer;


    public function __construct(private DataCollector $dataCollector)
    {
    }

    /**
     * @param Request $request
     * @return bool|string
     */
    public function getStreams(Request $request): bool|string
    {
        $data = $this->dataCollector->totalStreamsPerGame();
        return $data->toJson();
    }

    /**
     * @param Request $request
     * @return bool|string
     */
    public function getViewers(Request $request): bool|string
    {
        $data = $this->dataCollector->highestViewerCountPerGame();
        return $data->toJson();
    }

    /**
     * @param Request $request
     * @return bool|string
     */
    public function getMedians(Request $request): bool|string
    {
        return $this->dataCollector->medianAmountViewersPerGame();
    }

    public function getOddStreams(): bool|string
    {
        return $this->dataCollector->streamsWithOddViewers()->toJson();
    }

    public function getEvenStreams(): bool|string
    {
        return $this->dataCollector->streamsWithEvenViewers()->toJson();
    }

    public function getSameStreams()
    {
        return $this->dataCollector->sameAmountViewersStreams()->toJson();

    }

    public function getTopStreams(Request $request): bool|string
    {
$data= $this->dataCollector->top100Streams(sort: $request->get('sort'));
        return $data->toJson();
    }
}
