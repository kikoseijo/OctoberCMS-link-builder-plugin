<?php

namespace Ksoft\Links\Controllers;

use Backend\Classes\Controller;
use BackendMenu;
use Flash;
use Ksoft\Links\Models\Category;
use Lang;

/**
 * Categories Back-end Controller.
 */
class Categories extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController',
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Ksoft.Links', 'links', 'categories');
    }

    public function index_onDelete()
    {
        if ($checkedIds = post('checked')) {
            foreach ($checkedIds as $itemId) {
                if (!$table = Category::find($itemId)) {
                    continue;
                }
                $table->delete();
            }

            Flash::success(Lang::get('backend::lang.form.delete_success', ['name' => Lang::get('ksoft.links::lang.controller.form.categories.title')]));
        }

        return $this->listRefresh();
    }
}
