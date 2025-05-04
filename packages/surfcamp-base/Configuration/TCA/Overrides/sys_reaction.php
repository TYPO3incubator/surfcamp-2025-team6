<?php
if (\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('reactions')) {
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
        'sys_reaction',
        'table_name',
        [
            'label' => 'sys_registry',
            'value' => 'sys_registry',
            'icon' => 'mimetypes-x-sys_category',
        ]
    );
}
