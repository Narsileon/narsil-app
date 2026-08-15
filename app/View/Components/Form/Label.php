<?php

declare(strict_types=1);

namespace App\View\Components\Form;

#region USE

use Illuminate\View\Component;

#endregion

final class Label extends Component
{
    #region CONSTRUCTOR

    /**
     * @param array<string,mixed> $field
     * @param string $fieldName
     *
     * @return void
     */
    public function __construct(array $field, string $fieldName)
    {
        $this->label = is_string($field['label'] ?? null)
            ? $field['label']
            : $fieldName;
        $this->required = (bool) ($field['required'] ?? false);
    }

    #endregion

    #region PROPERTIES

    /**
     * @var string
     */
    public readonly string $label;

    /**
     * @var boolean
     */
    public readonly bool $required;

    #endregion

    #region PUBLIC METHODS

    /**
     * @return string
     */
    public function render(): string
    {
        return 'components.form.label';
    }

    #endregion
}
