<?php

namespace App\Http\Controllers;

use App\Device;
use App\Measurement;
use Illuminate\Http\Request;
use App\Http\Controllers\api\ApiResponseController;

// Se extiende del controlador de la API, que a su vez extiende del controlador generico
class MeasurementController extends ApiResponseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$sample = Measurement::all();
        //$sample = Measurement::orderBy('created_at', 'desc')->paginate(1);
        $measurement = Measurement::
            join('devices', 'measurements.device_id', '=' ,'devices.id')->
            select('devices.uuid as uuid', 'measurements.created_at as date', 'measurements.temperature as temperature', 'measurements.pressure as pressure', 'measurements.humidity as humidity')->
            orderBy('measurements.created_at', 'desc')->paginate(5);
        //return response()->json($measurement);
        return $this->successResponse($measurement, 200);
    }

    // Esta funcion deberia estar en otro controlador totalmente aparte
    public function device($device_id = NULL)
    {
        if($device_id != NULL){
            $device = Device::
                where('uuid', $device_id)->
                select('uuid', 'id')->
                get();
        }else{
            $device = Device::select('uuid', 'id')->
            get();
        }
        return $this->successResponse($device, 200);
    }

    public function store(Request $request)
    {
        //$_device = Device::where('uuid', $request->device_id)->get();
        //echo $_device->mapWithKeys('id');
        //echo $_id;
        //$request->merge(['device_id' => 1]);
        $measurement = Measurement::create($request->all());
        return $this->createdResponse($measurement);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Measurement $measurement)
    {
        //$sample = Measurement::orderBy('created_at', 'desc')->paginate(10);
        $measurement->device_id;
        //return response()->json($measurement);
        return $this->successResponse($measurement);
    }
}
