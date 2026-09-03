<?php

declare(strict_types=1);

namespace App\View\Components\Blocks;

#region USE

use Illuminate\Support\Str;
use Illuminate\View\Component;

#endregion

final class Form extends Component
{
    #region CONSTRUCTOR

    /**
     * @param array<string,mixed> $data
     * @param string|null $nodeId
     * @param string $paddingBottom
     * @param string $paddingTop
     *
     * @return void
     */
    public function __construct(
        array $data,
        ?string $nodeId = null,
        string $paddingBottom = '',
        string $paddingTop = '',
    )
    {
        $form = is_array($data['form'] ?? null) ? $data['form'] : [];

        if (isset($form[0]) && is_array($form[0]))
        {
            $form = $form[0];
        }

        $this->blockData = $data;
        $this->form = $form;
        $this->nodeId = $nodeId;
        $this->paddingBottom = $paddingBottom;
        $this->paddingTop = $paddingTop;
        $this->steps = is_array($form['steps'] ?? null) ? $form['steps'] : [];
        $this->submitted = (bool) session('success', false);
        $this->uuid = is_string($form['uuid'] ?? null) ? $form['uuid'] : (string) Str::uuid();
    }

    #endregion

    #region PROPERTIES

    /**
     * @var array<string,mixed>
     */
    public readonly array $blockData;

    /**
     * @var array<string,mixed>
     */
    public readonly array $form;

    /**
     * @var string|null
     */
    public readonly ?string $nodeId;

    /**
     * @var string
     */
    public readonly string $paddingBottom;

    /**
     * @var string
     */
    public readonly string $paddingTop;

    /**
     * @var boolean
     */
    public readonly bool $submitted;

    /**
     * @var array<int,array<string,mixed>>
     */
    public readonly array $steps;

    /**
     * @var string
     */
    public readonly string $uuid;

    #endregion

    #region PUBLIC METHODS

    /**
     * @return string
     */
    public function render(): string
    {
        return 'components.blocks.form';
    }

    #endregion
}
