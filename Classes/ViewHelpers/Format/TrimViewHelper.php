<?php
namespace Int\NewsRichteaser\ViewHelpers\Format;

/*                                                                        *
 * This script belongs to the TYPO3 Extension "news_richteaser".          *
 *                                                                        *
 * It is free software; you can redistribute it and/or modify it under    *
 * the terms of the GNU General Public License, either version 3 of the   *
 * License, or (at your option) any later version.                        *
 *                                                                        *
 * The TYPO3 project - inspiring people to share!                         *
 *                                                                        */

use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * View helper for trimming whitespace or configurable chars.
 */
class TrimViewHelper extends AbstractViewHelper
{
    /**
     * With this flag, you can disable the escaping interceptor inside this ViewHelper.
     * THIS MIGHT CHANGE WITHOUT NOTICE, NO PUBLIC API!
     *
     * @var bool
     */
    protected $escapingInterceptorEnabled = false;

    /**
     * Renders the children and trims whitespace around them.
     *
     * @param string $charlist If set these characters will be used for trimming.
     * @param bool $trimBetweenHtmlTags If true whitespace between HTML tags will be removed.
     * @return string
     */
    public function render($charlist = null, $trimBetweenHtmlTags = true)
    {
        $content = $this->renderChildren();

        if ($trimBetweenHtmlTags) {
            $content = preg_replace('~>\s+<~', '><', $content);
        }

        if ($charlist !== null) {
            return trim($content, $charlist);
        } else {
            return trim($content);
        }
    }
}
