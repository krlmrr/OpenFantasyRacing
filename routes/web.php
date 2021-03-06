<?php

use App\Http\Controllers\ConstructorController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FantasyTeamController;
use App\Http\Controllers\FAQController;
use App\Http\Controllers\LeagueController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RuleController;
use Illuminate\Support\Facades\Route;

Route::inertia('/', 'Home')->name('home');

Route::controller(FAQController::class)->group(function () {
    Route::get('/faq', 'index')->name('faq.index');
});

Route::controller(RuleController::class)->group(function () {
    Route::get('/rules', 'index')->name('rules.index');
});

Route::group(['prefix' => 'franchise/{franchise_slug}/'], function () {
    Route::controller(ConstructorController::class)->group(function () {
        Route::get('/constructors', 'index')->name('constructor.index');
        Route::get('/constructor/{slug}', 'show')->name('constructor.show');
    });

    Route::controller(DriverController::class)->group(function () {
        Route::get('/drivers', 'index')->name('driver.index');
        Route::get('/driver/{id}', 'show')->name('driver.show');
    });

    Route::controller(EventController::class)->group(function () {
        Route::get('/events', 'index')->name('event.index');
        Route::get('/event/{id}', 'show')->name('event.show');
    });
});

// Requires Auth
Route::middleware(['auth', 'verified'])->group(function () {
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/dashboard', 'index')->name('dashboard.index');
    });

    Route::controller(LeagueController::class)->group(function () {
        Route::get('/leagues/create', 'create')->name('league.create');
        Route::get('/leagues/{id}', 'show')->name('league.show');
        Route::post('/leagues', 'store')->name('league.store');
    });

    Route::group(['prefix' => '/leagues/{league}/'], function () {
        Route::controller(FantasyTeamController::class)->group(function () {
            Route::get('/team/{team}', 'show')->name('fantasy-team.show');
        });
    });

    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::post('/profile', 'update')->name('profile.update');
    });
});

require __DIR__ . '/auth.php';
