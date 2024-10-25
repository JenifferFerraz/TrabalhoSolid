<?php

namespace App\Services;

use App\Http\Requests\FlavorCreateRequest; 
use App\Models\Flavor;
use App\Http\Enums\TamanhoEnum;
use App\Services\Contracts\FlavorInterface;

class FlavorService implements FlavorInterface
{
    public function getAllFlavors() {
        return Flavor::select('id', 'sabor', 'preco', 'tamanho')->paginate(10);
    }

    public function createFlavor(FlavorCreateRequest $request) { 
        $data = $request->validated();
        return Flavor::create([
            'sabor' => $data['sabor'],
            'preco' => $data['preco'],
            'tamanho' => TamanhoEnum::from($data['tamanho']),
        ]);
    }

    public function getFlavorById(string $id) {
        return Flavor::find($id);
    }

    public function updateFlavor(Request $request, string $id) {
        $data = $request->all();
        $flavor = Flavor::find($id);
        if (!$flavor) return null;

        $flavor->update($data);
        return $flavor;
    }

    public function deleteFlavor(string $id) {
        $flavor = Flavor::find($id);
        if ($flavor) {
            $flavor->delete();
            return true;
        }
        return false;
    }
}
