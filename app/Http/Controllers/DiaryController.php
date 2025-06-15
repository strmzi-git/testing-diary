<?php

namespace App\Http\Controllers;

use App\Models\Diary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DiaryController extends Controller
{
    public function index()
    {
        $all_entries = Diary::all();
        // dd($all_entries);
        return view('diary.index', ['entries' => $all_entries]);
    }

    public function create()
    {
        return view('diary.create');
    }
    public function store(Request $request)
    {

        $validated = $request->validate([
            'title' => "required|string",
            'entry' => 'string'
        ]);
        $validated['user_id'] = Auth::id();
        // dd($validated)

        Diary::create($validated);
        return redirect()->route('diary.index')->with('success', 'Diary entry created successfully.');
    }

    public function show(Diary $diary)
    {
        if($diary->user_id !== Auth::id()) {
            abort(403);
        }
        return view('diary.show', ['entry' => $diary]);
    }

    public function edit(Diary $diary)
    {
        return view('diary.edit', ['entry' => $diary]);
    }

    public function update(Request $request, Diary $diary)
    {
        $validaated = $request->validate([
            'title' => 'required|string',
            'entry' => 'required|string'
        ]);
        $diary->update($validaated);
        return redirect()->route('diary.show', ['diary' => $diary])->with('success', 'Diary entry updated successfully.');
    }

    public function destroy(Diary $diary)
    {
        $diary->delete();
        return redirect()->route('diary.index')->with('success', 'Diary entry deleted.');
    }
}
