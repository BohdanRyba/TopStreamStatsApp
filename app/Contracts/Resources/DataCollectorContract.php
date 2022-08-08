<?php

declare(strict_types=1);

namespace App\Contracts\Resources;

interface DataCollectorContract
{
    public function totalStreamsPerGame(string $sort = "DESC");

    public function highestViewerCountPerGame(string $sort = "DESC");

    public function medianAmountViewersPerGame(string $sort = "DESC");

    public function streamsWithOddViewers(string $sort = "DESC");

    public function streamsWithEvenViewers(string $sort = "DESC");

    public function top100Streams(string $sort = "DESC");

    public function sameAmountViewersStreams(string $sort = "DESC");
}
