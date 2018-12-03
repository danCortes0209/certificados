use certificados; 
drop table if exists asignaturas_alumno;
drop table if exists rvoe;
drop table if exists expedicion;
drop table if exists certificado;
drop table if exists plancarrera;
drop table if exists alumnos;
drop table if exists responsable;
drop table if exists carreras;
drop table if exists asignaturas;
drop table if exists ipes;

create table asignaturas (
    idasignatura int not null auto_increment,
    nombre varchar(50),
    descripcion varchar(100),
    PRIMARY KEY(idasignatura)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table carreras (
    idcarrera int not null auto_increment,
    nombre varchar(50),
    descripcion varchar(100),
    PRIMARY KEY(idcarrera)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table ipes (
    idipes int not null auto_increment,
    idnombreinstitucion int,
    idcampus int, 
    identidadfederativa int,
    nombre tinytext,
    PRIMARY KEY (idipes)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table alumnos (
    idalumno int not null auto_increment,
    numerocontrol char(50),
    fechanacimiento date,
    curp tinytext,
    nombre tinytext,
    appaterno tinytext,
    apmaterno tinytext,
    idgenero smallint DEFAULT 251,
    PRIMARY KEY(idalumno)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table plancarrera (
    idplan int not null auto_increment,
    idcarrera int DEFAULT 1,
    claveplan tinytext,
    idtipoperiodo int DEFAULT 91,
    idalumno int,
    PRIMARY KEY(idplan),
    FOREIGN KEY(idcarrera) REFERENCES carreras(idcarrera),
    FOREIGN KEY(idalumno) REFERENCES alumnos(idalumno)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table responsable (
    idresponsable int not null auto_increment,
    idipes int,
    curp tinytext,
    nombre tinytext,
    appaterno tinytext,
    apmaterno tinytext,
    contraseña varchar(60),
    usuario varchar(60),
    idcargo smallint default 5,
    PRIMARY KEY (idresponsable),
    FOREIGN KEY (idipes) REFERENCES ipes (idipes)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table asignaturas_alumno (
    idasignaturaalumno int not null auto_increment,
    idalumno int,
    idasignatura int,
    ciclo tinytext,
    calificacion float,
    observaciones mediumint default 100,
    PRIMARY KEY(idasignaturaalumno),
    FOREIGN KEY(idasignatura) REFERENCES asignaturas(idasignatura),
    FOREIGN KEY(idalumno) REFERENCES alumnos(idalumno)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table certificado (
    idcertificado int not null auto_increment,
    tipocertificado smallint,
    foliocontrol varchar(250),
    sello varchar(250),
    certresp varchar(250),
    nocertresp varchar(250),
    idresponsable int,
    idalumno int,
    PRIMARY KEY (idcertificado),
    FOREIGN KEY (idalumno) REFERENCES alumnos(idalumno),
    FOREIGN KEY (idresponsable) REFERENCES responsable(idresponsable)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


create table rvoe (
    idrvoe int not null auto_increment,
    numero int,
    fecha datetime,
    idcertificado int,
    PRIMARY KEY (idrvoe),
    FOREIGN KEY (idcertificado) REFERENCES certificado (idcertificado)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table expedicion (
    idexpedicion int not null auto_increment,
    idtipocertificacion int default 79,
    fecha datetime,
    entidadfederativa int,
    idcertificado int,
    PRIMARY KEY (idexpedicion),
    FOREIGN KEY (idcertificado) REFERENCES certificado (idcertificado)

) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO asignaturas (nombre, descripcion) VALUES ('Matematicas', 'Matematicas'), ('Español 1', 'Español 1');

INSERT INTO carreras (nombre, descripcion) VALUES ('Ingenieria en Sistemas', 'Ingenieria en Sistemas'), ('Contaduria', 'Contaduria'); 

INSERT INTO ipes VALUES (null, 14, 1, 13, 'utectulancingo');

INSERT INTO responsable VALUES (NULL, 1, 'HECO981124HHGRSS00', 'Daniel', 'Hernandez', 'Cortes', '123456', 'dancortes', 5);

