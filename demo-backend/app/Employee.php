<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    //
    public $timestamps = false;
    protected $primaryKey = 'employee_id';
    public $incrementing = false;
}
