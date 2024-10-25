<?php
namespace App\Services\Contracts;

use App\Http\Requests\FlavorCreateRequest; 
use Illuminate\Http\Request;

interface FlavorInterface {
    public function getAllFlavors();
    public function createFlavor(FlavorCreatRequest $request);
    public function getFlavorById(string $id);
    public function updateFlavor(Request $request, string $id);
    public function deleteFlavor(string $id);
}