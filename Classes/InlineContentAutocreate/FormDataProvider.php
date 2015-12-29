<?php
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
use TYPO3\CMS\Backend\Form\FormDataProviderInterface;

/**
 * Initializes default values in child tt_content records of news.
 *
 * The default values will be set for the first inline child that is created
 * depending on their parent field (teaser or content).
 */
class FormDataProvider implements FormDataProviderInterface
{
    /**
     * This ID is submitted during AJAX requests that create initial inline childs.
     *
     * @const
     */
    const REQUEST_ID = 'isNewsRichteaserCreateRecordRequest';

    /**
     * @var \TYPO3\CMS\Lang\LanguageService
     */
    protected $languageService;

    /**
     * Checks if the current request is a create request for the first inline tt_content child of a news record.
     * If such a request is detected some default values for the header and the bodytext will be set in the result array.
     *
     * @param array $result Initialized result array
     * @return array Result filled with more data
     */
    public function addData(array $result)
    {
        if (empty($_POST['ajax'][1]) || $_POST['ajax'][1] !== static::REQUEST_ID) {
            return $result;
        }

        switch ($result['inlineParentFieldName']) {
            case 'teaser_content_elements':
                $result['databaseRow']['header'] = $this->translate('teaser_default_header');
                $result['databaseRow']['bodytext'] = $this->translate('teaser_default_bodytext');
                break;
            case 'content_elements':
                $result['databaseRow']['header'] = $this->translate('content_default_header');
                $result['databaseRow']['bodytext'] = $this->translate('content_default_bodytext');
                break;
        }

        return $result;
    }

    /**
     * Reads the translation with the given key from the Backend label language file.
     *
     * @param string $key
     * @return string string
     */
    protected function translate($key)
    {

        if (!isset($this->languageService)) {
            /** @var \TYPO3\CMS\Lang\LanguageService $GLOBALS ['LANG'] */
            $this->languageService = $GLOBALS['LANG'];
        }

        return $this->languageService->sL('LLL:EXT:news_richteaser/Resources/Private/Language/locallang_db.xlf:' . $key);
    }
}