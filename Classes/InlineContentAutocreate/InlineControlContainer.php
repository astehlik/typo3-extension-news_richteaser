<?php
declare(strict_types=1);

namespace Int\NewsRichteaser\InlineContentAutocreate;

/*                                                                        *
 * This script belongs to the TYPO3 Extension "news_richteaser".          *
 *                                                                        *
 * It is free software; you can redistribute it and/or modify it under    *
 * the terms of the GNU General Public License, either version 3 of the   *
 * License, or (at your option) any later version.                        *
 *                                                                        *
 * The TYPO3 project - inspiring people to share!                         *
 *                                                                        */

use TYPO3\CMS\Backend\Form\Container\InlineControlContainer as ParentInlineControlContainer;

/**
 * Form field renderer that behaves like a normal inline element but additionally
 * automatically creates a first inline child if the current record is new.
 */
class InlineControlContainer extends ParentInlineControlContainer
{
    /**
     * Checks if the current records is new and enhances the additionalJavaScriptPost
     * property of the resultArray if possible.
     *
     * @return array As defined in initializeResultArray() of AbstractNode
     */
    public function render()
    {
        $resultArray = parent::render();

        if ($this->data['command'] === 'new') {
            $resultArray['additionalJavaScriptPost'][] = $this->generateInlineContentAutocreateScript();
        }

        return $resultArray;
    }

    /**
     * Tries to determine the current field ID from the stored inlineData.
     *
     * If the field ID is available JavaScript code for an AJAX call is generated
     * that creates a new inline child record for the current field.
     *
     * @return string
     */
    protected function generateInlineContentAutocreateScript()
    {
        $script = '';

        $fieldConfig = $this->inlineData['config'];
        $keys = array_keys($fieldConfig);

        if (empty($keys[1])) {
            return $script;
        }

        $fieldId = $keys[1];
        $requestId = FormDataProvider::REQUEST_ID;

        $script .= /** @lang JavaScript */
            '
            (function() {
                var txNewsRichteaserAutocreate = function() {
                    // Wait until the FormEngine is available and make sure we do not make
                    // an AJAX call while the create method is locked.
                    if (!TYPO3 || !TYPO3.FormEngine || inline.lockedAjaxMethod[\'create\']) {
                        window.setTimeout(txNewsRichteaserAutocreate, 50);
                    } else {
                        var objectId = "' . $fieldId . '";
                        // We pass the isNewsRichteaserCreateRecord parameter to let the form engine know that these
                        // are the first tt_content childs that are created for a new news record.
                        inline.makeAjaxCall("create", [objectId, "' . $requestId . '"], true, inline.getContext(objectId));
                    }
                };
                TYPO3.jQuery(document).ready(function() {
                    txNewsRichteaserAutocreate();
                });
            })();
        ';

        return $script;
    }
}
