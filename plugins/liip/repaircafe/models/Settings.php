<?php namespace Liip\RepairCafe\Models;

use Model;

class Settings extends Model
{
    public $implement = ['System.Behaviors.SettingsModel'];

    // A unique code
    public $settingsCode = 'liip_repaircafe_settings';

    // Reference to field configuration
    public $settingsFields = 'fields.yaml';
}
