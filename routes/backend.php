    <?php

    #region USE

    use App\Http\Controllers\Backend\DashboardController;
    use Illuminate\Support\Facades\Route;

    #endregion

    Route::get('/', DashboardController::class)
        ->name('dashboard');
