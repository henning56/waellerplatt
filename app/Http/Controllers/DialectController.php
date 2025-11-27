<?php

namespace App\Http\Controllers;

use App\Models\DialectExpression;
use Illuminate\Http\Request;

class DialectController extends Controller
{
    public function expressions(Request $request)
    {
        $perPage = 30;
        
        if ($request->ajax()) {
            $expressions = DialectExpression::orderBy('letter')
                ->orderBy('dialect_word')
                ->paginate($perPage);

            return response()->json([
                'html' => view('dialect.partials.expressions_list', compact('expressions'))->render(),
                'hasMore' => $expressions->hasMorePages() // WICHTIG: 'hasMore' nicht 'hasMorePages'
            ]);
        }

        $expressions = DialectExpression::orderBy('letter')
            ->orderBy('dialect_word')
            ->paginate($perPage);

        $letters = range('A', 'Z');

        return view('dialect.expressions', compact('expressions', 'letters'));
    }

    public function byLetter(Request $request, $letter)
    {
        $perPage = 30;
        
        if ($request->ajax()) {
            $expressions = DialectExpression::where('letter', $letter)
                ->orderBy('dialect_word')
                ->paginate($perPage);

            return response()->json([
                'html' => view('dialect.partials.expressions_list', compact('expressions'))->render(),
                'hasMore' => $expressions->hasMorePages() // WICHTIG: 'hasMore' nicht 'hasMorePages'
            ]);
        }

        $expressions = DialectExpression::where('letter', $letter)
            ->orderBy('dialect_word')
            ->paginate($perPage);

        $letters = range('A', 'Z');

        return view('dialect.expressions', compact('expressions', 'letters'));
    }
}