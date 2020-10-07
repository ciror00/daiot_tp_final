<?php

namespace App\Http\Controllers;

use App\Device;
use Illuminate\Http\Request;
use App\Http\Requests\StoreDevicePost;

class DeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$Devices = Device::get(); // Metodo para obtener todos los registros
        $devices = Device::orderBy('created_at', 'desc')->paginate(10);
        return view('device.index', ['devices' => $devices]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Se crea una instancia de Device para evitar que rompa
        return view('device.create', ['post' => new Device()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // Se cambia el tipo de parametro por de la request con la validacion StoreDevicePost
    public function store(StoreDevicePost $request)
    {
        echo "Request: " . $request->content;
        // Se importa el modelo y se utiliza el metodo create para validar la request
        Device::create($request->validated());
        return back()->with('status', 'Device creado exitosamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Device $device)
    {
        return view('device.show', ["device" => $device]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Device $device)
    {
       return view('device.edit', ['device' => $device]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreDevicePost $request, Device $device)
    {
        $device->update($request->validated());
        return back()->with('status', 'Dispositivo actualizado con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Device $device)
    {
        $device->delete();
        return back()->with('status', 'Dispositivo borrado con exito');
    }
}
