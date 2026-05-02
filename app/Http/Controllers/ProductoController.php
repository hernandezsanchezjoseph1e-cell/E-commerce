<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use App\Http\Requests\Producto\StoreProductoRequest;
use App\Http\Requests\Producto\UpdateProductoRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductoController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Producto::class);
        $productos = Producto::with(['usuario', 'categorias'])->get();
        return view('productos.index', compact('productos'));
    }

    public function create()
    {
        $this->authorize('create', Producto::class);
        $categorias = Categoria::all();
        return view('productos.create', compact('categorias'));
    }

    public function store(StoreProductoRequest $request)
    {
        $this->authorize('create', Producto::class);

        $fotosPaths = [];

        if ($request->hasFile('fotos')) {
            foreach ($request->file('fotos') as $file) {
                $nombre = Str::uuid() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('productos', $nombre, 'public');
                $fotosPaths[] = $path;
            }
        }

        $producto = Producto::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
            'existencia' => $request->existencia,
            'usuario_id' => auth()->id(),
            'fotos' => $fotosPaths
        ]);

        $producto->categorias()->sync($request->categorias ?? []);

        return redirect()->route('productos.index');
    }


    public function edit(Producto $producto)
    {
        $this->authorize('update', $producto);
        $categorias = Categoria::all();
        return view('productos.edit', compact('producto', 'categorias'));
    }

    public function update(UpdateProductoRequest $request, Producto $producto)
    {
        $this->authorize('update', $producto);

        $fotosPaths = $producto->fotos ?? [];

        if ($request->hasFile('fotos')) {

            foreach ($fotosPaths as $foto) {
                Storage::disk('public')->delete($foto);
            }

            $fotosPaths = [];

            foreach ($request->file('fotos') as $file) {
                $nombre = Str::uuid() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('productos', $nombre, 'public');
                $fotosPaths[] = $path;
            }
        }

        $producto->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
            'existencia' => $request->existencia,
            'fotos' => $fotosPaths
        ]);

        $producto->categorias()->sync($request->categorias ?? []);

        return redirect()->route('productos.index');
    }

    public function destroy(Producto $producto)
    {
        $this->authorize('delete', $producto);

        if ($producto->fotos) {
            foreach ($producto->fotos as $foto) {
                Storage::disk('public')->delete($foto);
            }
        }

        $producto->delete();

        return redirect()->route('productos.index');
    }
}
