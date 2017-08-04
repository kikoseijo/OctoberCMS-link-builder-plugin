<?php

namespace Ksoft\Links\Models;

use Backend\Models\ImportModel;

class LinkItemImport extends ImportModel
{
    /**
     * @var array The rules to be applied to the data.
     */
    public $rules = [];

    public function importData($results, $sessionKey = null)
    {
        if ($this->auto_create_lists) {
            // Do something
        }

        foreach ($results as $row => $data) {
            try {
                $subscriber = new Item();
                $subscriber->fill($data);
                $subscriber->save();

                $this->logCreated();
            } catch (\Exception $ex) {
                $this->logError($row, $ex->getMessage());
            }
        }
    }
}
