
-- Création de la table 'Produkte' pour stocker les informations sur les produits
CREATE TABLE Produkte (
    ProduktID INT AUTO_INCREMENT PRIMARY KEY,
    Titel VARCHAR(255) NOT NULL,
    Preis DECIMAL(10,2) NOT NULL,
    Lagerbestand INT NOT NULL,
    Lieferzeit INT NOT NULL,
    Dateiname VARCHAR(255) NOT NULL,
);

-- Création de la table 'Kategorie' pour stocker les informations sur les catégories
CREATE TABLE Kategorie (
    KategorieID INT AUTO_INCREMENT PRIMARY KEY,
    KategorieName VARCHAR(50) NOT NULL
);

CREATE TABLE ProdukteKategory(
    ProduktID INT,
    KategorieID INT ,
    PRIMARY KEY (ProduktID ,KategorieID),
    FOREIGN KEY (ProduktID) REFERENCES Produkte(ProduktID),
    FOREIGN KEY (KategorieID) REFERENCES Kategorie(KategorieID),
    
)