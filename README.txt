# Real Estate Project: MLS Website with PHP, MySQL, and XAMPP

## Project Overview

This project implements a **Real Estate Listing Service** using PHP for the web interface, MySQL for the database, and the XAMPP server for local hosting. The website allows users to search for real estate listings, including houses and business properties, and interact with the database by running custom SQL queries.

### Key Features:
1. **Display all property listings**: View information about houses and business properties, including details such as price, location, size, and agent information.
2. **Search for properties**: Users can filter houses based on price range, number of bedrooms and bathrooms, and business properties based on price and size.
3. **View agent and buyer information**: Display details of real estate agents and buyers, including their preferences and details.
4. **Custom query execution**: Users can input any SQL query and view the results on a separate page.
5. **Responsive interface**: The website is built to work on a wide range of devices using HTML and CSS.

## Technologies Used
- **PHP**: Server-side scripting language to handle user requests and interact with the MySQL database.
- **MySQL**: Database system for storing and retrieving real estate data.
- **XAMPP**: Local web server and database management tool for running the project on your machine.
- **HTML/CSS**: Frontend technologies for designing the web interface.

## Database Schema

The database consists of several tables designed to hold real estate information:

1. **Property Table**: Holds general information about properties (address, price, owner).
2. **House Table**: Stores details for houses, such as the number of bedrooms, bathrooms, and size.
3. **BusinessProperty Table**: Stores details for business properties, such as the type of business and size.
4. **Agent Table**: Stores information about real estate agents, including their name, phone number, and the firm they work for.
5. **Firm Table**: Holds information about real estate firms.
6. **Buyer Table**: Stores information about potential buyers, including their property preferences.
7. **Listings Table**: Stores information about listings made by agents, including the MLS number, address, and agent details.
8. **Works_With Table**: Represents relationships between buyers and agents.

## Project Setup

To run this project locally, follow these steps:

### 1. Install XAMPP
Download and install XAMPP from [https://www.apachefriends.org/download.html](https://www.apachefriends.org/download.html). This includes Apache, MySQL, and PHP, which are necessary to run the project.

### 2. Set Up the Database
- Open **phpMyAdmin** (via the XAMPP control panel) and create a new database (e.g., `real_estate`).
- Run the SQL script located in the `real_estate_project` folder to create the necessary tables and populate them with sample data.
- Alternatively, you can run the SQL commands manually in phpMyAdmin to create the tables.

### 3. Configure the PHP Files
- Place all PHP files, HTML files, and SQL scripts in the `htdocs` folder within the XAMPP installation directory.
- Ensure the paths in the PHP scripts correctly reference your database and other necessary files.

###4 Run The Project 


## Features Explained

### 1. Display All Listings
- Displays a list of all properties, including both houses and business properties. It shows their address, price, and other relevant information. 

### 2. Search Functionality
- Users can search for properties based on:
  - **House Search**: Filter houses by price range, number of bedrooms, and number of bathrooms and other relevant information. 
  - **Business Property Search**: Filter business properties by price range and size and other relevant information. 

### 3. View Agents and Buyers
- The **Agent Page** shows all agents and their associated details.
- The **Buyer Page** displays all buyers and their preferences.
### 4. Custom Query Interface
- Provides a text box where users can enter any SQL query to interact with the database. The results are displayed on a separate page.

### 5. MySQL Queries
Here are a few example SQL queries that can be run in the system:
1. **Find the addresses of all houses currently listed.**
2. **Find all agents and their associated information.**
3. **Find the addresses and prices of all 3-bedroom, 2-bathroom houses with prices in the range $100,000 to $250,000.**

### 6. Screenshots
Please refer to the screenshots provided in the project submission for examples of the user interface and query results.



## Conclusion

This project provides a basic but functional real estate listing service using PHP and MySQL. It includes essential features such as property listings, search filters, agent and buyer information, and a custom query interface. It can be expanded with additional features in the future to make it a more robust real estate platform.

