// We could follow SE process to help guide us. 

// Database Funcitonalites:
// Store important information as environment variables
// Connect to the database (maybe a general PDO handler/wrapper class and then other classes like supplier or products can inherit from this or just use this)
// Have code that reads the text files, creates tables, and populates them
// Have code (wrapper classes) that provide the CRUD functionality as well as showing the status (performing join/special sql queries to get the data)
// Since we have login, we would also need to create a user table (with different access levels if we have time, focus on building admin user's functionality out right now)


// HTML Side:
// Simple tables will do for now (we can link Boostrap if we have time)
// Simple forms (factor CSRF token)


// PDO Handler class basically
// When initialized, the PDO hanndler class uses a PDO to connect with the AWS server and creates the required tables (supplier and products)
// Have a function that, given the data filepath for supplier and products.txt, it populates the required tables
// Have a function that, given an associated array for values for either supplier or products, it validates the values and inserts them into the appropriate table (returns success or failure as an int)
// Have a function that uses the relation and outputs the status (information)