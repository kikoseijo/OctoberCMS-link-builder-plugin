<?php

namespace Ksoft\Links\Controllers;

use BackendMenu;
use Backend\Classes\Controller;
use Flash;
use Ksoft\Links\Models\Category;
use Ksoft\Links\Models\LinkItem;
use Lang;

class LinkItems extends Controller
{
    /**
     * @var array
     */
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController',
        'Backend.Behaviors.ImportExportController',
    ];

    /**
     * @var string
     */
    public $importExportConfig = 'config_import_export.yaml';

    /**
     * @var string
     */
    public $formConfig = 'config_form.yaml';
    /**
     * @var string
     */
    public $listConfig = 'config_list.yaml';

    /**
     * @var array
     */
    public $requiredPermissions = ['ksoft.links.links'];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Ksoft.Links', 'links', 'items');
    }

    /**
     * Delete all selected link items in the table view.
     *
     * @return array The list element selector as the key, and the list contents are the value.
     */
    public function index_onDelete()
    {
        if ($checkedIds = post('checked')) {
            foreach ($checkedIds as $itemId) {
                if (!$table = LinkItem::find($itemId)) {
                    continue;
                }
                $table->delete();
            }
            Flash::success(Lang::get('backend::lang.form.delete_success', ['name' => Lang::get('ksoft.links::lang.controller.form.items.title')]));
        }

        return $this->listRefresh();
    }

    /**
     * Enable Link items on the listView Table.
     *
     * @return array The list element selector as the key, and the list contents are the value.
     */
    public function onEnableItems()
    {
        if (($checkedIds = post('checked')) && is_array($checkedIds) && count($checkedIds)) {
            foreach ($checkedIds as $itemId) {
                if (!$item = LinkItem::where('enabled', '!=', 1)->whereId($itemId)) {
                    continue;
                }

                $item->update(['enabled' => 1]);
            }

            Flash::success(Lang::get('ksoft.links::lang.flash.activate'));
        }

        return $this->listRefresh();
    }

    /**
     * Set enabled = 0 on table view actions.
     *
     * @return array The list element selector as the key, and the list contents are the value.
     */
    public function onDisableItems()
    {
        if (($checkedIds = post('checked')) && is_array($checkedIds) && count($checkedIds)) {
            foreach ($checkedIds as $itemId) {
                if (!$item = LinkItem::where('enabled', '!=', 0)->whereId($itemId)) {
                    continue;
                }

                $item->update(['enabled' => 0]);
            }

            Flash::success(Lang::get('ksoft.links::lang.flash.deactivate'));
        }

        return $this->listRefresh();
    }

    /**
     * Delete Table list view items.
     *
     * @return array The list element selector as the key, and the list contents are the value.
     */
    public function onRemoveItem()
    {
        if (($checkedIds = post('checked')) && is_array($checkedIds) && count($checkedIds)) {
            foreach ($checkedIds as $itemId) {
                if (!$item = LinkItem::whereId($itemId)) {
                    continue;
                }

                $item->delete();
            }

            Flash::success(Lang::get('ksoft.links::lang.controller.form.items.flashDelete'));
        }

        return $this->listRefresh();
    }

    /**
     * Api endpoints to show the link ites with categories.
     * 
     * @return array Laravel paginated object.
     */
    public function apiLinks()
    {
        $itemsPerPage = \Request::has('perPage') ? \Request::get('perPage') : 25;
        $pageNumber = \Request::has('page') ? \Request::get('page') : 1;

        $linksQuery = Category::whereHas('items', function ($q) {
            $q->where('enabled', 1);
        })->with('items');

        if (\Request::has('filter')) {
            $linksQuery->where('slug', \Request::get('filter'));
        }

        $items = $linksQuery->paginate($itemsPerPage, $pageNumber);

        header('Access-Control-Allow-Origin: *');

        return $items;
    }

    /* Functions to allow RESTful actions */
    public static function getAfterFilters()
    {
        return [];
    }

    public static function getBeforeFilters()
    {
        return [];
    }

    public static function getMiddleware()
    {
        return [];
    }

    /**
     * @param $method
     * @param $parameters
     */
    public function callAction($method, $parameters = false)
    {
        //dd($method);
        $action = 'api'.ucfirst($method);
        if (method_exists($this, $action) && is_callable([$this, $action])) {
            return call_user_func_array([$this, $action], $parameters);
        } else {
            return response()->json([
                'message' => 'Not Found',
            ], 404);
        }
    }
}
