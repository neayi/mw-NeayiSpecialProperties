# NeayiSpecialProperties

A MediaWiki extension that encapsulates adding new semantic properties to pages.

## Description

This extension integrates with SemanticExtraSpecialProperties to provide custom semantic properties for the Neayi MediaWiki installation. It currently adds a "Description" property to pages.

## Requirements

- MediaWiki 1.35.0 or later
- PHP 7.3 or later
- [Semantic MediaWiki](https://www.semantic-mediawiki.org/)
- [SemanticExtraSpecialProperties](https://github.com/SemanticMediaWiki/SemanticExtraSpecialProperties)

## Installation

1. Clone this repository to your MediaWiki `extensions/` directory:
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

## Configuration

This extension works out of the box with no additional configuration required. It automatically registers the following semantic properties:

- **Description**: A text property for page descriptions

## Usage

Once installed, the semantic properties are automatically available for use in your wiki pages. You can query them using Semantic MediaWiki's query syntax.

## Development

To run code quality checks:

```bash
composer test
```

To automatically fix code style issues:

```bash
composer fix
```

## License

This extension is licensed under GPL-2.0-or-later. See the LICENSE file for details.
