<?php
function connectToSupabase()
{
	$connString = "user=postgres.frefqqqwgocvfhspjgrn password=IntrepidTest123!*# host=aws-0-ap-southeast-2.pooler.supabase.com port=5432 dbname=postgres";

	$conn = pg_connect($connString);

	if (!$conn) {
		die("Connection to database failed");
	}

	return $conn;
}
?>