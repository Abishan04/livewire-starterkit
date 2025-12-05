<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    protected $table = 'informations';

    protected $fillable = ['first_name', 'last_name', 'nic_number', 'date_of_birth'];
}
