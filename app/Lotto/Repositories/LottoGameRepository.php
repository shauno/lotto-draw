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
     */
    public function cleanOldRecords($type, $limit)
    {

        $delete = $this->model->newInstance();
        $id = $delete->where('type', '=', $type)
            ->orderBy('id', 'DESC')
            ->limit($limit)
            ->get()
            ->last();

        $delete = $this->model->newInstance();
        $delete->where('id', '<', $id->id)
            ->where('type', '=', $type)
            ->delete();
    }

    public function getAll()
    {
        return $this->model->all()->load('numbers');
    }
}