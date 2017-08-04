<?php

namespace Ksoft\Links\Controllers;

use Backend\Classes\Controller;
use BackendMenu;
use Flash;
use Ksoft\Links\Models\Category;
use Ksoft\Links\Models\Item;
use Lang;

class Items extends Controller
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
                if (!$table = Item::find($itemId)) {
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
                if (!$item = Item::where('enabled', '!=', 1)->whereId($itemId)) {
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
                if (!$item = Item::where('enabled', '!=', 0)->whereId($itemId)) {
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
                if (!$item = Item::whereId($itemId)) {
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
        if (\Request::has('perPage')) {
            $itemsPerPage = \Request::get('perPage');
        } else {
            $itemsPerPage = 25;
        }

        $linksQuery = Category::has('items')->with('items');

        if (\Request::has('filter')) {
            $linksQuery->where('slug', \Request::get('filter'));
        }

        $items = $linksQuery->paginate($itemsPerPage);

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
