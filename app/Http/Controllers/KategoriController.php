<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index(Request $request)
    {
        $query = Kategori::with('kategoriBukuRelasi.buku');
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('nama_kategori', 'like', "%{$search}%");
        }
        $categories = $query->paginate(10)->withQueryString();
        return view('admin.kategori.index', compact('categories'), ['title' => 'Kategori']);
    }

    public function create()
    {
        return view('admin.kategori.create', ['title' => 'Tambah Kategori']);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kategori' => 'required|string|unique:kategoris,nama_kategori'
        ]);

        $category = Kategori::create([
            'nama_kategori' => $validated['nama_kategori']
        ]);

        return redirect()->route('kategori.index')->with('success');
    }

    public function show($id)
    {
        $category = Kategori::find($id);
        return view('admin.kategori.edit', compact('category'), ['title' => 'edit kategori']);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_kategori' => 'required|string|unique:kategoris,nama_kategori'
        ]);

        $category = Kategori::find($id);
        $category->update([
            'nama_kategori' => $validated['nama_kategori']
        ]);

        return redirect()->route('kategori.index')->with('success');
    }

    public function destroy(Request $request, $id)
    {
        $category = Kategori::find($id);
        $category->delete();

        return redirect()->route('kategori.index')->with('success');
    }
}
