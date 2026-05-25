<section class="card card-body">

    <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">

        <div>
            <p class="page-kicker">
                Producto destacado
            </p>

            <h3 class="mt-1 card-title">
                Producto más vendido
            </h3>

            <p class="card-description">
                Producto con mayor número de ventas registradas.
            </p>
        </div>

        @if($productoMasVendido)
        <span class="badge-success">
            {{ $productoMasVendido->unidades_vendidas ?? 0 }} unidades
        </span>
        @endif

    </div>

    <div class="mt-5 rounded-xl border border-slate-200 bg-slate-50 p-4">

        @if($productoMasVendido)
        <p class="text-xl font-bold text-slate-900">
            {{ $productoMasVendido->nombre }}
        </p>

        <p class="mt-2 text-sm text-slate-500">
            Este producto lidera las ventas dentro del sistema.
        </p>
        @else
        <p class="text-sm text-slate-500">
            No hay ventas registradas.
        </p>
        @endif

    </div>

</section>