<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CostCenter extends Model
{
    protected $guarded = [];

    public function parent()
    {
        return $this->belongsTo(CostCenter::class, 'parent_id');
    }

}
