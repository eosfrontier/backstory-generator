# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

### [Unreleased]

### Added
- SLs can now leave a comment when they approve a concept ( https://github.com/eosfrontier/backstory-generator/issues/21 )

### Changed
- E-mail inviting player to the backstory system now contains a due date ( https://github.com/eosfrontier/backstory-generator/issues/17 )

## [1.1.0] - 2024-8-may (Frontier 18 release)

### Changed 
 - Replace TinyMCE with better WYSIWYG Editor (Trumbowyg)

## [1.0.0] - 2024-07-jan (Frontier 17 release)

### Added

- Separate return to backstory admin setup for when a logged out person tries to access the admin side. (#13)
* Player Portal 
    - Button to access admin from main page that only appears if logged in as someone with rights to the admin side (#12)
* Admin Portal 
    - Filter by Faction (#10)
    - Record who requested changes or approved a concept/backstory in the DB (#9)
        TODO: Display in the admin portal before #9 is resolved.
    - Optional filter to hide characters not signed up for upcoming event (#8)
    - add an express background page where an SL can upload an existing background and approve it so existing players don't need to re-submit (#7)

### Fixed

- When refreshing the admin portal, whatever the last thing that was clicked was keeps getting applied. (#14)

### Changed

* Player portal
    - Put text blocks into containers to keep them visually separate (#11)


