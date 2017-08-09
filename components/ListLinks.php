<?php

namespace Ksoft\Links\Components;

use Cms\Classes\ComponentBase;
use Cms\Classes\Page;
use Ksoft\Links\Models\Category;
use Ksoft\Links\Models\LinkItem;
use Ksoft\Links\Models\Settings;
use Lang;

class ListLinks extends ComponentBase
{
    /**
     * Collection of the links items to display.
     *
     * @var Collection
     */
    public $links;

    /**
     * Holds the current templateType to use (bulma,bootstrap,...).
     *
     * @var Collection
     */
    public $templateType;

    /**
     * Reference to the item page to link items to.
     *
     * @var string
     */
    public $itemPage;

    /**
     * Reference to the page where items of a category are displayed.
     *
     * @var
     */
    public $catListPage;
    /**
     * Reference to the template to use when showing the item in the list, posible values: card,list,plain.
     *
     * @var
     */
    public $listTemplate;

    /**
     * Component Details.
     *
     * @return array
     */
    public function componentDetails()
    {
        return [
            'name'        => 'ksoft.links::lang.components.links.name',
            'description' => 'ksoft.links::lang.components.links.description',
        ];
    }

    /**
     * Define component properties.
     *
     * @return array
     */
    public function defineProperties()
    {
        $settings = Settings::instance();

        return [
            'category'       => [
                'title'       => 'ksoft.links::lang.components.links.properties.category.title',
                'type'        => 'dropdown',
                'default'     => '0',
                'placeholder' => 'ksoft.links::lang.components.links.properties.category.placeholder',
            ],
            'itemsPerPage'   => [
                'title'             => 'ksoft.links::lang.components.links.properties.itemsPerPage.title',
                'type'              => 'string',
                'validationPattern' => '^[0-9]+$',
                'validationMessage' => 'ksoft.links::lang.components.links.properties.itemsPerPage.validationMessage',
                'default'           => '6',
            ],
            'order'          => [
                'title'       => 'ksoft.links::lang.components.links.properties.order.title',
                'placeholder' => 'ksoft.links::lang.components.links.properties.order.placeholder',
                'type'        => 'dropdown',
                'default'     => 'desc',
            ],
            'listTemplate'   => [
                'title'       => 'ksoft.links::lang.components.links.properties.listTemplate.title',
                'description' => 'ksoft.links::lang.components.links.properties.listTemplate.description',
                'type'        => 'dropdown',
                'default'     => 'list',
                'options'     => ['list' => 'List', 'menu' => 'Menu', 'plain' => 'Plain', 'card' => 'Card', 'table' => 'Table'],
            ],
            'showCategories' => [
                'title'       => 'ksoft.links::lang.components.links.properties.showCategories.title',
                'description' => 'ksoft.links::lang.components.links.properties.showCategories.description',
                'type'        => 'checkbox',
                'default'     => '1',
            ],
            'showPagination' => [
                'title'       => 'ksoft.links::lang.components.links.properties.showPagination.title',
                'description' => 'ksoft.links::lang.components.links.properties.showPagination.description',
                'type'        => 'checkbox',
                'default'     => '1',
            ],
            'ulClass'        => [
                'title'       => 'ksoft.links::lang.components.links.properties.ulClass.title',
                'description' => 'ksoft.links::lang.components.links.properties.ulClass.description',
                'type'        => 'string',
                'default'     => 'menu',
                'group'       => 'ksoft.links::lang.components.links.properties.group.menuStyle',
            ],
            'liClass'        => [
                'title'       => 'ksoft.links::lang.components.links.properties.liClass.title',
                'description' => 'ksoft.links::lang.components.links.properties.liClass.description',
                'type'        => 'string',
                'default'     => 'menu-item',
                'group'       => 'ksoft.links::lang.components.links.properties.group.menuStyle',
            ],
            'aClass'         => [
                'title'       => 'ksoft.links::lang.components.links.properties.aClass.title',
                'description' => 'ksoft.links::lang.components.links.properties.aClass.description',
                'type'        => 'string',
                'default'     => 'menu-item-link',
                'group'       => 'ksoft.links::lang.components.links.properties.group.menuStyle',
            ],
            'pageNumber'     => [
                'title'       => 'ksoft.links::lang.components.links.properties.pageNumber.title',
                'description' => 'ksoft.links::lang.components.links.properties.pageNumber.description',
                'type'        => 'string',
                'default'     => '{{ :page }}',
                'group'       => 'ksoft.links::lang.components.links.properties.group.advanced',
            ],
            'selectedCat'    => [
                'title'       => 'ksoft.links::lang.components.links.properties.selectedCat.title',
                'description' => 'ksoft.links::lang.components.links.properties.selectedCat.description',
                'type'        => 'string',
                'default'     => '{{ :selected_cat }}',
                'group'       => 'ksoft.links::lang.components.links.properties.group.advanced',
            ],
            'catListPage'    => [
                'title'       => 'ksoft.links::lang.components.links.properties.catListPage.title',
                'description' => 'ksoft.links::lang.components.links.properties.catListPage.description',
                'type'        => 'dropdown',
                'default'     => $settings->links_page,
                'options'     => $this->getPageOptions(),
                'group'       => 'ksoft.links::lang.components.links.properties.group.links',
            ],
            'itemPage'       => [
                'title'       => 'ksoft.links::lang.components.links.properties.itemPage.title',
                'description' => 'ksoft.links::lang.components.links.properties.itemPage.description',
                'type'        => 'dropdown',
                'default'     => $settings->detail_page,
                'options'     => $this->getPageOptions(),
                'group'       => 'ksoft.links::lang.components.links.properties.group.links',
            ],
        ];
    }

