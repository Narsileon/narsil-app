<?php

declare(strict_types=1);

namespace App\View\Components\Contents\Form;

#region USE

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class FormField extends Component
{
    #region CONSTRUCTOR

    /**
     * @param array<string,mixed> $field
     * @param string|null $namePrefix
     *
     * @return void
     */
    public function __construct(array $field, ?string $namePrefix = null)
    {
        $input = $field['input'] ?? [];

        if ($input instanceof Arrayable)
        {
            $input = $input->toArray();
        }

        if (!is_array($input))
        {
            $input = [];
        }

        $type = is_string($input['type'] ?? null) ? $input['type'] : 'text';

        $htmlType = 'text';
        $fieldName = 'field';
        $fieldOptions = [];

        if (is_string($field['id'] ?? null))
        {
            $fieldName = $namePrefix
                ? $namePrefix . '[' . $field['id'] . ']'
                : $field['id'];
        }

        $options = $input['options'] ?? [];

        if ($options instanceof Arrayable)
        {
            $options = $options->toArray();
        }

        if (is_array($options))
        {
            $fieldOptions = $options;
        }

        if (in_array($type, [
            'color',
            'date',
            'datetime-local',
            'email',
            'file',
            'month',
            'number',
            'password',
            'range',
            'time',
            'week',
        ], true))
        {
            $htmlType = $type;
        }

        $this->fieldData = $field;
        $this->fieldInput = $input;
        $this->fieldName = $fieldName;
        $this->fieldOptions = $fieldOptions;
        $this->fieldType = $type;
        $this->htmlType = $htmlType;
    }

    #endregion

    #region PROPERTIES

    /**
     * @var array<string,mixed>
     */
    public readonly array $fieldData;

    /**
     * @var array<string,mixed>
     */
    public readonly array $fieldInput;

    /**
     * @var string
     */
    public readonly string $fieldName;

    /**
     * @var array<int,array<string,mixed>>
     */
    public readonly array $fieldOptions;

    /**
     * @var string
     */
    public readonly string $fieldType;

    /**
     * @var string
     */
    public readonly string $htmlType;

    #endregion

    #region PUBLIC METHODS

    /**
     * @return View
     */
    public function render(): View
    {
        return view('components.contents.form.form-field');
    }

    #endregion
}
