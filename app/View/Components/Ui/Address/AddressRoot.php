<?php

declare(strict_types=1);

namespace App\View\Components\Ui\Address;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class AddressRoot extends Component
{
    #region CONSTRUCTOR

    /**
     * @param string|null $city
     * @param string|null $country
     * @param string|null $postalCode
     * @param string|null $street
     *
     * @return void
     */
    public function __construct(
        ?string $city,
        ?string $country,
        ?string $postalCode,
        ?string $street,
    ) {
        $this->city = $city;
        $this->country = $country;
        $this->postalCode = $postalCode;
        $this->street = $street;
    }

    #endregion

    #region PROPERTIES

    /**
     * @var string|null
     */
    public readonly ?string $city;

    /**
     * @var string|null
     */
    public readonly ?string $country;

    /**
     * @var string|null
     */
    public readonly ?string $postalCode;

    /**
     * @var string|null
     */
    public readonly ?string $street;

    #endregion

    #region PUBLIC METHODS

    /**
     * {@inheritDoc}
     */
    public function render(): View
    {
        return view('components.ui.address.address-root');
    }

    #endregion
}
