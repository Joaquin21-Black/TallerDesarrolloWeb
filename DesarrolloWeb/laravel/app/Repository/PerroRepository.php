<?php

namespace App\Repositories;

use App\Models\Perro;

use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class PerroRepository
{

    public function showPerros()
    {
        $perros = Perro::all();

        return response()->json()(["perros" => $perros], Response::HTTP_OK);
    }

    public function createPerro($request)
    {
        try
        {
            $perros = Perro::create([
                "nombre" => $request->nombre,
                "url_foto" => $request->url_foto,
                "descripcion" => $request->descripcion
            ]);
        }
        catch (Exception $e)
        {
            return response()->json(["error" => $e], Response::HTTP_BAD_REQUEST);
        }
    }

    public function updatePerro($request)
    {
        try {
            $perros = Perro::findorFail($request->perro_id);
            isset($request->nombre) && $perros->nombre = $request->nombre;
            isset($request->url_foto) && $perros->url_foto = $request->url_foto;
            isset($request->descripcion) && $perros->descripcion = $request->descripcion;
            $perros->save();

            $perros = Perro::where('perro_id', $request->perro_id)
                ->update([
                    'nombre' => $request->nombre,
                    'url_foto' => $request->url_foto,
                    'descripcion' => $request->descripcion
                ]);


            return response()->json(["perros" => $perros], Response::HTTP_OK);
        } catch (Exception $e) {
            Log::info([
                "error" => $e,
                "mensaje" => $e->getMessage(),
                "linea" => $e->getLine(),
                "archivo" => $e->getFile(),
            ]);
            return response()->json(["error" => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }

    public function deletePerro($request)
    {
        try
        {
            $perro = Perro::find($request->perro_id);
            if(!$perro)
            {
                throw new Exception("Detente");
            }
            $perro->delete();

            return response()->json(["Eliminados"=>"Adios"], Response::HTTP_OK);
        }
        catch (Exception $e)
        {
            return response()->json(["error" => $e], Response::HTTP_BAD_REQUEST);
        }
    }
}