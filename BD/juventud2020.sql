#drop database if exists juventud2020; #PELIGROSO !!!
create database juventud2020;
use juventud2020;

create table usuarios(

id_usuario  int auto_increment primary key,
tipo_usuario char(3),
nombre_usuario varchar(20),
apellido_usuario  varchar(20),
username_usuario varchar(20),
contrasena_usuario char(32)

);


create table calendario(
	
    #generales
	
	id_evento int auto_increment primary key,
    nombre_evento varchar(30),
    descripcion_evento text,
    categoria_evento char(3),
    fecha_evento date,
    hora_evento time,
    fecha_publicacion timestamp default current_timestamp,

	#falta agregar un posible campo para saber el color dentro del calendario <-
    
    #verificacion de subida (HACER CON UPDATE)
    
    estado bool,
    
	#llaves foraneas
    
    id_redactor int,
    foreign key (id_redactor) references usuarios(id_usuario)
    
   

);


create table noticias(

	#generales

	id_noticia int auto_increment primary key,
    titulo_noticia varchar(30),
    contenido_noticia text,
    fecha_publicacion timestamp default current_timestamp,
    
    #verificacion de subida (HACER CON UPDATE)
    
    estado bool,
    
    #llaves foraneas
    
    id_redactor int,
    foreign key (id_redactor) references usuarios(id_usuario)
    
    #referencias IMAGENES
         
);


create table imagenes(

	#generales
	
	id_imagen int auto_increment primary key,
    
#por ver que tipo de archivo se almacenara             
    #extension_imagen varchar(10),
    #nombre_imagen varchar(100),
    #imagen blob,
    
    # referencia a NOTICIAS
    
    id_noticia int,
    foreign key (id_noticia) references noticias(id_noticia)
    

);