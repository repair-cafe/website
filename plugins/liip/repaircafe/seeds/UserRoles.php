<?php namespace Liip\RepairCafe\Seeds;

use Backend\Models\User;
use Backend\Models\UserRole;

class UserRoles
{
    public function seedUserRoles()
    {
        $contentManagerRole = UserRole::where('code', '=', 'contentManager')->first();

        if (!$contentManagerRole) {
            $contentManagerRole = UserRole::create([
                'name' => 'Content Manager',
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
                    'liip.repaircafe.is_content_manager' => true,
                ],
            ]);
        }

        $contentManagers = User::whereHas('groups', function ($managerRoleQuery) {
            $managerRoleQuery->where('code', '=', 'contentManager');
        })->get();

        $contentManagers->each(function($user, $key) use ($contentManagerRole) {
            $user->role = $contentManagerRole->id;
            $user->save();
        });

        $organisatorRole = UserRole::where('code', '=', 'repaircafeOrganisator')->first();

        if (!$organisatorRole) {
            $organisatorRole = UserRole::create([
                'name' => 'Repaircafe Organisator',
                'code' => 'repaircafeOrganisator',
                'description' => 'Members of this group can see and edit repair-cafes they are assigned to.',
                'permissions' => [
                    'media.manage_media' => true,
                    'backend.manage_preferences' => true,
                    'liip.repaircafe.cafes' => true,
                    'liip.repaircafe.events' => true,
                ],
            ]);
        }

        $reparicafeOrganisators = User::whereHas('groups', function ($organisatorRoleQuery) {
            $organisatorRoleQuery->where('code', '=', 'repaircafeOrganisator');
        })->get();

        $reparicafeOrganisators->each(function($user, $key) use ($organisatorRole) {
            $user->role = $organisatorRole->id;
            $user->save();
        });
    }
}
