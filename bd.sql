/* DROP */
/*
ALTER TABLE ParejaidPareja1 DROP FOREIGN KEY FKPareja1;
ALTER TABLE ParejaidPareja2 DROP FOREIGN KEY FKPareja2;
ALTER TABLE Enfrentamiento DROP FOREIGN KEY FKEnfrentami527261;
ALTER TABLE Enfrentamiento DROP FOREIGN KEY FKEnfrentami435037;
ALTER TABLE Grupo DROP FOREIGN KEY FKGrupo875320;
ALTER TABLE Clasificacion DROP FOREIGN KEY FKClasificac524722;
ALTER TABLE Clasificacion_Grupo DROP FOREIGN KEY FKClasificac658671;
ALTER TABLE Clasificacion_Grupo DROP FOREIGN KEY FKClasificac853250;
ALTER TABLE Campeonato_Categoria DROP FOREIGN KEY FKCampeonato73800;
ALTER TABLE Campeonato_Categoria DROP FOREIGN KEY FKCampeonato419290;
DROP TABLE IF EXISTS Campeonato;
DROP TABLE IF EXISTS Campeonato_Categoria;
DROP TABLE IF EXISTS Categoria;
DROP TABLE IF EXISTS Clasificacion;
DROP TABLE IF EXISTS Clasificacion_Grupo;
DROP TABLE IF EXISTS Enfrentamiento;
DROP TABLE IF EXISTS Grupo;
DROP TABLE IF EXISTS Pareja;
DROP TABLE IF EXISTS UsuarioRegistrado;*/

/* CREATE */
CREATE TABLE Campeonato (
  idCampeonato int(4) NOT NULL AUTO_INCREMENT,
  fechaInicio  datetime NOT NULL,
  fechaFin     datetime NOT NULL,
  PRIMARY KEY (idCampeonato));
CREATE TABLE Campeonato_Categoria (
  CampeonatoidCampeonato int(4) NOT NULL,
  CategoriaidCategoria   int(4) NOT NULL,
  PRIMARY KEY (CampeonatoidCampeonato,
  CategoriaidCategoria));
CREATE TABLE Categoria (
  idCategoria      int(4) NOT NULL AUTO_INCREMENT,
  nivel            int(1) NOT NULL,
  tipo             varchar(10) NOT NULL,
  maxParticipantes int(2) NOT NULL,
  PRIMARY KEY (idCategoria));
CREATE TABLE Clasificacion (
  idClasificacion int(4) NOT NULL AUTO_INCREMENT,
  ParejaidPareja  int(4) NOT NULL,
  resultado       int(3),
  PRIMARY KEY (idClasificacion));
CREATE TABLE Clasificacion_Grupo (
  ClasificacionidClasificacion int(4) NOT NULL,
  GrupoidGrupo                 int(4) NOT NULL,
  GrupotipoLiga                varchar(10) NOT NULL,
  PRIMARY KEY (ClasificacionidClasificacion,
  GrupoidGrupo,
  GrupotipoLiga));
CREATE TABLE Enfrentamiento (
  idEnfrentamiento int(4) NOT NULL AUTO_INCREMENT,
  ParejaidPareja1 int(4) NOT NULL,
  ParejaidPareja2 int(4) NOT NULL,
  resultado        int(3),
  set1             varchar(3),
  set2             varchar(3),
  set3             varchar(3),
  GrupoidGrupo     int(4) NOT NULL,
  GrupotipoLiga    varchar(10) NOT NULL,
  PRIMARY KEY (idEnfrentamiento));
CREATE TABLE Grupo (
  idGrupo                                    int(4) NOT NULL UNIQUE,
  tipoLiga                                   varchar(10) NOT NULL,
  Campeonato_CategoriaCampeonatoidCampeonato int(4) NOT NULL,
  Campeonato_CategoriaCategoriaidCategoria   int(4) NOT NULL,
  PRIMARY KEY (idGrupo,
  tipoLiga));
CREATE TABLE Pareja (
  idPareja      int(4) NOT NULL AUTO_INCREMENT,
  capitan       varchar(20) NOT NULL UNIQUE,
  deportista    varchar(20) NOT NULL UNIQUE,
  GrupoidGrupo  int(4) NOT NULL,
  GrupotipoLiga varchar(10) NOT NULL,
  PRIMARY KEY (idPareja));
CREATE TABLE UsuarioRegistrado (
  usuario     varchar(20) NOT NULL,
  password    varchar(20) NOT NULL,
  nombre      varchar(20) NOT NULL,
  apellido    varchar(40) NOT NULL,
  tipoUsuario varchar(15) NOT NULL,
  PRIMARY KEY (usuario));
