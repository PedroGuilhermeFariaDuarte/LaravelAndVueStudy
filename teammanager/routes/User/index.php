<?php
// Controllers
use App\Http\Controllers\User\UserController;

// Route
use Illuminate\Support\Facades\Route;

Route::get("/user/all", [UserController::class, "index"]);

Route::get("/user/show/{user_id}", [UserController::class, "show"])
    ->whereNumber("user_id");

Route::delete("/user/delete/{user_id}", [UserController::class, "delete"])
    ->whereNumber("user_id");

Route::group(["middleware" => ["trimstrings"]], function () {
    Route::post('/user/create', [UserController::class, "create"]);
    Route::put('/user/update/{user_id}', [UserController::class, "update"])
        ->whereNumber("user_id");
});
