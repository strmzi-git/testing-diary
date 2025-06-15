@extends('layouts.app')

@section('main-content')
<div class="max-w-2xl mx-auto mt-8 p-6 bg-white border-l-4 border-[#3aa499] rounded-lg shadow-md">
    <h1 class="text-2xl font-bold mb-4 text-gray-800">{{ $entry->title }}</h1>
    <p class="text-lg text-gray-700 whitespace-pre-line mb-8">{{ $entry->entry }}</p>

    <div class="flex gap-4">
        <a
            href="{{ route('diary.edit', $entry->id) }}"
            class="bg-[#3aa499] text-white px-5 py-2 rounded-md font-semibold hover:bg-[#329485] transition"
        >
            Edit
        </a>

        <form
            action="{{ route('diary.destroy', $entry->id) }}"
            method="POST"
            onsubmit="return confirm('Are you sure you want to delete this entry?')"
            class="inline"
        >
            @csrf
            @method('DELETE')
            <button
                type="submit"
                class="bg-red-500 text-white px-5 py-2 rounded-md font-semibold hover:bg-red-600 transition"
            >
                Delete
            </button>
        </form>
    </div>
</div>
@endsection
