<?php

namespace NeayiSpecialProperties;

use MediaWiki\MediaWikiServices;
use SMW\DIProperty;
use SMW\SemanticData;
use SMWDIBlob;
use SESP\AppFactory;

/**
 * Hooks for NeayiSpecialProperties extension
 */
class Hooks {

	/**
	 * Hook: sespLocalDefinitions
	 *
	 * Register custom SESP property definitions
	 *
	 * @param array &$definitions
	 */
	public static function onSespLocalDefinitions( array &$definitions ) {
		$definitions['_DESCRIPTION'] = [
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
				$pageProps = MediaWikiServices::getInstance()->getPageProps();
				$propertyNames = [ 'description' ];
				$properties = $pageProps->getProperties( [ $title ], $propertyNames );
				$pageId = $title->getArticleID();
				$value = $properties[$pageId]['description'] ?? null;
				
				return new SMWDIBlob( $value );
			}
		];
	}
}
