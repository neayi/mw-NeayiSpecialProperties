# NeayiSpecialProperties

A MediaWiki extension that adds a semantic special property "Description" to pages using page properties.

## Description

This extension integrates with [SemanticExtraSpecialProperties (SESP)](https://github.com/SemanticMediaWiki/SemanticExtraSpecialProperties) to add a custom semantic property `___DESCRIPTION` that automatically extracts the `description` page property value and makes it available as a semantic property.

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

3. **Programmatically:**
   ```php
   $pageProps = MediaWiki\MediaWikiServices::getInstance()->getPageProps();
   $pageProps->setProperty( $title, 'description', 'Your description here' );
   ```

## Localization

The extension supports internationalization. Currently supported languages:
- English (en)
- French (fr)

To add more languages, create a new JSON file in the `i18n/` directory following the pattern of existing files.

## License

This extension is licensed under the GNU General Public License v2.0 or later. See the [LICENSE](LICENSE) file for details.
