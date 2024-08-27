CREATE TABLE 'Admin' (
    `Id_admin` int(1) AUTO_INCREMENT PRIMARY KEY,
    `Nom_admin` varchar(30),
    `Email_admin` varchar(50),
    `Mot_de_passe_ad` varchar(255)
    );


CREATE TABLE `message` (
    `id_message` INT(4) AUTO_INCREMENT PRIMARY KEY,
    `cont_message` VARCHAR(255) NOT NULL,
    `date_message` date NOT null,
     `id_admin` INT(1),
    `id_stg` INT(4),
     FOREIGN KEY (`id_admin`) REFERENCES `admin`(`id_admin`),
     FOREIGN KEY (`id_stg`) REFERENCES `stagiaire`(`id_stg`)
);


CREATE TABLE `avis` (
    `id_avis` INT(4) AUTO_INCREMENT PRIMARY KEY,
    `cont_avis` VARCHAR(255) NOT NULL,
    `date_avis` date NOT null,
     `id_formation` INT(4),
    `id_stg` INT(4),
     FOREIGN KEY (`id_formation`) REFERENCES `formation`(`id_formation`),
     FOREIGN KEY (`id_stg`) REFERENCES `stagiaire`(`id_stg`)
);



CREATE TABLE `image` (
   ` id_img` INT(4) AUTO_INCREMENT PRIMARY KEY,
    `url_img` VARCHAR(50),
    `description_img` varchar(50),
    `id_admin` INT(1),
    `id_formateur` INT(4),
    `id_formation` INT(4),
    FOREIGN KEY (`id_admin`) REFERENCES `admin`(`id_admin`),
    FOREIGN KEY (`id_formateur`) REFERENCES `formateur`(`id_formateur`),
    FOREIGN KEY (`id_formation`) REFERENCES `formation`(`id_aformation`)
); 


CREATE TABLE `session_formation` (
   ` id_session` INT(4) AUTO_INCREMENT PRIMARY KEY,
    `date_debut` date,
    `date_fin` date,
    `id_admin` INT(1),
    `id_formateur` INT(4),
    `id_formation` INT(4),
    FOREIGN KEY (`id_admin`) REFERENCES `admin`(`id_admin`),
    FOREIGN KEY (`id_formateur`) REFERENCES `formateur`(`id_formateur`),
    FOREIGN KEY (`id_formation`) REFERENCES `formation`(`id_aformation`)
); 


CREATE TABLE `stagiaire` (
    `id_stg` INT(4) AUTO_INCREMENT PRIMARY KEY,
    `nom_stg` VARCHAR(30) NOT NULL,
    `prenom_stg` varchar(30) NOT null,
     `email_stg`varchar(30) NOT null,
     `num_tel_stg` varchar(13) NOT null,
    `Mot_de_passe_stg` varchar(255),
    `id_admin` INT(1),
     FOREIGN KEY (`id_admin`) REFERENCES `admin`(`id_admin`)
);
CREATE TABLE `type_formation` (
    `id_tf` INT(4) AUTO_INCREMENT PRIMARY KEY,
    `nom_tf` VARCHAR(10) NOT NULL
    );




CREATE TABLE `formateur` (
    `id_formateur` INT(4) AUTO_INCREMENT PRIMARY KEY,
    `nom_formateur` VARCHAR(30) NOT NULL,
    `prenom_formateur` varchar(30) NOT null,
     `email_formateur`varchar(30) NOT null,
     `num_tel_formateur` varchar(13) NOT null,
    `id_admin` INT(1),
     FOREIGN KEY (`id_admin`) REFERENCES `admin`(`id_admin`)
);


CREATE TABLE `formation` (
    `id_formation` INT(4) AUTO_INCREMENT PRIMARY KEY,
    `nom_formation` VARCHAR(50) NOT NULL,
    `prenom_formation` varchar(30) NOT null,
     `cout_formation`decimal(5,2) NOT null,
     `duree_formation` varchar(5) NOT null,
    `id_tf` INT(4),
     FOREIGN KEY (`id_tf`) REFERENCES `type_formation`(`id_tf`)
);
CREATE TABLE `inscrit` (
    
    `id_stg` INT(4) NOT NULL,
    `id_session`  INT(4) NOT NULL,
    `statut_stg` VARCHAR(20) NULL,
    PRIMARY KEY (`id_stg`,`id_session`),
    FOREIGN KEY (`id_stg`) REFERENCES stagiaire(`id_stg`),
    FOREIGN KEY (`id_session`) REFERENCES session_formation(`id_session`)
);
    