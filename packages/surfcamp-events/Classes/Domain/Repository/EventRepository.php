<?php

namespace TYPO3Incubator\SurfcampEvents\Domain\Repository;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Persistence\Repository;

class EventRepository extends Repository
{
    /**
     * Default Ordering by UID
     * @var array
     */
    protected $defaultOrderings = ['uid' => QueryInterface::ORDER_ASCENDING];

    public function initializeObject(): void
    {
        /** @var Typo3QuerySettings $querySettings */
        $querySettings = GeneralUtility::makeInstance(Typo3QuerySettings::class);
        $querySettings->setRespectStoragePage(false);
        $this->setDefaultQuerySettings($querySettings);
    }

    public function findByLocation(float $lat, float $lng, float $radiusKm = 10.0)
    {
        $query = $this->createQuery();

        $sql = "
            SELECT * FROM tx_myeventextension_domain_model_event
            WHERE hidden = 0 AND deleted = 0
            HAVING (
                6371 * acos(
                    cos(radians(:lat)) * cos(radians(latitude)) *
                    cos(radians(longitude) - radians(:lng)) +
                    sin(radians(:lat)) * sin(radians(latitude))
                )
            ) < :radius
        ";

        $stmt = $connection->prepare($sql);
        $stmt->execute([
            'lat' => $lat,
            'lng' => $lng,
            'radius' => $radiusKm
        ]);

        $rows = $stmt->fetchAllAssociative();

        return $this->dataMapper->map(Event::class, $rows);
    }
}
