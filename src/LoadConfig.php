<?php

namespace NeayiSpecialProperties;

use MediaWiki\MediaWikiServices;
use SMW\DIProperty;
use SMW\SemanticData;
use SMWDIBlob;
use SESP\AppFactory;

$sespgEnabledPropertyList[] = '_DESCRIPTION';

$sespgLocalDefinitions['_DESCRIPTION'] = [
	'id' => '___DESCRIPTION',
	'type' => '_txt',
	'alias' => 'sesp-property-description',
	'label' => 'Description',

	'callback' => static function (
		AppFactory $appFactory,
		DIProperty $property,
		SemanticData $semanticData
	) {
		$title = $semanticData->getSubject()->getTitle();

		if ( $title === null ) {
			return null;
		}

		$pageProps = MediaWikiServices::getInstance()->getPageProps();
		$properties = $pageProps->getProperties( [ $title ], [ 'description' ] );
		$pageId = $title->getArticleID();

		if ( !isset( $properties[$pageId]['description'] ) ) {
			return null;
		}

		$value = $properties[$pageId]['description'];

		// Ensure the value is a string
		if ( !is_string( $value ) ) {
			return null;
		}

		return new SMWDIBlob( $value );
	}
];
