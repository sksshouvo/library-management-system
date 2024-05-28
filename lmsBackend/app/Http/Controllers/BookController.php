<?php

namespace App\Http\Controllers;
use App\Http\Requests\BookUpdateRequest;
use App\Http\Requests\BookStoreRequest;
use App\Repositories\BookRepository;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function __construct(public BookRepository $bookRepository) {

    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return $this->successResponse(__('book.list'), $this->bookRepository->list()->getData(), $request->bearerToken(), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BookStoreRequest $request) : JsonResponse
    {
        try {
            DB::beginTransaction();
            $book = $this->bookRepository->store($request->validated());
            DB::commit();
            return $this->successResponse(__('book.created'), $book->getData(), $request->bearerToken(), 201);
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
        try {
            return $this->successResponse(__('book.list'), $this->bookRepository->single($id)->getData(), request()->bearerToken(), 200);
        } catch (\Throwable $th) {
            return $this->errorResponse(__('common.no_data_found'), $th, request()->bearerToken(), 200);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BookUpdateRequest $request, string $id)
    {
        try {
            DB::beginTransaction();
            $book = $this->bookRepository->update($request->validated(), $id);
            if (!empty($book->getdata()->message)) {
                return $this->errorResponse(__('common.no_data_found'), NULL, $request->bearerToken(), 422);
            }
            DB::commit();
            return $this->successResponse(__('book.updated'), $book->getData(), $request->bearerToken(), 200);
        } catch (\Exception $e) {
            DB::rollback();
            Log::emergency($e);
            return $this->errorResponse(__('common.error'), $e, $request->bearerToken());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, int $id) : JsonResponse
    {
        try {
            DB::beginTransaction();
            $book = $this->bookRepository->delete($id);
            DB::commit();
            if ($book->getData()) {
                return $this->successResponse(__('book.deleted'), NULL, $request->bearerToken(), 200);
            } else {
                return $this->errorResponse(__('book.invalid_id'), NULL, $request->bearerToken());
            }
            
        } catch (\Exception $e) {
            DB::rollback();
            Log::emergency($e);
            return $this->errorResponse(__('common.error'), $e, $request->bearerToken());
        }
    }
    
}
