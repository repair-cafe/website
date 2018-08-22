<?php namespace Liip\RepairCafe\Seeds;

use Backend\Models\User;
use Backend\Models\UserRole;

class Users
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
        if (!User::where('email', static::$rco_email)->exists()) {
            $repaircafeOrganisatorRole = UserRole::where('code', 'repaircafeOrganisator')->first();
            User::create([
                'email' => static::$rco_email,
                'login' => static::$rco_login,
                'password' => static::$rco_password,
                'password_confirmation' => static::$rco_password,
                'first_name' => static::$rco_firstName,
                'last_name' => static::$rco_lastName,
                'is_superuser' => false,
                'is_activated' => true,
                'role' => ($repaircafeOrganisatorRole ? $repaircafeOrganisatorRole->id : 0),
            ]);
        }

        if (!User::where('email', static::$cms_email)->exists()) {
            $contentManagerRole = UserRole::where('code', 'contentManager')->first();
            User::create([
                'email' => static::$cms_email,
                'login' => static::$cms_login,
                'password' => static::$cms_password,
                'password_confirmation' => static::$cms_password,
                'first_name' => static::$cms_firstName,
                'last_name' => static::$cms_lastName,
                'is_superuser' => false,
                'is_activated' => true,
                'role' => ($contentManagerRole ? $contentManagerRole->id : 0),
            ]);
        }
    }
}