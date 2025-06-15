@extends('layouts.app')

@section('main-content')
<div class="max-w-2xl mx-auto mt-8 p-6 bg-white rounded-lg shadow-md">
    <h1 class="text-2xl font-semibold mb-6 text-center text-gray-800">Edit Diary Entry</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 border border-green-200 rounded-md p-4 mb-6">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('diary.update', $entry->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label for="title" class="block mb-2 font-semibold text-gray-700">Title</label>
            <input
                type="text"
                name="title"
                id="title"
                value="{{ old('title', $entry->title) }}"
                required
                class="w-full px-4 py-2 border border-gray-300 rounded-md text-base focus:outline-none focus:ring-2 focus:ring-[#3aa499]"
            >
            @error('title')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="entry" class="block mb-2 font-semibold text-gray-700">Entry</label>
            <textarea
                name="entry"
                id="entry"
                rows="8"
                required
                class="w-full px-4 py-2 border border-gray-300 rounded-md text-base resize-y focus:outline-none focus:ring-2 focus:ring-[#3aa499]"
            >{{ old('entry', $entry->entry) }}</textarea>
            @error('entry')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <button
            type="submit"
            class="bg-[#3aa499] text-white px-6 py-2 rounded-md font-semibold hover:bg-[#329485] transition"
        >
            Update Entry
        </button>
    </form>
</div>
@endsection
