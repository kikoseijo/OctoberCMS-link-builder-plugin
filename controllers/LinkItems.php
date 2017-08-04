<?php

namespace Ksoft\Links\Controllers;

use Backend\Classes\Controller;
use BackendMenu;
use Flash;
use Ksoft\Links\Models\Category;
use Ksoft\Links\Models\LinkItem;
use Lang;

class LinkItems extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController',
        'Backend.Behaviors.ImportExportController',
    ];

    public $importExportConfig = 'config_import_export.yaml';

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';

    public $requiredPermissions = ['ksoft.links.links'];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Ksoft.Links', 'links', 'items');
    }

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
        // ['msg' => 'Getting link builder array success.',
        //     'data'    => $results,
        //     'count'   => $items->count(),
        // ];
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
