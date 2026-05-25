@if($categoria->productos->isNotEmpty())

<section x-data="{ expanded: false }" class="space-y-4">

    <div class="flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <p class="text-sm font-semibold uppercase tracking-wide text-emerald-700">
                Categoría
            </p>

            <h2 class="text-2xl font-bold tracking-tight text-slate-900">
                {{ $categoria->nombre }}
            </h2>

            @if($categoria->descripcion)
            <p class="mt-1 max-w-2xl text-sm text-slate-500">
                {{ $categoria->descripcion }}
            </p>
            @endif
        </div>

        <span class="w-fit rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-600">
            {{ $categoria->productos->count() }} productos
        </span>
    </div>

    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 xl:grid-cols-3">
        @foreach($categoria->productos as $producto)
        <div @if($loop->index >= 6) x-show="expanded" x-cloak @endif>
            @include('cliente.components.producto-card', ['producto' => $producto])
        </div>
        @endforeach
    </div>

    @if($categoria->productos->count() > 6)
    <div class="flex justify-center pt-2">
        <button type="button" @click="expanded = !expanded" class="btn-secondary">
            <span x-show="!expanded">
                Ver más productos
            </span>

            <span x-show="expanded" x-cloak>
                Ver menos
            </span>
        </button>
    </div>
    @endif

</section>

@endif