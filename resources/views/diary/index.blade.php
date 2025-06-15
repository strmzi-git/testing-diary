@extends('layouts.app')

@section('main-content')
<div class="max-w-3xl mx-auto my-8 px-4">
    <h1 class="text-3xl font-bold mb-6 text-center text-gray-800">All Diary Entries</h1>

    @forelse ($entries as $entry)
    <div class="bg-gray-100 border-l-4 border-[#3aa499] p-6 mb-6 rounded-md shadow-sm">
        <p class="text-sm text-gray-500 mb-2">Edited from the host machine</p>
        <h2 class="text-xl font-semibold mb-2 text-gray-900">
            <a href="{{ route('diary.show', ['diary' => $entry]) }}" class="hover:underline">
                {{ $entry->title }}
            </a>
        </h2>
        <p class="text-base text-gray-700 whitespace-pre-line">{{ $entry->entry }}</p>
    </div>
    @empty
    <p class="text-center italic text-gray-500">No entries yet.</p>
    @endforelse
    <a href="{{ route('diary.create') }}" class="hover:underline border rounded-md px-4 py-2 cursor-pointer ">
        Create Entry
    </a>
    </h2>
</div>
@endsection