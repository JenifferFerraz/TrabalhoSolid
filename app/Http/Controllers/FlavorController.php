<?php

namespace App\Http\Controllers;

use App\Http\Requests\FlavorCreateRequest; 
use App\Services\FlavorService;
use Illuminate\Http\Request;

class FlavorController extends Controller
{
    protected $flavorService;

    public function __construct(FlavorService $flavorService)
    {
        $this->flavorService = $flavorService;
    }

    public function index()
    {
        $flavors = $this->flavorService->getAllFlavors();

        return [
            'status' => 200,
            'message' => 'Sabores encontrados!!',
            'sabores' => $flavors
        ];
    }

    public function store(FlavorCreateRequest $request)
    {
        $flavor = $this->flavorService->createFlavor($request);

        return [
            'status' => 200,
            'message' => 'Sabor cadastrado com sucesso!!',
            'sabor' => $flavor
        ];
    }

    public function show(string $id)
    {
        $flavor = $this->flavorService->getFlavorById($id);

        if (!$flavor) {
            return [
                'status' => 404,
                'message' => 'Sabor não encontrado! Que triste!',
                'user' => null
            ];
        }

        return [
            'status' => 200,
            'message' => 'Sabor encontrado com sucesso!!',
            'user' => $flavor
        ];
    }

    public function update(Request $request, string $id)
    {
        $flavor = $this->flavorService->updateFlavor($request, $id);

        if (!$flavor) {
            return [
                'status' => 404,
                'message' => 'Sabor não encontrado! Que triste!',
                'user' => null
            ];
        }

        return [
            'status' => 200,
            'message' => 'Sabor atualizado com sucesso!!',
            'user' => $flavor
        ];
    }

    public function destroy(string $id)
    {
        if ($this->flavorService->deleteFlavor($id)) {
            return [
                'status' => 200,
                'message' => 'Sabor deletado com sucesso!!'
            ];
        }

        return [
            'status' => 404,
            'message' => 'Sabor não encontrado! Que triste!'
        ];
    }
}
