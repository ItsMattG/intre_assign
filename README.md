# Explanation of PHP implementation

## api/database_connection.php
- The api/database_connection.php file hosts the connectToSupabase() function for connecting to the Supabase database.
- Within the function, predefined connection parameters like username, password, host, port, and database name are initialized.
- Using pg_connect(), the function establishes the database connection and handles errors gracefully, ensuring reliable connectivity.

## api/insert_books.php
- api/insert_books.php facilitates database operations related to book data insertion and table creation.
- It contains functions for creating the 'books' table if it doesn't exist (createBooksTableIfNotExists()).
- Another function (insertBooksIntoSupabase($books)) handles the insertion of book data into the 'books' table.
- Both functions utilise the connectToSupabase() function from database_connection.php for database connectivity.
- Error handling is implemented to gracefully handle database errors during table creation and data insertion operations.

## books-api.php
- The script includes dependencies for database connectivity (api/database_connection.php) and autoloading Composer dependencies (vendor/autoload.php).
- It defines a fetchData() function to fetch book data from the database, employing dependency injection for a BookRepositoryInterface instance and an optional language parameter.
- Upon execution, the script connects to the Supabase database, initialises a StaticBookRepository using the connection, retrieves the language parameter from the query string, and invokes the fetchData() function with the book repository instance and language parameter.

## src/Repository/BookRepositoryInterface.php
- The BookRepositoryInterface file defines an interface in the IntrepidGroup\SampleApplication\Repository namespace, specifying a contract for all implementing repositories handling book entities by mandating a fetchAll() method that can optionally accept a language parameter.

## src/Repository/StaticBookRepository.php
- The StaticBookRepository class, located in the IntrepidGroup\SampleApplication\Repository namespace, acts as a repository for book entities.
- Implementing the BookRepositoryInterface interface mandates the provision of a fetchAll() method for accessing book data.
- The fetchAll() method executes a SQL query to retrieve books from the database via the provided connection, constructs Book objects from the retrieved data, converts them to arrays, and returns them as a collection. It ensures graceful error handling throughout the data retrieval process.

## public/js/app.js
getBooks() method:
- Constructs a URL for the '/books-api.php' endpoint, appending a query parameter for the user's session language if available enable filtering books by language on the backend.
- Initiates a GET request to the constructed URL using the fetch() function.
- Upon successful response, parses the JSON data, updates the Vue.js component's books data property with the fetched data, and sets the loading property to false. Any encountered errors are logged to the console, and the loading property is also set to false to handle errors gracefully.

## src/Twig/html.twig
- No longer passing in window.__INITIAL_STATE__ = ${ books|raw }; as it's unnecessary now, thanks to the getBooks() endpoint call.

  
