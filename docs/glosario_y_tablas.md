1. Pasaje a Tablas
roles: (id_rol [PK], nombre_rol, descripcion)

usuarios: (id_usuario [PK], nombre, apellido, email, password, id_rol [FK -> roles.id_rol])

autores: (id_autor [PK], nombre_autor, biografia, foto)

categorias: (id_categoria [PK], nombre_categoria)

libros: (id_libro [PK], titulo, precio, stock, portada, id_autor [FK -> autores.id_autor], id_categoria [FK -> categorias.id_categoria])

prestamos: (id_prestamo [PK], id_usuario [FK -> usuarios.id_usuario], id_libro [FK -> libros.id_libro], fecha_prestamo, fecha_devolucion, estado)

2. Glosario de Datos 
Entidad: roles
Tipo entidad: Maestra

Descripción: Tabla independiente que guarda los tipos de roles de la app para saber si el usuario es administrador o un lector común.

Datos:

[id_rol (int ai, pk), nombre_rol (varchar(50)), descripcion (varchar(255) null)]

Entidad: usuarios
Tipo entidad: Subordinada (roles)

Descripción: Guarda los datos personales de la gente que se registra en la página, su mail, contraseña cifrada y qué rol tiene asignado.

Datos:

[id_usuario (int ai, pk), nombre (varchar(100)), apellido (varchar(100)), email (varchar(100)), password (varchar(255)), id_rol (int foranea roles:id_rol)]

Entidad: autores
Tipo entidad: Maestra

Descripción: Catálogo donde se guardan los datos de los escritores de los libros, con su biografía y foto.

Datos:

[id_autor (int ai, pk), nombre_autor (varchar(100)), biografia (text null), foto (varchar(255) null)]

Entidad: categorias
Tipo entidad: Maestra

Descripción: Lista de los distintos géneros o categorías literarias para organizar el catálogo de la biblioteca.

Datos:

[id_categoria (int ai, pk), nombre_categoria (varchar(50))]

Entidad: libros
Tipo entidad: Subordinada (autores, categorias)

Descripción: Es la tabla principal del catálogo. Almacena cada libro con su título, precio, stock, imagen de portada y los links al autor y a la categoría correspondiente.

Datos:

[id_libro (int ai, pk), titulo (varchar(150)), precio (decimal(10,2)), stock (int), portada (varchar(255) null), id_autor (int foranea autores:id_autor), id_categoria (int foranea categorias:id_categoria)]

Entidad: prestamos
Tipo entidad: Subordinada (usuarios, libros)

Descripción: Tabla transaccional para controlar los préstamos que hacen los usuarios de los libros, registrando las fechas y si el libro fue devuelto o sigue activo.

Datos:

[id_prestamo (int ai, pk), id_usuario (int foranea usuarios:id_usuario), id_libro (int foranea libros:id_libro), fecha_prestamo (date), fecha_devolucion (date null), estado (varchar(30))]