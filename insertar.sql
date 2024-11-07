use tianguis;

# INSERTAR DATOS DE PRUEBA

-- Insertar un vendedor
INSERT INTO vendedor (nombre, apellido, email, telefono, password) VALUES 
('Ian', 'Garcia', 'ian.diaz@example.com', '555-1234', 'password123');

-- Insertar un puesto
INSERT INTO puesto (nombre, descripcion_corta, descripcion_larga, vendedor_id) VALUES 
('Stickers Store', 'Todo tipo de stickers', 'Ofrecemos un amplio catalogo de todo tipo de stickers de todos los tamanos, colores y categorias, tambien manejamos pedidos de stickers personalizados, puedes contactarnos por cualquier medio disponible!.', 3);

-- Insertar contactos del puesto
INSERT INTO contacto_puesto (tipo, url, puesto_id) VALUES 
('facebook', 'https://facebook.com/puestoartesanias', 3),
('whatsapp', 'https://wa.me/5551234', 3),
('telefono', '555-1234', 3),
('instagram', 'https://instahgram.com', 3),
('email', 'gmail.com', 3),

-- Insertar productos del puesto
INSERT INTO producto (nombre, descripcion, precio, puesto_id, img) VALUES 
('Los simpsons', 'paquete de +100 stickers de los simpsons', 50, 3, 'https://m.media-amazon.com/images/I/81Q63QbF7WL.jpg'),
('sanrio', 'paquete de 10 stickers de tus personajes favorios de sanrio', 20, 3, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTvrvtld_96xnIZ-iman7F0Lx0g0MvAJlEP5A&s'),
('Paquete 1', 'Paquete de 10 stickers personalizados', 40, 3, 'https://m.media-amazon.com/images/I/716e9fXREoL._AC_UF894,1000_QL80_.jpg'),
('Paquete 2', 'Paquete de 50 stickers personalizados', 60, 3, 'https://m.media-amazon.com/images/I/716e9fXREoL._AC_UF894,1000_QL80_.jpg'),
('PERSONALIZADO', 'Paquete de stickers personalizados, cualquier cantidad (precio variable)', null, 3, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ7cz6fEqyLUNg45ezwpSQS6Df97BN1D9jO6g&s');

-- Insertar imagenes del puesto
insert into imagenes_puesto (puesto_id,url) values
(3, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTtX2HaNBfPF1F4AZ3RFg9M-S_x9mWvpMDOPw&s'),
(3, 'https://noticaribepeninsular.com.mx/wp-content/uploads/2022/08/photo_5183831359846722241_y.jpg'),
(3, 'https://thumbs.dreamstime.com/z/varios-stickers-locales-en-un-puesto-al-aire-libre-la-tienda-se%C3%BAl-corea-del-sur-de-noviembre-una-el-distrito-myeong-dong-ciudad-164670399.jpg');

-- horario del puesto
INSERT INTO horario_puesto (dia, hora_inicio, hora_fin, puesto_id) values
('lunes', '10:00:00', '12:00:00', 2),
('martes', '11:00:00', '14:00:00'),
('viernes', '14:00:00', '16:00:00');

select * from puesto where id = 2;