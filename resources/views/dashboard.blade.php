<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    Hola Admin!
                </div>
            </div>
            <a href="{{route('admin_crear_usuario')}}" class="bg-ucn-color hover:bg-ucn-color focus:bg-green-900 | focus:outline-none border rounded-md text-white focus:text-white p-2 transition ease-in-out duration-150">
                <button>
                    Admin
                </button>
            </a>    
        </div>
    </div>

    
    
</x-app-layout>
