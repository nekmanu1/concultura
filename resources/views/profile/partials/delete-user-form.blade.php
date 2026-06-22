<section>

    <div class="p-6">

        <div class="bg-red-50 border border-red-200 rounded-xl p-4 mb-6">

            <div class="flex gap-3">

                <x-heroicon-o-exclamation-triangle
                    class="w-6 h-6 text-red-600 flex-shrink-0" />

                <div>

                    <p class="font-semibold text-red-700">
                        Advertencia
                    </p>

                    <p class="text-sm text-red-600">
                        Una vez eliminada la cuenta, todos los datos, evaluaciones,
                        configuraciones y registros asociados serán eliminados de forma
                        permanente y no podrán recuperarse.
                    </p>

                </div>

            </div>

        </div>

        <button
            x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
            class="inline-flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white px-5 py-3 rounded-xl shadow">

            <x-heroicon-o-trash class="w-5 h-5" />

            Eliminar cuenta

        </button>

    </div>

    <x-modal
        name="confirm-user-deletion"
        :show="$errors->userDeletion->isNotEmpty()"
        focusable>

        <form method="post"
              action="{{ route('profile.destroy') }}"
              class="p-6">

            @csrf
            @method('delete')

            <div class="flex items-center gap-3 mb-4">

                <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center">
                    <x-heroicon-o-exclamation-triangle class="w-6 h-6 text-red-600" />
                </div>

                <div>
                    <h2 class="text-xl font-bold text-gray-900">
                        Confirmar eliminación
                    </h2>

                    <p class="text-sm text-gray-500">
                        Esta acción no puede deshacerse.
                    </p>
                </div>

            </div>

            <div class="bg-red-50 border border-red-200 rounded-xl p-4 mb-6">

                <p class="text-sm text-red-700">
                    ¿Estás seguro de que deseas eliminar tu cuenta?
                    Todos los datos asociados serán eliminados permanentemente.
                </p>

            </div>

            <div>

                <label class="flex items-center gap-2 text-sm font-semibold text-gray-700 mb-2">
                    <x-heroicon-o-lock-closed class="w-5 h-5 text-red-600" />
                    Contraseña
                </label>

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="w-full border-gray-300 rounded-xl"
                    placeholder="Ingrese su contraseña" />

                <x-input-error
                    :messages="$errors->userDeletion->get('password')"
                    class="mt-2" />

            </div>

            <div class="mt-6 flex justify-end gap-2 border-t pt-4">

                <button
                    type="button"
                    x-on:click="$dispatch('close')"
                    class="inline-flex items-center gap-2 bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-xl">

                    <x-heroicon-o-x-mark class="w-5 h-5" />

                    Cancelar

                </button>

                <button
                    type="submit"
                    class="inline-flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-xl">

                    <x-heroicon-o-trash class="w-5 h-5" />

                    Eliminar definitivamente

                </button>

            </div>

        </form>

    </x-modal>

</section>