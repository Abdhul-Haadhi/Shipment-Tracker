// ---------Shipment Tracker Project-----------------

// Setup Instructions.

1.   Install XAMPP.
   - Download and install with default settings

2.   Import Database.
   - Start Apache and MySQL in XAMPP
   - Access phpMyAdmin at "http://localhost/phpmyadmin/"
   - Create new database called "shipment_trackerdb"
   - Import "database.sql" file

3.   Run the Project.
   - Place project folder in "htdocs" in XAMPP.
   - Access at "http://localhost/shipping-tracker"

4.   Admin Credentials.
   - Username: admin
   - Password: Abcd1234

// Project Structure

- "admin/" - Admin pages(dashboard.php, manageShipment.php, viewContacts.php).
- "includes/" - Core PHP files.
- "auth/" - Authentication pages.
- "CSS/" - CSS style sheets.
- "JS/" - Java Script files.
- "images/" - Images used in the project.
- "Dashboard.php" - Dashboard for Admin.
- "manageShipment.php" - Shipping details management page.
- "viewContacts.php" - User queries management page.
- "login.php" - Login page.
- "logout.php" - Loguot function.
- "db.php" - Database connection details.
- "contacts.php" - Contact form for users.
- "home.php - Home page with tracking number input field.

// Features

- Admin login and logout.
- Contact form with database storage.
- Shipment tracking functionality.
- Admin dashboard (access with admin credentials).


In my shipment tracker project, there is no login or registration page for users, as real world tracking sites typically don't require user accounts to track shipments. Therefore, I did not implement user registration or login functionality. However, the admin section is protected with a login system. The admin credentials are pre stored in the database, allowing only the admin to log in and access the admin dashboard and related features.