    /**
     * Get options for the category dropdown.
     *
     * @return mixed
     */
    public function getCategoryOptions()
    {
        $categories = Category::lists('name', 'id');
        $categories[0] = Lang::get('ksoft.links::lang.components.links.properties.category.all');

        return $categories;
    }

    /**
     * Get options for the order dropdown.
     *
     * @return array
     */
    public function getOrderOptions()
    {
        return [
            'asc'  => Lang::get('ksoft.links::lang.components.links.properties.order.ascending'),
            'desc' => Lang::get('ksoft.links::lang.components.links.properties.order.descending'),
        ];
    }

    /**
     * Get options for the dropdown where the link to the item page can be selected.
     *
     * @return mixed
     */
    public function getPageOptions()
    {
        return Page::sortBy('baseFileName')->lists('baseFileName', 'baseFileName');
    }

    /**
     * When running this component, load all items based on the selections.
     */
    public function onRun()
    {
        $this->itemPage = $this->page['itemPage'] = $this->property('itemPage');
        $this->catListPage = $this->page['catListPage'] = $this->property('catListPage');
        $this->templateType = Settings::get('css_framework') ? 'bulma' : 'bootstrap';
        $this->page['listTemplate'] = $this->property('listTemplate');
        $this->page['showCategories'] = $this->property('showCategories');
        $this->page['showPagination'] = $this->property('showPagination');
        $this->page['liClass'] = $this->property('liClass');
        $this->page['ulClass'] = $this->property('ulClass');
        $this->page['aClass'] = $this->property('aClass');
        $this->page['cats'] = Category::whereHas('items', function ($q) {
            $q->where('enabled', 1);
        })->get();
        $this->page['selectedCat'] = $this->property('selectedCat');

        if ($this->property('listTemplate') == 'table') {
            $this->addJs('https://cdnjs.cloudflare.com/ajax/libs/axios/0.16.2/axios.js');
            $this->addJs('https://cdnjs.cloudflare.com/ajax/libs/vue/2.4.2/vue.js');
        }

        // find the correct property to select the items with
        $object = null;
        if ($this->property('selectedCat') != null) {
            $object = $this->loadItemsByCategory($this->property('selectedCat'), true);
        } elseif ($this->property('category') != null) {
            $object = $this->loadItemsByCategory($this->property('category'));
        }

        // check if a valid object has been created
        if (!$object) {
            // display all items
            if ($this->property('listTemplate') == 'menu') {
                $this->links = LinkItem::with('category')->where('enabled', 1)->orderBy('order', $this->property('order'))->get();
            } else {
                $this->links = LinkItem::with('category')->where('enabled', 1)->orderBy('order', $this->property('order'))->paginate($this->property('itemsPerPage'), $this->property('pageNumber'));
            }
        } else {
            // show the items in the links
            $this->links = $object->items()->where('enabled', 1)
                ->orderBy('order', $this->property('order'))->paginate($this->property('itemsPerPage'), $this->property('pageNumber'));
        }

        // Add url helper to the items
        if ($this->links != null) {
            $this->links = $this->updatePageUrls($this->links);
        }
    }

    /**
     * Get the selected category object for further processing.
     *
     * @param $selectedCategory
     * @param bool|false $bySlug
     *
     * @return mixed
     */
    protected function loadItemsByCategory($selectedCategory, $bySlug = false)
    {
        if ($bySlug) {
            $category = Category::where('slug', '=', $selectedCategory)->first();
        } else {
            $category = Category::find($selectedCategory);
        }

        return $category;
    }

    /**
     * Add PageUrl helpers to all items which can be linked to a
     * dedicated page to display the item.
     *
     * @param $items
     *
     * @return mixed
     */
    protected function updatePageUrls($items)
    {
        //Add a "url" helper attribute for linking to each item
        $items->each(function ($item) {
            $item->setPageUrl($this->itemPage, $this->controller);

            $item->category->setPageUrl($this->catListPage, $this->controller);
        });

        return $items;
    }
}
