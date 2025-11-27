<?php

namespace App\Http\Controllers;

use App\Services\AnthropicClient;
use Illuminate\Http\Request;

class AnthropicTestController extends Controller
{
    public function __invoke(Request $request, AnthropicClient $anthropic)
    {
        $prompt = $request->input('prompt', "Sag hallo in Wällerplatt");
        $resp = $anthropic->respond($prompt);
        return response()->json($resp);
    }
}
