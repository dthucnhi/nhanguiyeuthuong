<?php

namespace Modules\Home\Entities;

use Illuminate\Database\Eloquent\Model;

class userslist extends Model
{
    protected $table = "userslist";
    protected $fillable = ['namereceiver', 'phonereceiver', 'namesender', 'phonesender','vFile1','vFile2','timecall'];
}
