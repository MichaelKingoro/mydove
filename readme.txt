Here’s the documentation on how to run the **SokoLima** project on **XAMPP**:

---

## **SokoLima Marketplace - Running on XAMPP**

### **Prerequisites**
Before you start, ensure you have the following installed:
- **XAMPP** (Apache, MySQL)
- A web browser (e.g., Chrome, Firefox)

### **Step 1: Install XAMPP**
If you don't already have **XAMPP** installed, follow these steps:
1. **Download XAMPP**: Visit [XAMPP's official website](https://www.apachefriends.org/index.html) and download the version suitable for your operating system.
2. **Install XAMPP**: Follow the installation instructions to install XAMPP.
3. **Start XAMPP Control Panel**:
    - Open the **XAMPP Control Panel**.
    - Start the **Apache** and **MySQL** services by clicking the **Start** button next to each.

### **Step 2: Set up the Project Directory**
1. **Extract the Project Files**:
   - Extract the **SokoLima_Project.zip** file you downloaded earlier.
   - After extraction, you will have a folder (e.g., `SokoLima_Project`).

2. **Move to XAMPP's `htdocs` Directory**:
   - Open the **XAMPP installation directory** (typically located at `C:\xampp`).
   - Navigate to the `htdocs` folder: `C:\xampp\htdocs\`.
   - Move the **SokoLima_Project** folder to the `htdocs` directory. This folder will contain all your project files.

3. **Rename the Folder (Optional)**:
   - Optionally, you can rename the folder to a simpler name, like `sokolima` for easier access.

### **Step 3: Create the Database**
1. **Open phpMyAdmin**:
   - In your web browser, go to `http://localhost/phpmyadmin/`.
   - This will open **phpMyAdmin**, which is the MySQL database management tool.

2. **Create a New Database**:
   - Click on **Databases** in the top menu.
   - Enter `marketplace` in the **Database name** field.
   - Click **Create** to create the database.

3. **Create Tables**:
   - Click on the **marketplace** database in the left sidebar.
   - Go to the **SQL** tab and paste the following SQL queries to create the necessary tables:


CREATE TABLE sellers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(100),
    last_name VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    username VARCHAR(100) UNIQUE,
    password VARCHAR(255)
);

CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    price DECIMAL(10, 2),
    location VARCHAR(100),
    image_1 VARCHAR(255),
    image_2 VARCHAR(255),
    image_3 VARCHAR(255),
    upload_date TIMESTAMP
);


   - Click **Go** to execute the queries and create the tables.

### **Step 4: Configure Database Connection**
1. Open the **db.php** file in your project directory (located in `htdocs/SokoLima_Project/db.php`).
2. Ensure the database connection details are correct:
   ```php
   $servername = "localhost";
   $username = "root";      // Default MySQL username in XAMPP
   $password = "";          // Default MySQL password in XAMPP is empty
   $dbname = "marketplace"; // Your database name
   ```

### **Step 5: Access the Project**
1. **Open the Project in Your Browser**:
   - Open your web browser and go to `http://localhost/SokoLima_Project/` (or `http://localhost/sokolima/` if you renamed the folder).
   - This should load the homepage of the **SokoLima Marketplace**.

### **Step 6: Testing the Features**
- **Registering a Seller**: Go to the **register.php** page and register a new seller.
- **Logging in**: After registering, go to the **login.php** page to log in using your username/email and password.
- **Uploading Products**: Once logged in, go to the **upload.php** page to upload products with images.
- **View Products**: The **index.php** page will display the products in a grid layout.

### **Step 7: Troubleshooting**
If you encounter any issues, here are some common solutions:
- **Database Connection Issues**: Check the database connection settings in `db.php` and ensure MySQL is running in the XAMPP Control Panel.
- **Page Not Found**: Ensure your project files are correctly placed inside the `htdocs` folder and that the folder name is correct in the URL.

### **Step 8: Stopping XAMPP**
Once you're done, you can stop the XAMPP services by clicking **Stop** next to **Apache** and **MySQL** in the **XAMPP Control Panel**.

---

This documentation should guide you in setting up the **SokoLima Marketplace** on XAMPP. Let me know if you encounter any issues or need further assistance!