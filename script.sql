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
('T-shirt compression', 'SN015', 22.50, 'T-shirt moulant de récupération', 'T-shirts', 'compression.jpg'),
('Veste sport unisexe', 'SN016', 65.40, 'superbe veste de sport unisexe', 'Vestes','veste2.jpg'),
('Veste hiver homme', 'SN017', 80.00, 'superbe veste hiver pour homme', 'Vestes','veste3.jpg'),
('Veste hiver femme', 'SN018', 80.00, 'superbe veste hiver pour femme', 'Vestes','veste4.jpg'),
('écharpe unisexe', 'SN019', 15.00, 'écharpe légère et confortable', 'Accessoires', 'echarpe.jpg'),
('Sac de sport compact', 'SN020', 27.99, 'Sac léger avec plusieurs compartiments', 'Accessoires', 'sac.jpg'),
('Legging seamless femme', 'SN021', 31.50, 'Legging sans couture pour un confort optimal', 'Leggings', 'legging_seamless.jpg'),
('Legging sport homme', 'SN022', 33.00, 'Legging de compression pour homme', 'Leggings', 'legging_homme.jpg'),
('Legging imprimé femme', 'SN023', 29.90, 'Legging coloré avec motifs géométriques', 'Leggings', 'legging_imprime.jpg'),
('Pantalon cargo sport', 'SN024', 42.00, 'Pantalon multi-poches pour activités outdoor', 'Pantalons', 'pantalon_cargo.jpg'),
('Pantalon training léger', 'SN025', 36.50, 'Pantalon respirant pour entraînement intensif', 'Pantalons', 'pantalon_training.jpg'),
('Short running homme', 'SN026', 17.99, 'Short léger avec doublure intégrée', 'Shorts', 'short_running_homme.jpg'),
('Short training femme', 'SN027', 16.50, 'Short taille haute pour le fitness', 'Shorts', 'short_training_femme.jpg'),
('Short cycliste', 'SN028', 19.00, 'Short moulant idéal pour le vélo', 'Shorts', 'short_cycliste.jpg'),
('Boxer sport homme', 'SN029', 11.99, 'Boxer respirant en tissu technique', 'Sous-vêtements', 'boxer_homme.jpg'),
('Culotte sans couture', 'SN030', 9.50, 'Culotte invisible idéale pour le sport', 'Sous-vêtements', 'culotte_femme.jpg'),
('Sweat oversize unisexe', 'SN031', 44.90, 'Sweat ample et confortable pour tous', 'Sweats', 'sweat_oversize.jpg'),
('Sweat zippé respirant', 'SN032', 47.00, 'Sweat à fermeture zippée pour entraînement', 'Sweats', 'sweat_zippe.jpg');



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

-- Veste sport unisexe (Noir, Vert, Bleu)
(16, 'M', 'Noir', 20),
(16, 'L', 'Noir', 18),
(16, 'M', 'Vert', 15),
(16, 'L', 'Vert', 12),
(16, 'M', 'Bleu', 14),
(16, 'L', 'Bleu', 10),

-- Veste hiver homme (Noir, Gris, Bleu)
(17, 'M', 'Noir', 25),
(17, 'L', 'Noir', 20),
(17, 'M', 'Gris', 18),
(17, 'L', 'Gris', 15),
(17, 'M', 'Bleu', 12),
(17, 'L', 'Bleu', 10),

-- Veste hiver femme (Noir, Rose, Beige)
(18, 'S', 'Noir', 22),
(18, 'M', 'Noir', 18),
(18, 'S', 'Rose', 16),
(18, 'M', 'Rose', 14),
(18, 'S', 'Beige', 12),
(18, 'M', 'Beige', 10),

-- Écharpe unisexe (Gris, Noir, Bleu)
(19, 'Taille Unique', 'Gris', 40),
(19, 'Taille Unique', 'Noir', 38),
(19, 'Taille Unique', 'Bleu', 35),

