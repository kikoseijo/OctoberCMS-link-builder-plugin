<?php

namespace Ksoft\Links\Models;

use Model;

/**
 * LinkItem Model.
 */
class LinkItem extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /**
     * @var string
     */
    public $table = 'ksoft_links_items';
    /**
     * @var array
     */
    public $implement = ['@RainLab.Translate.Behaviors.TranslatableModel'];
    /**
     * @var array
     */
    public $translatable = ['title'];

    /**
     * @var array
     */
    public $rules = [
        'title' => 'required|max:50',
        'order' => 'numeric',
        'link'  => 'url'
    ];

    /**
     * @var array
     */
    public $customMessages = [
        'linkItem.link' => 'The link format is invalid (http:// or https://)'
    ];

    /**
     * @var array Relations
     */
    public $belongsTo = [
        'category' => ['Ksoft\Links\Models\Category']
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
            'item_slug' => $this->slug
        ];

        return $this->pageUrl = $controller->pageUrl($pageName, $params);
    }

    /**
     * @param $size
     */
    public function imageUrl($size = '300x220')
    {
        if ($this->image != '') {
            return '/storage/app/media'.$this->image;
        } else {
            return 'http://via.placeholder.com/'.$size.'?text='.$this->slug;
        }
    }
}