ALTER TABLE Pareja ADD CONSTRAINT FKPareja602943 FOREIGN KEY (GrupoidGrupo, GrupotipoLiga) REFERENCES Grupo (idGrupo, tipoLiga);
ALTER TABLE Enfrentamiento ADD CONSTRAINT FKEnfrentami527261 FOREIGN KEY (GrupoidGrupo, GrupotipoLiga) REFERENCES Grupo (idGrupo, tipoLiga);
ALTER TABLE Enfrentamiento ADD CONSTRAINT FKEnfrentami435037 FOREIGN KEY (ParejaidPareja) REFERENCES Pareja (idPareja);
ALTER TABLE Grupo ADD CONSTRAINT FKGrupo875320 FOREIGN KEY (Campeonato_CategoriaCampeonatoidCampeonato, Campeonato_CategoriaCategoriaidCategoria) REFERENCES Campeonato_Categoria (CampeonatoidCampeonato, CategoriaidCategoria);
ALTER TABLE Clasificacion ADD CONSTRAINT FKClasificac524722 FOREIGN KEY (ParejaidPareja) REFERENCES Pareja (idPareja);
ALTER TABLE Clasificacion_Grupo ADD CONSTRAINT FKClasificac658671 FOREIGN KEY (ClasificacionidClasificacion) REFERENCES Clasificacion (idClasificacion);
ALTER TABLE Clasificacion_Grupo ADD CONSTRAINT FKClasificac853250 FOREIGN KEY (GrupoidGrupo, GrupotipoLiga) REFERENCES Grupo (idGrupo, tipoLiga);
ALTER TABLE Campeonato_Categoria ADD CONSTRAINT FKCampeonato73800 FOREIGN KEY (CampeonatoidCampeonato) REFERENCES Campeonato (idCampeonato);
ALTER TABLE Campeonato_Categoria ADD CONSTRAINT FKCampeonato419290 FOREIGN KEY (CategoriaidCategoria) REFERENCES Categoria (idCategoria);
ALTER TABLE Enfrentamiento ADD CONSTRAINT FKPareja1 FOREIGN KEY (ParejaidPareja1) REFERENCES Pareja(idPareja);
ALTER TABLE Enfrentamiento ADD CONSTRAINT FKPareja2 FOREIGN KEY (ParejaidPareja2) REFERENCES Pareja(idPareja);

/* INSERT */

/* usuarios registrados */
INSERT INTO `UsuarioRegistrado` (`usuario`, `password`, `nombre`, `apellido`, `tipoUsuario`) VALUES ('pmperez', 'purple', 'Patricia', 'Martin', 'deportista');

INSERT INTO `UsuarioRegistrado` (`usuario`, `password`, `nombre`, `apellido`, `tipoUsuario`) VALUES ('vfvarela', 'purple', 'Victor', 'Fernandez', 'deportista');

INSERT INTO `UsuarioRegistrado` (`usuario`, `password`, `nombre`, `apellido`, `tipoUsuario`) VALUES ('pepe', 'purple', 'Pepito', 'Grillo', 'deportista');

INSERT INTO `UsuarioRegistrado` (`usuario`, `password`, `nombre`, `apellido`, `tipoUsuario`) VALUES ('irpereira', 'purple', 'Ignacio', 'Rodriguez', 'deportista');

INSERT INTO `UsuarioRegistrado` (`usuario`, `password`, `nombre`, `apellido`, `tipoUsuario`) VALUES ('elena', 'purple', 'Elena', 'Fernandez', 'deportista');

INSERT INTO `UsuarioRegistrado` (`usuario`, `password`, `nombre`, `apellido`, `tipoUsuario`) VALUES ('mario', 'purple', 'Mario', 'Sanchez', 'deportista');

INSERT INTO `UsuarioRegistrado` (`usuario`, `password`, `nombre`, `apellido`, `tipoUsuario`) VALUES ('miguel', 'purple', 'Miguel', 'Sanchez', 'deportista');

INSERT INTO `UsuarioRegistrado` (`usuario`, `password`, `nombre`, `apellido`, `tipoUsuario`) VALUES ('ana', 'purple', 'Ana', 'Martinez', 'deportista');

/* campeonato */
INSERT INTO `Campeonato` (`idCampeonato`, `fechaInicio`, `fechaFin`) VALUES ('1', '2018-11-12 00:00:00', '2018-11-19 00:00:00');
INSERT INTO `Campeonato` (`idCampeonato`, `fechaInicio`, `fechaFin`) VALUES ('2', '2018-12-20 00:00:00', '2018-01-15 00:00:00');

/* categoria */
INSERT INTO `Categoria` (`idCategoria`, `nivel`, `tipo`, `maxParticipantes`) VALUES ('0001', '1', 'mixto', '12');
INSERT INTO `Categoria` (`idCategoria`, `nivel`, `tipo`, `maxParticipantes`) VALUES ('2', '1', 'femenino', '12');

