<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;
use App\Models\Project;

Route::get('/', function () {
    return redirect('dashboard');
});



Route::get('/dashboard', function () {
    $projects = Project::latest()->get();
    return view('dashboard', compact('projects'));
})->middleware(['auth'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::resource('/projects', ProjectController::class)->middleware('auth');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
