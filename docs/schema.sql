-- database name: sec_ecommerce
-- test credentials: 'root', ''
-- prod credentials: 'sec_ecommerce', 'sec_ecommerce'


DROP TABLE IF EXISTS OrderLines;
DROP TABLE IF EXISTS Orders;
DROP TABLE IF EXISTS Products;
DROP TABLE IF EXISTS ProductCategories;
DROP TABLE IF EXISTS Customers;


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
  id INT NOT NULL AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL,
  PRIMARY KEY (id)
);

CREATE TABLE Products
(
  id INT NOT NULL AUTO_INCREMENT,
  category_id INT NOT NULL,
  name VARCHAR(255) NOT NULL,
  description TEXT NOT NULL,
  price INT NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (category_id) REFERENCES ProductCategories(id) ON DELETE CASCADE
);


CREATE TABLE Orders
(
  id INT NOT NULL AUTO_INCREMENT,
  customer_id INT NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (customer_id) REFERENCES Customers(id) ON DELETE CASCADE
);

CREATE TABLE OrderLines
(
  id INT NOT NULL AUTO_INCREMENT,
  order_id INT NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (order_id) REFERENCES Orders(id) ON DELETE CASCADE
);
