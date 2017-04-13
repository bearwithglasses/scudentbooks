# Change Log
All notable changes to this project will be documented in this file.

4/12/2017

	Renee

		- FrontEnd folder

			- Modified and renamed login page
				- Login works successfully for all users in database with client-side validation
			- Modified and renamed user registration pages
				- User registration works successfully with client-side validation and adds user to database
			- Editted login accesibility
				- All users can see every page without needing to log in.
				- The homepage and navigation change depending on whether the user is signed in or not.
				- Homepage includes a 'welcome' section when user is not logged in; it disappears when the user logs in.

			- Navigation update for all pages
				- Added 'Register' and 'Login' links if a user is not logged in, and if a user logs in, the two links are removed and is replaced with a 'You' link with a dummy user navigation. User navigation includes a functional 'Log Out' link.

			- Browse by Majors pages/functionality
				- Book major categories are created dynamically on the home page. These link to their respective pages using 'categories.php' and the major parameter in the URL. Pages show a list of books that are labeled with that major.

			- Miscellaneous styling edits to footer, login page


4/7/2017
	
	Winston
		- FrontEnd folder
			- Modified login page
				- Still doesn't work. Will update accordingly
			- Modified user registration
				- Client side validation works
				- Disabled server side validation for now
				- Still doesn't entirely work. Will update accordingly
		- Database
			- Adjusted several data types and certain constraint values in database tables
			- Drafted an entity relationship diagram schema for the inbox messaging system. Will implement soon


4/1/2017
	
	Renee
		- edited homepage and listing for book listings with no pictures/less than 3 pictures
		- updated showData.php to display 'NULL' if the data is NULL
		- edited listing styling for descriptions and book information


3/30/2017
	
	Renee
		- recreated BookPicture table and added dummy data to it
		- updated homepage and listing page to show pictures from the BookPicture table
		- updated showData.php to show the BookPicture data
		- created bookimages folder and added pictures
3/31/2017

	Christina
		- FrontEnd/demopages folder
			- updated addbook.html to match createtables.sql tables.
			- updated ProcessBook.php to take corresponding values from addbook.html and include BookPostSqlFnc.php
			- added BookPostSqlFnc.php for add function.
			- added main.css and booksusers.css in the folder to make pages look nicer
		- Backend folder
			- deleted old files from beginning of project to avoid confusion (still on my local drive though)

3/10/2017

	Renee
		- FrontEnd folder
			- updated showData.php to show BookDescription table
			- created homepage.php that shows all current books in database
			- created profile.php for user pages
			- created listing.php for book pages
		- created demopages folder
			- added all html files to this folder

3/10/2017

	Winston:
		- FrontEnd folder
			- Added user registration complete page
			- Updated regex validation for user registration page to include client and server side validation (still incomplete)

3/7/2017

	Renee: 
		- BackEnd folder
			- showData.php shows current entries for the USERINFO and BOOKPOST tables in the database
		- FrontEnd folder
			- Added demo pages for the search results page at searchpage.html
			- Created book listing images: clicking on each image in the navigation will make it the main product image + clicking on the main product image will make it appear as a popup module
			- Updated CSS files and JS files
<<<<<<< Updated upstream
=======
<<<<<<< HEAD
			
	Christina: 
		- Uploaded new code for creating book database, populating tables, and modified addBook.html	
=======
>>>>>>> Stashed changes
	
	Christina: 
		- BackEnd folder
			- Uploaded new code for creating book database, populating tables, and modified addBook.html
<<<<<<< Updated upstream
=======
>>>>>>> origin/master
>>>>>>> Stashed changes

2/6/2017
	
	Renee: 
		- Added
			- Created FrontEnd folder 
			- Added demo pages of website pages: homepage.html, booklisting.html, and userprofile.html with corresponding CSS files and JS file
		- FrontEnd Updates
			- Basic styling
			- Made pages responsive for mobile dimensions
			- Message box pop-up modal appears on user profiles and book listings after clicking "Send a Message" button
		
	Christina: 
		- Added
			- Created BackEnd folder
			- Uploaded current code for creating book database, adding books, and searching for books. Will be changed accordingly.

	Winston: 
		- Added
			- Created database folder in BackEnd folder
			- Added database tables: createtables.sql
		- BackEnd Updates
			- createtables.sql
				- Modified database tables and added email message table. Will be changed accordingly
