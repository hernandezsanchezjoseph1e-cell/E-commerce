<?php

namespace App\Http\Requests\Venta;

use Illuminate\Foundation\Http\FormRequest;

class StoreVentaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('create', \App\Models\Venta::class);
    }

    public function rules(): array
    {
        return [
            'producto_id' => ['required', 'integer', 'exists:productos,id'],
            'cliente_id'  => ['required', 'integer', 'exists:users,id'],
            'fecha'       => ['nullable', 'date'],
            'ticket' => ['nullable|image|mimes:jpg,jpeg,png|max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'producto_id.required' => 'Debe seleccionar un producto.',
            'producto_id.exists'   => 'El producto seleccionado no existe.',
            'cliente_id.required'  => 'Debe seleccionar un cliente.',
            'cliente_id.exists'    => 'El cliente seleccionado no existe.',
            'fecha.date'           => 'La fecha no tiene un formato válido.',
        ];
    }
}
