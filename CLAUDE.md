# Foundation WordPress Theme — Claude Code Build Instructions

## Project Overview

You are helping build **Foundation WP**, a minimal, professional WordPress block theme starter. This is a reusable agency-grade starter theme that will be forked for every future client project. It is **not** a classic theme and **not** a pure FSE theme — it is a **block theme with PHP-rendered ACF blocks** for dynamic content.

The theme is built without page builders. All custom sections are either:
- **Block Patterns** — core blocks arranged in the editor, stored in `/patterns/` as PHP files
- **ACF Pro Blocks** — PHP-rendered custom blocks registered via `acf_register_block_type()`

---

## Core Principles

- **Never** touch WordPress core files
- **Never** put styles in `style.css` (metadata only)
- **Always** use `FOUNDATION_WP_DIR` and `FOUNDATION_WP_URI` constants for paths
- **Always** write mobile-first CSS
- **Always** use `--wp--preset--*` CSS custom properties rather than hardcoded values
- **Always** escape output in PHP templates (`esc_html()`, `esc_url()`, `esc_attr()`)
- **Always** check `function_exists()` before calling ACF functions
- Keep `functions.php` as a clean router only — no logic goes directly in it
- One responsibility per `inc/` file

---

## Constants & Naming

```php
define( 'FOUNDATION_WP_VERSION', '1.0.0' );
define( 'FOUNDATION_WP_DIR', get_template_directory() );
define( 'FOUNDATION_WP_URI', get_template_directory_uri() );
```

- **Text domain:** `foundation-wp`
- **Block category slug:** `foundation-blocks`
- **Pattern category slug:** `foundation-patterns`
- **CSS class prefix:** `fwp-` (e.g. `fwp-block-hero`, `fwp-block-testimonials`)
- **Handle prefix:** `foundation-wp-` (e.g. `foundation-wp-style`, `foundation-wp-hero`)

---

## Theme File Structure

Build and maintain the following structure. Do not deviate from it:

```
foundation-wp/
├── style.css                        ← Theme metadata ONLY
├── theme.json                       ← Design system / tokens
├── functions.php                    ← Router only (already written, do not modify)
├── readme.txt
│
├── templates/
│   ├── index.html                   ← Required fallback
│   ├── front-page.html              ← Homepage
│   ├── single.html                  ← Single post
│   ├── page.html                    ← Static page
│   ├── archive.html                 ← Post archive
│   ├── search.html                  ← Search results
│   └── 404.html                     ← Error page
│
├── parts/
│   ├── header.html                  ← Site header
│   └── footer.html                  ← Site footer
│
├── patterns/                        ← Block patterns (PHP file headers, block markup)
│   ├── hero.php
│   └── cta.php
│
├── blocks/                          ← ACF block render templates
│   ├── testimonials/
│   │   ├── testimonials.php
│   │   └── testimonials.css
│   └── work-grid/
│       ├── work-grid.php
│       └── work-grid.css
│
├── inc/
│   ├── setup.php                    ← Theme support, menus, image sizes, wp_head cleanup
│   ├── enqueue.php                  ← All asset enqueuing
│   ├── blocks.php                   ← ACF block registration + block categories
│   └── patterns.php                 ← Pattern category registration
│
└── assets/
    ├── css/
    │   ├── main.css                 ← All custom front end styles
    │   └── editor.css               ← Editor-specific style overrides
    ├── js/
    │   └── main.js                  ← Custom JavaScript (deferred)
    ├── fonts/                       ← Self-hosted fonts if used
    └── images/                      ← Theme images / fallbacks
```

---

## functions.php

Already written. **Do not modify this file.** It is the clean router:

```php
<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

define( 'FOUNDATION_WP_VERSION', '1.0.0' );
define( 'FOUNDATION_WP_DIR', get_template_directory() );
define( 'FOUNDATION_WP_URI', get_template_directory_uri() );

require_once FOUNDATION_WP_DIR . '/inc/setup.php';
require_once FOUNDATION_WP_DIR . '/inc/enqueue.php';
require_once FOUNDATION_WP_DIR . '/inc/blocks.php';
require_once FOUNDATION_WP_DIR . '/inc/patterns.php';
```

---

## style.css

Metadata only. No styles:

```css
/*
Theme Name: Foundation WP
Theme URI: https://yourdomain.com
Author: Your Name
Author URI: https://yourdomain.com
Description: A minimal block theme foundation for professional custom client builds.
Requires at least: 6.4
Tested up to: 6.7
Requires PHP: 8.1
Version: 1.0.0
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Text Domain: foundation-wp
Tags: block-theme, full-site-editing, custom-colors, custom-typography
*/
```

