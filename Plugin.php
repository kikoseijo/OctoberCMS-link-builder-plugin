<?php

namespace Ksoft\Links;

use Backend;
use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function pluginDetails()
    {
        return [
            'name'        => 'ksoft.links::lang.plugin.name',
            'description' => 'ksoft.links::lang.plugin.description',
            'author'      => 'Kiko Seijo',
            'icon'        => 'icon-cubes',
            'homepage'    => 'https://github.com/kikoseijo/OctoberCMS-link-builder-plugin'
        ];
    }

    public function registerNavigation()
    {
        return [
            'links' => [
                'label'       => 'ksoft.links::lang.navigation.label',
                'url'         => Backend::url('ksoft/links/linkitems'),
                'permissions' => ['ksoft.links.*'],
                'icon'        => 'icon-link',
                'order'       => 500,
                'sideMenu'    => [
                    'items' => [
                        'label' => 'ksoft.links::lang.navigation.sideMenu.items',
                        'icon'  => 'icon-list',
                        'url'   => Backend::url('ksoft/links/linkitems'),
                    ],
                    'categories' => [
                        'label' => 'ksoft.links::lang.navigation.sideMenu.categories',
                        'icon'  => 'icon-folder',
                        'url'   => Backend::url('ksoft/links/categories'),
                    ],
                ],
            ],
        ];
    }

    public function registerPermissions()
    {
        return [
            'ksoft.links.links' => ['label' => 'Access Link builder page', 'tab' => 'Link Builder'],
        ];
    }

    public function registerComponents()
    {
        return [
            'Ksoft\Links\Components\ListLinks' => 'listLinks',
            'Ksoft\Links\Components\DetailLink'  => 'detailLink',
        ];
    }
}
