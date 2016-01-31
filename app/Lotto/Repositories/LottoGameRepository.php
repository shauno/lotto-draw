<?php

namespace Lotto\Repositories;

use Illuminate\Database\DatabaseManager;
use Lotto\Interfaces\LottoGameServiceInterface;
use Lotto\Interfaces\LottoGameRepositoryInterface;
use Lotto\Models\LottoGame;
use Lotto\Models\LottoGameNumbers;

class LottoGameRepository implements LottoGameRepositoryInterface
{
    protected $model;

    protected $db;

    public function __construct(LottoGame $model, DatabaseManager $db)
    {
        $this->model = $model;
        $this->db = $db;
    }

    public function save(LottoGameServiceInterface $type, $totalBalls, $gameBalls, array $numbers)
    {
        $reflect = new \ReflectionClass($type);

        $this->model->type = $reflect->getShortName();
        $this->model->total_balls = $totalBalls;
        $this->model->game_balls = $gameBalls;

        $numberModels = [];
        foreach($numbers as $number) {
            $numberModels[] = new LottoGameNumbers(['number' => $number]);
        }

        $this->db->transaction(function() use($numberModels) {
            $this->model->save();
            $this->model->numbers()->saveMany($numberModels);
        });

        $this->cleanOldRecords($reflect->getShortName(), 100);

        return $this->model->load('numbers');
    }

    /*
     * Makes sure only the last $limit records of $type are kept in persistence
     *
     * Only persisting N records is not a pattern I have come across before. I have moved records off to a history or
     * cache db or table on a cron, but not tried to limit the rows in real time. There seems to be a issue with a
     * "Deadlock" form time to time with this query that I don't quite understand yet
     */
    public function cleanOldRecords($type, $limit)
    {
        $this->db->select(
            $this->db->raw('DELETE FROM `lotto_games`
                WHERE type = :type1 AND id NOT IN (
	                SELECT * FROM (
		                SELECT id FROM `lotto_games`
		                WHERE `type` = :type2
		                ORDER BY id DESC
		                LIMIT :limit
	                ) AS t
                )
            '),
            [
                'type1' => $type,
                'type2' => $type,
                'limit' => $limit,
            ]
        );
    }
}