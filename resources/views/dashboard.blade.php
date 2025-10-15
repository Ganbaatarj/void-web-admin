<x-app-layout>
    <x-slot name="title">Хянах самбар</x-slot>
    <h1 class="text-2xl font-bold mb-4">Тавтай морил, {{ Auth::user()->name }}!</h1>
    <p>Энэ бол таны удирдлагын хуудас юм.</p>
</x-app-layout>