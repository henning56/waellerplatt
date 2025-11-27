<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DialectExpression;
use Illuminate\Http\Request;

class ExpressionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $expressions = DialectExpression::orderBy('letter')->orderBy('dialect_word')->paginate(10);
        return view('admin.expressions.index', compact('expressions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $letters = range('A', 'Z');
        return view('admin.expressions.create', compact('letters'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'dialect_word' => 'required|string|max:255',
            'german_translation' => 'required|string|max:255',
            'example_sentence' => 'nullable|string',
            // 'region' => 'nullable|string|max:100',
            'letter' => 'required|string|size:1'
        ]);

        DialectExpression::create($validated);

        return redirect()->route('admin.expressions.index')
                        ->with('success', 'Dialektausdruck erfolgreich erstellt!');
    }

    /**
     * Display the specified resource.
     */
    public function show(DialectExpression $expression)
    {
        return view('admin.expressions.show', compact('expression'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DialectExpression $expression)
    {
        $letters = range('A', 'Z');
        return view('admin.expressions.edit', compact('expression', 'letters'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DialectExpression $expression)
    {
        $validated = $request->validate([
            'dialect_word' => 'required|string|max:255',
            'german_translation' => 'required|string|max:255',
            'example_sentence' => 'nullable|string',
            'region' => 'nullable|string|max:100',
            'letter' => 'required|string|size:1'
        ]);

        $expression->update($validated);

        return redirect()->route('admin.expressions.index')
                        ->with('success', 'Dialektausdruck erfolgreich aktualisiert!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DialectExpression $expression)
    {
        $expression->delete();

        return redirect()->route('admin.expressions.index')
                        ->with('success', 'Dialektausdruck erfolgreich gelöscht!');
    }
}