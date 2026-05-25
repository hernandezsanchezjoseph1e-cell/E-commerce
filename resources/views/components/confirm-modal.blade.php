<div id="confirmModal" class="modal-backdrop hidden">

    <div class="modal-card">

        <div class="px-6 pt-6 text-center">
            <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-red-50 text-red-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v4m0 4h.01M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z" />
                </svg>
            </div>

            <h2 id="confirmModalTitle" class="mt-4 text-lg font-bold text-slate-900">
                Confirmar acción
            </h2>

            <p id="confirmModalMessage" class="mt-2 text-sm leading-6 text-slate-500">
                ¿Seguro que deseas continuar?
            </p>
        </div>

        <form id="confirmModalForm" method="POST" action="">
            @csrf

            <input id="confirmModalMethod" type="hidden" name="_method" value="" disabled>

            <div class="flex flex-col-reverse gap-3 border-t border-slate-200 bg-slate-50 px-6 py-4 sm:flex-row sm:justify-end">
                <button type="button" data-confirm-cancel class="btn-secondary">
                    Cancelar
                </button>

                <button id="confirmModalSubmit" type="submit" class="btn-danger">
                    Confirmar
                </button>
            </div>
        </form>

    </div>

</div>