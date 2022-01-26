<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
            
        </x-slot>


        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('admin_store_usuario') }}">
            @csrf

            <!-- Rut -->
            <div>
                <x-label for="rut" :value="__('Rut')" />

                <x-input id="rut" class="block mt-1 w-full" type="text" name="rut" :value="old('rut')" required autofocus />
            </div>

            <!-- Nombre -->
            <div class="mt-4">
                <x-label for="nombre" :value="__('Nombre')" />

                <x-input id="nombre" class="block mt-1 w-full" type="text" name="nombre" :value="old('nombre')" required autofocus />
            </div>

            <!-- Apellido -->
            <div class="mt-4">
                <x-label for="apellido" :value="__('Apellido')" />

                <x-input id="apellido" class="block mt-1 w-full" type="text" name="apellido" :value="old('apellido')" required autofocus />
            </div>

            <!-- Email -->
            <div class="mt-4">
                <x-label for="correo" :value="__('Correo')" />

                <x-input id="correo" class="block mt-1 w-full" type="text" name="correo" :value="old('correo')" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>

            <br>

            <!--<div class="dropdown show">
                <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Dropdown link
                </a>
              
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                  <a class="dropdown-item" href="#">Action</a>
                  <a class="dropdown-item" href="#">Another action</a>
                  <a class="dropdown-item" href="#">Something else here</a>
                </div>
              </div>-->

              <div class="form-group">
                <label for="tipo_trabajador">Tipo de Trabajador:</label>

                <select class="form-control"  id="tipo_trabajador" name="tipo_trabajador" title="Escoja el tipo de trabajador:
                - Vendedor solo podrá acceder a listado de precios y realizar ventas a clientes
                - Ejecutivo podrá acceder a lo anterior dicho y a tareas de administración de inventario y catálogo">
                    <option value="1">Ejecutivo</option>
                    <option value="2">Vendedor</option>
                  </select>
              </div>


            

            <div class="flex items-center justify-end mt-4">

                <x-button class="ml-4">
                    {{ __('Registrar') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
