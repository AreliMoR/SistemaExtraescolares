<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-0.5 py-0.5 bg-gray-800 border border-transparent rounded-md font-semibold text-xxs text-white uppercase tracking-wide hover:bg-gray-500 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>

