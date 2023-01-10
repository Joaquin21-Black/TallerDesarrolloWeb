<?php

namespace App\Repositories;

use App\Models\Interaccion;
use App\Models\Perro;

use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class InteraccionRepository
{
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

    public function guardarAceptados($request)
    {
        try
        {
            $interesado = Perro::select('perro_id')->first();
             $aceptado = Interaccion::create([
                 'perro_interesado_id' => $interesado->perro_id,
                 'perro_candidato_id' => $request->id,
                 'preferencia' => 'A',
            ]);
            return response()->json(["mensaje"=>"Perro aceptado", "datos" => $aceptado], Response::HTTP_OK);
        }
        catch(Exception $e)
        {
            return response()->json(["error" => $e], Response::HTTP_BAD_REQUEST);
        }
    }

    public function guardarRechazados($request)
    {
        try
        {
            $interesado = Perro::select('perro_id')->first();
            $rechazado = Interaccion::create([
                 'perro_interesado_id' => $interesado->perro_id,
                 'perro_candidato_id' => $request->id,
                 'preferencia' => 'R',
            ]);
            return response()->json(["mensaje"=>"Perro rechazado", "datos" => $rechazado], Response::HTTP_OK);
        }
        catch(Exception $e)
        {
            return response()->json(["error" => $e], Response::HTTP_BAD_REQUEST);
        }
    }
}