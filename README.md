# Secure Electronic Commerce Assignment 2

## Pages
Home<br>
Products
- Product details

FAQs<br>
Contact

Account<br>
Cart
- Checkout
 - Mock paypal payment processing page

Register<br>
Login

## Schema
```sql
CREATE TABLE Customers
(
  id INT NOT NULL AUTO_INCREMENT,
  email VARCHAR(50) NOT NULL,
  password_hash VARCHAR(255) NOT NULL,
  is_verified TINYINT(1) NOT NULL DEFAULT '0',
  verification_code VARCHAR(32) NOT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY email (email)
);


CREATE TABLE ProductCategories
(
  `id` INT NOT NULL AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE Products
(
  id INT NOT NULL AUTO_INCREMENT,
  category_id INT NOT NULL,
  name VARCHAR(255) NOT NULL,
  desc TEXT NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (category_id) REFERENCES ProductCategories(id) ON DELETE CASCADE
);


CREATE TABLE Orders
(
  id INT NOT NULL AUTO_INCREMENT,
  customer_id INT NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (customer_id) REFERENCES Customer(id) ON DELETE CASCADE
);

CREATE TABLE OrderLines
(
  id INT NOT NULL AUTO_INCREMENT,
  order_id INT NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (order_id) REFERENCES Orders(id) ON DELETE CASCADE
);
```
