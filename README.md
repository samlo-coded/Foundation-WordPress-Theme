# Foundation WordPress Theme

A minimal, professional WordPress block theme starter built for agency use. Fork this repository as the base for every new client project — consistent structure, zero page builder dependency, ready to go.

> **Requires [Advanced Custom Fields PRO](https://www.advancedcustomfields.com/pro/)** — all custom dynamic blocks are PHP-rendered ACF blocks.

---

## Requirements

| Dependency | Version |
|---|---|
| WordPress | 6.9 or higher |
| PHP | 8.1 or higher |
| ACF Pro | Latest |

---

## What This Theme Is

This is **not** a classic theme and **not** a pure Full Site Editing theme. It is a **block theme with PHP-rendered ACF blocks** — the site frame (header, footer, page templates) is handled by the block editor and `theme.json`, while all dynamic, structured content sections are built as ACF Pro blocks with PHP render templates.

---

## How It Works

### Design System — `theme.json`

All design tokens (colours, typography, spacing) are defined in `theme.json` and exposed as CSS custom properties (`--wp--preset--*`). No hardcoded values appear anywhere in the codebase. Every stylesheet and render template references these tokens, which means rebranding a fork is a `theme.json` edit, not a find-and-replace.

### Templates & Template Parts

Page structure is handled by HTML block templates in `/templates/` and template parts in `/parts/` — the block theme equivalent of classic `header.php` and `footer.php`.

| Path | Purpose |
|---|---|
| `templates/` | Full page layouts: index, front-page, single, page, archive, search, 404 |
| `parts/header.html` | Site title and primary navigation with mobile hamburger |
| `parts/footer.html` | Site title, footer navigation, copyright line |

### ACF Pro Blocks — `/blocks/`

Custom dynamic sections are registered via `acf_register_block_type()` and rendered with PHP templates. Each block lives in its own subfolder with a render template and a scoped stylesheet.

| Block | Description |
|---|---|
| `hero` | Full width hero section with heading, subheading, and CTA button |
| `work-grid` | Portfolio project grid powered by a repeater field |
| `testimonials` | Client testimonials powered by a repeater field |
| `services` | Services list powered by a repeater field |

All blocks follow BEM naming (`fwp-block-{name}__element`), use `--wp--preset--*` tokens exclusively, and are mobile-first with container queries where appropriate.

**To add a new block:**
1. Create `/blocks/{name}/{name}.php` and `/blocks/{name}/{name}.css`
2. Add it to the `$blocks` array in `inc/blocks.php`
3. Build the ACF field group in the WordPress admin and assign it to the block

### Block Patterns — `/patterns/`

Reusable core block arrangements editors can insert from the Patterns tab. Patterns are for content-area layouts — not the site frame.

| Pattern | Description |
|---|---|
| `foundation-wp/hero` | Full width contrast hero with heading, paragraph, and button |
| `foundation-wp/cta` | Full width primary colour call-to-action section |

### Assets

| File | Purpose |
|---|---|
| `assets/css/main.css` | Global front-end styles: resets, typography, nav, forms |
| `assets/css/editor.css` | Mirrors front-end appearance inside the block editor |
| `assets/css/admin-colors.css` | Custom WordPress admin colour scheme matching the theme palette |
| `assets/js/main.js` | Vanilla JS scaffold, deferred |

---

## Forking for a New Client Project

1. Fork or duplicate this repository
2. Rename the theme folder and update `style.css` — `Theme Name`, `Author`, `Text Domain`
3. Update the text domain string in all `inc/` PHP files to match
4. Update the colour palette in `theme.json` to match the client brand
5. Add, remove, or modify blocks in `/blocks/` as needed
6. Build ACF field groups in the WordPress admin and assign them to their blocks

> **Note:** ACF field groups are not version-controlled by default. Add an `/acf-json/` folder to the theme root to enable ACF local JSON — field groups will then save as `.json` files alongside your code.

---

## File Structure

```
foundation-wp/
├── style.css                   # Theme metadata only (no styles)
├── theme.json                  # Design tokens: colour, typography, spacing
├── functions.php               # Router only — loads all inc/ files
│
├── inc/
│   ├── setup.php               # Theme supports, menus, image sizes, wp_head cleanup, admin colour scheme
│   ├── enqueue.php             # Asset enqueuing
│   ├── blocks.php              # ACF block category + block registration
│   └── patterns.php            # Pattern category registration
│
├── templates/                  # Block theme page templates
├── parts/                      # Header and footer template parts
├── patterns/                   # Reusable block patterns
│
├── blocks/                     # ACF block render templates and stylesheets
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
```

---

## Changelog

### 1.0.0
- Initial release

---

## License

Foundation WordPress Theme, &copy; 2026 Samuel Long. Distributed under the [GNU General Public License v2](https://www.gnu.org/licenses/gpl-2.0.html) or later.
