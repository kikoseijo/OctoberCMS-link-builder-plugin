<?php

namespace Ksoft\Links\Models;

use Cms\Classes\Page;
use Model;

class Settings extends Model
{
    /**
     * @var array
     */
    public $implement = ['System.Behaviors.SettingsModel'];
    /**
     * @var string
     */
    public $settingsCode = 'ksoft_links_settings';
    /**
     * @var string
     */
    public $settingsFields = 'fields.yaml';

    public function getDetailPageOptions()
    {
        return Page::sortBy('baseFileName')->lists('baseFileName', 'baseFileName');
    }
}
