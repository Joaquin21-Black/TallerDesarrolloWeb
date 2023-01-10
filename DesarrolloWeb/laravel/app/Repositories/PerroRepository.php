<?php

namespace App\Repositories;

use App\Models\Perro;
use App\Models\Interaccion;

use Illuminate\Support\Facades\Http;

use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class PerroRepository
{

    public function showPerros()
    {
        $perros = Perro::inRandomOrder()->first();

        return response()->json(["mensaje"=>"Se listan los perros","datos" => $perros], Response::HTTP_OK);
    }

    public function urlPerro($request)
    {
            
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


            return response()->json(["mensaje"=>"Se actualizaron los perro","datos" => $perros], Response::HTTP_OK);
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

            return response()->json(["mensaje"=>"Se elimino al perro","Eliminados"=>"Adios"], Response::HTTP_OK);
        }
        catch (Exception $e)
        {
            return response()->json(["error" => $e], Response::HTTP_BAD_REQUEST);
        }
    }

    public function listarAceptados()
    {
        try
        {
            $aceptado = Interaccion::where('preferencia', 'A')->with(['perrosInteresados','perrosCandidato'])->get();
            return response()->json(["mensaje"=>"Lista de perros aceptados", "datos" => $aceptado], Response::HTTP_OK);
        }
        catch(Exception $e)
        {
            return response()->json(["error" => $e], Response::HTTP_BAD_REQUEST);
        }
    }

    public function listarRechazados()
    {
        try
        {
            $rechazados = Interaccion::where('preferencia', 'R')->with(['perrosInteresados','perrosCandidato'])->get();
            return response()->json(["mensaje"=>"Lista de perros rechazados", "datos" => $rechazados], Response::HTTP_OK);
        }
        catch(Exception $e)
        {
            return response()->json(["error" => $e], Response::HTTP_BAD_REQUEST);
        }
    }

    public function Filtro()
    {
        try
        {
            $interesados = Interaccion::select('perro_candidato_id')->get();
            $candidatos_nuevos = Perro::whereNotIn('perro_id', $interesados)->inRandomOrder()->first();
            return response()->json(["mensaje"=>"Lista de candidatos", "datos" => $candidatos_nuevos], Response::HTTP_OK);
        }
        catch(Exception $e)
        {
            return response()->json(["error" => $e], Response::HTTP_BAD_REQUEST);
        }
    }
}