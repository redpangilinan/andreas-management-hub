# Andrea's Management Hub

Official Management and Ordering System for Andrea's Fresh and Greens

## Table of contents

- [Andrea's Management Hub](#andreas-management-hub)
  - [Table of contents](#table-of-contents)
  - [Overview](#overview)
    - [Features](#features)
    - [Project Scopes](#project-scopes)
  - [Tech Stack](#tech-stack)
    - [Languages](#languages)
    - [Frameworks/Libraries](#frameworkslibraries)
  - [Workflows and Activities](#workflows-and-activities)
    - [Management System](#management-system)
      - [Admin Login](#admin-login)
      - [Data Visualization](#data-visualization)
      - [Data Tables](#data-tables)
      - [Adding and Editing Data](#adding-and-editing-data)
      - [Products Cart for Admin](#products-cart-for-admin)
      - [Editing Admin Profile](#editing-admin-profile)
    - [Ordering System](#ordering-system)
      - [Customer Information](#customer-information)
      - [Ordering Products](#ordering-products)
      - [Viewing Order History](#viewing-order-history)
  - [License](#license)

## Overview

### Features
- Orders and sales tracking
- Orders and sales reporting and analytics
- Income growth charts and graphs
- Order status management
- Data tables for sales, orders, products, and relevant data
- Customer statistics tracking

### Project Scopes
- To ease tracking of orders and stop manual computation of order prices
- Visualization of the business progress and growth
- To make managing the business easier
- Save tons of time dealing with customers
- Easily track income growth and expenses
- Motivate the business team

## Tech Stack

### Languages
- [HTML5/CSS3](https://developer.mozilla.org/en-US/docs/Glossary/HTML5)
- [JavaScript](https://www.javascript.com/)
- [PHP](https://www.php.net/)

### Frameworks/Libraries
- [JQuery/AJAX](https://jquery.com/)
- [Bootstrap](https://getbootstrap.com/)
- [SweetAlert2](https://sweetalert2.github.io/)
- [Chart.js](https://www.chartjs.org/)
- [Select2](https://select2.org/)

## Workflows and Activities

### Management System

#### Admin Login

1. Access admin login form through URL. (Not for customers)
2. Input email and password to access the Management Hub.
3. All inputs will be validated if the information is correct.
4. After successful login, admin will proceed to Dashboard and can access different management features.

#### Data Visualization

1. Logging in will direct the administrator to Dashboard which will show analytical charts about the business.
2. Admin can filter the data shown in the charts by selecting whether this week, this month, this year, or all time data.
3. After selecting a filter, AJAX will GET the data from the backend and the chart will be rendered using JavaScript if it doesn't exist yet, otherwise it will be updated.
4. From this, the admin can monitor the data regarding the business such as:
  - Completed Orders
  - Most Sold Products
  - Total Income

#### Data Tables

1. After admins access the Management Hub, they can select categories from the sidebar which includes the data tables of important data such as:
  - Accounts
  - Products
  - Orders
  - Customers
2. After selecting a category, the admin will be redirected to the selected table, which lets them view the records.
3. The admins would be able to add records directly if the tables are:
  - Products
  - Orders

#### Adding and Editing Data

1. Input necessary information to fill up the form then press the Add button.
2. The input will be validated whether the input is possible or not.
3. If the validation is successful, the entry will proceed uploading to the database. Otherwise, an alert will prompt.
4. All the data in data tables can also be edited with the same procedures as adding data.

#### Products Cart for Admin

1. To add orders, the admins will have to add products to products cart in the add form to complete the process.
2. After filling out necessary fields, the admin can select a range of products from the select box which is integrated into the products data.
3. After selecting a product, admins can press the "+" button to add it to the cart. Just click the button again with the same selected product to increase the quantity.
4. After adding products to the cart, the total price will automatically be computed by multiplying the product's price to its quantity.
5. Products can also be removed from the cart by pressing the "X" button beside the listed product.
6. After the product cart has been filled, the order can finally be submitted as a "Pending" order which can be updated to "Completed" or "Cancelled" once the order is either completed or cancelled.

#### Editing Admin Profile

1. From the sidebar, the admin profile can be accessed which shows basic information such as the admin's name, email address, contact number, and the account's creation date.
2. The profile has a card-like appearance which has an edit button to it. Once clicked, a form will prompt that will let the admin edit their profile details.
3. They can change details in the form and input/edit the following detail:
  - Full Name
  - Email
  - Contact No.
  - Password
4. After editing, admins can confirm their changes in which their inputs will be validated.
5. If all the inputs are valid, the data will be updated. Otherwise, changes will not reflect.
6. Owner accounts can also access the Accounts data table which can let them edit the admin accounts with the same process stated above.

### Ordering System

#### Customer Information

1. The ordering system does not offer account creation for customers (As per client's request) so customer orders will be tracked through their input information. Mainly through the customer name and contact number.
2. Once the ordering hub (Andrea's Fresh and Greens) has been accessed, the customers will be prompted to input the following details:
  - Full Name
  - Address
  - Contact No.
3. Once they enter the following information, the data will be saved locally. This will enable customer privilege without having to re-input their data by the lack of accounts. The following features will be enabled:
  - Ordering Products
  - Viewing Order History

#### Ordering Products

1. Customers can browse the menu to select products.
2. Once a product has been clicked, a popup will appear that lets the customer select the quantity.
3. After clicking the "Add to Cart" button, the product will be added to the cart.
4. Once satisfied, the customers can confirm their order by pressing the "Confirm" button on their cart. If their payment method is Gcash, they can scan a QR code to straight up purchase their order.
5. Once the order is confirmed, the order will be listed on the orders data and can be seen by the admins as "Pending".
6. The necessity of Contact No. will come as the customers will need to be contacted by the business admins to clarify all the details which are important to complete the order process.

#### Viewing Order History

1. The customer can access the order history from the navigation bar.
2. Once the order history is accessed, the system will read the following customer information input:
  - Full Name
  - Contact No.
3. All the data from the orders table that includes the same customer name and contact number will be retrieved.
4. After receiving the data from the orders table, the customers can view all of their purchase history and view the details.

## License

This project is licensed under the [Creative Commons Attribution-NonCommercial-NoDerivatives 4.0 International (CC BY-NC-ND 4.0)](https://creativecommons.org/licenses/by-nc-nd/4.0/) license. See the [LICENSE](LICENSE) file for details.

This license allows others to download and share the project for non-commercial purposes, as long as they give credit to the developers and do not modify the work or create derivative works based on it. If you wish to modify the project, please contact the developers for permission.