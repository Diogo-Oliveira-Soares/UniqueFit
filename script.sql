CREATE USER 'AdminUF'@'localhost' IDENTIFIED BY 'Pa$$w0rd';
CREATE DATABASE UniqueFit;
GRANT ALL PRIVILEGES ON UniqueFit.* TO 'AdminUF'@'localhost';
FLUSH PRIVILEGES;
SHOW GRANTS FOR 'AdminUF'@'localhost';

USE UniqueFit;

CREATE TABLE users (
    idusers INT PRIMARY KEY,
    nickname VARCHAR(45) NOT NULL,
    firstname VARCHAR(20) NOT NULL,
    lastname VARCHAR(40) NOT NULL,
    adress VARCHAR(50) NOT NULL,
    mail VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    image VARCHAR(100)
);

CREATE TABLE products (
  idproducts INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(30) NOT NULL,
  serial_number VARCHAR(45) NOT NULL,
  price FLOAT NOT NULL,
  description VARCHAR(100) NOT NULL,
  category VARCHAR(30) NOT NULL,
  image VARCHAR(100)
);

CREATE TABLE product_variants (
  idvariant INT AUTO_INCREMENT PRIMARY KEY,
  idproducts INT,
  size VARCHAR(5) NOT NULL,
  color VARCHAR(10) NOT NULL,
  stock INT NOT NULL,
  FOREIGN KEY (idproducts) REFERENCES products(idproducts)
);

CREATE TABLE orders (
    idorders INT PRIMARY KEY NOT NULL,
    number_of_order VARCHAR(40) NOT NULL,
    date DATE NOT NULL,
    users_idusers INT,
    FOREIGN KEY (users_idusers) REFERENCES users(idusers)
);

CREATE TABLE `order-details` (
    products_idproducts INT,
    orders_idorders INT,
    quantity INT NOT NULL,
    price FLOAT NOT NULL,
    PRIMARY KEY (products_idproducts, orders_idorders),
    FOREIGN KEY (products_idproducts) REFERENCES products(idproducts),
    FOREIGN KEY (orders_idorders) REFERENCES orders(idorders)
);

INSERT INTO products (name, serial_number, price, description, category, image)
VALUES
('T-shirt sport homme', 'SN001', 19.99, 'T-shirt respirant pour entraînement', 'T-shirts', 'tshirt_homme.jpg'),
('T-shirt sport femme', 'SN002', 21.99, 'T-shirt stretch pour fitness', 'T-shirts', 'tshirt_femme.jpg'),
('Pantalon jogging homme', 'SN003', 34.99, 'Jogging confortable coton', 'Pantalons', 'jogging_homme.jpg'),
('Legging sport femme', 'SN004', 29.99, 'Legging taille haute extensible', 'Leggings', 'legging_femme.jpg'),
('Short entraînement', 'SN005', 15.50, 'Short léger pour cardio', 'Shorts', 'short.jpg'),
('Brassière de sport', 'SN006', 25.00, 'Brassière maintien fort', 'Sous-vêtements', 'brassiere.jpg'),
('Débardeur musculation', 'SN007', 18.00, 'Débardeur dos nageur', 'T-shirts', 'debardeur.jpg'),
('Veste zippée training', 'SN008', 49.99, 'Veste légère à capuche', 'Vestes', 'veste.jpg'),
('Sweat à capuche homme', 'SN009', 39.95, 'Sweat molletonné', 'Sweats', 'sweat_homme.jpg'),
('Sweat à capuche femme', 'SN010', 39.95, 'Sweat femme coupe ajustée', 'Sweats', 'sweat_femme.jpg'),
('Chaussettes sport', 'SN011', 5.99, 'Chaussettes respirantes lot de 2', 'Sous-vêtements', 'chaussettes.jpg'),
('Gants de musculation', 'SN012', 14.50, 'Gants antidérapants', 'Accessoires', 'gants.jpg'),
('Casquette training', 'SN013', 12.00, 'Casquette anti-UV', 'Accessoires', 'casquette.jpg'),
('Collant thermique', 'SN014', 32.00, 'Collant isolant pour hiver', 'Pantalons', 'collant.jpg'),
('T-shirt compression', 'SN015', 22.50, 'T-shirt moulant de récupération', 'T-shirts', 'compression.jpg');

