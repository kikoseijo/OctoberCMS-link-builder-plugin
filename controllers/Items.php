<?php

namespace Ksoft\Links\Controllers;

use BackendMenu;
use Backend\Classes\Controller;
use Flash;
use Ksoft\Links\Models\Item;
use Lang;

class Items extends Controller {

    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController',
        'Backend.Behaviors.ImportExportController'
    ];

    public $importExportConfig = 'config_import_export.yaml';

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';

    public $requiredPermissions = ['ksoft.links.links'];

    public function __construct() {
        parent::__construct();
        BackendMenu::setContext('Ksoft.Links', 'links', 'items');
    }

    public function index_onDelete() {
        if($checkedIds = post('checked')) {
            foreach($checkedIds as $itemId) {
                if(! $table = Item::find($itemId))
                    continue;
                $table->delete();
            }
            Flash::success(Lang::get('backend::lang.form.delete_success', ['name' => Lang::get('ksoft.links::lang.controller.form.items.title')]));
        }
        return $this->listRefresh();
    }

    public function apiLinks()
    {
        $items = Item::all();
        return ['msg' => 'Getting link builder array success.',
            'data' => $items,
            'count' => $items->count()
        ];
    }

    public function apiFoo()
    {
      return 'bar (foo)';
    }

    /* Functions to allow RESTful actions */
    public static function getAfterFilters() {return [];}
    public static function getBeforeFilters() {return [];}
    public static function getMiddleware() {return [];}
    public function callAction($method, $parameters=false) {
        //dd($method);
      $action = 'api' . ucfirst($method);
      if (method_exists($this, $action) && is_callable(array($this, $action)))
      {
        return call_user_func_array(array($this, $action), $parameters);
      } else {
        return response()->json([
            'message' => 'Not Found',
        ], 404);
      }
    }

}
