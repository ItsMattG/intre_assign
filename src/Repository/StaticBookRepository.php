<?php

namespace IntrepidGroup\SampleApplication\Repository;

use IntrepidGroup\SampleApplication\Entity\Book;

/**
 * Class StaticBookRepository.
 *
 * This class returns acts as a Book Repository for a statically defined list of books
 */
class StaticBookRepository implements BookRepositoryInterface
{
	private $conn;

	public function __construct($conn)
	{
		$this->conn = $conn;
	}

	/**
	 * Retrieve and return a collection of all books.
	 *
	 * @return Book[]
	 */
	public function fetchAll(?string $language = null)
	{
		$query = "SELECT * FROM books";

		if ($language !== null) {
			$query .= " WHERE language = '$language'";
		}

		$result = pg_query($this->conn, $query);

		if (!$result) {
			die("Error fetching books: " . pg_last_error($this->conn));
		}

		while ($row = pg_fetch_assoc($result)) {
			$book = new Book(
				$row['title'],
				$row['author'],
				$row['category'],
				$row['language'],
				intval($row['year']),
				intval($row['rating'])
			);

			$bookArray = $book->toArray();

			$output[] = $bookArray;
		}

		return $output;
	}
}