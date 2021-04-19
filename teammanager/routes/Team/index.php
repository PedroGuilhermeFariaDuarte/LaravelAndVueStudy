<?php
// Controllers
use App\Http\Controllers\Team\TeamController;

// Route
use Illuminate\Support\Facades\Route;

Route::get("/team/all", [TeamController::class, "index"])
    ->name("team.all");

Route::get("/team/show/{team_id}", [TeamController::class, "show"])
    ->whereNumber("team_id")
    ->name("team.show");

Route::delete("/team/delete/{user_id}/{team_id}", [TeamController::class, "delete"])
    ->whereNumber("team_id")
    ->name("team.delete");

Route::group(["middleware" => ["trimstrings"]], function () {
    Route::post('/team/create', [TeamController::class, "create"])
        ->whereNumber("team_id")
        ->name("team.create");

    Route::put('/team/update/{user_id}/{team_id}', [TeamController::class, "update"])
        ->whereNumber("team_id")
        ->name("team.update");
});
