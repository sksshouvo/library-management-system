<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthorStoreRequest;
use App\Repositories\AuthorRepository;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AuthorStoreRequest $request, AuthorRepository $authorService): JsonResponse
    {
        try {
            
            DB::beginTransaction();
            $author = $authorService->store($request->validated());
            DB::commit();
            return $this->successResponse(__('author.created'), $author->getData(), $request->bearerToken(), 201);
        } catch (\Exception $e) {
            DB::rollback();
            Log::emergency($e);
            return $this->errorResponse(__('common.error'), $e, $request->bearerToken());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
