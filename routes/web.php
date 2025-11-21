<?php

use App\Http\Controllers\PlannerController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PlannerController::class, 'index'])->name('index');
Route::post('/processPlanner', [PlannerController::class, 'processPlanner'])->name('processPlanner');
