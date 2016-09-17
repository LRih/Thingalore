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
  image VARCHAR(255) NOT NULL,
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

INSERT INTO ProductCategories (name) VALUES ("Figurines");
INSERT INTO ProductCategories (name) VALUES ("Model Kits");
INSERT INTO ProductCategories (name) VALUES ("Recreation");

INSERT INTO Products (category_id, name, price, image, description) VALUES (3, "Pine Tree", 450, "pine_tree.jpg", "A tree.");
INSERT INTO Products (category_id, name, price, image, description) VALUES (3, "Pier", 995, "pier.jpg", "Made of wood.");
INSERT INTO Products (category_id, name, price, image, description) VALUES (3, "Pencil", 1400, "pencil.jpg", "One pencil.");

INSERT INTO Products (category_id, name, price, image, description) VALUES (2, "MG Gundam SEED 1/100 Freedom Gundam", 4860, "mg_freedom.jpg", "Frame, exterior both revamped proportions in the new shape completely. Detail has followed the SEED Ver.RM system.\nDesigned to achieve a natural moving close to human. Fully reproduce the heroic poses of Freedom Gundam.\nArms stretch movable elbow joints. Delicate movement can also be realized.\nThigh armor to the slide mechanism, and adopt a double joint specification of the toe.\nWarp, crouched, twisting and flexibly abdomen moving.");

INSERT INTO Products (category_id, name, price, image, description) VALUES (1, "DXF One-Punch Man Saitama", 5000, "saitama.jpg", "Depicted giving one of his famous punches, Saitama from the hit series One-Punch Man is beautifully captured in this exciting painted ABS and PVC figure! With a height of 7.5”, it captures both his realistic form with carefully detailed muscles and his overwhelmingly powerful presence through the pose and dramatic cape, the combination of which can’t help but inspire you. Doesn’t seeing this make you want to cheer him on?!");
