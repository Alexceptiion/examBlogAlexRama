#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: Categorie
#------------------------------------------------------------

CREATE TABLE Categorie(
        idCategorie          Int  Auto_increment  NOT NULL ,
        nomCategorie         Varchar (150) NOT NULL ,
        descriptionCategorie Varchar (150) NOT NULL
	,CONSTRAINT Categorie_PK PRIMARY KEY (idCategorie)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Article
#------------------------------------------------------------

CREATE TABLE Article(
        idArticle              Int  Auto_increment  NOT NULL ,
        titreArticle           Varchar (150) NOT NULL ,
        dateCreationArticle    Date NOT NULL ,
        datePublicationArticle Date NOT NULL ,
        statutArticle          Bool NOT NULL ,
        contenuArticle         Text NOT NULL ,
        idCategorie            Int
	,CONSTRAINT Article_PK PRIMARY KEY (idArticle)

	,CONSTRAINT Article_Categorie_FK FOREIGN KEY (idCategorie) REFERENCES Categorie(idCategorie)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Tag
#------------------------------------------------------------

CREATE TABLE Tag(
        idTags         Int  Auto_increment  NOT NULL ,
        nomTag         Varchar (150) NOT NULL ,
        descriptionTag Varchar (150) NOT NULL
	,CONSTRAINT Tag_PK PRIMARY KEY (idTags)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Contenir
#------------------------------------------------------------

CREATE TABLE Contenir(
        idTags    Int NOT NULL ,
        idArticle Int NOT NULL
	,CONSTRAINT Contenir_PK PRIMARY KEY (idTags,idArticle)

	,CONSTRAINT Contenir_Tag_FK FOREIGN KEY (idTags) REFERENCES Tag(idTags)
	,CONSTRAINT Contenir_Article0_FK FOREIGN KEY (idArticle) REFERENCES Article(idArticle)
)ENGINE=InnoDB;

