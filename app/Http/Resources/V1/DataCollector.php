<?php

declare(strict_types=1);

namespace App\Http\Resources\V1;

use App\Contracts\Resources\DataCollectorContract;
use Illuminate\Support\Facades\DB;

/**
 * SQL Queries
 */
class DataCollector implements DataCollectorContract
{

    /**
     * @param string $sort
     * @return array
     */
    public function totalStreamsPerGame(string $sort = "DESC"): array
    {
        $sql = "SELECT game_id, game_name, COUNT(*) as total_streams FROM streams GROUP BY game_id, game_name  ORDER BY total_streams {$sort};";
        return DB::select((string)DB::raw($sql));
    }

    /**
     * @param string $sort
     * @return array
     */
    public function highestViewerCountPerGame(string $sort = "DESC"): array
    {
        $sql = "SELECT game_id,game_name, SUM(viewer_count) as total_viewers FROM streams GROUP BY game_id, game_name ORDER BY total_viewers {$sort};";
        return DB::select((string)DB::raw($sql));
    }

    /**
     * @param string $sort
     * @return array
     */
    public function medianAmountViewersPerGame(string $sort = "DESC"): array
    {
        $sql = "SELECT AVG(dd.viewer_count) as median_val
FROM (
         SELECT d.viewer_count, @rownum:=@rownum+1 as 'row_number', @total_rows:=@rownum
         FROM streams d, (SELECT @rownum:=0) r
         ORDER BY d.viewer_count
     ) as dd
WHERE dd.row_number IN ( FLOOR((@total_rows+1)/2), FLOOR((@total_rows+2)/2) );";
        return DB::select((string)DB::raw($sql));

    }

    /**
     * @param string $sort
     * @return array
     */
    public function streamsWithOddViewers(string $sort = "ASC"): array
    {
        $sql = "SELECT  DISTINCT game_name, viewer_count FROM streams WHERE viewer_count % 2 != 0  group by game_name,viewer_count ORDER BY game_name {$sort};";
        return DB::select((string)DB::raw($sql));
    }

    /**
     * @param string $sort
     * @return array
     */
    public function streamsWithEvenViewers(string $sort = "ASC"): array
    {
        $sql = "SELECT DISTINCT game_name,viewer_count FROM streams WHERE viewer_count % 2 = 0 group by game_name,viewer_count  ORDER BY game_name {$sort};";
        return DB::select((string)DB::raw($sql));
    }

    /**
     * @param string $sort
     * @return array
     */
    public function top100Streams(string $sort = "DESC"): array
    {
        $sql = "SELECT game_name, viewer_count
FROM streams
GROUP BY game_name, viewer_count ORDER BY viewer_count {$sort} LIMIT 100;";
        return DB::select((string)DB::raw($sql));
    }

    /**
     * @param string $sort
     * @return array
     */
    public function sameAmountViewersStreams(string $sort = "ASC"): array
    {
        $sql = "select distinct game_name, viewer_count from streams where viewer_count in (
    select viewer_count from streams
    group by viewer_count having count(*) > 1
    order by viewer_count {$sort}) order by viewer_count {$sort}";
        return DB::select((string)DB::raw($sql));
    }
}
