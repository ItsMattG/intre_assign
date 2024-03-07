<?php

require_once 'database_connection.php';

function createBooksTableIfNotExists()
{
	$conn = connectToSupabase();

	$createTableQuery = "CREATE TABLE IF NOT EXISTS books (
							id SERIAL PRIMARY KEY,
							title VARCHAR(255),
							author VARCHAR(255),
							category VARCHAR(255),
							language VARCHAR(50),
							year INT,
							rating INT
						)";
	$result = pg_query($conn, $createTableQuery);

	if (!$result) {
		die("Error creating table: " . pg_last_error());
	}

	pg_close($conn);
}

function insertBooksIntoSupabase($books)
{
	$conn = connectToSupabase();

	foreach ($books as $book) {
		$title = pg_escape_string($book['title']);
		$author = pg_escape_string($book['author']);
		$category = pg_escape_string($book['category']);
		$language = pg_escape_string($book['language']);
		$year = (int) $book['year'];
		$rating = (int) $book['rating'];

		$insertQuery = "INSERT INTO books (title, author, category, language, year, rating)
						VALUES
						('{$title}', '{$author}', '{$category}', '{$language}', {$year}, {$rating})";

		$result = pg_query($conn, $insertQuery);

		if (!$result) {
			die("Error inserting data: " . pg_last_error());
		}
	}

	echo "Data inserted successfully";

	pg_close($conn);
}
?>