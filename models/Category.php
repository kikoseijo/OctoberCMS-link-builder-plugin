<?php

namespace Ksoft\Links\Models;

use Model;

/**
 * Category Model.
 */
class Category extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /**
     * @var array
     */
    public $implement = ['@RainLab.Translate.Behaviors.TranslatableModel'];

    /**
     * @var array
     */
    public $rules = [
        'name'  => 'required|max:50',
        'order' => 'numeric',
    ];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'ksoft_links_categories';

    /**
     * @var array Guarded fields
     */
    protected $guarded = [];

    /**
     * @var array Translatable fields
     */
    public $translatable = ['name', 'description'];

    /**
     * @var array Relations
     */
    public $hasMany = [
        'items' => ['Ksoft\Links\Models\LinkItem'],
    ];

    /**
     * Set the PageUrl parameter to link the correct page.
     *
     * @param $pageName
     * @param $controller
     *
     * @return mixed
     */
    public function setPageUrl($pageName, $controller)
    {
        $params = [
            'selected_cat' => $this->slug,
        ];

        //dd($controller->pageUrl($pageName, $params));

        return $this->pageUrl = $controller->pageUrl($pageName, $params);
    }
}
