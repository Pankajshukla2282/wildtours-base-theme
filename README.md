# WildTours Base Theme

Enterprise-grade classic WordPress theme for travel, safari and tourism websites.
Designed to work standalone or with the **Panna Wild Tour** companion plugin
(which adds safari/package/destination post types and booking flows).

## Features

- **Travel component library** — reusable, `$args`-driven components in
  `template-parts/components/`:
  `card`, `trip-card`, `itinerary`, `inclusions`, `exclusions`, `pricing-table`,
  `testimonials`, `gallery` (+ lightbox), `faq`, `cta-band`, `stats`, `social-links`,
  `trust-badges`, `newsletter`, `currency-switcher`, `language-switcher`,
  `whatsapp-float`, `back-to-top`.
  Render any of them anywhere: `wildtours_component('gallery', ['images' => $ids]);`
- **Page templates** — Full Width, No Title, Blank, and Landing templates plus
  matching block `templates/` (header, footer, index) for editor users.
- **Flexibility layer** — extensive Customizer (layout, sidebar, header topbar + CTA,
  contact/WhatsApp, footer + social, CTA band defaults, color scheme + accent colors),
  dynamic CSS variables, `theme.json` v3 presets, gradients, fluid typography and
  style variations (Forest / Desert / Savanna / Ocean).
- **Structured data** — JSON-LD `TravelAgency`, `WebSite` + SearchAction,
  `BreadcrumbList` and `FAQPage` via the `wildtours/base/schema` filter.
- **Block patterns** — 11 one-click patterns under the *WildTours* category
  (hero, CTA band, stats, pricing, itinerary, inclusions/exclusions, testimonials,
  gallery, trust badges, newsletter, contact).
- **i18n ready** — all strings in `languages/wildtours-base.pot` (`Text Domain: wildtours-base`).
- **RTL support** — automatic `assets/css/rtl.css` loading.
- **Accessibility** — skip link, visible focus indicators, `prefers-reduced-motion` support.

## Installable Package

Do not upload the repository source archive from GitHub, for example `wildtours-base-theme-main.zip`.
That archive contains the theme inside a nested folder, so WordPress cannot find the required root files and reports `Template is missing`.

Build and upload the dedicated theme package instead:

```powershell
./package-theme.cmd
```

This creates `wildtours-base-theme.zip` at the workspace root. Upload that file in WordPress under Appearance > Themes > Add Theme > Upload Theme.

## Customizer Quick Start

| Setting | Location | Effect |
| --- | --- | --- |
| WhatsApp Number | Contact | Enables the floating WhatsApp button |
| Color Scheme | Colors | Swaps the frontend palette instantly |
| Sidebar Layout | Layout | Right sidebar on posts/pages (hidden on travel post types) |
| Top Bar Text / Header CTA | Header | Utility bar above the navigation |
| CTA defaults | Call to Action | Feeds the `cta-band` component |

## Filters for Child Themes & Plugins

- `wildtours/base/schema` — reshape the JSON-LD graph.
- `wildtours/base/providers` — extend the service provider list.
- `wildtours/base/currencies`, `wildtours/base/currency_rates` — currency switcher.
- `wildtours/base/color_schemes`, `wildtours/base/dynamic_css_variables` — theming.
- `wildtours/base/card/render`, `wildtours/base/card/classes` — card output.
- `wildtours/base/sidebar_layout`, `wildtours/base/archive_columns` — layout.
- `wildtours/base/social/links`, `wildtours/base/badges/items`, `wildtours/base/whatsapp_number`.

## Why The GitHub Zip Fails

WordPress expects the uploaded zip to contain the theme files directly under a single theme folder such as:

```text
wildtours-base-theme/
	style.css
	index.php
	functions.php
```

The GitHub source download wraps the entire repository first, so the theme ends up nested too deeply inside the archive.
