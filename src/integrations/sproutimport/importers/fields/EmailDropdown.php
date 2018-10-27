<?php

namespace barrelstrength\sproutfields\integrations\sproutimport\importers\fields;

use barrelstrength\sproutbase\SproutBase;
use barrelstrength\sproutbase\app\import\base\FieldImporter;
use barrelstrength\sproutforms\fields\formfields\EmailDropdown as EmailDropdownField;

class EmailDropdown extends FieldImporter
{
    /**
     * @return string
     */
    public function getModelName()
    {
        return EmailDropdownField::class;
    }

    /**
     * @return mixed
     */
    public function getMockData()
    {
        $settings = $this->model->settings;

        if (!empty($settings['options']))
        {
            return SproutBase::$app->fieldImporter->getRandomOptionValue($settings['options']);
        }

        return null;
    }
}
