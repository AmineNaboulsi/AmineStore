use aminestore ;

CREATE TABLE Users
(
    id_u INT AUTO_INCREMENT ,
    name VARCHAR(250) ,
    email VARCHAR(250) NOT NULL UNIQUE,
    password VARCHAR(250) NOT NULL,
    Active BOOLEAN ,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id_u)
);
CREATE TABLE Roles (
    id_r INT AUTO_INCREMENT PRIMARY KEY,
    role_name VARCHAR(150) NOT NULL UNIQUE
);

INSERT INTO Roles (role_name) VALUES ('Admin') , ('Client');

CREATE TABLE UserRoles (
      id_u INT NOT NULL,
      id_r INT NOT NULL,
      PRIMARY KEY (id_u, id_r),
      FOREIGN KEY (id_u) REFERENCES Users(id_u) ON UPDATE CASCADE ON DELETE CASCADE,
      FOREIGN KEY (id_r) REFERENCES Roles(id_r) ON UPDATE CASCADE ON DELETE CASCADE
);
CREATE TABLE Roles
(
    id_r INT AUTO_INCREMENT ,
    id_u INT,
    role VARCHAR(150),
    PRIMARY KEY (id_r),
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
    Name LONGTEXT NOT NULL,
    img VARCHAR(1000) NOT NULL,
    PRIMARY KEY (id_ca)
);

CREATE TABLE Products
(
    id_p INT AUTO_INCREMENT ,
    name VARCHAR(250) NOT NULL,
    prix FLOAT NOT NULL,
    description LONGTEXT,
    quantité INT NOT NULL,
    projected INT ,
    img LONGTEXT,
    categorie_id INT ,
    PRIMARY KEY (id_p),
    foreign key (categorie_id) REFERENCES Categories(id_ca) ON DELETE SET NULL
);
DESCRIBE  Products ;
CREATE TABLE CommandDetails
(
    id_cd INT AUTO_INCREMENT ,
    id_command INT  ,
    id_c INT NOT NULL,
    id_p INT NOT NULL,
    quantité INT NOT NULL,
    Status INT ,
    PRIMARY KEY (id_cd),
    FOREIGN KEY (id_c) REFERENCES Users(id_u) ON UPDATE CASCADE
    ON DELETE CASCADE ,
    FOREIGN KEY (id_command) REFERENCES Commands(id_c) ON UPDATE CASCADE
    ON DELETE CASCADE ,
    FOREIGN KEY (id_p) REFERENCES Products(id_p) ON UPDATE CASCADE 
    ON DELETE CASCADE 
);

SELECT * FROM Commands;

INSERT INTO Categories (name, img) VALUES
                           ('MAC' , 'https://store.storeimages.cdn-apple.com/4982/as-images.apple.com/is/store-card-13-mac-nav-202410?wid=400&hei=260&fmt=png-alpha&.v=1728342368663') ,
                           ('iPhone' , 'https://store.storeimages.cdn-apple.com/4982/as-images.apple.com/is/store-card-13-mac-nav-202410?wid=400&hei=260&fmt=png-alpha&.v=1728342368663') ,
                           ('iPad' , 'https://store.storeimages.cdn-apple.com/4982/as-images.apple.com/is/store-card-13-ipad-nav-202405?wid=400&hei=260&fmt=png-alpha&.v=1714168620875') ,
                           ('Apple Watch' , 'https://store.storeimages.cdn-apple.com/4982/as-images.apple.com/is/store-card-13-watch-nav-202409?wid=400&hei=260&fmt=png-alpha&.v=1724165625838') ,
                           ('AirPods' , 'https://store.storeimages.cdn-apple.com/4982/as-images.apple.com/is/store-card-13-airpods-nav-202409?wid=400&hei=260&fmt=png-alpha&.v=1722974349822') ;