---

## theme.json

Use version 3. Follow these rules:

- Set `"defaultPalette": false` and `"defaultGradients": false` — clients only see theme colours
- Set `"customFontSize": false` — clients only use defined font sizes
- Set `"customSpacingSize": false` — clients only use defined spacing
- Set `"fluid": true` on typography with min/max values for every font size
- Set `"useRootPaddingAwareAlignments": true`
- Set `"appearanceTools": true`
- Define `contentSize` and `wideSize` under `settings.layout`
- All colours must have a `slug`, `color`, and `name`
- Register `header` and `footer` under `templateParts`
- All styles must reference presets via `var(--wp--preset--*)` — no hardcoded values in styles

Design token structure:

```json
{
  "$schema": "https://schemas.wp.org/trunk/theme.json",
  "version": 3,
  "settings": {
    "appearanceTools": true,
    "useRootPaddingAwareAlignments": true,
    "layout": {
      "contentSize": "720px",
      "wideSize": "1200px"
    },
    "color": {
      "defaultPalette": false,
      "defaultGradients": false,
      "custom": false,
      "customGradient": false,
      "palette": [
        { "slug": "base",      "color": "#ffffff", "name": "Base"      },
        { "slug": "contrast",  "color": "#0a0a0a", "name": "Contrast"  },
        { "slug": "primary",   "color": "#2563eb", "name": "Primary"   },
        { "slug": "secondary", "color": "#64748b", "name": "Secondary" },
        { "slug": "accent",    "color": "#f59e0b", "name": "Accent"    },
        { "slug": "muted",     "color": "#f1f5f9", "name": "Muted"     }
      ]
    },
    "typography": {
      "fluid": true,
      "customFontSize": false,
      "lineHeight": true,
      "dropCap": false,
      "fontFamilies": [
        {
          "fontFamily": "system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif",
          "slug": "system",
          "name": "System"
        }
      ],
      "fontSizes": [
        { "slug": "small",    "size": "0.875rem", "name": "Small",      "fluid": { "min": "0.875rem", "max": "0.875rem" } },
        { "slug": "medium",   "size": "1rem",     "name": "Medium",     "fluid": { "min": "1rem",     "max": "1.125rem" } },
        { "slug": "large",    "size": "1.25rem",  "name": "Large",      "fluid": { "min": "1.125rem", "max": "1.25rem"  } },
        { "slug": "x-large",  "size": "1.875rem", "name": "Extra Large","fluid": { "min": "1.375rem", "max": "1.875rem" } },
        { "slug": "xx-large", "size": "2.5rem",   "name": "Huge",       "fluid": { "min": "1.75rem",  "max": "2.5rem"   } }
      ]
    },
    "spacing": {
      "padding": true,
      "margin": true,
      "blockGap": true,
      "customSpacingSize": false,
      "units": ["px", "rem", "em", "%", "vh", "vw"],
      "spacingScale": {
        "operator": "*",
        "increment": 1.5,
        "steps": 7,
        "mediumStep": 1.5,
        "unit": "rem"
      }
    },
    "border": {
      "color": true,
      "radius": true,
      "style": true,
      "width": true
    }
  }
}
```

Add global `styles`, heading element styles, link styles, and `templateParts` registration for header and footer.

---

## inc/setup.php

Responsibilities:
- `add_theme_support()` declarations inside `after_setup_theme`
- Register navigation menus
- Register custom image sizes
- Remove unwanted `wp_head` output
- Register admin colour scheme
- Set admin colour scheme as default for new and existing users
- Remove core block patterns (theme provides its own)

Key requirements:
- Always wrap in `after_setup_theme` hook
- Add `editor-styles` support and point to `assets/css/editor.css`
- Add `post-thumbnails`, `title-tag`, `responsive-embeds`, `html5` support
- Call `remove_theme_support( 'core-block-patterns' )`
- Clean `wp_head` by removing: `wp_generator`, `wlwmanifest_link`, `rsd_link`, `wp_shortlink_wp_head`
- Register menus: `primary` and `footer`
- Register image sizes: `fwp-thumb` (800×600 hard crop), `fwp-hero` (1600×900 hard crop)
- Register admin colour scheme using `wp_admin_css_color()` pointing to `assets/css/admin-colors.css`
- Set scheme as default on `user_register` and for existing users without a scheme set

---

## inc/enqueue.php

Responsibilities:
- Enqueue `assets/css/main.css` on `wp_enqueue_scripts`
- Enqueue `assets/js/main.js` on `wp_enqueue_scripts` with `strategy: defer`
- Enqueue `assets/css/editor.css` on `enqueue_block_editor_assets`
- Conditionally enqueue `comment-reply` script on singular posts with open comments

