# Core Web Vitals Baseline Audit
_Generated: 2026-03-12_

---

## Findings — Ranked by CWV Impact

---

### 1. Adobe Fonts (Typekit) — Render-Blocking External Request
**Impact: HIGH — LCP / FCP**

`clarendon-text-pro` and `aktiv-grotesk` are Adobe Fonts (Typekit). These are loaded via
an external `<link>` or `<script>` tag injected by Salient/WordPress, which is render-blocking
by default. This delays First Contentful Paint and LCP because the browser must fetch the
Typekit stylesheet before rendering text.

**These two fonts are used as the primary typefaces across every page.**

Recommendations:
- Add `<link rel="preconnect" href="https://use.typekit.net">` in `<head>` to reduce DNS/TLS cost.
- If Typekit allows it, use `font-display: swap` in the kit settings.
- Audit whether both weights/variants of aktiv-grotesk are actually used (multiple variants
  referenced: `aktiv-grotesk-thin`, `aktiv-grotesk` — may be duplicating requests).

---

### 2. All CSS Loaded Synchronously — No Async/Defer Strategy
**Impact: HIGH — FCP / LCP**

All page stylesheets are enqueued via `wp_enqueue_style()` which outputs standard `<link rel="stylesheet">` tags. These are render-blocking — the browser cannot paint until all CSS files are downloaded and parsed.

Pages load between 2–4 CSS files each:
- `style.min.css` (global, every page)
- `home.min.css` / `contact.min.css` / etc. (page-specific)
- `blog.min.css` or `blog-category.min.css` (archive pages)

No critical CSS is inlined, and no stylesheets are loaded asynchronously.

Recommendation: Inline above-the-fold (critical) CSS in `<head>` and load the rest async using
the `media="print" onload="this.media='all'"` pattern or a `preload` hint.

---

### 3. 14 Gotham Font Variants Declared — Many Likely Unused
**Impact: MEDIUM — LCP / TBT (network cost)**

`fonts.scss` declares 14 `@font-face` rules for Gotham across various weights and styles
(100–900, normal + italic). Browsers only download font files when a matching element is
rendered, but declaring unused variants adds overhead to the font matching process and
creates risk of accidental downloads.

The primary body font usage appears to be `font-weight: normal` (Book) and `font-weight: bold`.
Italic variants and extreme weights (Ultra, Black Italic, XLight Italic, Thin Italic) are
likely only used in specific contexts.

Recommendation: Audit which Gotham weights are actually rendered in production and remove
unused `@font-face` declarations.

---

### 4. Font Paths Are Absolute (Hardcoded)
**Impact: MEDIUM — portability / correctness**

All `@font-face` src URLs use absolute paths:
```scss
url('/wp-content/themes/tlc-theme/fonts/Gotham-Book.woff2')
```

If the site moves to a subdirectory, or the theme is renamed, all fonts will 404 silently.

Recommendation: Use `get_stylesheet_directory_uri()` via a CSS custom property set in PHP,
or at minimum switch to relative paths from the compiled CSS output location.

---

### 5. `forms.js` Is Not Minified
**Impact: LOW-MEDIUM — TBT**

`assets/js/forms.js` is the only custom JS file actively enqueued. It is loaded as-is with
no minification step in the Gulp pipeline. The `gulpfile.js` has no JS processing tasks at all.

Recommendation: Add a `gulp-terser` task for JS minification and output to `assets/js/forms.min.js`.

---

### 6. No Font Preload Hints for Critical Fonts
**Impact: LOW-MEDIUM — LCP**

No `<link rel="preload">` hints exist for the primary fonts (Gotham Book, clarendon-text-pro).
The browser discovers these fonts late — only after parsing CSS — causing a flash of invisible
or fallback text.

Recommendation: Add `wp_enqueue_style` preload hints or `add_action('wp_head', ...)` for the
2–3 most critical font files (Gotham-Book.woff2, Gotham-Bold.woff2).

---

### 7. No Source Maps in Development Build
**Impact: LOW — developer experience only**

`gulpfile.js` has no source map generation. Debugging compiled/minified CSS in DevTools
requires mapping back to SCSS manually.

Recommendation: Add `gulp-sourcemaps` wrapped around the SCSS compile step, active only
when `NODE_ENV !== 'production'`.

---

### 8. Dead Code — `custom.js`
**Impact: NONE — housekeeping**

`custom.js` in the theme root is registered in `includes/enqueue.php` but the enqueue call
is commented out. The file should either be activated or deleted.

---

## What's Already Good

- All CSS compiled to `.min.css` — good.
- All Gotham fonts self-hosted (no Google Fonts external requests from custom CSS).
- `font-display: swap` set on all Gotham `@font-face` declarations.
- Per-page CSS loading (no single large stylesheet on every page).
- `forms.js` loaded in the footer (`$in_footer = true`).
- `functions.php` now split into focused include files.
