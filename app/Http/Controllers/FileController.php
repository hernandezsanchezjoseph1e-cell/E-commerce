<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function ticket(Venta $venta)
    {
        $this->authorize('view', $venta);

        if (!$venta->ticket) {
            abort(404);
        }

        return Storage::disk('private')->response($venta->ticket);
    }
}