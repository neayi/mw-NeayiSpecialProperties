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
			'callback' => static function (
				AppFactory $appFactory,
				DIProperty $property,
				SemanticData $semanticData
			) {
				$title = $semanticData->getSubject()->getTitle();
				$pageProps = MediaWikiServices::getInstance()->getPageProps();
				$properties = $pageProps->getProperties( [ $title ], [ 'description' ] );
				$pageId = $title->getArticleID();

				if ( !isset( $properties[$pageId]['description'] ) ) {
					return null;
				}

				$value = $properties[$pageId]['description'];
				return new SMWDIBlob( $value );
			}
		];
	}
}
