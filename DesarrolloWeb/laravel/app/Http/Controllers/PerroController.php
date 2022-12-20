<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\PerroRepository;
use App\Http\Requests\PerroRequest;
use App\Models\Perro;

class PerroController extends Controller
{

    protected PerroRepository $perroRepo;
    public function __construct(PerroRepository $perroRepo)
    {
        $this->testRepo = $perroRepo;
    }

    public function showPerros()
    {
        return $this->perroRepo->showPerros();
    }

    public function create(PerroRequest $request)
    {
        return $this->perroRepo->createPerro($request);
    }

    public function update(PerroRequest $request)
    {
        return $this->perroRepo->updatePerro($request);
    }

    public function delete(Request $request)
    {
        return $this->perroRepo->deletePerro($request);
    }
}
