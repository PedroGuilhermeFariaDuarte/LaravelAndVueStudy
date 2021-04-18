<?php
// Controllers
use App\Http\Controllers\Driver\DriverController;

// Route
use Illuminate\Support\Facades\Route;

Route::get("/driver/all", [DriverController::class, "index"]);

Route::get("/driver/show/{driver_id}", [DriverController::class, "show"])
    ->whereNumber("driver_id");

Route::delete("driver/delete/{driver_id}", [DriverController::class, "delete"])
    ->whereNumber("driver_id");

Route::group(["middleware" => ["trimstrings"]], function () {
    Route::post('/driver/create', [DriverController::class, "create"]);
    Route::put('/driver/update/{driver_id}', [DriverController::class, "update"])
        ->whereNumber("driver_id");
});
