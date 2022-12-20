<?php

namespace App\Repositories;

use App\Models\Perro;
use App\Models\Interaccion;

use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class PerroRepository
{

    public function showPerros()
    {
        $perros = Perro::all();

        return response()->json(["mensaje"=>"Se listan los perros","datos" => $perros], Response::HTTP_OK);
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

    public function guardarInteresado($request)
    {
        // perro interesado y perro candidato guardan sus id en el modelo de interaccion, igual mente en este modelo se guarda la preferencia (A o R)
        // por lo que en el request deberia venir el id de ambos perro
        try{
        $interesado = $request->perro_id;
        $candidato = $request->perro_id_2; // los id se diferencian por front
        
        $preferencia = $request->preferencia;

        $perros = Interaccion::create([
            "perro_interesado_id" => $interesado ,
            "perro_candidato_id" => $candidato,
            "preferencia" => $preferencia
        ]);

        return response()->json(["mensaje"=>"Se guardaron los perro interesados", "datos" => $perros], Response::HTTP_OK);

        }
        catch (Exception $e)
        {
            return response()->json(["error" => $e], Response::HTTP_BAD_REQUEST);
        }

    }

    public function verInteresados($request)
    {
        try
        {
            $interesados = Interaccion::select('perro_interesado_id','perro_candidato_id','preferencia')->when($request->perro_interesado_id,function($query) use($request){
                $query->where('perro_interesado_id',$request->perro_interesado_id);
            })->get();

            return response()->json(["mensaje"=>"Se muestran los perros candidatos", "datos" => $interesados], Response::HTTP_OK);
        }
        catch (Exception $e)
        {
            return response()->json(["error" => $e], Response::HTTP_BAD_REQUEST);
        }
    }
}