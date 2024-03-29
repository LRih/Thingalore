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
    fname VARCHAR(50) NOT NULL,
    lname VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    address VARCHAR(255) NOT NULL,
    phone VARCHAR(50) NOT NULL,
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
    manufacturer VARCHAR(50),
    series VARCHAR(50),
    rrp INT NOT NULL, -- in cents
    price INT, -- in cents
    qty INT NOT NULL,
    image VARCHAR(255) NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (category_id) REFERENCES ProductCategories(id) ON DELETE CASCADE
);


CREATE TABLE Orders
(
    id INT NOT NULL AUTO_INCREMENT,
    customer_id INT NOT NULL,
    shipping_label VARCHAR(255) NOT NULL, -- stored because customer address may change after order is placed
    order_date DATETIME NOT NULL,
    status VARCHAR(50) NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (customer_id) REFERENCES Customers(id) ON DELETE CASCADE
);

CREATE TABLE OrderLines
(
    id INT NOT NULL AUTO_INCREMENT,
    order_id INT NOT NULL,
    product_id INT NOT NULL,
    qty INT NOT NULL,
    total_price INT NOT NULL, -- stored because price of product may change after order is placed
    PRIMARY KEY (id),
    FOREIGN KEY (order_id) REFERENCES Orders(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES Products(id) ON DELETE CASCADE
);


INSERT INTO ProductCategories (name) VALUES ("Figurines");
INSERT INTO ProductCategories (name) VALUES ("Model Kits");
INSERT INTO ProductCategories (name) VALUES ("Recreation");

INSERT INTO Products (category_id, name, rrp, image, qty, manufacturer, series, description) VALUES (1, "Hatsune Miku -Hanairogoromo- 1/8 Complete Figure", 12800, "miku_hanairogoromo.jpg", 100, "Stronger", "VOCALOID", "Was three-dimensional Miku than ""Hatsune Miku - Hanairokoromo ~"" series during deployment in character to cheer the Hokkaido is a shop and museum of ""Yuki Miku (Hatsune Miku)"" ""Snow Miku Sky Town"".\nBy Mr. popular illustrator Choco Fuji, the delicacy of the spread tails and colorful Sunday best clothes, of course, we expressed to the view of the world in the pedestal and three-dimensional flowers with the motif of the background.");
INSERT INTO Products (category_id, name, rrp, image, qty, manufacturer, description) VALUES (3, "HB Pencil", 1400, "pencil.jpg", 100, "DIXON", "One pencil. Of the finest craftmanship by DIXON.\n Includes revolutionary top-tipped eraser mechanism.");
INSERT INTO Products (category_id, name, rrp, image, qty, description) VALUES (3, "Pine Tree", 450, "pine_tree.jpg", 100, "A tree.");
INSERT INTO Products (category_id, name, rrp, image, qty, description) VALUES (3, "Oak Pier", 995, "pier.jpg", 100, "Made of wood.");
INSERT INTO Products (category_id, name, rrp, price, image, qty, manufacturer, series, description) VALUES (1, "Revoltech Danboard (BOX re makeup)", 4415, 3530, "danboard.jpg", 100, "Revoltech", "Yotsuba&!", "Blockbuster [Revoltech Danboard] is re-produced in the [BOX re makeup] renewal package.\nA box of latest design to Revoltech usually reform package size (215mm x 215mm x 65mm).\nI movable! Eye shines! Head of Miura-chan also attached!\nThe imposing Revoltech costume of cardboard that has emerged as a tool of summer vacation [Danbo].\nThe size is the same as [Revoltech Yotsuba], fun also doubled if play together side by side.\nAs well as comics, eyes will light up when I put the switch on the head.\nHead of [Miura] also included as replacement parts further.\nThe modeling in the cozy looseness, the body of cardboard ecology.\nTexture of cardboard, also reproduced in the paint more than necessary.\nPoured in vain a variety of technology to simple structure, it is Revoltech unique.\nSpecial base with which to decorate make a figure.");
INSERT INTO Products (category_id, name, rrp, image, qty, manufacturer, series, description) VALUES (1, "Hatsune Miku 1/8th scale", 5238, "miku.jpg", 100, "Good Smile Company", "VOCALOID", "This 1/8 scale figure of Hatsune Miku was first released in September, but due to it's overwhelming popularity, a re-release has already been announced for October! From VOCALOID2's popular ""Character Vocal Series 01"" comes a realistic PVC figure of the mascot character Hatsune Miku.\nThis particular pose was based off an original illustration by the character's original designer, KEI. Special care has been taken in preserving every enchanting detail, from her trademark twintails fluttering around her, to the hand on her headset, everything comes together and makes her seem ready to burst into song at any moment. She's jumped out of the virtual world and into this cute figure, so be sure to take one home with you.");
INSERT INTO Products (category_id, name, rrp, image, qty, manufacturer, series, description) VALUES (2, "MG 1/100 GN-X Plastic Model", 3888, "gnx.jpg", 100, "Bandai", "Gundam 00", "Characteristic GN Drive is accurately recreated!\nWhole body specially designed to accommodate the GN-X's unorthodox frame while keeping the MG range of motion and stability!\nCockpit hatch opens, and cockpit interior is detailed, and figures for both Peries and Sergei are included!\nFollowing in the wake of the extremely successful Gundam Exia, the updated frame features the characteristic hex binder, and is built to allow maximum mobility!");
INSERT INTO Products (category_id, name, rrp, image, qty, manufacturer, series, description) VALUES (2, "MG Gundam SEED 1/100 Freedom Gundam", 4860, "mg_freedom.jpg", 100, "Bandai", "Gundam SEED", "Frame, exterior both revamped proportions in the new shape completely. Detail has followed the SEED Ver.RM system.\nDesigned to achieve a natural moving close to human. Fully reproduce the heroic poses of Freedom Gundam.\nArms stretch movable elbow joints. Delicate movement can also be realized.\nThigh armor to the slide mechanism, and adopt a double joint specification of the toe.\nWarp, crouched, twisting and flexibly abdomen moving.");
INSERT INTO Products (category_id, name, rrp, image, qty, manufacturer, series, description) VALUES (1, "Nendoroid Saitama", 3995, "saitama_nendoroid.jpg", 100, "Good Smile Company", "One Punch Man", "From the popular anime 'One-Punch Man' comes a second release of the Nendoroid who obtained unrivalled power - Nendoroid Saitama! The characteristic round appearance of his head has been completely preserved in Nendoroid form!\nHe comes with two head parts with different expressions - one with his standard unconcerned expression and one with a more serious expression to show off during battle scenes! He also comes with a super market packet to hold to display the calmer side of his life as well! Simply pick the parts and pose that you prefer, and enjoy the company of the invincible Saitama!");
INSERT INTO Products (category_id, name, rrp, image, qty, manufacturer, series, description) VALUES (1, "DXF One-Punch Man Saitama", 5000, "saitama.jpg", 100, "Banpresto", "One Punch Man", "Depicted giving one of his famous punches, Saitama from the hit series One-Punch Man is beautifully captured in this exciting painted ABS and PVC figure! With a height of 7.5"", it captures both his realistic form with carefully detailed muscles and his overwhelmingly powerful presence through the pose and dramatic cape, the combination of which can't help but inspire you. Doesn't seeing this make you want to cheer him on?!");

INSERT INTO Customers (id, fname, lname, email, address, phone, password_hash, verification_code) VALUES (1, "John", "Smith", "test@test.com", "123 Fake St, Melbourne VIC 3000", "0555-5555", "$2y$10$nDA.ISqTtCxyzXQyXdNl2elk8wFuz/PVBEearEq7W4hn8wwDJBLE.", "code");
INSERT INTO Orders (id, customer_id, shipping_label, order_date, status) VALUES (1, 1, "John Smith\n123 Fake St, Melbourne VIC 3000", "2008-11-23", "Shipped");
INSERT INTO OrderLines (id, order_id, product_id, qty, total_price) VALUES (1, 1, 1, 2, 1200);
INSERT INTO OrderLines (id, order_id, product_id, qty, total_price) VALUES (2, 1, 2, 1, 99000);
INSERT INTO Orders (id, customer_id, shipping_label, order_date, status) VALUES (2, 1, "John Smith\n123 Real St, Melbourne VIC 3000", "2014-08-10", "Processing");
INSERT INTO OrderLines (id, order_id, product_id, qty, total_price) VALUES (3, 2, 3, 3, 4000);
