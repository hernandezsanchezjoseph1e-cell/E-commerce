<div id="deleteUserModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-950/55 px-4 py-6 backdrop-blur-sm">
    <div class="delete-user-modal-card overflow-hidden rounded-2xl bg-white shadow-2xl ring-1 ring-slate-900/10">

        <div class="px-6 pt-6 text-center">
            <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-red-50 text-red-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v4m0 4h.01M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z" />
                </svg>
            </div>

            <h2 class="mt-4 text-lg font-bold text-slate-900">
                Eliminar usuario
            </h2>

            <p class="mt-2 text-sm leading-6 text-slate-500">
                Esta acción eliminará al usuario seleccionado y no podrá deshacerse.
            </p>
        </div>

        <div class="px-6 py-5">
            <div class="rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-center">
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                    Usuario seleccionado
                </p>

                <p id="deleteUserName" class="mt-1 text-sm font-bold text-slate-900"></p>
            </div>
        </div>

        <div class="flex gap-3 border-t border-slate-200 bg-slate-50 px-6 py-4">
            <button type="button" id="cancelDeleteUser" class="flex-1 rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-100 focus:outline-none focus:ring-4 focus:ring-slate-300/40">
                Cancelar
            </button>

            <form id="deleteUserForm" method="POST" action="" class="flex-1">
                @csrf
                @method('DELETE')

                <button type="submit" class="w-full rounded-lg bg-red-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-red-700 focus:outline-none focus:ring-4 focus:ring-red-500/20">
                    Eliminar
                </button>
            </form>
        </div>

    </div>
</div>