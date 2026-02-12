<?php

namespace MediaWiki\Extension\NeayiSpecialProperties\Hooks;

use SESP\PropertyRegistry;

/**
 * Hook handler for registering custom semantic properties
 *
 * This class encapsulates the logic for adding new semantic properties
 * to the MediaWiki installation through SemanticExtraSpecialProperties
 */
class SemanticPropertiesHook {

	/**
	 * Hook handler for SemanticExtraSpecialPropertiesHandlers
	 *
	 * Registers custom semantic properties with SemanticExtraSpecialProperties
	 *
	 * @param PropertyRegistry $propertyRegistry The property registry to add properties to
	 * @return bool True to continue hook processing
	 */
	public static function onSemanticExtraSpecialPropertiesHandlers( PropertyRegistry $propertyRegistry ) {
		// Register a custom Description property
		// Property ID without underscore to avoid conflicts with SMW reserved properties
		// Parameters: ID, Label, Type (text), Visibility (true = visible)
		$propertyRegistry->registerProperty(
			'NEAYI_DESCRIPTION',
			'Neayi description',
			'_txt',
			true
		);

		return true;
	}
}