/* campeonato_categoria */
INSERT INTO `Campeonato_Categoria` (`CampeonatoidCampeonato`, `CategoriaidCategoria`) VALUES ('1', '2');
INSERT INTO `Campeonato_Categoria` (`CampeonatoidCampeonato`, `CategoriaidCategoria`) VALUES ('1', '1');
INSERT INTO `Campeonato_Categoria` (`CampeonatoidCampeonato`, `CategoriaidCategoria`) VALUES ('2', '2');
INSERT INTO `Campeonato_Categoria` (`CampeonatoidCampeonato`, `CategoriaidCategoria`) VALUES ('2', '1');

/* clasificacion */
INSERT INTO `Clasificacion` (`idClasificacion`, `ParejaidPareja`) VALUES ('1', NULL);
INSERT INTO `Clasificacion` (`idClasificacion`, `ParejaidPareja`) VALUES ('2', NULL);
INSERT INTO `Clasificacion` (`idClasificacion`, `ParejaidPareja`) VALUES ('3', NULL);

/* grupo */
INSERT INTO `Grupo` (`idGrupo`,`tipoLiga`, `Campeonato_CategoriaCampeonatoidCampeonato`, `Campeonato_CategoriaCategoriaidCategoria`) VALUES ('1', 'regular', '1', '1');
INSERT INTO `Grupo` (`idGrupo`, `tipoLiga`, `Campeonato_CategoriaCampeonatoidCampeonato`, `Campeonato_CategoriaCategoriaidCategoria`) VALUES ('2', 'cuartos', '1', '1');
INSERT INTO `Grupo` (`idGrupo`, `tipoLiga`, `Campeonato_CategoriaCampeonatoidCampeonato`, `Campeonato_CategoriaCategoriaidCategoria`) VALUES ('3', 'regular','2', '1');

/* grupo_clasificacion*/
INSERT INTO Clasificacion (ClasificacionidClasificacion, GrupoidGrupo, GrupotipoLiga) VALUES ('1', '1', 'regular');
INSERT INTO Clasificacion (ClasificacionidClasificacion, GrupoidGrupo, GrupotipoLiga) VALUES ('2', '1', 'cuartos');
INSERT INTO Clasificacion (ClasificacionidClasificacion, GrupoidGrupo, GrupotipoLiga) VALUES ('3', '1', 'regular');

/* pareja */
INSERT INTO `Pareja` (`idPareja`, `capitan`, `deportista`, `GrupoidGrupo`, `GrupotipoLiga`) VALUES ('1', 'pmperez', 'pepe', '1', 'regular');
INSERT INTO `Pareja` (`idPareja`, `capitan`, `deportista`, `GrupoidGrupo`, `GrupotipoLiga`) VALUES ('2', 'vfvarela', 'irpereira', '1', 'regular');
INSERT INTO `Pareja` (`idPareja`, `capitan`, `deportista`, `GrupoidGrupo`, `GrupotipoLiga`) VALUES ('3', 'elena', 'mario', '1', 'regular');
INSERT INTO `Pareja` (`idPareja`, `capitan`, `deportista`, `GrupoidGrupo`, `GrupotipoLiga`) VALUES ('4', 'miguel', 'ana', '1', 'regular');


/* enfrentamiento */
INSERT INTO `Enfrentamiento` (`idEnfrentamiento`, `ParejaidPareja1`, `ParejaidPareja2`, `resultado`, `set1`, `set2`, `set3`, `GrupoidGrupo`) VALUES ('1', '1', '2', NULL, NULL, NULL, NULL, '1');
INSERT INTO `Enfrentamiento` (`idEnfrentamiento`, `ParejaidPareja1`, `ParejaidPareja2`, `resultado`, `set1`, `set2`, `set3`, `GrupoidGrupo`) VALUES ('3', '2', '1', NULL, NULL, NULL, NULL, '1');
INSERT INTO `Enfrentamiento` (`idEnfrentamiento`, `ParejaidPareja1`, `ParejaidPareja2`, `resultado`, `set1`, `set2`, `set3`, `GrupoidGrupo`) VALUES ('2', '3','4', NULL, NULL, NULL, NULL, '1');
INSERT INTO `Enfrentamiento` (`idEnfrentamiento`, `ParejaidPareja1`, `ParejaidPareja2`, `resultado`, `set1`, `set2`, `set3`, `GrupoidGrupo`) VALUES ('4', '4','3', NULL, NULL, NULL, NULL, '1');
INSERT INTO `Enfrentamiento` (`idEnfrentamiento`, `ParejaidPareja1`, `ParejaidPareja2`, `resultado`, `set1`, `set2`, `set3`, `GrupoidGrupo`) VALUES ('5', '1','3', NULL, NULL, NULL, NULL, '1');
INSERT INTO `Enfrentamiento` (`idEnfrentamiento`, `ParejaidPareja1`, `ParejaidPareja2`, `resultado`, `set1`, `set2`, `set3`, `GrupoidGrupo`) VALUES ('6', '1','2', NULL, NULL, NULL, NULL, '1');