-- Sac de sport compact (Noir, Rouge, Gris)
(20, 'Taille Unique', 'Noir', 50),
(20, 'Taille Unique', 'Rouge', 45),
(20, 'Taille Unique', 'Gris', 40),
    
-- Legging seamless femme (Noir, Rose, Violet)
(21, 'S', 'Noir', 30),
(21, 'M', 'Noir', 25),
(21, 'S', 'Rose', 22),
(21, 'M', 'Rose', 20),
(21, 'S', 'Violet', 18),
(21, 'M', 'Violet', 15),

-- Legging sport homme (Noir, Gris, Bleu)
(22, 'M', 'Noir', 28),
(22, 'L', 'Noir', 25),
(22, 'M', 'Gris', 22),
(22, 'L', 'Gris', 20),
(22, 'M', 'Bleu', 18),
(22, 'L', 'Bleu', 16),

-- Legging imprimé femme (Rose, Violet, Multicolore)
(23, 'S', 'Rose', 24),
(23, 'M', 'Rose', 20),
(23, 'S', 'Violet', 18),
(23, 'M', 'Violet', 16),
(23, 'S', 'Multicolore', 15),
(23, 'M', 'Multicolore', 13),

-- Pantalon cargo sport (Kaki, Noir, Beige)
(24, 'M', 'Kaki', 22),
(24, 'L', 'Kaki', 20),
(24, 'M', 'Noir', 18),
(24, 'L', 'Noir', 15),
(24, 'M', 'Beige', 14),
(24, 'L', 'Beige', 12),

-- Pantalon training léger (Gris, Bleu, Noir)
(25, 'M', 'Gris', 20),
(25, 'L', 'Gris', 18),
(25, 'M', 'Bleu', 16),
(25, 'L', 'Bleu', 14),
(25, 'M', 'Noir', 12),
(25, 'L', 'Noir', 10),

-- Short running homme (Noir, Bleu, Gris)
(26, 'M', 'Noir', 30),
(26, 'L', 'Noir', 28),
(26, 'M', 'Bleu', 26),
(26, 'L', 'Bleu', 24),
(26, 'M', 'Gris', 22),
(26, 'L', 'Gris', 20),

-- Short training femme (Rose, Noir, Violet)
(27, 'S', 'Rose', 18),
(27, 'M', 'Rose', 16),
(27, 'S', 'Noir', 14),
(27, 'M', 'Noir', 12),
(27, 'S', 'Violet', 10),
(27, 'M', 'Violet', 8),

-- Short cycliste (Noir, Bleu, Gris)
(28, 'M', 'Noir', 25),
(28, 'L', 'Noir', 22),
(28, 'M', 'Bleu', 20),
(28, 'L', 'Bleu', 18),
(28, 'M', 'Gris', 15),
(28, 'L', 'Gris', 12),

-- Boxer sport homme (Noir, Gris, Bleu)
(29, 'M', 'Noir', 30),
(29, 'L', 'Noir', 28),
(29, 'M', 'Gris', 26),
(29, 'L', 'Gris', 24),
(29, 'M', 'Bleu', 22),
(29, 'L', 'Bleu', 20),

-- Culotte sans couture (Beige, Noir, Rose)
(30, 'S', 'Beige', 20),
(30, 'M', 'Beige', 18),
(30, 'S', 'Noir', 16),
(30, 'M', 'Noir', 14),
(30, 'S', 'Rose', 12),
(30, 'M', 'Rose', 10),

-- Sweat oversize unisexe (Noir, Gris, Bordeaux)
(31, 'M', 'Noir', 22),
(31, 'L', 'Noir', 20),
(31, 'M', 'Gris', 18),
(31, 'L', 'Gris', 15),
(31, 'M', 'Bordeaux', 12),
(31, 'L', 'Bordeaux', 10),

-- Sweat zippé respirant (Bleu, Noir, Rouge)
(32, 'M', 'Bleu', 18),
(32, 'L', 'Bleu', 15),
(32, 'M', 'Noir', 20),
(32, 'L', 'Noir', 17),
(32, 'M', 'Rouge', 12),
(32, 'L', 'Rouge', 10);

