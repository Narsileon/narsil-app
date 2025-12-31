<?php

namespace App\Http\Controllers;

#region USE

use Database\Seeders\TemplateSeeder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

#endregion

class SeederController extends Controller
{
    #region PUBLIC METHODS

    /**
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function __invoke(Request $request): RedirectResponse
    {
        Artisan::call('db:seed', [
            '--class' => TemplateSeeder::class,
        ]);

        return back()
            ->with('success', trans('toasts.success.seeded'));
    }

    #endregion
}
