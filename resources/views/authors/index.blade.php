@extends('layouts.app')

@section('title', 'Daftar Penulis')

@section('content')
    <h1 class="h3 mb-3">Daftar Penulis</h1>

    <div class="table-responsive">
        <table class="table table-striped table-bordered bg-white">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Jumlah Buku</th>
                    <th>Bio</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($authors as $author)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $author->name }}</td>
                        <td>{{ $author->email }}</td>
                        <td>{{ $author->books_count }}</td>
                        <td>{{ $author->bio }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Belum ada data penulis.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
