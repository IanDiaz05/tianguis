use tianguis;

# INSERTAR DATOS DE PRUEBA

-- Insertar un vendedor
INSERT INTO vendedor (nombre, apellido, email, telefono, password) VALUES 
('Ian', 'Diaz', 'ian.diaz@example.com', '555-1234', 'password123'),
('Ana', 'Lopez', 'ana.lopez@example.com', '555-5678', 'password456'),
('Carlos', 'Martinez', 'carlos.martinez@example.com', '555-8765', 'password789'),
('Maria', 'Gomez', 'maria.gomez@example.com', '555-4321', 'password101');

-- Insertar un puesto
INSERT INTO puesto (nombre, descripcion_corta, descripcion_larga, vendedor_id) VALUES 
('Stickers Store', 'Todo tipo de stickers', 'Ofrecemos un amplio catalogo de todo tipo de stickers de todos los tamanos, colores y categorias, tambien manejamos pedidos de stickers personalizados, puedes contactarnos por cualquier medio disponible!.', 1),
('Artesanías Mayas', 'Artesanías tradicionales', 'Ofrecemos una variedad de artesanías tradicionales mayas, incluyendo textiles, cerámica y joyería.', 2),
('Delicias Veganas', 'Comida vegana', 'Deliciosa comida vegana hecha con ingredientes frescos y locales. Ofrecemos una variedad de platillos saludables y sabrosos.', 3),
('Libros Usados', 'Venta de libros usados', 'Gran selección de libros usados en buen estado. Encuentra tus títulos favoritos a precios accesibles.', 4);

-- Insertar contactos del puesto
INSERT INTO contacto_puesto (tipo, url, puesto_id) VALUES 
('facebook', 'https://facebook.com/puestoartesanias', 1),
('whatsapp', 'https://wa.me/5551234', 1),
('telefono', '555-1234', 1),
('instagram', 'https://instahgram.com', 1),
('email', 'gmail.com', 1),

('facebook', 'https://facebook.com/artesaniasmayas', 2),
('whatsapp', 'https://wa.me/5555678', 2),
('telefono', '555-5678', 2),
('email', 'contacto@artesaniasmayas.com', 2),

('facebook', 'https://facebook.com/deliciasveganas', 3),
('instagram', 'https://instagram.com/deliciasveganas', 3),

('facebook', 'https://facebook.com/librosusados', 4),
('whatsapp', 'https://wa.me/5554321', 4),
('telefono', '555-4321', 4),
('instagram', 'https://instagram.com/librosusados', 4),
('email', 'contacto@librosusados.com', 4),
('pagina web', 'https://librosusados.com', 4);

