<?php

/*
 * This file is part of Phraseanet SDK.
 *
 * (c) Alchemy <info@alchemy.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PhraseanetSDK\Repository;

use PhraseanetSDK\AbstractRepository;
use PhraseanetSDK\Exception\RuntimeException;
use Doctrine\Common\Collections\ArrayCollection;
use PhraseanetSDK\EntityHydrator;

class Metadata extends AbstractRepository
{
    /**
     * Find All the metadata for the record provided in parameters
     *
     * @param  integer          $databoxId The databox id
     * @param  integer          $recordId  The record id
     * @return ArrayCollection
     * @throws RuntimeException
     */
    public function findByRecord($databoxId, $recordId)
    {
        $response = $this->query('GET', sprintf('v1/records/%d/%d/metadatas/', $databoxId, $recordId));

        if (true !== $response->hasProperty('record_metadatas')) {
            throw new RuntimeException('Missing "record_metadatas" property in response content');
        }

        return new ArrayCollection(\PhraseanetSDK\Entity\Metadata::fromList(
            $response->getProperty('record_metadatas')
        ));
    }
}
