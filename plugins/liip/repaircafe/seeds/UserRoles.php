<?php namespace Liip\RepairCafe\Seeds;

use Backend\Models\User;
use Backend\Models\UserRole;

class UserRoles
{
    public static $email = 'admino@domain.tld';
    public static $login = 'admino';
    public static $password = 'admino';
    public static $firstName = 'Admin';
    public static $lastName = 'Person';

    public static $cms_email = 'cms@repair-cafe.test';
    public static $cms_login = 'cms';
    public static $cms_password = 'cmscms';
    public static $cms_firstName = 'Content';
    public static $cms_lastName = 'Manager';

    public static $rco_email = 'rco@repair-cafe.test';
    public static $rco_login = 'rco';
    public static $rco_password = 'rcorco';
    public static $rco_firstName = 'Repair Cafe';
    public static $rco_lastName = 'Owner';


    public static function seedUserData()
    {
        if (!UserRole::where('name', 'RepaircafeOrganisator')->first()) {
            $repaircafeOrganisatorRole = UserRole::create([
                'name' => 'RepaircafeOrganisator',
                'code' => 'repaircafeOrganisator',
                'description' => 'Members of this group can see and edit repair-cafes they are assigned to.',
                'permissions' => [
                    'media.manage_media' => true,
                    'backend.manage_preferences' => true,
                    'liip.repaircafe.cafes' => true,
                    'liip.repaircafe.events' => true,
                ],
            ]);

            $repaircafeOrganisator = User::create([
                'email' => static::$rco_email,
                'login' => static::$rco_login,
                'password' => static::$rco_password,
                'password_confirmation' => static::$rco_password,
                'first_name' => static::$rco_firstName,
                'last_name' => static::$rco_lastName,
                'is_superuser' => false,
                'is_activated' => true,
                'role_id' => $repaircafeOrganisatorRole->id,
            ]);
        }

        if (!UserRole::where('name', 'ContentManager')->first()) {
            $contentManagerRole = UserRole::create([
                'name' => 'ContentManager',
                'code' => 'contentManager',
                'description' => 'Members of this group can see and edit cms-content.',
                'permissions' => [
                    'cms.manage_themes' => true,
                    'media.manage_media' => true,
                    'backend.manage_preferences' => true,
                    'system.manage_mail_templates' => true,
                    'rainlab.pages.manage_pages' => true,
                    'rainlab.pages.access_snippets' => true,
                    'rainlab.pages.manage_content' => true,
                    'rainlab.pages.manage_menus' => true,
                    'krisawzm.embed.settings' => true,
                    'liip.repaircafe.news' => true,
                    'liip.repaircafe.events' => true,
                    'liip.repaircafe.categories' => true,
                    'liip.repaircafe.cafes' => true,
                    'liip.repaircafe.settings' => true,
                ],
            ]);

            $contentManager = User::create([
                'email' => static::$cms_email,
                'login' => static::$cms_login,
                'password' => static::$cms_password,
                'password_confirmation' => static::$cms_password,
                'first_name' => static::$cms_firstName,
                'last_name' => static::$cms_lastName,
                'is_superuser' => false,
                'is_activated' => true,
                'role_id' => $contentManagerRole->id,
            ]);
        }
    }
}
