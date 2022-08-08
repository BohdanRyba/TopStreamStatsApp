<?php
declare(strict_types=1);

namespace App\Http\Resources\V2;

use App\Contracts\Resources\DataCollectorContract;
use App\Models\Stream;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as CollectionAlias;
use Illuminate\Support\Facades\DB;

/**
 * Array functions
 */
class DataCollector implements DataCollectorContract
{

    /**
     * @param string $sort
     * @return Collection|array
     */
    public function totalStreamsPerGame(string $sort = "DESC"): Collection|array
    {
        return Stream::query()->select(['game_id', 'game_name', DB::raw("COUNT(*) as total_streams")])->groupBy(['game_id', 'game_name'])->orderBy('total_streams', $sort)->get();
    }

    /**
     * @param string $sort
     * @return Collection|array
     */
    public function highestViewerCountPerGame(string $sort = "DESC"): Collection|array
    {
        return Stream::query()->select(['game_id', 'game_name', DB::raw("SUM(viewer_count) as total_viewers")])->groupBy(['game_id', 'game_name'])->orderBy('total_viewers', $sort)->get();
    }

    /**
     * @param string $sort
     * @return float|int|null
     */
    public function medianAmountViewersPerGame(string $sort = "DESC"): float|int|null
    {
        return Stream::all()->median('viewer_count');
    }

    /**
     * @param string $sort
     * @return Collection|array
     */
    public function top100Streams(string $sort = "DESC"): Collection|array
    {
        return Stream::query()->select('game_name', 'viewer_count')->groupBy('game_name', 'viewer_count')->orderBy('viewer_count', $sort)->limit(100)->get();
    }

    /**
     * @param string $sort
     * @return CollectionAlias
     */
    public function sameAmountViewersStreams(string $sort = "ASC"): CollectionAlias
    {
        return Stream::query()->select('game_name', 'viewer_count')->whereIn('viewer_count', function ($query) {
            $query->select('viewer_count')->from('streams')->groupBy('viewer_count')->havingRaw('count(*) > 1');
        })->orderBy('viewer_count', $sort)->get();
    }

    /**
     * @param string $sort
     * @return Collection|array
     */
    public function streamsWithOddViewers(string $sort = "ASC"): Collection|array
    {
        return Stream::query()->select('game_name', 'viewer_count')->groupBy('game_name', 'viewer_count')->whereRaw('viewer_count %2 != 0')->orderBy('game_name', $sort)->get();
    }

    /**
     * @param string $sort
     * @return Collection|array
     */
    public function streamsWithEvenViewers(string $sort = "ASC"): Collection|array
    {
        return Stream::query()->select('game_name', 'viewer_count')->groupBy('game_name', 'viewer_count')->whereRaw('viewer_count %2 = 0')->orderBy('game_name', $sort)->get();
    }
}
