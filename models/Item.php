<?php

namespace Ksoft\Links\Models;

use Model;

class Item extends Model
{
    use \October\Rain\Database\Traits\Validation;

    public $table = 'ksoft_links_items';
    public $implement = ['@RainLab.Translate.Behaviors.TranslatableModel'];
    public $translatable = ['title'];

    public $rules = [
        'title' => 'required|max:50',
        'order' => 'numeric',
    ];

    public $customMessages = [
        'link.url' => 'The link format is invalid (http:// or https://)',
    ];

    /**
     * @var array Relations
     */
    public $belongsTo = [
        'category' => ['Ksoft\Links\Models\Category'],
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
            'item_slug' => $this->slug,
        ];

        return $this->pageUrl = $controller->pageUrl($pageName, $params);
    }

    public function imageUrl($size = '300x220')
    {
        if ($this->image != '') {
            return '/storage/app/media'.$this->image;
        } else {
            return 'http://via.placeholder.com/'.$size.'?text='.$this->slug;
        }
    }
}
