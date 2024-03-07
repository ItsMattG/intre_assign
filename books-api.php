<?php

require_once 'api/database_connection.php';
use IntrepidGroup\SampleApplication\Repository\StaticBookRepository;
use IntrepidGroup\SampleApplication\Repository\BookRepositoryInterface;
require_once __DIR__.'/vendor/autoload.php';

function fetchData(BookRepositoryInterface $bookRepository, ?string $language = null) {
	$books = $bookRepository->fetchAll($language);

	echo json_encode($books);
}

$conn = connectToSupabase();

// Instantiate the BookRepository using dependency injection
$bookRepository = new StaticBookRepository($conn);

$language = $_GET['language'] ?? null;

fetchData($bookRepository, $language);