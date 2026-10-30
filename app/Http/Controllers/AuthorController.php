<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AuthorController extends Controller
{
    // GET /api/authors
    public function index(): JsonResponse
    {
        $authors = Author::withCount('books')->get();

        return response()->json([
            'message' => 'Daftar penulis berhasil diambil',
            'data' => $authors,
        ], 200);
    }

    // GET /api/authors/{id}
    public function show($id): JsonResponse
    {
        $author = Author::with('books')->find($id);

        if (! $author) {
            return response()->json(['message' => 'Penulis tidak ditemukan'], 404);
        }

        return response()->json([
            'message' => 'Detail penulis berhasil diambil',
            'data' => $author,
        ], 200);
    }

    // POST /api/authors
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:authors,email',
            'bio' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validasi gagal',
                'errors' => $validator->errors(),
            ], 422);
        }

        $author = Author::create($validator->validated());

        return response()->json([
            'message' => 'Penulis berhasil ditambahkan',
            'data' => $author,
        ], 201);
    }

    // PUT /api/authors/{id}
    public function update(Request $request, $id): JsonResponse
    {
        $author = Author::find($id);

        if (! $author) {
            return response()->json(['message' => 'Penulis tidak ditemukan'], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('authors', 'email')->ignore($author->id)],
            'bio' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validasi gagal',
                'errors' => $validator->errors(),
            ], 422);
        }

        $author->update($validator->validated());

        return response()->json([
            'message' => 'Penulis berhasil diperbarui',
            'data' => $author,
        ], 200);
    }

    // DELETE /api/authors/{id}
    public function destroy($id): JsonResponse
    {
        $author = Author::find($id);

        if (! $author) {
            return response()->json(['message' => 'Penulis tidak ditemukan'], 404);
        }

        $author->delete(); // buku milik penulis ikut terhapus (onDelete cascade)

        return response()->json(['message' => 'Penulis berhasil dihapus'], 200);
    }
}
