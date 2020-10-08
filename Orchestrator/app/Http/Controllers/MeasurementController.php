<?php

namespace App\Http\Controllers;

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
            select('devices.uuid', 'measurements.temperature', 'measurements.pressure', 'measurements.humidity')->
            orderBy('measurements.created_at', 'desc')->paginate(1);
        //return response()->json($measurement);
        return $this->successResponse($measurement, 200);
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
        return $this->successResponse($post);
    }
}
