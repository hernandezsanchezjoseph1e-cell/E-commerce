<?php

namespace App\Http\Requests\Producto;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('create', \App\Models\Producto::class);
    }

    public function rules(): array
    {
        return [
            'nombre'      => ['required', 'string', 'max:255'],
            'descripcion' => ['nullable', 'string', 'max:1000'],
            'precio'      => ['required', 'numeric', 'min:0'],
            'existencia'  => ['required', 'integer', 'min:0'],
            'fotos' => 'nullable|array',
            'fotos.*' => 'image|mimes:jpg,jpeg,png|max:2048',
            'categorias'  => ['nullable', 'array'],
            'categorias.*' => ['integer', 'exists:categorias,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required'      => 'El nombre del producto es obligatorio.',
            'nombre.max'           => 'El nombre no puede superar 255 caracteres.',
            'precio.required'      => 'El precio es obligatorio.',
            'precio.numeric'       => 'El precio debe ser un número.',
            'precio.min'           => 'El precio no puede ser negativo.',
            'existencia.required'  => 'La existencia es obligatoria.',
            'existencia.integer'   => 'La existencia debe ser un número entero.',
            'existencia.min'       => 'La existencia no puede ser negativa.',
            'categorias.*.exists'  => 'Una o más categorías seleccionadas no existen.',
        ];
    }
}
