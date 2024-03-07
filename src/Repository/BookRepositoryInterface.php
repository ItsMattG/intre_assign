<?php

namespace IntrepidGroup\SampleApplication\Repository;

/**
 * Interface BookRepositoryInterface.
 *
 * This interface defines the api contract for all implementing Repositories for the Book Entity
 */
interface BookRepositoryInterface
{
	public function fetchAll(?string $language = null);
}