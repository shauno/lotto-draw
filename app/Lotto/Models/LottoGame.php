<?php

namespace Lotto\Models;

use Illuminate\Database\Eloquent\Model;

class LottoGame extends Model
{
    public function numbers()
    {
        return $this->hasMany('\Lotto\Models\LottoGameNumbers', 'lotto_games_id', 'id');
    }
}
