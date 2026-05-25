<?php

namespace App\Http\Requests\Venta;

use App\Models\Producto;
use App\Models\User;
use App\Models\Venta;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class StoreVentaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->can('create', Venta::class) ?? false;
    }

    public function rules(): array
    {
        return [
            'producto_id' => ['required', 'integer', 'exists:productos,id',],
            'cliente_id' => [
                $this->user()?->isGerente() ? 'required' : 'nullable',
                'integer',
                // Verifica que el cliente realmente sea cliente
                Rule::exists('users', 'id')->where(function ($query) {
                    $query->where('role', User::ROLE_CLIENTE);
                }),
            ],

            'cantidad' => ['required', 'integer', 'min:1',],
            'ticket' => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:4096',],
        ];
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function ($validator) {
            $productoId = $this->input('producto_id');
            $cantidad = (int) $this->input('cantidad', 1);

            if (!$productoId) {
                return;
            }

            $producto = Producto::find($productoId);

            if (!$producto) {
                return;
            }

            if ($producto->existencia < $cantidad) {
                $validator->errors()->add(
                    'cantidad',
                    'No hay suficiente inventario para completar la venta.'
                );
            }
        });
    }

    public function messages(): array
    {
        return [
            'producto_id.required' => 'Debe seleccionar un producto.',
            'producto_id.exists' => 'El producto seleccionado no existe.',

            'cliente_id.required' => 'Debe seleccionar un cliente.',
            'cliente_id.exists' => 'El cliente seleccionado no existe o no tiene rol de cliente.',

            'cantidad.required' => 'Debe ingresar la cantidad.',
            'cantidad.integer' => 'La cantidad debe ser un número entero.',
            'cantidad.min' => 'La cantidad mínima es 1.',

            'fecha.date' => 'La fecha no tiene un formato válido.',

            'ticket.file' => 'El ticket debe ser un archivo válido.',
            'ticket.mimes' => 'El ticket debe ser JPG, JPEG, PNG o PDF.',
            'ticket.max' => 'El ticket no debe pesar más de 4 MB.',
        ];
    }
}
