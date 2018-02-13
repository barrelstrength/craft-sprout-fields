<?php

namespace barrelstrength\sproutfields;

use barrelstrength\sproutfields\helpers\SproutFieldsInstallHelper;
use barrelstrength\sproutfields\models\SettingsModel;
use barrelstrength\sproutbase\SproutBaseHelper;
use barrelstrength\sproutfields\fields\Address as AddressField;
use barrelstrength\sproutfields\fields\Phone as PhoneField;
use barrelstrength\sproutfields\fields\Email as EmailField;
use barrelstrength\sproutfields\fields\EmailDropdown as EmailDropdownField;
use barrelstrength\sproutfields\fields\Gender as GenderField;
use barrelstrength\sproutfields\fields\Url as UrlField;
use barrelstrength\sproutfields\fields\Notes as NotesField;
use barrelstrength\sproutfields\fields\Predefined as PredefinedField;
use barrelstrength\sproutfields\fields\RegularExpression as RegularExpressionField;
use barrelstrength\sproutfields\integrations\sproutimport\fields\Address as AddressFieldImporter;
use barrelstrength\sproutfields\integrations\sproutimport\fields\Email as EmailFieldImporter;
use barrelstrength\sproutfields\integrations\sproutimport\fields\EmailDropdown as EmailDropdownFieldImporter;
use barrelstrength\sproutfields\integrations\sproutimport\fields\Gender as GenderFieldImporter;
use barrelstrength\sproutfields\integrations\sproutimport\fields\Url as UrlFieldImporter;
use barrelstrength\sproutfields\integrations\sproutimport\fields\Notes as NotesFieldImporter;
use barrelstrength\sproutfields\integrations\sproutimport\fields\Phone as PhoneFieldImporter;
use barrelstrength\sproutfields\integrations\sproutimport\fields\Predefined as PredefinedFieldImporter;
use barrelstrength\sproutfields\integrations\sproutimport\fields\RegularExpression as RegularExpressionFieldImporter;

use barrelstrength\sproutimport\services\Utilities;
use Craft;
use craft\base\Plugin;
use yii\base\Event;
use craft\events\RegisterComponentTypesEvent;
use craft\services\Fields;

class SproutFields extends Plugin
{
    public function init()
    {
        parent::init();

        SproutBaseHelper::registerModule();

        Event::on(Fields::class, Fields::EVENT_REGISTER_FIELD_TYPES, function(RegisterComponentTypesEvent $event) {
            $event->types[] = AddressField::class;
            $event->types[] = PhoneField::class;
            $event->types[] = EmailField::class;
            $event->types[] = EmailDropdownField::class;
            $event->types[] = UrlField::class;
            $event->types[] = NotesField::class;
            $event->types[] = RegularExpressionField::class;
            $event->types[] = GenderField::class;
            $event->types[] = PredefinedField::class;
        });

        $plugin = Craft::$app->getPlugins()->getPlugin("sprout-import");
        
        if ($plugin){
            Event::on(Utilities::class, Utilities::EVENT_REGISTER_IMPORTER, function(RegisterComponentTypesEvent $event) {
//            $event->types[] = AddressFieldImporter::class;
                $event->types[] = EmailFieldImporter::class;
                $event->types[] = EmailDropdownFieldImporter::class;
                $event->types[] = GenderFieldImporter::class;
                $event->types[] = UrlFieldImporter::class;
                $event->types[] = NotesFieldImporter::class;
//            $event->types[] = PhoneFieldImporter::class;
                $event->types[] = PredefinedFieldImporter::class;
                $event->types[] = RegularExpressionFieldImporter::class;
            });
        }
    }

    /**
     * @param string $message
     * @param array  $params
     *
     * @return string
     */
    public static function t($message, array $params = [])
    {
        return Craft::t('sprout-fields', $message, $params);
    }

    /**
     * Returns settings model with custom properties
     *
     * @return SettingsModel
     */
    public function createSettingsModel()
    {
        return new SettingsModel();
    }

    /**
     * @return null|string
     * @throws \Twig_Error_Loader
     * @throws \yii\base\Exception
     */
    public function settingsHtml()
    {
        return Craft::$app->getView()->renderTemplate('sproutfields/_cp/settings',
            [
                'settings' => $this->getSettings()
            ]
        );
    }

    public function afterInstall()
    {
        $helper = new SproutFieldsInstallHelper();
        $helper->installDefaultNotesStyles();
    }
}


