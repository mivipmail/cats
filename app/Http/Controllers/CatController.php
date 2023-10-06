<?php

namespace App\Http\Controllers;

use App\Models\Cat;
use App\Http\Requests\StoreCatRequest;
use App\Http\Requests\UpdateCatRequest;
use App\Http\Resources\CatResource;
use App\Lib\CatImageUploader;
use Illuminate\Support\Facades\Storage;


class CatController extends Controller
{
    public function index()
    {
        try {
            $cats = Cat::all();

            return response()->json(CatResource::collection($cats)->resolve());
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 403);
        }
    }


    public function store(StoreCatRequest $request)
    {
        try {
            $data = $request->all();

            $catImageUploader = new CatImageUploader($data['image']);
            $data['image'] = $catImageUploader->uploadImageToStorageFolder('images');

            $cat = Cat::create($data);

            return response()->json((new CatResource($cat))->resolve());
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 403);
        }
    }


    public function show($id)
    {
        try {
            $cat = Cat::find($id);

            if(!$cat)
                return response()->json([
                    'message' => 'Не удалось найти запись с id ' . $id,
                ], 404);

            return response()->json((new CatResource($cat))->resolve());
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 403);
        }
    }


    public function update(UpdateCatRequest $request, $id)
    {
        try {
            $data = $request->all();

            $cat = Cat::find($data['id']);
            if(!$cat)
                return response()->json([
                    'message' => 'Не удалось найти запись с id ' . $id,
                ], 404);

            if (basename($data['image']) != basename($cat->image)) {
                Storage::disk('public')->delete($cat->image);

                $catImageUploader = new CatImageUploader($data['image']);
                $data['image'] = $catImageUploader->uploadImageToStorageFolder('images');
            } else
                unset($data['image']);

            $cat->update($data);

            return response()->json(new CatResource($cat));
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 403);
        }
    }


    public function destroy($id)
    {
        try {
            $cat = Cat::find($id);
            if(!$cat)
                return response()->json([
                    'message' => 'Не удалось найти запись с id ' . $id,
                ], 404);

            Storage::disk('public')->delete($cat->image);
            $cat->delete();

            return response()->json(['result' => 'success']);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 403);
        }
    }
}
