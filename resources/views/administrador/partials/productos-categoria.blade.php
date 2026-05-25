<section class="card">

    <div class="card-header">
        <h2 class="card-title">
            Productos por categoría
        </h2>

        <p class="card-description">
            Distribución de productos registrados en cada categoría.
        </p>
    </div>

    <div class="divide-y divide-slate-100">
        @forelse($productosPorCategoria as $categoria)
        <div class="flex items-center justify-between gap-4 px-5 py-4 sm:px-6">
            <div>
                <p class="font-medium text-slate-900">
                    {{ $categoria->nombre }}
                </p>

                <p class="mt-1 text-sm text-slate-500">
                    Categoría registrada
                </p>
            </div>

            <span class="badge-slate">
                {{ $categoria->productos->count() }} productos
            </span>
        </div>
        @empty
        <div class="px-5 py-8 text-center sm:px-6">
            <p class="text-sm text-slate-500">
                No hay categorías registradas.
            </p>
        </div>
        @endforelse
    </div>

</section>