Rules:
- Use `FOUNDATION_WP_URI` for all paths
- Use `FOUNDATION_WP_VERSION` as cache bust version for all handles
- Use handle prefix `foundation-wp-`
- Never enqueue in `functions.php` directly

---

## inc/blocks.php

Responsibilities:
- Register a custom block category `foundation-blocks` via `block_categories_all` filter
- Register all ACF blocks inside `acf/init` hook
- Guard with `if ( ! function_exists( 'acf_register_block_type' ) ) return;`

ACF block registration rules:
- `render_template` points to `FOUNDATION_WP_DIR . '/blocks/{name}/{name}.php'`
- `enqueue_style` points to `FOUNDATION_WP_URI . '/blocks/{name}/{name}.css'`
- `category` is always `foundation-blocks`
- `supports` always includes `'anchor' => true` and `'jsx' => true`
- `'align' => false` unless the block specifically needs alignment options

Starter blocks to register (empty render templates are fine initially):
- `hero` — full width hero section
- `work-grid` — portfolio project grid with repeater
- `testimonials` — client testimonials with repeater
- `services` — services list with repeater

---

## inc/patterns.php

Responsibilities:
- Register the `foundation-patterns` pattern category on `init`
- WordPress auto-registers pattern files from `/patterns/` folder — no manual `register_block_pattern()` calls needed

---

## Block Templates (templates/*.html)

All templates follow this structure:

```html
<!-- wp:template-part {"slug":"header","tagName":"header"} /-->

<!-- wp:main {"layout":{"type":"constrained"}} -->
<main class="wp-block-main">
    <!-- Content blocks here -->
</main>
<!-- /wp:main -->

<!-- wp:template-part {"slug":"footer","tagName":"footer"} /-->
```

Templates to create:

| File | Content |
|------|---------|
| `index.html` | Query loop with post title, excerpt, date. Pagination. |
| `front-page.html` | Placeholder group with site title and tagline |
| `single.html` | Post title, featured image, post content, post navigation |
| `page.html` | Page title, post content |
| `archive.html` | Archive title, query loop matching index.html |
| `search.html` | Search title, query loop, no results fallback |
| `404.html` | Heading, paragraph, search block |

---

## Template Parts (parts/*.html)

**parts/header.html**
- Constrained group wrapping a flex row
- Site title (left) and navigation block (right)
- Navigation should have `overlayMenu: mobile` for hamburger on small screens

**parts/footer.html**
- Constrained group
- Flex row with site title and footer nav (if registered)
- Copyright line with current year using `<!-- wp:post-date {"format":"Y"} /-->`

---

## Block Patterns (patterns/*.php)

Every pattern file requires this header format:

```php
<?php
/**
 * Title: Pattern Name
 * Slug: foundation-wp/pattern-slug
 * Categories: foundation-patterns
 * Block Types: core/group
 */
?>
<!-- block markup -->
```

Starter patterns to create:

**patterns/hero.php** — `foundation-wp/hero`
- Full width group with contrast background
- H1 heading
- Paragraph subheading
- Buttons block with one primary button
- Centred layout with constrained content

**patterns/cta.php** — `foundation-wp/cta`
- Full width group with primary background colour
- Centred H2
- Short paragraph
- Buttons block
- Generous vertical padding using spacing presets

---

## ACF Block Render Templates (blocks/{name}/{name}.php)

Every render template follows this structure:

```php
<?php
/**
 * Block Name Block Template
 */

if ( ! defined( 'ABSPATH' ) ) exit;

// Retrieve ACF fields
$field = get_field( 'field_name' );

// Build block classes
$block_id      = 'block-' . $block['id'];
$block_classes = 'fwp-block-{name}';

if ( ! empty( $block['className'] ) ) {
    $block_classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $block_classes .= ' align' . $block['align'];
}
?>

<section id="<?php echo esc_attr( $block_id ); ?>"
         class="<?php echo esc_attr( $block_classes ); ?>">
    <!-- Template output -->
</section>
```

Rules:
- Always escape output: `esc_html()`, `esc_url()`, `esc_attr()`
- Always check fields before rendering: `<?php if ( $field ): ?>`
- CSS class prefix is always `fwp-block-`
- Use BEM naming: `fwp-block-hero__heading`, `fwp-block-hero__content`
- Use `--wp--preset--*` variables in inline styles where needed
- Repeater fields use `foreach` loops

---

## ACF Block Stylesheets (blocks/{name}/{name}.css)

