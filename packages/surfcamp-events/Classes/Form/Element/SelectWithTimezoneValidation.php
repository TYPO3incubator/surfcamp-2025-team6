<?php

namespace TYPO3Incubator\SurfcampEvents\Form\Element;

class SelectWithTimezoneValidation extends \TYPO3\CMS\Backend\Form\Element\SelectSingleElement
{
    /**
     * This will render a selector box element, or possibly a special construction with two selector boxes.
     *
     * @return array As defined in initializeResultArray() of AbstractNode
     */
    public function render(): array
    {
        $resultArray = parent::render();

        $html = $resultArray['html'];
        $html = str_replace('<select', '<select data-select-timezone-validation="1"', $html);
        $resultArray['html'] = $html;

        /** @var \TYPO3\CMS\Core\Page\PageRenderer $pageRenderer */
        $pageRenderer = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Page\PageRenderer::class);
        $pageRenderer->loadJavaScriptModule('@typo3-incubator/surfcamp-events/select-with-timezone.js');
        return $resultArray;
    }
}
