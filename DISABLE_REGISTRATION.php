<?php
// HOW TO DISABLE REGISTRATION IN LARAVEL BREEZE
// ================================================
// After installing Breeze, do ONE of the following:

// OPTION 1 — Remove the registration routes from routes/auth.php
// Open routes/auth.php and DELETE or COMMENT OUT these lines:
//
//   Route::get('register', [RegisteredUserController::class, 'create'])
//                   ->name('register');
//
//   Route::post('register', [RegisteredUserController::class, 'store']);
//
// This is the cleanest and recommended approach.


// OPTION 2 — Redirect the /register route to login
// Add this to routes/web.php:
//
//   Route::get('/register', function () {
//       return redirect()->route('login');
//   });


// OPTION 3 — Return 404 for registration attempts
// In routes/web.php:
//
//   Route::get('/register',  fn() => abort(404));
//   Route::post('/register', fn() => abort(404));


// Also remove the "Register" link from the navigation view:
// resources/views/layouts/navigation.blade.php
// Find and delete:
//   <a href="{{ route('register') }}">Register</a>
