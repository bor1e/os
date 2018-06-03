<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use RecordsActivity; // TODO: is it needed here?
    protected $guarded = [];
}
