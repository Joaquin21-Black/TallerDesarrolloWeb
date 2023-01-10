<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\InteraccionRepository;
use App\Http\Request\PerroRequest;
use App\Http\Request\InteraccionRequest;

class InteraccionController extends Controller
{
    protected InteraccionRepository $inteRepo;
    public function __construct(InteraccionRepository $inteRepo)
    {
        $this->inteRepo = $inteRepo;
    }

    public function guardarInteresado(InteraccionRequest $request)
    {
        return $this->inteRepo->guardarInteresado($request);
    }

    public function verInteresados(InteraccionRequest $request)
    {
        return $this->inteRepo->verInteresados($request);
    }

    public function guardarAceptado(Request $request)
    {
        return $this->inteRepo->guardarAceptados($request);
    }

    public function guardarRechazados(Request $request)
    {
        return $this->inteRepo->guardarRechazados($request);
    }
}