-- Insertar productos del puesto
INSERT INTO producto (nombre, descripcion, precio, puesto_id, img) VALUES 
('Los simpsons', 'paquete de +100 stickers de los simpsons', 50, 1, 'https://m.media-amazon.com/images/I/81Q63QbF7WL.jpg'),
('sanrio', 'paquete de 10 stickers de tus personajes favorios de sanrio', 20, 1, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTvrvtld_96xnIZ-iman7F0Lx0g0MvAJlEP5A&s'),
('Paquete 1', 'Paquete de 10 stickers personalizados', 40, 1, 'https://m.media-amazon.com/images/I/716e9fXREoL._AC_UF894,1000_QL80_.jpg'),
('Paquete 2', 'Paquete de 50 stickers personalizados', 60, 1, 'https://m.media-amazon.com/images/I/716e9fXREoL._AC_UF894,1000_QL80_.jpg'),
('PERSONALIZADO', 'Paquete de stickers personalizados, cualquier cantidad (precio variable)', null, 1, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ7cz6fEqyLUNg45ezwpSQS6Df97BN1D9jO6g&s'),

('Textiles Mayas', 'Hermosos textiles hechos a mano.', 200, 2, 'https://www.guioteca.com/manualidades-y-artesania/files/2014/05/tejidos-maya-1.jpg'),
('Joyería Maya', 'Joyería tradicional hecha a mano.', 150, 2, 'https://img.optimalcdn.com/www.posta.com.mx/2023/08/c48d7e496dda5591bfece383006ab51a1a818b80/WhatsApp_Image_2023-08-07_at_8.37.00_PM.webp'),
('Cerámica Maya', 'Cerámica pintada a mano.', 300, 2, 'https://live.staticflickr.com/65535/48173650751_61f7c953b5_b.jpg'),

('Hamburguesa Vegana', 'Hamburguesa hecha con ingredientes frescos y veganos.', 50, 3, 'https://www.larecetafacil.com/wp-content/uploads/2023/08/hamburguesas-veganas-receta.jpg'),
('Ensalada Vegana', 'Ensalada fresca con ingredientes locales.', 30, 3, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTMcPwx6Kd1tlncia8QkwMeqis95I59kHzh2w&s'),
('Tacos Veganos', 'Tacos deliciosos y saludables.', 40, 3, 'https://cdn.recetasderechupete.com/wp-content/uploads/2020/01/tacos-veganos.jpg'),

('Novelas', 'Gran selección de novelas usadas.', 100, 4, 'https://i.etsystatic.com/13861140/r/il/804f96/3286307277/il_fullxfull.3286307277_iuom.jpg'),
('Libros de Texto', 'Libros de texto usados en buen estado.', 80, 4, 'https://storage.googleapis.com/www-paredro-com/uploads/2019/08/%E2%96%B7-Portadas-de-los-libros-de-texto-gratuitos-de-la-SEP-1960-201913-1068x941.png'),
('Cómics', 'Cómics usados en buen estado.', 60, 4, 'https://imagenes.20minutos.es/files/image_1920_1080/uploads/imagenes/2023/06/14/tres-portadas.jpeg');

-- Insertar imagenes del puesto
insert into imagenes_puesto (puesto_id,url) values
(1, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTtX2HaNBfPF1F4AZ3RFg9M-S_x9mWvpMDOPw&s'),
(1, 'https://noticaribepeninsular.com.mx/wp-content/uploads/2022/08/photo_5183831359846722241_y.jpg'),
(1, 'https://thumbs.dreamstime.com/z/varios-stickers-locales-en-un-puesto-al-aire-libre-la-tienda-se%C3%BAl-corea-del-sur-de-noviembre-una-el-distrito-myeong-dong-ciudad-164670399.jpg'),

(2, 'https://i.ytimg.com/vi/Fh88roHHmT0/hqdefault.jpg'),
(2, 'https://www.guioteca.com/manualidades-y-artesania/files/2014/05/tejidos-maya-1.jpg'),
(2, 'https://live.staticflickr.com/65535/48173650751_61f7c953b5_b.jpg'),

(3, 'https://img.lajornadamaya.mx/75411695252120Tianguis-del-mayab.jpeg'),
(3, 'https://cdn.recetasderechupete.com/wp-content/uploads/2020/01/tacos-veganos.jpg'),

(4, 'https://noticaribepeninsular.com.mx/wp-content/uploads/2022/08/photo_5183831359846722241_y-1024x768.jpg'),
(4, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQRyFnyiZDQ_nWf_-mDa0SUi7HUlx_y_-c71w&s');


-- horario del puesto
INSERT INTO horario_puesto (dia, hora_inicio, hora_fin, puesto_id) values
('lunes', '10:00:00', '12:00:00', 1),
('martes', '11:00:00', '14:00:00', 1),
('viernes', '14:00:00', '16:00:00', 1),

('lunes', '09:00:00', '17:00:00', 2),
('martes', '09:00:00', '17:00:00', 2),
('miércoles', '09:00:00', '17:00:00', 2),

('jueves', '10:00:00', '18:00:00', 3),
('viernes', '10:00:00', '18:00:00', 3),
('sábado', '10:00:00', '18:00:00', 3),

('lunes', '08:00:00', '16:00:00', 4),
('miércoles', '08:00:00', '16:00:00', 4),
('viernes', '08:00:00', '16:00:00', 4);