INSERT INTO product_variants (idproducts, size, color, stock)
VALUES
-- T-shirt sport homme (Noir, Blanc, Bleu)
(1, 'S', 'Noir', 50),
(1, 'M', 'Noir', 45),
(1, 'L', 'Noir', 40),
(1, 'XL', 'Noir', 35),
(1, 'S', 'Blanc', 60),
(1, 'M', 'Blanc', 55),
(1, 'L', 'Blanc', 50),
(1, 'XL', 'Blanc', 45),
(1, 'S', 'Bleu', 55),
(1, 'M', 'Bleu', 50),
(1, 'L', 'Bleu', 45),
(1, 'XL', 'Bleu', 40),
-- T-shirt sport femme (Rose, Bleu, Vert)
(2, 'S', 'Rose', 40),
(2, 'M', 'Rose', 30),
(2, 'L', 'Rose', 20),
(2, 'S', 'Bleu', 30),
(2, 'M', 'Bleu', 25),
(2, 'L', 'Bleu', 20),
(2, 'S', 'Vert', 25),
(2, 'M', 'Vert', 20),
(2, 'L', 'Vert', 15),
-- Pantalon jogging homme (Gris, Noir, Bleu)
(3, 'L', 'Gris', 30),
(3, 'XL', 'Gris', 25),
(3, 'L', 'Noir', 20),
(3, 'XL', 'Noir', 15),
(3, 'L', 'Bleu', 18),
(3, 'XL', 'Bleu', 12),
-- Legging sport femme (Noir, Gris, Rose)
(4, 'M', 'Noir', 45),
(4, 'L', 'Noir', 35),
(4, 'S', 'Noir', 40),
(4, 'M', 'Gris', 30),
(4, 'L', 'Gris', 25),
(4, 'S', 'Gris', 28),
(4, 'M', 'Rose', 25),
(4, 'L', 'Rose', 22),
(4, 'S', 'Rose', 30),
-- Short entraînement (Bleu, Rouge, Noir)
(5, 'M', 'Bleu', 50),
(5, 'L', 'Bleu', 60),
(5, 'M', 'Rouge', 45),
(5, 'L', 'Rouge', 55),
(5, 'M', 'Noir', 40),
(5, 'L', 'Noir', 50),
-- Brassière de sport (Violet, Rose, Noir)
(6, 'S', 'Violet', 35),
(6, 'M', 'Violet', 25),
(6, 'L', 'Violet', 20),
(6, 'S', 'Rose', 28),
(6, 'M', 'Rose', 22),
(6, 'L', 'Rose', 18),
(6, 'S', 'Noir', 30),
(6, 'M', 'Noir', 25),
(6, 'L', 'Noir', 20),
-- Débardeur musculation (Blanc, Gris, Noir)
(7, 'S', 'Blanc', 28),
(7, 'M', 'Blanc', 20),
(7, 'S', 'Gris', 25),
(7, 'M', 'Gris', 18),
(7, 'S', 'Noir', 22),
(7, 'M', 'Noir', 20),
-- Veste zippée training (Noir, Bleu, Gris)
(8, 'L', 'Noir', 20),
(8, 'M', 'Noir', 15),
(8, 'L', 'Bleu', 18),
(8, 'M', 'Bleu', 12),
(8, 'L', 'Gris', 10),
(8, 'M', 'Gris', 8),
-- Sweat à capuche homme (Rouge, Noir, Bleu)
(9, 'M', 'Rouge', 15),
(9, 'L', 'Rouge', 10),
(9, 'XL', 'Rouge', 5),
(9, 'M', 'Noir', 20),
(9, 'L', 'Noir', 18),
(9, 'XL', 'Noir', 12),
(9, 'M', 'Bleu', 10),
(9, 'L', 'Bleu', 8),
(9, 'XL', 'Bleu', 6),
-- Sweat à capuche femme (Bordeaux, Noir, Gris)
(10, 'S', 'Bordeaux', 10),
(10, 'M', 'Bordeaux', 12),
(10, 'S', 'Noir', 8),
(10, 'M', 'Noir', 10),
(10, 'S', 'Gris', 7),
(10, 'M', 'Gris', 6),
-- Chaussettes sport (Blanc, Noir, Gris)
(11, 'M', 'Blanc', 100),
(11, 'L', 'Blanc', 95),
(11, 'M', 'Noir', 90),
(11, 'L', 'Noir', 85),
(11, 'M', 'Gris', 80),
(11, 'L', 'Gris', 75),
-- Gants de musculation (Noir, Gris, Bleu)
(12, 'M', 'Noir', 38),
(12, 'L', 'Noir', 25),
(12, 'M', 'Gris', 30),
(12, 'L', 'Gris', 20),
(12, 'M', 'Bleu', 15),
(12, 'L', 'Bleu', 10),
-- Casquette training (Gris, Noir, Bleu)
(13, 'M', 'Gris', 45),
(13, 'L', 'Gris', 40),
(13, 'M', 'Noir', 50),
(13, 'L', 'Noir', 45),
(13, 'M', 'Bleu', 42),
(13, 'L', 'Bleu', 38),
-- Collant thermique (Bleu, Gris, Noir)
(14, 'S', 'Bleu', 18),
(14, 'M', 'Bleu', 12),
(14, 'S', 'Gris', 20),
(14, 'M', 'Gris', 15),
(14, 'S', 'Noir', 22),
(14, 'M', 'Noir', 18),
-- T-shirt compression (Vert, Bleu, Noir)
(15, 'M', 'Vert', 33),
(15, 'L', 'Vert', 25),
(15, 'M', 'Bleu', 28),
(15, 'L', 'Bleu', 22),
(15, 'M', 'Noir', 40),
(15, 'L', 'Noir', 35);
