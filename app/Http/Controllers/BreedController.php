<?php

namespace App\Http\Controllers;

use App\Models\Breed;
use App\Http\Requests\StoreBreedRequest;
use App\Http\Requests\UpdateBreedRequest;
use App\Http\Resources\BreedResource;


class BreedController extends Controller
{
    public function index()
    {
        try {
            $breeds = Breed::all();

            return response()->json(BreedResource::collection($breeds)->resolve());
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 403);
        }
    }


    public function store(StoreBreedRequest $request)
    {
        try {
            $data = $request->all();

            $breed = Breed::create($data);

            return response()->json((new BreedResource($breed))->resolve());
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 403);
        }
    }


    public function show($id)
    {
        try {
            $breed = Breed::find($id);

            if(!$breed)
                return response()->json([
                    'message' => 'Не удалось найти запись с id ' . $id,
                ], 404);

            return response()->json((new BreedResource($breed))->resolve());
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 403);
        }
    }


    public function update(UpdateBreedRequest $request, $id)
    {
        try {
            $data = $request->all();

            $breed = Breed::find($data['id']);
            if(!$breed)
                return response()->json([
                    'message' => 'Не удалось найти запись с id ' . $id,
                ], 404);

            $breed->update($data);

            return response()->json(new BreedResource($breed));
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 403);
        }
    }


    public function destroy($id)
    {
        try {
            $breed = Breed::find($id);
            if(!$breed)
                return response()->json([
                    'message' => 'Не удалось найти запись с id ' . $id,
                ], 404);

            $breed->delete();

            return response()->json(['result' => 'success']);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 403);
        }
    }
}
