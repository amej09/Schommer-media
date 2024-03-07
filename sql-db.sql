
CREATE TABLE Produkte (
    ProduktID INT AUTO_INCREMENT PRIMARY KEY,
    Titel VARCHAR(255) NOT NULL,
    Preis DECIMAL(10,2) NOT NULL,
    Lagerbestand INT NOT NULL,
    Lieferzeit INT NOT NULL,
    Dateiname VARCHAR(255) NOT NULL
);

CREATE TABLE Kategorie (
    KategorieID INT AUTO_INCREMENT PRIMARY KEY,
    KategorieName VARCHAR(50) NOT NULL
);

CREATE TABLE ProdukteKategory(
    ProduktID INT,
    KategorieID INT ,
    PRIMARY KEY (ProduktID ,KategorieID),
    FOREIGN KEY (ProduktID) REFERENCES Produkte(ProduktID),
    FOREIGN KEY (KategorieID) REFERENCES Kategorie(KategorieID)
    
)


DELETE FROM `produktekategory` ;
ALTER TABLE produktekategory AUTO_INCREMENT = 1;

DELETE FROM `kategorie` ;
ALTER TABLE kategorie AUTO_INCREMENT = 1;

DELETE FROM `produkte` ;
ALTER TABLE produkte AUTO_INCREMENT = 1;