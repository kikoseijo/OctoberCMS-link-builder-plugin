<?php

return [

    'links' => 'Links',

    'plugin' => [
        'name'        => 'Links Builder',
        'description' => 'Allows you to show a categorized list of link items on your website.',
    ],

    'navigation' => [
        'label'    => 'Link builder',
        'sideMenu' => [
            'items'      => 'Links',
            'categories' => 'Categories',
            'settings'   => 'Settings',
        ],
    ],

    'settings' => [
        'menuLabel'       => 'Settings',
        'menuDescription' => 'Set your default pages and prefered framework.',
        'detail_page'     => 'Select the link detail page',
        'links_page'      => 'Select the page to go when clicking on categories',
        'general'         => 'General options',
        'style'           => 'Partials render options',
        'syleLabel'       => 'Select your prefered CSS framework used to render the partials',
    ],

    'button' => [
        'activate'   => 'Activate',
        'deactivate' => 'Hide',
        'import'     => 'Import',
        'export'     => 'Export',
    ],

    'controller' => [
        'view' => [
            'items'      => [
                'new'                 => 'New Link',
                'breadcrumb_label'    => 'Links',
                'return'              => 'Return to links list',
                'creating'            => 'Creating Link...',
                'delete_confirmation' => 'Do you really want to delete this link?',
            ],
            'categories' => [
                'new'                 => 'New Category',
                'breadcrumb_label'    => 'Categories',
                'return'              => 'Return to category list',
                'creating'            => 'Creating Category...',
                'delete_confirmation' => 'Do you really want to delete this category?',
            ],
        ],
        'list' => [
            'items'      => 'Manage Link items',
            'categories' => 'Manage Categories',
        ],
        'form' => [
            'items'      => [
                'title'       => 'Link item',
                'create'      => 'Create Link item',
                'update'      => 'Update Link item',
                'flashCreate' => 'The Link item has been created successfully',
                'flashUpdate' => 'The Link item has been updated successfully',
                'flashDelete' => 'The Link item has been deleted successfully',
            ],
            'categories' => [
                'title'       => 'Category',
                'create'      => 'Create Category',
                'update'      => 'Update Category',
                'flashCreate' => 'The Category has been created successfully',
                'flashUpdate' => 'The Category has been updated successfully',
                'flashDelete' => 'The Category has been deleted successfully',
            ],
        ],
    ],

    'columns' => [
        'item'     => [
            'title'   => 'Title',
            'link'    => 'Link',
            'image'   => 'Image',
            'phone'   => 'Phone',
            'order'   => 'Order',
            'target'  => 'Open in new window',
            'enabled' => 'Enabled',
        ],
        'category' => [
            'id'          => 'ID',
            'name'        => 'Category',
            'description' => 'Description',
        ],
    ],

    'fields' => [
        'item'     => [
            'title'      => 'Title',
            'link'       => 'Link',
            'image'      => 'Image',
            'extra_data' => 'Link description',
            'phone'      => 'Phone',
            'order'      => 'Order',
            'target'     => 'Open in new window',
            'enabled'    => 'Enabled',
            'slug'       => 'Url Slug',
        ],
        'category' => [
            'name'        => 'Name',
            'slug'        => 'Slug',
            'description' => 'Description',
        ],
    ],

    'components' => [
        'visit_website' => 'View website',
        'item'          => [
            'name'        => 'Link Item detail',
            'description' => 'Display a Link item in a page.',
            'properties'  => [
                'item'     => [
                    'title'       => 'Default link item to show',
                    'description' => 'Select a Link item to show. Will be overridden by URL item selection.',
                    'none'        => 'None',
                ],
                'itemSlug' => [
                    'title'       => 'Link item slug',
                    'description' => 'Link item slug URL identifier',
                ],
            ],
        ],
        'links'         => [
            'name'        => 'Links builder list',
            'description' => 'Display a list fo Link items',
            'properties'  => [
                'category'       => [
                    'title'       => 'Category',
                    'placeholder' => 'Select Category',
                    'all'         => 'All',
                ],
                'pageNumber'     => [
                    'title'       => 'Page Number',
                    'description' => 'This value is used to determine what page the user is on.',
                ],
                'itemsPerPage'   => [
                    'title'             => 'Link items per page',
                    'validationMessage' => 'Invalid format of the Link items per page value',
                ],
                'order'          => [
                    'title'       => 'Order',
                    'placeholder' => 'Select Order',
                    'ascending'   => 'Ascending',
                    'descending'  => 'Descending',
                ],
                'group'          => [
                    'advanced'  => 'Advanced',
                    'links'     => 'Link items',
                    'menuStyle' => 'Menu template style',
                ],
                'selectedCat'    => [
                    'title'       => 'Selected category',
                    'description' => 'Don\'t change this value (default: {{ :selected_cat }})',
                ],
                'itemPage'       => [
                    'title'       => 'Link detail page',
                    'description' => 'Page where Link items can be displayed.',
                ],
                'catListPage'    => [
                    'title'       => 'Link items page',
                    'description' => 'Page where Link item of the selected category are listed.',
                ],
                'listTemplate'   => [
                    'title'       => 'Choose a template',
                    'description' => 'Template to use from the list when rendering the component.',
                ],
                'showCategories' => [
                    'title'       => 'Show categories',
                    'description' => 'Disabled will hide categories navbar.',
                ],
                'showPagination' => [
                    'title'       => 'Show pagination',
                    'description' => 'Disabled will hide pagination links.',
                ],
                'ulClass'        => [
                    'title'       => 'ul Class',
                    'description' => 'Class to be added in the "ul" tag. (Only valid in Menu template)',
                ],
                'liClass'        => [
                    'title'       => 'li Class',
                    'description' => 'Class to be added in the "li" tag. (Only valid in Menu template)',
                ],
                'aClass'         => [
                    'title'       => 'Link class',
                    'description' => 'Class to be added in the "a" tag. (Only valid in Menu template)',
                ],
            ],
        ],
    ],

    'form' => [
        'status'           => 'Status',
        'status_published' => 'Published',
        'status_hide'      => 'Hidden',
        'status_draft'     => 'Draft',
        'status_active'    => 'Active',
        'featured'         => 'Featured',
    ],

];