Rules:
- Mobile first — base styles target mobile, `@media (min-width: Xpx)` for larger
- Use `--wp--preset--spacing--*` for all padding, margin, gap values
- Use `--wp--preset--color--*` for all colours
- Use `--wp--preset--font-size--*` for all font sizes
- Use container queries (`container-type: inline-size`) for layout shifts where the block context may vary
- BEM naming matching the render template classes

Breakpoint reference (document in each file, cannot use custom props in media queries):
```
sm:  640px
md:  768px
lg:  1024px
xl:  1280px
```

---

## assets/css/main.css

Global styles not controlled by theme.json. Structure:

```css
/* ==========================================================================
   Foundation WP — Main Stylesheet
   Mobile first. Use --wp--preset--* variables throughout.
   ========================================================================== */

/* Base resets beyond what theme.json provides */

/* Typography overrides */

/* Navigation styles */

/* Forms */

/* Utility classes */

/* WordPress core block overrides */
```

---

## assets/css/editor.css

Mirrors front end appearance inside the block editor. Key rules:
- Target `.editor-styles-wrapper` for global editor styles
- Mirror any `.wp-block` max-width constraints
- Include any ACF block styles that need editor representation
- Never include styles that should only appear on the front end

---

## assets/css/admin-colors.css

Custom admin colour scheme stylesheet. Must override:
- `#adminmenu`, `#adminmenuback`, `#adminmenuwrap` — sidebar background
- `#adminmenu a` — sidebar links
- `#adminmenu li.menu-top:hover` — hover states
- `#adminmenu .current a.menu-top` — active states
- `#adminmenu .wp-submenu` — submenu background
- `#wpadminbar` — admin bar
- `.wp-core-ui .button-primary` — primary buttons
- `:root` — `--wp-admin-theme-color` and darker variants

Use the same colour values as defined in `theme.json` palette.

---

## assets/js/main.js

Minimal JavaScript. Defer loaded. Structure:

```js
/**
 * Foundation WP — Main JavaScript
 */

document.addEventListener( 'DOMContentLoaded', () => {
    // Navigation toggle (mobile)
    // Any global UI interactions
});
```

Do not use jQuery. Vanilla JS only.

---

## WordPress Block Markup Conventions

When writing block templates manually:

- Self-closing blocks use ` /-->` (space before closing)
- Opening/closing block pairs wrap their inner HTML
- Attributes are JSON encoded in the comment
- Reference spacing presets as `"var:preset|spacing|50"` inside block attributes
- Reference colour presets as `"var:preset|color|primary"` inside block attributes
- Reference font size presets as `"var:preset|font-size|large"` inside block attributes

Example constrained section:

```html
<!-- wp:group {"align":"full","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull">
    <!-- wp:heading {"level":2,"fontSize":"x-large"} -->
    <h2 class="wp-block-heading has-x-large-font-size">Section Title</h2>
    <!-- /wp:heading -->
</div>
<!-- /wp:group -->
```

---

## What Not to Build

Do not create or suggest:
- A `page-builder` approach or shortcodes
- Any use of the Customizer API
- Classic PHP templates (`header.php`, `footer.php`, `page.php` as PHP files)
- Inline `<style>` blocks in render templates
- Hardcoded hex values or pixel sizes in CSS (use presets)
- jQuery or any external JavaScript libraries unless explicitly requested
- Plugin territory functionality (CPTs, taxonomies) — those belong in a plugin, not this theme

---

## Completion Checklist

When the theme is complete, verify:

- [ ] `style.css` has correct metadata and no styles
- [ ] `theme.json` has all colour, typography, spacing tokens defined
- [ ] `theme.json` has `templateParts` registered for header and footer
- [ ] All 7 templates exist in `templates/`
- [ ] `parts/header.html` and `parts/footer.html` exist
- [ ] `inc/setup.php` has all theme supports, menu registration, image sizes, wp_head cleanup, admin colour scheme
- [ ] `inc/enqueue.php` enqueues main.css, main.js (deferred), editor.css
- [ ] `inc/blocks.php` registers block category and all 4 starter ACF blocks
- [ ] `inc/patterns.php` registers pattern category
- [ ] `patterns/hero.php` and `patterns/cta.php` exist with correct file headers
- [ ] `blocks/` folder has subfolder per block with `.php` render template and `.css` stylesheet
- [ ] `assets/css/main.css` exists (can be minimal)
- [ ] `assets/css/editor.css` exists
- [ ] `assets/css/admin-colors.css` exists with full admin overrides
- [ ] `assets/js/main.js` exists
- [ ] Theme activates in WordPress without errors
- [ ] Site Editor opens without errors
- [ ] Block pattern category appears in pattern inserter
- [ ] Custom block category appears in block inserter (requires ACF Pro active)
