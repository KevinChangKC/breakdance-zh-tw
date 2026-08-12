# Breakdance — Traditional Chinese (zh-TW)

An unofficial Traditional Chinese translation for [Breakdance](https://breakdance.com), the WordPress website builder by Soflyy.

**1,869 unique strings translated.** Installed and verified in production on Breakdance 3.0.

Built and maintained by [MoTech](https://onemore-dl9s.1wp.site), a web design studio in Taiwan. Offered to Soflyy and the community free of charge — see [Licence](#licence).

---

## Why this exists

Traditional Chinese is not among Breakdance's shipped locales. For an agency in Taiwan that matters more than it sounds: we hand finished sites to clients who then edit their own content, and an English-only editor is a real obstacle for them. This pack exists so that "the client can maintain it themselves" is actually true.

## Coverage

| Layer | Where it lives | Strings |
|---|---|---|
| PHP — element names, control labels, admin UI | `.mo` / `.l10n.php` | 1,512 messages (1,109 unique msgids) |
| Editor — the Breakdance Vue app | `.json` | 914 |
| **Union, deduplicated** | | **1,869** |

Roughly 66% of Breakdance's ~2,808 translatable strings. The untranslated remainder is deliberate: coverage was prioritised by what a client-facing editor actually sees, not by raw count. Deep developer-facing settings screens are still English.

### Known gap

Element category names — *Basic*, *Blocks*, *Media*, and so on — are not exposed in any `.pot` file and are not currently translatable through any documented filter. They remain English. If Soflyy ever makes them translatable, they'll be covered here.

## How it works

Breakdance localises in two distinct layers, and each needs different handling if the translation is to survive plugin updates.

**1. The PHP layer** — element names and control labels, many registered with `_x()` and a context. Standard WordPress territory: drop the `.mo` (and, for WordPress 7.0+, the `.l10n.php`) into `wp-content/languages/plugins/`. WordPress loads it automatically and plugin updates never touch it.

**2. The editor layer** — the Vue application. Breakdance hardcodes a read from `languages/breakdance-{locale}.json` *inside its own plugin directory*, which means any file placed there is destroyed on the next update. Rather than fight that, this pack uses Breakdance's own `breakdance_i18n_json` filter and injects the JSON from a mu-plugin. Update-safe by construction.

The loader also fails closed: if the JSON is missing or malformed it returns the original untouched, because a broken payload white-screens the editor.

## Installation

```
wp-content/
├── languages/plugins/
│   ├── breakdance-zh_TW.mo
│   └── breakdance-zh_TW.l10n.php
└── mu-plugins/
    ├── breakdance-zhtw-loader.php
    └── breakdance-zhtw/
        └── breakdance-zh_TW.json
```

Copy `languages/*` into `wp-content/languages/plugins/`, and the entire `mu-plugin/` contents into `wp-content/mu-plugins/`. Set the site or user locale to 繁體中文 (`zh_TW`).

If translations don't appear, flush any object cache and persistent page cache — WordPress 7.0 reads the `.l10n.php` in preference to the `.mo`, and cached translation lookups will happily serve you the old English strings.

## Contributing

`languages/breakdance-zh_TW.po` is the editable source. Edit it in Poedit or any gettext tool, then regenerate:

```sh
msgfmt breakdance-zh_TW.po -o breakdance-zh_TW.mo
wp i18n make-php languages/            # regenerates the .l10n.php
```

Corrections are welcome. Taiwanese software terminology has its own conventions and this translation follows Taiwan usage, not mainland Chinese usage — if something reads wrong to a native ear, open an issue.

## Licence

GPL-2.0-or-later, matching WordPress and Breakdance.

Soflyy is explicitly welcome to adopt this as the official zh-TW pack, fold it into the Breakdance repository, relicense it under whatever terms their distribution requires, and ship it without attribution or compensation. No permission needed — this is offered, not licensed for negotiation.

---

## 中文說明

Breakdance 的非官方繁體中文語系包，已翻譯 **1,869 條**唯一字串，在 Breakdance 3.0 正式站上安裝驗證通過。

**為什麼要做這個**：Breakdance 官方沒有繁中。對台灣的接案工作室來說這不是小事——網站交付後客戶要自己編輯內容，全英文編輯器就是實際的門檻。這份語系包讓「客戶可以自己維護」這個賣點真的成立。

**覆蓋率**約 66%（全部可翻約 2,808 條）。沒翻完是刻意的：優先翻客戶端編輯者實際會看到的那一層，開發者才會碰的深層設定頁維持英文。

**已知缺口**：元件分類名（Basic／Blocks／Media）不在任何 `.pot` 檔裡，目前沒有任何公開 filter 可以翻，維持英文。

**安裝**：`languages/` 底下兩個檔案放到 `wp-content/languages/plugins/`，`mu-plugin/` 底下全部放到 `wp-content/mu-plugins/`，再把網站或使用者語系設成繁體中文。翻譯沒出現的話先清物件快取和頁面快取（WP 7.0 優先讀 `.l10n.php`，快取住的舊字串會讓你以為沒生效）。

**要改翻譯**：改 `languages/breakdance-zh_TW.po`，再用 `msgfmt` 產生 `.mo`、`wp i18n make-php` 產生 `.l10n.php`。用語一律照台灣慣用，不用中國大陸用語；讀起來怪的地方歡迎開 issue。
