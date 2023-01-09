<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\InteraccionRepository;
use App\Http\Request\PerroRequest;
use App\Http\Request\InteraccionRequest;

class InteraccionController extends Controller
{
    public function guardarInteresado(InteraccionRequest $request)
    {
        return $this->perroRepo->guardarInteresado($request);
    }

    public function verInteresados(InteraccionRequest $request)
    {
        return $this->perroRepo->verInteresados($request);
    }
}
