<div class="grid grid-cols-1 gap-5 sm:grid-cols-3">

    <div class="card card-body">
        <p class="text-sm font-medium text-slate-500">
            Total usuarios
        </p>

        <p class="mt-2 text-3xl font-bold text-slate-900">
            {{ $totalUsuarios }}
        </p>

        <p class="mt-1 text-xs text-slate-400">
            Usuarios registrados en el sistema
        </p>
    </div>

    <div class="card card-body">
        <p class="text-sm font-medium text-slate-500">
            Vendedores
        </p>

        <p class="mt-2 text-3xl font-bold text-slate-900">
            {{ $totalVendedores }}
        </p>

        <p class="mt-1 text-xs text-slate-400">
            Gerentes con productos registrados
        </p>
    </div>

    <div class="card card-body">
        <p class="text-sm font-medium text-slate-500">
            Compradores
        </p>

        <p class="mt-2 text-3xl font-bold text-slate-900">
            {{ $totalCompradores }}
        </p>

        <p class="mt-1 text-xs text-slate-400">
            Clientes disponibles para comprar
        </p>
    </div>

</div>