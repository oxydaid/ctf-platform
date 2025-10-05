<?php

use App\Livewire\Home;
use Livewire\Volt\Volt;
use App\Livewire\Challenges;
use App\Livewire\Leaderboards;
use App\Livewire\ChallengeDetail;
use Illuminate\Support\Facades\Route;

Route::get('/', Home::class)->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {

    Route::get('challenges', Challenges::class)->name('challenges');
    Route::get('/challenges/{challenge}', ChallengeDetail::class)->name('challenges.detail');
    Route::get('leaderboards', Leaderboards::class)->name('leaderboards');
    
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__ . '/auth.php';
