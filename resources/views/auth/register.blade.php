@extends('layouts.app')

@section('main-content')
<div class="max-w-md mx-auto my-12 px-6 py-8 bg-gray-50 border border-gray-400 rounded-md shadow-md">
    <h1 class="text-2xl font-bold text-center mb-6 text-gray-700">Create a New Account</h1>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <div>
            <label class="block mb-1 text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" required
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#3aa499] focus:border-transparent">
        </div>

        <div>
            <label class="block mb-1 text-sm font-medium text-gray-700">password</label>
            <input type="password" name="password" required
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#3aa499] focus:border-transparent">
        </div>

        <button type="submit"
            class="w-full bg-[#3aa499] hover:bg-[#2b8b81] text-white font-semibold py-2 rounded-md transition-colors">
            Register
        </button>
    </form>

    <div class="text-center mt-4">
        <a href="{{ route('login') }}" class="text-sm text-[#3aa499] hover:underline">Login here</a>
    </div>

    @if ($errors->any())
    <div class="mt-4 text-red-600 text-sm text-center">
        {{ $errors->first() }}
    </div>
    @endif
</div>
@endsection