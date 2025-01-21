# Changelog

## 3.4.0
- Fix incorrect password reset link

## 3.3.1
- Minor template updates

## 3.3.0
- Updated variable names for first name and last name

## 3.2.1
- Updated: JTB classes
  
## 3.2.0
- Updated: admin dashboard route for constancy
- Added: `nav-admin.json` to stubs

## 3.1.0
- Updated: Routes to conditionally add user and admin dashboard
- Updated: Installer to handle more options
- Minor fixes and tweaks

## 3.0.0
- Added: Laravel 11 support
- Updated: dependencies
- Updated: controllers resources
- Updated: `authit:install` command

## 2.3.1
- Added: publish configuration
- Fixed: typo

## 2.3.0
- Added: use permissions confirmation to installer (defaults to no)

## 2.2.0
- Added: option in config to use first and last name for user name
- Removed: `avatar` and `avatarUrl` from `User` model (handle separately from now on)
- Update: livewire components to Livewire 3
- Update: views to reflect change

## 2.1.0
- Fixed: file input for avatar

## 2.0.0
- Added: `config/authit.php` config file
- Moved: `nav-user` to stubs and updated install command
- Moved: guest layout to `components.layout` directory and updated references
- Moved: livewire components ready for upgrade to v3
- Updated: `InstallCommand` to reflect changes
- Updated: to Livewire 3
- Updated: to optionally add `dashboard` layout and route
- Updated: to use breeze `v1.26.2` auth resources

## 1.10.1
- Updated: JTB Classes

## 1.10.0
- Updated: JTB Classes

## 1.9.1
- Updated: JTB Classes

## 1.9.0
- replace 'dashboard' with 'account'
- remove UserController

## 1.8.2
- change allow registration key

## 1.8.1
- fix logout icon

## 1.8.0
- check for avatarUrl existence to prevent undefined method error
- add dedicated user and admin auth routes
- add const user and admin dashboard routes to AuthitServiceProvider
- template updates

## 1.7.2
- fix path to copy nav-user.json
- fix account dropdown icon

## 1.7.1
- update install command to un comment mustVerifyEmail
- update user seeder

## 1.7.0
- update gotime menu component

## 1.6.5
- fix folder naming issue

## 1.6.4
- tidy up files and update classes

## 1.6.3
- update jtb classes

## 1.6.2
- fix nav drop down styling

## 1.6.1
- fix composer psr-4 name issue
- update file control

## 1.6.0
- fix incorrect control names

## 1.5.0
- update control components with new Gotime syntax

## 1.4.3
- Add "check junk mail folder" message to registration
- Minor fixes

## 1.4.2
- add account dropdown
- template class updates

## 1.4.1
- minor template updates

## 1.4.0
- remove dependency on fortify
- add new auth controllers (based on breeze)
- add UpdatePassword livewire component and rules
- fix avatar and profile form

## 1.3.0
- update templates styles

## 1.2.0
- upgrade spatie-permissions to v5.5

## 1.1.2
- disable fortify routes in FortifyServiceProvider.php for custom implement
- add spatie/honeypot
- add fortify routes to routes.php

## 1.1.1
- add registration verification

## 1.1.0
- update to gotime form components

## 1.0.0
- update with new layouts and install method
- add livewire components

## 0.1.1
- fix menu styles

## 0.0.6
squash
- bug fixes

## 0.0.5
- add livewire avatar

## 0.0.4
- add account links

## 0.0.3
- remove admin template
- template updates

## 0.0.2
- update templates

## 0.0.1
-   Initial release
