<?php
if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tceforms.php']['getMainFieldsClass'][] = 'Int\\NewsRichteaser\\Hooks\\FormEngine';

$GLOBALS['TYPO3_CONF_VARS']['SYS']['Objects']['TYPO3\\CMS\\Backend\\Form\\DataPreprocessor']['className'] = 'Int\\NewsRichteaser\\Hooks\\DataPreprocessor';

?>