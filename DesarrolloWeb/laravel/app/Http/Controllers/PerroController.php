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

    public function guardarInteresado(InteraccionRequest $request)
    {
        return $this->perroRepo->guardarInteresado($request);
    }

    public function verInteresados(InteraccionRequest $request)
    {
        return $this->perroRepo->verInteresados($request);
    }
}
