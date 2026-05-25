<section class="card">

    <div class="card-header">
        <h2 class="card-title">
            Top comprador por categoría
        </h2>

        <p class="card-description">
            Cliente con mayor actividad de compra dentro de cada categoría.
        </p>
    </div>

    <div class="divide-y divide-slate-100">
        @forelse($topCompradorPorCategoria as $item)
        <div class="flex items-center justify-between gap-4 px-5 py-4 sm:px-6">
            <div>
                <p class="font-medium text-slate-900">
                    {{ $item['categoria'] }}
                </p>

                <p class="mt-1 text-sm text-slate-500">
                    Categoría analizada
                </p>
            </div>

            <div class="text-right">
                <p class="text-sm font-semibold text-slate-900">
                    {{ $item['cliente']->nombre ?? 'Sin datos' }}
                </p>

                <p class="mt-1 text-xs text-slate-500">
                    Comprador principal
                </p>
            </div>
        </div>
        @empty
        <div class="px-5 py-8 text-center sm:px-6">
            <p class="text-sm text-slate-500">
                No hay información suficiente para mostrar compradores destacados.
            </p>
        </div>
        @endforelse
    </div>

</section>