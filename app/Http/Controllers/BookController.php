<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    // GET /api/books
    public function index(): JsonResponse
    {
        $books = Book::with('author')->get();

        return response()->json([
            'message' => 'Daftar buku berhasil diambil',
            'data' => $books,
        ], 200);
    }

    // GET /api/books/{id}
    public function show($id): JsonResponse
    {
        $book = Book::with('author')->find($id);

        if (! $book) {
            return response()->json(['message' => 'Buku tidak ditemukan'], 404);
        }

        return response()->json([
            'message' => 'Detail buku berhasil diambil',
            'data' => $book,
        ], 200);
    }

    // POST /api/books
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'author_id' => 'required|exists:authors,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'published_year' => 'required|integer|min:1000|max:' . date('Y'),
            'price' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validasi gagal',
                'errors' => $validator->errors(),
            ], 422);
        }

        $book = Book::create($validator->validated());

        return response()->json([
            'message' => 'Buku berhasil ditambahkan',
            'data' => $book->load('author'),
        ], 201);
    }

    // PUT /api/books/{id}
    public function update(Request $request, $id): JsonResponse
    {
        $book = Book::find($id);

        if (! $book) {
            return response()->json(['message' => 'Buku tidak ditemukan'], 404);
        }

        $validator = Validator::make($request->all(), [
            'author_id' => 'required|exists:authors,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'published_year' => 'required|integer|min:1000|max:' . date('Y'),
            'price' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validasi gagal',
                'errors' => $validator->errors(),
            ], 422);
        }

        $book->update($validator->validated());

        return response()->json([
            'message' => 'Buku berhasil diperbarui',
            'data' => $book->load('author'),
        ], 200);
    }

    // DELETE /api/books/{id}
    public function destroy($id): JsonResponse
    {
        $book = Book::find($id);

        if (! $book) {
            return response()->json(['message' => 'Buku tidak ditemukan'], 404);
        }

        $book->delete();

        return response()->json(['message' => 'Buku berhasil dihapus'], 200);
    }
}
