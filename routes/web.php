<?php

use App\Http\Controllers\DialectController;
use App\Http\Controllers\Admin\ExpressionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;

use App\Http\Controllers\HirtenfestController;

Route::get('/hirtenfest', [HirtenfestController::class, 'index'])->name('hirtenfest');
Route::get('/', function () {
    return view('home');})->name('home');
Route::get('/reime', function () {
    return view('reime');})->name('reime');
Route::get('/mundart', function () {
    return view('mundart');})->name('mundart');
Route::get('/aussprache', function () {
    return view('aussprache');})->name('aussprache');
Route::get('/weisheiten', function () {
    return view('weisheiten');})->name('weisheiten');


Route::get('/check-columns', function() {
    $tableName = 'dialect_expressions'; // Ersetze mit dem tatsächlichen Tabellennamen
    $columns = Schema::getColumnListing($tableName);
    dd($columns);
});

// Öffentliche Routes
Route::get('/dialect', [DialectController::class, 'index'])->name('dialect.index'); 
Route::get('/ausdruecke', [DialectController::class, 'expressions'])->name('dialect.expressions');
Route::get('/ausdruecke/{letter}', [DialectController::class, 'byLetter'])->name('dialect.by-letter');
// Temporär in routes/web.php testen
Route::get('/test-count', function() {
    return [
        'total' => \App\Models\DialectExpression::count(),
        'per_page' => 30,
        'pages' => ceil(\App\Models\DialectExpression::count() / 30)
    ];
});
// Temporär in routes/web.php
Route::get('/test-pagination', function() {
    $expressions = \App\Models\DialectExpression::paginate(30);
    return [
        'current_page' => $expressions->currentPage(),
        'data_count' => $expressions->count(),
        'total' => $expressions->total(),
        'has_more' => $expressions->hasMorePages(),
        'next_page_url' => $expressions->nextPageUrl()
    ];
});
    
    // Temporary Anthropic test route (GET param `prompt`)
    use App\Http\Controllers\AnthropicTestController;
    Route::get('/_anthropic_test', AnthropicTestController::class)->name('anthropic.test');

// Geschützte Admin-Routes mit DASHBOARD
Route::middleware(['auth'])->group(function () {
    // Dashboard Route (ersetzt Breeze Dashboard)
    Route::get('/dashboard', [ExpressionController::class, 'index'])->name('dashboard');
    
    // Admin Bereich
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('expressions', ExpressionController::class);
    });
    
    // Profile Routes (von Breeze - müssen manuell hinzugefügt werden)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// BREEZE AUTH ROUTES EINBINDEN
require __DIR__.'/auth.php';