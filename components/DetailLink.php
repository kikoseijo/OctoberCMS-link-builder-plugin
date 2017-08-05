<?php

namespace Ksoft\Links\Components;

use Cms\Classes\ComponentBase;
use Cms\Classes\Page;
use Ksoft\Links\Models\LinkItem;
use Lang;

class DetailLink extends ComponentBase
{
    /**
     * Value holds the selected item to display.
     *
     * @var
     */
    public $linkItem;

    /**
     * Reference to the page where items of a category are displayed.
     *
     * @var
     */
    public $catListPage;

    public function componentDetails()
    {
        return [
            'name'        => 'ksoft.links::lang.components.item.name',
            'description' => 'ksoft.links::lang.components.item.description',
        ];
    }

    public function defineProperties()
    {
        return [
            'item'        => [
                'title'       => 'ksoft.links::lang.components.item.properties.item.title',
                'description' => 'ksoft.links::lang.components.item.properties.item.description',
                'type'        => 'dropdown',
                'default'     => '1',
            ],
            'itemSlug'    => [
                'title'       => 'ksoft.links::lang.components.item.properties.itemSlug.title',
                'description' => 'ksoft.links::lang.components.item.properties.itemSlug.description',
                'type'        => 'string',
                'default'     => '{{ :item_slug }}',
                'group'       => 'ksoft.links::lang.components.links.properties.group.advanced',
            ],
            'catListPage' => [
                'title'       => 'ksoft.links::lang.components.links.properties.catListPage.title',
                'description' => 'ksoft.links::lang.components.links.properties.catListPage.description',
                'type'        => 'dropdown',
                'group'       => 'ksoft.links::lang.components.links.properties.group.links',
            ],
        ];
    }

    /**
     * Get options for the item dropdown.
     *
     * @return mixed
     */
    public function getItemOptions()
    {
        $categories    = LinkItem::lists('title', 'slug');
        $categories[0] = Lang::get('ksoft.links::lang.components.item.properties.item.none');

        return $categories;
    }

    /**
     * Get options for the dropdown where the link to the category list page can be selected.
     *
     * @return mixed
     */
    public function getCatListPageOptions()
    {
        return Page::sortBy('baseFileName')->lists('baseFileName', 'baseFileName');
    }

    public function onRun()
    {
        // Page links
        $this->catListPage = $this->page['catListPage'] = $this->property('catListPage');

        // find the correct property to select the items with
        $object = null;
        if ($this->property('itemSlug') != null && $this->property('itemSlug') != 'default') {
            $object = $this->loadItemBySlug($this->property('itemSlug'));
        } elseif ($this->property('item') != null && $this->property('item') != 'None') {
            $object = $this->loadItemBySlug($this->property('item'));
        }

        // check if a valid object has been created
        if (!$object) {
            // TODO: throw error - or warn user in logs--
            $this->linkItem = null;
        } else {
            // show the items in the links
            $this->linkItem = $object;
        }

        // Add url helper to the items
        if ($this->linkItem != null) {
            $this->linkItem = $this->updatePageUrls($this->linkItem);
        }
    }

    /**
     * Load the selected item by its slug.
     *
     * @param $selectedItem
     *
     * @return mixed
     */
    protected function loadItemBySlug($selectedItem)
    {
        $linkItem = LinkItem::where('slug', '=', $selectedItem)->first();

        return $linkItem;
    }

    /**
     * Add PageUrl helpers to all items which can be linked to a
     * dedicated page to display the item.
     *
     * @param $linkItem
     *
     * @return mixed
     */
    protected function updatePageUrls($linkItem)
    {
        // add to category
        $linkItem->category->setPageUrl($this->catListPage, $this->controller);

        return $linkItem;
    }
}
