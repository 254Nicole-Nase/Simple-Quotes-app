# Quote Saver Web Application

A simple yet powerful web application where users can save, retrieve, and delete their favorite quotes. It also fetches and displays a daily motivational quote from an external API, providing users with fresh inspiration every day.

## Table of Contents
- [Features](#features)
- [Technologies Used](#technologies-used)
- [Installation](#installation)
- [Configuration](#configuration)
- [Usage](#usage)
- [Folder Structure](#folder-structure)
- [Future Improvements](#future-improvements)
- [Contributing](#contributing)
- [License](#license)

---

## Features

- **User Authentication**: Users can register and log in to access their personalized quote collection.
- **Daily Quote Display**: Fetches and displays a fresh motivational quote each day from the [Quotable API](https://api.quotable.io/).
- **CRUD Operations**: Users can create, read, and delete their saved quotes.
- **Responsive Design**: A clean and modern design that adjusts to various screen sizes for an optimal user experience.

---

## Technologies Used

- **Frontend**: HTML, CSS, JavaScript
- **Backend**: PHP
- **Database**: MariaDB
- **Server**: Apache
- **Operating System**: CentOS (or any Linux environment compatible with Apache and MariaDB)
- **External API**: Quotable API (for fetching daily quotes)

---

## Installation

### Prerequisites

- [XAMPP](https://www.apachefriends.org/index.html) or [LAMP](https://www.linode.com/docs/guides/lamp-stack-on-centos/) stack installed (for Apache, PHP, and MariaDB)
- PHP 7+ and MariaDB 10+
- Composer (optional for dependency management)

### Steps

1. **Clone the Repository**:
   ```bash
   git clone https://github.com/yourusername/quote-saver-app.git
   cd quote-saver-app
   ```
2. **Database Setup**:
   - Open MariaDB and create a new database:
     ```sql
     CREATE DATABASE quote_app;
     USE quote_app;
     ```
   - Import the provided SQL file to set up the necessary tables:
     ```bash
     mysql -u root -p quote_app < database.sql
     ```
   - Ensure the `quotes` table includes `id`, `user_id`, and `quote` columns to store each user’s quotes.
    
3. **Configure Database Connection**:
   - Update the database connection details in `config.php` (or equivalent file):
     ```php
     $conn = new mysqli("localhost", "root", "your_password", "quote_app");
     ```

4. **Start Apache Server**:
   - For XAMPP users, start Apache from the XAMPP Control Panel.
   - Place the project folder inside `htdocs` if using XAMPP (e.g., `C:\xampp\htdocs\quote-saver-app`).
   - For CentOS or other Linux distributions, ensure Apache is configured to point to the application directory.

---

## Configuration

### External API Setup

- **Quotable API**: This app retrieves daily quotes from the [Quotable API](https://api.quotable.io/random). Ensure API endpoints in `dashboard.php` point to this URL:
  ```php
  $api_url = "https://api.quotable.io/random";
  ```
## Usage

1. **User Registration & Login**:
   - Visit the `register.php` page to create an account, or go to `login.php` if you already have one.
   - Registration and login are required to access the dashboard and manage personal quotes.

2. **Daily Motivational Quote**:
   - After logging in, you’ll be taken to the dashboard (`dashboard.php`), where a daily motivational quote is displayed, fetched directly from the Quotable API.

3. **Adding a New Quote**:
   - Use the form on the dashboard to add a new personal quote to your collection.
   - Enter your quote in the input field and click "Add Quote" to save it to your account.

4. **Viewing Saved Quotes**:
   - Below the daily quote, you’ll see a list of all the quotes you’ve saved.
   - Each quote displays along with an option to delete it if you no longer want it in your collection.

5. **Deleting Quotes**:
   - Next to each saved quote, there is a "Delete" link. Click it to remove the quote from your saved list permanently.

6. **Handling API Errors**:
   - If the app is unable to fetch a daily quote from the API, you will see an error message: "Could not fetch quote."
   - This ensures a smooth user experience, even if the external API is temporarily unavailable.

---

## Styling & Theming

The app’s visual design follows a modern, minimalist style with consistent styling across all pages. Key design aspects include:

- **Responsive Layout**: Optimized for both desktop and mobile viewing.
- **Typography**: Clean and readable fonts, enhancing readability.
- **Color Scheme**: A soothing color palette with subtle backgrounds and primary accents, enhancing the user experience without overwhelming the content.
- **Custom Styling**: Defined in `style.css`, all styling is consistent across pages, making navigation intuitive and visually cohesive.

---

## Error Handling

- **Database Errors**: The app gracefully handles connection errors, displaying a user-friendly message if the database cannot be reached.
- **API Errors**: If the quote API fails, the user is informed with an error message and an alternative daily message could be added in the future.
- **Form Validation**: Input fields have basic HTML5 validation, and server-side checks ensure data integrity and security.

--- 

## Project Structure

Here's a quick overview of the project’s main structure:

```plaintext
quote-saver-app/
├── add_quote.php          # Handles adding quotes
├── delete_quote.php       # Handles deleting quotes
├── dashboard.php          # Main user dashboard with daily quote display
├── login.php              # User login functionality
├── register.php           # User registration functionality
├── config.php             # Database configuration
├── style.css              # Main CSS file for styling
├── README.md              # Project documentation
└── database.sql           # SQL file for database setup
```
