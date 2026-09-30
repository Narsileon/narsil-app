<?php

declare(strict_types=1);

namespace App\View\Components\Footer;

#region USE

use Illuminate\View\Component;

#endregion

final class Contact extends Component
{
    #region CONSTRUCTOR

    /**
     * @param string|null $email
     * @param string|null $phone
     *
     * @return void
     */
    public function __construct(
        ?string $email,
        ?string $phone,
    ) {
        $this->email = $email;
        $this->phone = $phone;
    }

    #endregion

    #region PROPERTIES

    /**
     * @var string|null
     */
    public readonly ?string $email;

    /**
     * @var string|null
     */
    public readonly ?string $phone;

    #endregion

    #region PUBLIC METHODS

    /**
     * {@inheritDoc}
     */
    public function render(): string
    {
        return 'components.footer.contact';
    }

    #endregion
}
