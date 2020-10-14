<?php

namespace App;

use App\Device;
use Illuminate\Database\Eloquent\Model;

class Measurement extends Model
{
    protected $fillable = ['device_id', 'temperature', 'pressure', 'humidity', 'uuid'];

    public function device(){
        return $this->hasOne(Device::class);
    }
}
