use aminestore

CREATE TABLE Users
(
    id_u INT AUTO_INCREMENT ,
    name VARCHAR(250) ,
    email VARCHAR(250) NOT NULL UNIQUE,
    password VARCHAR(250) NOT NULL,
    PRIMARY KEY (id_u)
);

CREATE TABLE Admins
(
    id_a INT AUTO_INCREMENT ,
    id_u INT NOT NULL,
    PRIMARY KEY (id_a),
    FOREIGN KEY (id_u) REFERENCES Users(id_u) ON UPDATE CASCADE 
    ON DELETE CASCADE
);

CREATE TABLE Clients
(
    id_c INT AUTO_INCREMENT ,
    id_u INT NOT NULL,
    Active INT NOT NULL,
    PRIMARY KEY (id_c),
    FOREIGN KEY (id_u) REFERENCES Users(id_u) ON UPDATE CASCADE 
    ON DELETE CASCADE
);

CREATE TABLE Commands
(
    id_c INT AUTO_INCREMENT ,
    date_c Date NOT NULL,
    PRIMARY KEY (id_c)
);  

CREATE TABLE Categories
(
    id_ca INT AUTO_INCREMENT ,
    date_c Date NOT NULL,
    PRIMARY KEY (id_ca)
);  
CREATE TABLE Products
(
    id_p INT AUTO_INCREMENT ,
    name VARCHAR(250) NOT NULL,
    prix FLOAT NOT NULL,
    description VARCHAR(1000),
    quantité INT NOT NULL,
    projected INT ,
    img VARCHAR(1000) ,
    PRIMARY KEY (id_p)
);  

CREATE TABLE CommandDetails
(
    id_cd INT AUTO_INCREMENT ,
    id_c INT NOT NULL,
    id_p INT NOT NULL,
    quantité INT NOT NULL,
    Status INT ,
    PRIMARY KEY (id_cd),
    FOREIGN KEY (id_c) REFERENCES Clients(id_c) ON UPDATE CASCADE 
    ON DELETE CASCADE , 
    FOREIGN KEY (id_p) REFERENCES Products(id_p) ON UPDATE CASCADE 
    ON DELETE CASCADE 
);  

