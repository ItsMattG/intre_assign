new Vue({
	el: '#app',
	data: {
		books: [],
		language: 'English',
		sortColumn: 'year',
		rating: {
			selected: 'All',
			ratings: ['1', '2', '3', '4', '5']
		},
		loading: true
	},
	created() {
		this.getBooks();
	},
	methods: {
		getBooks() {
			let url = '/books-api.php';
			let sessionLanguage = 'English'; // Would be actual session storage/user data
			if (sessionLanguage) {
				url += `?language=${encodeURIComponent(sessionLanguage)}`;
			}
			fetch(url)
				.then(response => {
					if (!response.ok) {
						throw new Error('Network response was not ok');
					}
					return response.json();
				})
				.then(data => {
					this.books = data;
					this.loading = false;
				})
				.catch(error => {
					console.error('Error fetching books:', error);
					this.loading = false;
				});
		},
	},
	computed: {
		sortedBooks() {
			return this.filteredBooksByRating.slice().sort((a, b) => {
				return b[this.sortColumn] - a[this.sortColumn];
			});
		},
		filteredBooksByRating() {
			return this.rating.selected === 'All' ? this.books : this.books.filter(book => book.rating === parseInt(this.rating.selected));
		}
	},
});
