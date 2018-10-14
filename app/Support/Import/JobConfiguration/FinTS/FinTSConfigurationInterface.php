<?php
/**
 * FinTSConfigurationInterface.php
 * Copyright (c) 2018 https://github.com/bnw
 *
 * This file is part of Firefly III.
 *
 * Firefly III is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Firefly III is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Firefly III. If not, see <http://www.gnu.org/licenses/>.
 */
declare(strict_types=1);

namespace FireflyIII\Support\Import\JobConfiguration\FinTS;

use FireflyIII\Models\ImportJob;
use Illuminate\Support\MessageBag;

/**
 *
 */
interface FinTSConfigurationInterface
{
    /**
     * Store data associated with current stage.
     *
     * @param array $data
     *
     * @return MessageBag
     */
    public function configureJob(array $data): MessageBag;

    /**
     * Get the data necessary to show the configuration screen.
     *
     * @return array
     */
    public function getNextData(): array;

    /**
     * @param ImportJob $importJob
     */
    public function setImportJob(ImportJob $importJob): void;
}