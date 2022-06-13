<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CostCenter extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function parent()
    {
        return $this->belongsTo(CostCenter::class, 'parent_id');
    }

}
