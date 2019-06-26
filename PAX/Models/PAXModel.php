<?php

namespace PAX\Models;

use Illuminate\Database\Eloquent\Model;

abstract class PAXModel extends Model
{
    public function filterFillable($attributes)
    {
        return $this->fillableFromArray($attributes);
    }
}
