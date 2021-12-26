@props(['disabled' => false, 'isValid' => true])
@if ($attributes->get('input') === 'select')
    <select {!! $isValid ? $attributes->merge(['class' => 'mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm']) : $attributes->merge(['class' => 'mt-1 block w-full py-2 px-3 border border-red-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-red-700 focus:border-red-700 sm:text-sm']) !!}>
        {{ $slot }}
    </select>
@else
    <input {{ $disabled ? 'disabled' : '' }} {!! $isValid ? $attributes->merge(['class' => 'focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md']) : $attributes->merge(['class' => 'focus:ring-red-700 focus:border-red-700 border-2 block w-full shadow-sm sm:text-sm border-red-400 rounded-md']) !!}>
@endif
