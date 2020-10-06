<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ["amount", "status", "user_id", "subscp_plan_id"];
}
