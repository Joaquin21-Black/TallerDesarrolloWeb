<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\PerroRepository;
use App\Http\Request\PerroRequest;
use App\Http\Request\InteraccionRequest;
use App\Models\Perro;

class PerroController extends Controller
{

    protected PerroRepository $perroRepo;
    public function __construct(PerroRepository $perroRepo)
    {
        $this->perroRepo = $perroRepo;
    }

    public function showPerros()
    {
        return $this->perroRepo->showPerros();
    }

    public function createPerro(PerroRequest $request)
    {
        return $this->perroRepo->createPerro($request);
    }

    public function updatePerro(PerroRequest $request)
    {
        return $this->perroRepo->updatePerro($request);
    }

    public function deletePerro(Request $request)
    {
        return $this->perroRepo->deletePerro($request);
    }

    public function listarAceptados(InteraccionRequest $request)
    {
        return $this->perroRepo->listarAceptados($request);
    }

    public function listarRechazados(InteraccionRequest $request)
    {
        return $this->perroRepo->listarRechazados($request);
    }

    public function Filtro()
    {
        return $this->perroRepo->Filtro();
    }

    public function urlPerro(Request $request)
    {
        return $this->perroRepo->urlPerro($request);
    }
}
