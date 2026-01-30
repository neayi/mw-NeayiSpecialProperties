# NeayiSpecialProperties

A MediaWiki extension that adds a semantic special property "Description" to pages using page properties.

## Description

This extension integrates with [SemanticExtraSpecialProperties (SESP)](https://github.com/SemanticMediaWiki/SemanticExtraSpecialProperties) to add a custom semantic property `___DESCRIPTION` that automatically extracts the `description` page property value and makes it available as a semantic property.

**Note:** The property ID uses triple underscores (`___DESCRIPTION`) to distinguish it as a custom property from SESP's built-in properties which use single or double underscores. This naming convention helps avoid conflicts with future SESP built-in properties.

## Requirements

- MediaWiki 1.35 or later
- PHP 7.4 or later
- [Semantic MediaWiki](https://www.semantic-mediawiki.org/)
- [SemanticExtraSpecialProperties](https://github.com/SemanticMediaWiki/SemanticExtraSpecialProperties)

## Installation

1. Clone or download this repository to your MediaWiki `extensions` directory:
   ```bash
   cd extensions/
   git clone https://github.com/neayi/mw-NeayiSpecialProperties.git NeayiSpecialProperties
   ```

2. Add the following line to your `LocalSettings.php`:
   ```php
   wfLoadExtension( 'NeayiSpecialProperties' );
   ```

3. Run the MediaWiki update script:
   ```bash
   php maintenance/update.php
   ```

## Usage

Once installed, the extension automatically adds a "Description" semantic property to all pages that have a `description` page property set.

The property will be visible in the page's semantic data and can be queried using Semantic MediaWiki queries.

### Setting the Description Page Property

You can set the description page property using various methods:

1. **Using ParserFunctions extension:**
   ```wikitext
   {{#setpageproperties:description=This is the page description}}
   ```

2. **Using PageProperties extension:**
   Add the description in the page properties interface.

3. **Programmatically (from an extension or hook):**
   ```php
   $outputPage = $context->getOutput();
   $outputPage->setProperty( 'description', 'Your description here' );
   ```

### Querying the Description Property

You can query pages by their description using Semantic MediaWiki queries:

```wikitext
{{#ask: [[Description::+]]
 |?Description
 |format=table
}}
```

Or search for pages with specific descriptions:

```wikitext
{{#ask: [[Description::~*keyword*]]
 |?Description
 |format=ul
}}
```

## How It Works

1. The extension registers a hook handler for the `sespLocalDefinitions` hook provided by SemanticExtraSpecialProperties
2. It defines a new semantic property `___DESCRIPTION` with the alias `sesp-property-description`
3. The callback function retrieves the `description` page property from MediaWiki's PageProps system
4. The value is converted to a semantic data item (SMWDIBlob) and added to the page's semantic data
5. The property label is translated using MediaWiki's i18n system, fixing the `⧼sesp-property-description⧽` display issue

## Localization

The extension supports internationalization. Currently supported languages:
- English (en)
- French (fr)

To add more languages, create a new JSON file in the `i18n/` directory following the pattern of existing files.

### Translation Messages

- `neayispecialproperties-desc`: Extension description shown in Special:Version
- `sesp-property-description`: Label for the Description semantic property

## Troubleshooting

### Property label shows as `⧼sesp-property-description⧽`

This usually means:
1. The extension is not loaded properly - verify `wfLoadExtension( 'NeayiSpecialProperties' );` is in `LocalSettings.php`
2. The i18n files are not being read - check file permissions on the `i18n/` directory
3. MediaWiki cache needs to be cleared - try running `php maintenance/rebuildLocalisationCache.php`

### Description property not appearing

1. Verify that the page has a `description` page property set
2. Run the Semantic MediaWiki data rebuild: `php extensions/SemanticMediaWiki/maintenance/rebuildData.php`
3. Check that SemanticExtraSpecialProperties is properly installed and configured

## Development

### Code Style

The extension follows MediaWiki coding conventions. To check your code:

```bash
composer install
composer test
```

To automatically fix code style issues:

```bash
composer fix
```

## License

This extension is licensed under the GNU General Public License v2.0 or later. See the [LICENSE](LICENSE) file for details.
