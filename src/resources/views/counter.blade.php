<x-app-layout title="">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('counter') }}
        </h2>
    </x-slot>
    <livewire:counter />
</x-app-layout>