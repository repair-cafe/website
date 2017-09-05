<?php namespace Liip\RepairCafe\Components;

use Cms\Classes\ComponentBase;

class Button extends ComponentBase
{
    /**
     * {@inheritdoc}
     */
    public function componentDetails()
    {
        return [
            'name'        => 'liip.repaircafe::lang.component.button.details.name',
            'description' => 'liip.repaircafe::lang.component.button.details.description',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function defineProperties()
    {
        return [
            'label' => [
                'title'             => 'liip.repaircafe::lang.component.button.label.title',
                'description'       => 'liip.repaircafe::lang.component.button.label.description',
                'required'          => true,
                'type'              => 'string',
            ],
            'url' => [
                'title'             => 'liip.repaircafe::lang.component.button.url.title',
                'description'       => 'liip.repaircafe::lang.component.button.url.description',
                'required'          => true,
                'type'              => 'string',
            ],
            'target' => [
                'title'             => 'liip.repaircafe::lang.component.button.target.title',
                'description'       => 'liip.repaircafe::lang.component.button.target.description',
                'default'           => '',
                'type'              => 'dropdown',
                'options'           => [
                    '' => 'liip.repaircafe::lang.component.button.target.option.self',
                    '_blank' => 'liip.repaircafe::lang.component.button.target.option.blank',
                ],
            ],
            'style' => [
                'title'             => 'liip.repaircafe::lang.component.button.style.title',
                'description'       => 'liip.repaircafe::lang.component.button.style.description',
                'default'           => 'btn-primary',
                'required'          => true,
                'type'              => 'dropdown',
                'options'           => [
                    'btn-primary' => 'liip.repaircafe::lang.component.button.style.option.btn_primary',
                    'btn-secondary' => 'liip.repaircafe::lang.component.button.style.option.btn_secondary',
                    'btn-outline-primary' => 'liip.repaircafe::lang.component.button.style.option.btn_outline_primary',
                    'btn-outline-secondary' => 'liip.repaircafe::lang.component.button.style.option.btn_outline_secondary',
                ],
            ],
            'position' => [
                'title'             => 'liip.repaircafe::lang.component.button.position.title',
                'description'       => 'liip.repaircafe::lang.component.button.position.description',
                'default'           => '',
                'type'              => 'dropdown',
                'options'           => [
                    '' => 'liip.repaircafe::lang.component.button.position.option.left',
                    'text-center' => 'liip.repaircafe::lang.component.button.position.option.center',
                    'text-right' => 'liip.repaircafe::lang.component.button.position.option.right',
                ],
            ],
            'size' => [
                'title'             => 'liip.repaircafe::lang.component.button.size.title',
                'description'       => 'liip.repaircafe::lang.component.button.size.description',
                'default'           => '',
                'type'              => 'dropdown',
                'options'           => [
                    '' => 'liip.repaircafe::lang.component.button.size.option.normal',
                    'btn-lg' => 'liip.repaircafe::lang.component.button.size.option.large',
                    'btn-sm' => 'liip.repaircafe::lang.component.button.size.option.small',
                ],
            ],
        ];
    }

    /**
     * Get the button label.
     *
     * @return string
     */
    public function getLabel()
    {
        return $this->property('label');
    }

    /**
     * Get the button url.
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->property('url');
    }

    /**
     * Get the button target.
     *
     * @return string
     */
    public function getTarget()
    {
        return $this->property('target');
    }

    /**
     * Get the button class.
     *
     * @return string
     */
    public function getStyle()
    {
        $style = !empty($this->property('style')) ? $this->property('style') : 'btn-primary';
        $style .= !empty($this->property('size')) ? ' ' . $this->property('size') : '';
        return 'btn ' . $style;
    }

    /**
     * Get the button position.
     *
     * @return string
     */
    public function getPosition()
    {
        return !empty($this->property('position')) ? $this->property('position') : '';
    }
}
