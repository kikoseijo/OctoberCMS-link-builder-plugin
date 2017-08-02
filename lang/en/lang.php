<?php

return [

    'links' => 'Links',

    'plugin' => [
        'name'        => 'Links Builder',
        'description' => 'Draws a list of links for your website.',
    ],

    'navigation' => [
        'label'    => 'Link builder',
        'sideMenu' => [
            'items'      => 'Links',
            'categories' => 'Categories',
        ],
    ],

    'button' => [
        'activate'    => 'Activate',
        'deactivate'  => 'Hide',
        'active'      => 'Active',
        'inactive'    => 'Inactive',
        'import'      => 'Import',
        'export'      => 'Export',
        'unsubscribe' => 'Unsubscribe',
        'subscribe'   => 'Subscription',
        'return'      => 'Return',
    ],

    'controller' => [
        'view' => [
            'items' => [
                'new'                 => 'New Item',
                'breadcrumb_label'    => 'Items',
                'return'              => 'Return to items list',
                'creating'            => 'Creating Item...',
                'delete_confirmation' => 'Do you really want to delete this item?',
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
            'items'      => 'Manage Items',
            'categories' => 'Manage Categories',
        ],
        'form' => [
            'items' => [
                'title'       => 'Item',
                'create'      => 'Create Item',
                'update'      => 'Update Item',
                'flashCreate' => 'The Item has been created successfully',
                'flashUpdate' => 'The Item has been updated successfully',
                'flashDelete' => 'The Item has been deleted successfully',
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
        'item' => [
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
        'item' => [
            'title'   => 'Title',
            'link'    => 'Link',
            'image'   => 'Image',
            'phone'   => 'Phone',
            'order'   => 'Order',
            'target'  => 'Open in new window',
            'enabled' => 'Enabled',
            'slug'    => 'Url Slug',
        ],
        'category' => [
            'name'        => 'Name',
            'slug'        => 'Slug',
            'description' => 'Description',
        ],
    ],

    'components' => [
        'item' => [
            'name'        => 'Link Item detail',
            'description' => 'Display a link in a page.',
            'properties'  => [
                'item' => [
                    'title'       => 'Item to show',
                    'description' => 'Select a item to show. Will be overridden by URL item selection.',
                    'none'        => 'None',
                ],
                'itemSlug' => [
                    'title'       => 'Item slug',
                    'description' => 'Item slug URL identifier',
                ],
            ],
        ],
        'links' => [
            'name'        => 'Links builder list',
            'description' => 'Display a links list in page.',
            'properties'  => [
                'category' => [
                    'title'       => 'Category',
                    'placeholder' => 'Select Category',
                    'all'         => 'All',
                ],
                'pageNumber' => [
                    'title'       => 'Page Number',
                    'description' => 'This value is used to determine what page the user is on.',
                ],
                'itemsPerPage' => [
                    'title'             => 'Items per page',
                    'validationMessage' => 'Invalid format of the items per page value',
                ],
                'order' => [
                    'title'       => 'Order',
                    'placeholder' => 'Select Order',
                    'ascending'   => 'Ascending',
                    'descending'  => 'Descending',
                ],
                'group' => [
                    'advanced' => 'Advanced',
                    'links'    => 'Links',
                ],
                'selectedCat' => [
                    'title'       => 'Selected category',
                    'description' => 'Don\'t change this value (default: {{ :selected_cat }})',
                ],
                'itemPage' => [
                    'title'       => 'Item page',
                    'description' => 'Page where portfolio items can be displayed.',
                ],
                'catListPage' => [
                    'title'       => 'Category page',
                    'description' => 'Page where portfolio items of the selected category are listed.',
                ],
            ],
        ],
    ],

    'form' => [
        // General
        'created' => 'Created at',
        'updated' => 'Updated at',
        // Posts
        'id'                  => 'ID',
        'title'               => 'Title',
        'slug'                => 'Slug',
        'introductory'        => 'Introductory',
        'content'             => 'Content',
        'image'               => 'Image',
        'status'              => 'Status',
        'status_published'    => 'Published',
        'status_hide'         => 'Hidden',
        'status_draft'        => 'Draft',
        'status_active'       => 'Active',
        'status_unsubscribed' => 'Unsubscribed',
        'featured'            => 'Featured',
        'yes'                 => 'Yes',
        'no'                  => 'No',
        'view'                => 'view',
        'published'           => 'Published at',
        'send'                => 'Send the e-mail to subscribers.',
        'length'              => 'Length',
        // Subscribers
        'name'   => 'Name',
        'email'  => 'E-mail',
        'common' => 'Common',
        'locale' => 'Locale',
        'lang'   => 'en',
        'mail'   => 'mail',
    ],

];
