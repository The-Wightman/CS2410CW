<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
	//This line is added due to wanting to have specific times for when the event was created and planned for using keywords reserved for the timestamps, this is resolved by disabling them.
    public $timestamps = false;
}
