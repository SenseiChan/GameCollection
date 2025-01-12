DROP TABLE IF EXISTS Avaible;
DROP TABLE IF EXISTS Game;
DROP TABLE IF EXISTS Platform;
DROP TABLE IF EXISTS User;

CREATE TABLE User(
    Id_user INT,
    FirstName_user VARCHAR(100) NOT NULL,
    Email_user VARCHAR(100) NOT NULL,
    Password_user VARCHAR(255) NOT NULL,
    LastName_user VARCHAR(100) NOT NULL,
    PRIMARY KEY(Id_user)
);

CREATE TABLE Game(
    Id_game INT,
    Name_game VARCHAR(50) NOT NULL,
    Url_picture VARCHAR(255) NOT NULL,
    Url_site VARCHAR(255) NOT NULL,
    Desc_game VARCHAR(255) NOT NULL,
    Date_game DATE NOT NULL,
    Publisher_game VARCHAR(255) NOT NULL,
#    TimeIn_game INT NOT NULL,
#    Id_user INT NOT NULL,
   PRIMARY KEY(Id_game)
#    FOREIGN KEY(Id_user) REFERENCES User(Id_user)
);

CREATE TABLE Library(
    Id_user INT,
    Id_game INT,
    Time_Played DATE NOT NULL,
    PRIMARY KEY (Id_user,Id_game),
    FOREIGN KEY (Id_user) REFERENCES User(id_user),
    FOREIGN KEY (Id_game) REFERENCES Game(id_game)
);

CREATE TABLE Platform(
    Id_platform INT,
    Name_platform VARCHAR(100) NOT NULL,
    PRIMARY KEY(Id_platform)
);

CREATE TABLE Available(
    Id_game INT,
    Id_platform INT,
    PRIMARY KEY(Id_game, Id_platform),
    FOREIGN KEY(Id_game) REFERENCES Game(Id_game),
    FOREIGN KEY(Id_platform) REFERENCES Platform(Id_platform)
);
