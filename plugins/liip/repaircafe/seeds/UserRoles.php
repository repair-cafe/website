<?php namespace Liip\RepairCafe\Seeds;

use Backend\Models\User;
use Backend\Models\UserGroup;

class UserRoles
{
    public static $email = 'admino@domain.tld';
    public static $login = 'admino';
    public static $password = 'admino';
    public static $firstName = 'Admin';
    public static $lastName = 'Person';

    public static $cms_email = 'cms@repair-cafe.dev';
    public static $cms_login = 'cms';
    public static $cms_password = 'cmscms';
    public static $cms_firstName = 'Content';
    public static $cms_lastName = 'Manager';

    public static $rco_email = 'rco@repair-cafe.dev';
    public static $rco_login = 'rco';
    public static $rco_password = 'rcorco';
    public static $rco_firstName = 'Repair Cafe';
    public static $rco_lastName = 'Owner';


    public static function seedUserData()
    {
        if (!UserGroup::where('name', 'RepaircafeOrganisator')->first()) {
            $repaircafeOrganisatorGroup = UserGroup::create([
                'name' => 'RepaircafeOrganisator',
                'code' => 'repaircafeOrganisator',
                'description' => 'Members of this group can see and edit repair-cafes they are assigned to.',
                'permissions' => [
                    'liip.repaircafe.cafes' => true,
                    'liip.repaircafe.events' => true,
                ],
                'is_new_user_default' => true
            ]);

            $repaircafeOrganisator = User::create([
                'email' => static::$rco_email,
                'login' => static::$rco_login,
                'password' => static::$rco_password,
                'password_confirmation' => static::$rco_password,
                'first_name' => static::$rco_firstName,
                'last_name' => static::$rco_lastName,
                'is_superuser' => false,
                'is_activated' => true
            ]);

            $repaircafeOrganisator->addGroup($repaircafeOrganisatorGroup);
        }

        if (!UserGroup::where('name', 'ContentManager')->first()) {
            $contentManagerGroup = UserGroup::create([
                'name' => 'ContentManager',
                'code' => 'contentManager',
                'description' => 'Members of this group can see and edit cms-content.',
                'permissions' => [
                    'cms.manage_themes' => true,
                    'media.manage_media' => true,
                    'system.manage_mail_templates' => true,
                    'rainlab.pages.manage_pages' => true,
                    'rainlab.pages.access_snippets' => true,
                    'rainlab.pages.manage_content' => true,
                    'rainlab.pages.manage_menus' => true,
                    'rainlab.translate.manage_messages' => true,
                    'krisawzm.embed.settings' => true,
                    'liip.repaircafe.news' => true,
                    'liip.repaircafe.events' => true,
                    'liip.repaircafe.categories' => true,
                    'liip.repaircafe.cafes' => true,
                    'liip.repaircafe.settings' => true,
                ],
                'is_new_user_default' => false
            ]);

            $contentManager = User::create([
                'email' => static::$cms_email,
                'login' => static::$cms_login,
                'password' => static::$cms_password,
                'password_confirmation' => static::$cms_password,
                'first_name' => static::$cms_firstName,
                'last_name' => static::$cms_lastName,
                'is_superuser' => false,
                'is_activated' => true
            ]);

            $contentManager->addGroup($contentManagerGroup);
        }
    }
}
