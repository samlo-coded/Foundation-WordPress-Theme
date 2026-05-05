== Foundation WordPress Theme ==

Contributors: Samuel Long
Requires at least: 6.9
Tested up to: 6.9
Requires PHP: 8.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html


== Description ==

Foundation WP is a minimal, professional WordPress block theme starter built for agency use. It is designed to be forked as the base for every new client project, providing a consistent, well-structured foundation without any page builder dependency.

This theme is not a classic theme and not a pure Full Site Editing theme. It is a block theme with PHP-rendered ACF blocks — all dynamic, custom sections are built as Advanced Custom Fields (ACF Pro) blocks rather than relying on the block editor alone.


== Requirements ==

* WordPress 6.9 or higher
* PHP 8.1 or higher
* Advanced Custom Fields PRO — required for all custom ACF blocks


== How It Works ==

=== Design System (theme.json) ===

All design tokens — colours, typography, spacing — are defined in theme.json and exposed as CSS custom properties (--wp--preset--*). No hardcoded values appear anywhere in the codebase. Every stylesheet, block template, and render template references these tokens.

=== Templates & Template Parts ===

Page structure is handled by HTML block templates in /templates/ and template parts in /parts/. These are the block theme equivalent of classic header.php and footer.php files.

* templates/    — full page layouts (index, front-page, single, page, archive, search, 404)
* parts/        — reusable frame sections loaded via wp:template-part
  * header.html — site logo/title and primary navigation with mobile hamburger menu
  * footer.html — site title, footer navigation, and copyright line

=== ACF Pro Blocks (/blocks/) ===

Custom dynamic sections are built as ACF Pro blocks — PHP-rendered templates registered via acf_register_block_type(). Each block lives in its own subfolder with a render template and a scoped stylesheet.

Starter blocks included:

* hero          — full width hero section with heading, subheading, and CTA button
* work-grid     — portfolio project grid powered by a repeater field
* testimonials  — client testimonials powered by a repeater field
* services      — services list powered by a repeater field

Each block follows BEM naming (fwp-block-{name}__element), uses --wp--preset--* tokens for all values, and is mobile-first with container queries where appropriate.

To add a new ACF block:
1. Create /blocks/{name}/{name}.php and /blocks/{name}/{name}.css
2. Register it in inc/blocks.php inside the $blocks array
3. Define your ACF field group and assign it to the block in the WordPress admin

=== Block Patterns (/patterns/) ===

Reusable arrangements of core blocks that editors can insert from the Patterns tab in the block inserter. Patterns are for content-area layouts, not the site frame.

Starter patterns included:

* foundation-wp/hero — full width contrast hero with heading, paragraph, and button
* foundation-wp/cta  — full width primary colour call-to-action section

=== Assets ===

* assets/css/main.css        — global front-end styles (resets, typography, nav, forms)
* assets/css/editor.css      — mirrors front-end appearance inside the block editor
* assets/css/admin-colors.css — custom WordPress admin colour scheme matching the theme palette
* assets/js/main.js          — vanilla JS scaffold, deferred


== Forking for a New Client Project ==

1. Fork or duplicate this repository
2. Rename the theme folder and update the metadata in style.css (Theme Name, Author, Text Domain)
3. Update the text domain string in all inc/ PHP files to match
4. Update the colour palette in theme.json to match the client brand
5. Add, remove, or modify ACF blocks in /blocks/ as the project requires
6. Register all ACF field groups against their respective blocks in the WordPress admin


== File Structure ==

foundation-wp/
├── style.css                   — Theme metadata only (no styles)
├── theme.json                  — Design tokens: colour, typography, spacing
├── functions.php               — Router only: loads all inc/ files
│
├── inc/
│   ├── setup.php               — Theme supports, menus, image sizes, wp_head cleanup, admin colour scheme
│   ├── enqueue.php             — Asset enqueuing
│   ├── blocks.php              — ACF block category + block registration
│   └── patterns.php            — Pattern category registration
│
├── templates/                  — Block theme page templates
├── parts/                      — Header and footer template parts
├── patterns/                   — Reusable block patterns
│
├── blocks/                     — ACF block render templates and stylesheets
│   ├── hero/
│   ├── work-grid/
│   ├── testimonials/
│   └── services/
│
└── assets/
    ├── css/main.css
    ├── css/editor.css
    ├── css/admin-colors.css
    └── js/main.js


== Changelog ==

= 1.0.0 =
* Initial release


== Copyright ==

Foundation WordPress Theme, (C) 2026 Samuel Long
Foundation WordPress Theme is distributed under the terms of the GNU GPL.

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
