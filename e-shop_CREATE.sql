CREATE TABLE Zakaznik
(
	jmeno_zakaznik char(20) NOT NULL,
	prijmeni_zakaznik char(50) NOT NULL,
	email_zakaznik char (100) NOT NULL PRIMARY KEY,
	heslo_zakaznik char (65) NOT NULL
);


CREATE TABLE Produkt
(
	id_produkt int AUTO_INCREMENT PRIMARY KEY,
	nazev_produkt char (200) NOT NULL,
	druh_prdukt char (200) NOT NULL,
	cena_produkt int NOT NULL DEFAULT 1
);

CREATE TABLE Kosik
(
	id_pordukt_kosik int AUTO_INCREMENT PRIMARY KEY,
	nazev_produkt_kosik char (100) NOT NULL,
	mnozstvi_kosik int NOT NULL DEFAULT 1,
	cena_produktu_kosik int NOT NULL
);

INSERT INTO Produkt (nazev_produkt, druh_prdukt, cena_produkt) VALUES
	("HP Notebook 15s-du1034tu", "Notebooky / Kancelářské Notebooky", 15999),
	("Samsung Galaxy Note 20", "Mobilní telefony / Samsung", 25999),
	("Apple Watch Series 5", "Chytré hodinky / Apple", 11999),
	("Samsung 810 L", "Lednice / Samsung", 61999);

INSERT INTO Zakaznik (jmeno_zakaznik, prijmeni_zakaznik, email_zakaznik, heslo_zakaznik) VALUES
	("Pokus", "Pokus", "pokus@pokus.com", "86303f5fd1af9c5aa84afbedccec2d2441826683e88020e498172af8c1bcf188") /* Ab12345 */