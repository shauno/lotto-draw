<?php

namespace Lotto\Services;

use Lotto\Interfaces\LottoGameRepositoryInterface;

class ExportGamesService
{
    protected $lottoGameRepo;

    public function __construct(LottoGameRepositoryInterface $lottoGameRepo)
    {
        $this->lottoGameRepo = $lottoGameRepo;
    }

    public function csv()
    {
        $data = $this->lottoGameRepo->getAll();

        $handle = fopen('php://temp', 'wb');

        fputcsv($handle, [
            'id',
            'Type',
            'Total Balls',
            'Game Balls',
            'Created At',
            'Numbers',
        ]);

        foreach($data as $row) {
            $numbers = $row->numbers->map(function($tmp) {
                return $tmp->number;
            });

            fputcsv($handle, [
                $row->id,
                $row->type,
                $row->total_balls,
                $row->game_balls,
                $row->created_at,
                $numbers->implode(','),
            ]);
        }

        rewind($handle);
        return stream_get_contents($handle);

    }
}