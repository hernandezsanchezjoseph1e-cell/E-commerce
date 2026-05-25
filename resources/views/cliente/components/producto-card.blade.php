<article class="group overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm transition hover:-translate-y-0.5 hover:border-emerald-200 hover:shadow-lg">

    <div class="relative bg-slate-100">

        @php
        $fotoProducto = is_array($producto->fotos) ? ($producto->fotos[0] ?? null) : null;
        @endphp

        @if($fotoProducto)
        <img src="{{ asset('storage/' . $fotoProducto) }}" alt="{{ $producto->nombre }}" class="h-56 w-full object-cover transition duration-300 group-hover:scale-105">
        @else
        <div class="flex h-56 w-full items-center justify-center bg-gradient-to-br from-slate-100 to-slate-200 text-slate-400">
            <div class="text-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75A2.25 2.25 0 0 1 6 4.5h12a2.25 2.25 0 0 1 2.25 2.25v10.5A2.25 2.25 0 0 1 18 19.5H6a2.25 2.25 0 0 1-2.25-2.25V6.75Zm3 8.25 2.72-2.72a.75.75 0 0 1 1.06 0l1.72 1.72 3.22-3.22a.75.75 0 0 1 1.06 0L20.25 14.5M8.25 8.25h.01" />
                </svg>

                <p class="mt-2 text-sm font-medium">
                    Sin imagen
                </p>
            </div>
        </div>
        @endif

        <div class="absolute left-4 top-4">
            @if($producto->existencia > 5)
            <span class="rounded-full bg-emerald-600 px-3 py-1 text-xs font-semibold text-white shadow-sm">
                Disponible
            </span>
            @elseif($producto->existencia > 0)
            <span class="rounded-full bg-amber-500 px-3 py-1 text-xs font-semibold text-white shadow-sm">
                Últimas piezas
            </span>
            @else
            <span class="rounded-full bg-slate-700 px-3 py-1 text-xs font-semibold text-white shadow-sm">
                Sin stock
            </span>
            @endif
        </div>

    </div>

    <div class="flex min-h-[300px] flex-col p-5">

        <div class="flex-1">
            <h3 class="line-clamp-2 text-lg font-bold text-slate-900">
                {{ $producto->nombre }}
            </h3>

            <div class="mt-3 rounded-xl border border-slate-200 bg-slate-50 px-3 py-2">
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                    Vendedor
                </p>

                <p class="mt-1 text-sm font-semibold text-slate-800">
                    {{ $producto->usuario?->nombreCompleto() ?: 'Vendedor no disponible' }}
                </p>
            </div>

            <p class="mt-3 line-clamp-3 text-sm leading-6 text-slate-500">
                {{ $producto->descripcion ?? 'Producto disponible en Tech & Home.' }}
            </p>

            <div class="mt-4 flex items-end justify-between gap-4">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                        Precio
                    </p>

                    <p class="mt-1 text-2xl font-bold text-slate-900">
                        ${{ number_format($producto->precio, 2) }}
                    </p>
                </div>

                <div class="text-right">
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                        Stock
                    </p>

                    <p class="mt-1 text-sm font-semibold text-slate-700">
                        {{ $producto->existencia }} disponibles
                    </p>
                </div>
            </div>
        </div>

        <div class="mt-5 border-t border-slate-100 pt-4">

            @if($producto->existencia > 0)
            <form action="{{ route('carrito.agregar', $producto) }}" method="POST">
                @csrf

                <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
                    <div class="sm:w-24">
                        <label for="cantidad-{{ $producto->id }}" class="sr-only">
                            Cantidad
                        </label>

                        <input id="cantidad-{{ $producto->id }}" type="number" name="cantidad" min="1" max="{{ $producto->existencia }}" value="1" class="w-full rounded-lg border border-slate-300 px-3 py-2.5 text-center text-sm font-semibold text-slate-900 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                    </div>

                    <button type="submit" class="inline-flex flex-1 items-center justify-center rounded-lg bg-slate-900 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-emerald-700 focus:outline-none focus:ring-4 focus:ring-emerald-500/20">
                        Agregar al carrito
                    </button>
                </div>
            </form>
            @else
            <button type="button" disabled class="inline-flex w-full cursor-not-allowed items-center justify-center rounded-lg bg-slate-200 px-4 py-2.5 text-sm font-semibold text-slate-500">
                Producto sin stock
            </button>
            @endif

        </div>

    </div>

</article>