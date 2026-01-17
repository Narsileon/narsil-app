<?php

namespace App\Http\Data;

#region USE

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Spatie\LaravelData\Attributes\Computed;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#endregion

#[TypeScript]
final class SessionData extends Data
{
    #region CONSTRUCTOR

    /**
     * @return void
     */
    public function __construct()
    {
        $this->locale = App::getLocale();
        $this->url = Config::get('app.url');
    }

    #endregion

    #region PROPERTIES

    #[Computed]
    public string $locale;
    #[Computed]
    public string $url;

    #endregion
}
