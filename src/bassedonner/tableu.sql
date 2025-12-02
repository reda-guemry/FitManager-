
CREATE TABLE cours (
    id int primary key auto_increment , 
    nom varchar(150) NOT NULL , 
    categorie varchar(150) NOT NULL , 
    heure int NOT NULL , 
    date varchar(20) NOT NULL ,
    duree INT NOT NULL , 
    max_participants INT NOT NULL 
) ;



CREATE TABLE equipement (
    id int primary key auto_increment , 
    nom varchar(150) NOT NULL , 
    type varchar(150) NOT NULL , 
    quuantiter int NOT NULL , 
    etat varchar(150) NOT NULL DEFAULT "moyen"
) ;

CREATE TABLE cours_equipement (
    id_cours INT ,
    id_equipement INT ,
    PRIMARY KEY (id_cours , id_equipement),
    FOREIGN KEY (id_cours) REFERENCES cours(id) , 
    FOREIGN KEY (id_equipement) REFERENCES equipement(id) 
);






INSERT INTO cours (nom , categorie , heure , date , duree , max_participants) 
VALUE   ("Yoga Matinal" , "Yoga" , 9 , "lundi" , 60 , 20) , 
        ('Cardio Intense', 'Cardio', 11, 'mardi', 45, 15),
        ('Musculation Pro', 'Musculation', 14, 'mercredi', 90, 25),
        ('Pilates Doux', 'Pilates', 10, 'jeudi', 50, 18),
        ('Zumba Fun', 'Dance', 17, 'vendredi', 55, 30);


INSERT INTO equipement (nom , type , quuantiter , etat) 
VALUE   ('Tapis de course', 'Endurance', 5, 'bon'),
        ('Haltères 10kg', 'Strength', 12, 'moyen'),
        ('Ballon de gym', 'Mobility', 8, 'bon'),
        ('Barre Olympique', 'Weightlifting', 4, 'a remplacer'),
        ('Corde à sauter', 'Endurance', 20, 'bon');


INSERT INTO cours_equipement (id_cours , id_equipement)
VALUES  (1, 1), 
        (1, 3),  
        (2, 1),
        (2, 5),  
        (3, 2),
        (3, 4),
        (4, 3), 
        (5, 5),  
        (5, 3);  


