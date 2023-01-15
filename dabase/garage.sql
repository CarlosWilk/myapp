-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 15-Jan-2023 às 19:09
-- Versão do servidor: 10.4.27-MariaDB
-- versão do PHP: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `garage`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `timeslot` varchar(100) NOT NULL,
  `vehicle_type` int(11) NOT NULL,
  `vehicle_license` varchar(11) NOT NULL,
  `engine_type` int(11) NOT NULL,
  `booking_type` int(11) NOT NULL,
  `comments` varchar(200) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `username_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `bookings`
--

INSERT INTO `bookings` (`id`, `name`, `phone`, `email`, `date`, `timeslot`, `vehicle_type`, `vehicle_license`, `engine_type`, `booking_type`, `comments`, `status`, `username_id`) VALUES
(20, 'Mario Bros', '083 999 9999', 'mario@test.com', '2022-12-29', '11.00AM-13:00PM', 1, '05-D-12345', 1, 1, 'Dead Battery', 4, 4),
(21, 'Augusto Torres', '083 999 9933', 'augusto@test.com', '2022-12-29', '13.00PM-15:00PM', 1, '05-D-54321', 1, 1, 'Broken lantern', 2, 8),
(22, 'Flavia de Oliveira', '083 999 9997', 'flavia@test.com', '2022-12-29', '15.00PM-17:00PM', 1, '05-D-12387', 1, 1, 'lateral amasada', 2, 7),
(23, 'Flavia de Oliveira', '083 999 9998', 'flavia@test.com', '2022-12-31', '15.00PM-17:00PM', 1, '05-D-12387', 1, 1, 'Dead Battery', 4, 7),
(24, 'Flavia de Oliveira', '083 999 9998', 'flavia@test.com', '2022-12-31', '13.00PM-15:00PM', 1, '05-D-12387', 1, 3, 'Broken lantern', 1, 7),
(25, 'Mario', '083 999 9996', 'mario@test.com', '2023-01-03', '09.00AM-11:00AM', 1, '23-E-12387', 1, 1, 'accelerator is not working', 4, 4),
(26, 'Flavia de Oliveira', '083 999 9998', 'flavia@test.com', '2023-01-06', '13.00PM-15:00PM', 1, '05-D-12387', 1, 1, 'accelerator is not working', 1, 7),
(27, 'Flavia de Oliveira', '083 999 9998', 'flavia@test.com', '2023-01-06', '15.00PM-17:00PM', 1, '05-D-12387', 1, 3, 'Squeaking Brakes', 4, 7),
(32, 'CARLOS WILKER', '123', 'carloswilkersp@hotmail.com', '2023-01-07', '11.00AM-13:00PM', 1, '123', 1, 1, '123', 1, 1),
(33, 'Flavia de Oliveira', '083 999 9998', 'flavia@test.com', '2023-01-12', '09.00AM-11:00AM', 1, '05-D-12387', 1, 1, 'Dead Battery', 1, 7),
(34, 'Mary Anne', '083 999 1188', 'marya@test.com', '2023-01-17', '11.00AM-13:00PM', 1, '22-BR-9838', 1, 1, 'Dead Battery', 1, 9),
(35, 'Mario Bros', '082 010 1232', 'mario@test.com', '2023-01-20', '11.00AM-13:00PM', 30, '23-01-1BW8', 1, 3, 'driver side window not going down', 2, 4),
(36, 'Carlos Wilker', '083 999 9989', 'carloswilkersp@hotmail.com', '2023-01-17', '15.00PM-17:00PM', 1, '23-01-ABCD', 1, 1, 'Dead Battery', 3, 11),
(37, 'Carlos Wilker', '083 999 9986', 'carloswilkersp@hotmail.com', '2023-01-18', '09.00AM-11:00AM', 1, '23-E-1245G', 1, 1, 'I do not know the problem. It noising', 2, 11),
(38, 'Maria Costa', '083 999 9909', 'mariac@gmail.com', '2023-01-19', '09.00AM-11:00AM', 1, '05-D-345hg', 1, 1, 'oil leaking', 5, 12),
(39, 'Carlos Paulino', '083 999 0000', 'carlos@test.com', '2023-01-21', '13.00PM-15:00PM', 1, '23-DGFD-234', 1, 1, 'BREAKING pedals not working properly', 2, 13);

-- --------------------------------------------------------

--
-- Estrutura da tabela `booking_status`
--

CREATE TABLE `booking_status` (
  `status_id` int(11) NOT NULL,
  `status_desc` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `booking_status`
--

INSERT INTO `booking_status` (`status_id`, `status_desc`) VALUES
(1, 'Booked'),
(2, 'In Service'),
(3, 'Fixed / Completed'),
(4, 'Collected'),
(5, 'Unrepairable');

-- --------------------------------------------------------

--
-- Estrutura da tabela `booking_type`
--

CREATE TABLE `booking_type` (
  `id` int(11) NOT NULL,
  `booking_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `booking_type`
--

INSERT INTO `booking_type` (`id`, `booking_name`) VALUES
(1, 'Annual Service'),
(2, 'Major Service'),
(3, 'Repair'),
(4, 'Major Repair');

-- --------------------------------------------------------

--
-- Estrutura da tabela `invoice_order`
--

CREATE TABLE `invoice_order` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `booking_id` int(11) NOT NULL,
  `mechanic_id` int(11) NOT NULL,
  `order_receiver_name` varchar(250) NOT NULL,
  `order_receiver_address` text NOT NULL COMMENT 'Phone number',
  `order_total_before_tax` decimal(10,2) NOT NULL,
  `order_total_tax` decimal(10,2) NOT NULL,
  `service_fee` double(10,2) NOT NULL,
  `order_tax_per` varchar(250) NOT NULL,
  `order_total_after_tax` double(10,2) NOT NULL,
  `order_amount_paid` decimal(10,2) NOT NULL,
  `order_total_amount_due` decimal(10,2) NOT NULL,
  `note` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Extraindo dados da tabela `invoice_order`
--

INSERT INTO `invoice_order` (`order_id`, `user_id`, `order_date`, `booking_id`, `mechanic_id`, `order_receiver_name`, `order_receiver_address`, `order_total_before_tax`, `order_total_tax`, `service_fee`, `order_tax_per`, `order_total_after_tax`, `order_amount_paid`, `order_total_amount_due`, `note`) VALUES
(685, 123456, '2023-01-08 12:19:21', 0, 3, 'Mario Bros', '082 010 1232', '638.00', '31.90', 0.00, '5', 669.90, '0.00', '669.90', 'Changed suspension'),
(686, 123456, '2023-01-11 20:24:01', 0, 1, 'Flavia de Oliveira', '083 999 9998', '530.00', '53.00', 0.00, '10', 743.00, '100.00', '643.00', 'Small repair'),
(687, 123456, '2023-01-11 20:43:19', 0, 2, 'Mary Anne', '080 999 8888', '177.00', '0.00', 0.00, '0', 177.00, '0.00', '177.00', 'Ready to collection'),
(689, 123456, '2023-01-14 23:26:29', 0, 1, 'Mario Bros', '082 010 1232', '72.00', '3.60', 0.00, '5', 75.60, '0.00', '75.60', 'changed mirror'),
(690, 123456, '2023-01-15 11:11:47', 20, 2, 'Mario Bros', '083 999 9999', '250.00', '25.00', 100.00, '10', 375.00, '0.00', '375.00', 'Changed battery'),
(691, 123456, '2023-01-15 11:35:52', 21, 1, 'Augusto Torres', '083 999 9933', '98.00', '9.80', 150.00, '10', 207.80, '0.00', '257.80', 'Changed 2 the ignition coil'),
(692, 123456, '2023-01-15 15:27:18', 36, 0, 'Carlos Wilker', '083 999 9989', '441.00', '44.10', 0.00, '10', 485.10, '100.00', '385.10', 'Service as a test');

-- --------------------------------------------------------

--
-- Estrutura da tabela `invoice_order_item`
--

CREATE TABLE `invoice_order_item` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `item_code` int(11) NOT NULL,
  `item_name` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `order_item_quantity` decimal(10,2) NOT NULL,
  `order_item_price` decimal(10,2) NOT NULL,
  `order_item_final_amount` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Extraindo dados da tabela `invoice_order_item`
--

INSERT INTO `invoice_order_item` (`order_item_id`, `order_id`, `item_code`, `item_name`, `order_item_quantity`, `order_item_price`, `order_item_final_amount`) VALUES
(4364, 0, 1, 'Brake Disc BD2887 Bosch', '1.00', '175.00', '175.00'),
(4368, 684, 200, 'wing mirror', '2.00', '36.00', '72.00'),
(4369, 686, 100, 'wing mirror', '1.00', '36.00', '36.00'),
(4373, 687, 340, 'brake caliper rebuild', '2.00', '36.00', '72.00'),
(4374, 687, 100, 'wing mirror', '2.00', '36.00', '72.00'),
(4375, 687, 110, 'gas struts', '1.00', '33.00', '33.00'),
(4378, 689, 100, 'wing mirror', '2.00', '36.00', '72.00'),
(4379, 690, 750, 'Battery', '1.00', '250.00', '250.00'),
(4380, 691, 720, 'ignition coil', '2.00', '49.00', '98.00'),
(4385, 692, 100, 'wing mirror', '2.00', '36.00', '72.00'),
(4386, 692, 500, 'shock absorbers', '1.00', '319.00', '319.00'),
(4387, 692, 200, 'tail lights', '2.00', '25.00', '50.00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `invoice_user`
--

CREATE TABLE `invoice_user` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `mobile` bigint(20) NOT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Extraindo dados da tabela `invoice_user`
--

INSERT INTO `invoice_user` (`id`, `email`, `password`, `first_name`, `last_name`, `mobile`, `address`) VALUES
(123456, 'gersgarage@gmail.com', '12345', 'Gers', 'Garage', 831234567, 'Dublin - Ireland');

-- --------------------------------------------------------

--
-- Estrutura da tabela `itens`
--

CREATE TABLE `itens` (
  `product_id` int(100) NOT NULL,
  `name` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `category` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `itens`
--

INSERT INTO `itens` (`product_id`, `name`, `category`, `price`) VALUES
(1, 'name', 'category', '0.00'),
(100, 'wing mirror', 'mouldings', '36.00'),
(101, 'wing mirror glass', 'mouldings', '18.00'),
(102, 'wing mirror cover', 'mouldings', '10.00'),
(103, 'rear view mirror', 'mouldings', '15.00'),
(104, 'blind spot mirrors', 'mouldings', '5.00'),
(110, 'gas struts', 'mouldings', '33.00'),
(120, 'rear bumper protection', 'mouldings', '35.00'),
(200, 'tail lights', 'lighting', '25.00'),
(210, 'car bulbs', 'lighting', '24.00'),
(220, 'indicators', 'lighting', '13.00'),
(230, 'fog lights', 'lighting', '11.00'),
(240, 'third brake light', 'lighting', '29.00'),
(300, 'brake discs', 'brake system', '170.00'),
(310, 'brake pads', 'brake system', '70.00'),
(320, 'brake calipers', 'brake system', '170.00'),
(330, 'brake shoe kit', 'brake system', '147.00'),
(340, 'brake caliper rebuild', 'brake system', '36.00'),
(400, 'exhaust backbox', 'exhaust system', '366.00'),
(410, 'lambda sensor', 'exhaust system', '93.00'),
(420, 'catalytic converter', 'exhaust system', '76.00'),
(430, 'middle silencer', 'exhaust system', '93.00'),
(440, 'performance exhaust', 'exhaust system', '411.00'),
(500, 'shock absorbers', 'suspension', '319.00'),
(510, 'track control arms', 'suspension', '108.00'),
(520, 'clutch kit', 'suspension', '151.00'),
(530, 'wheel trims', 'suspension', '31.00'),
(540, 'wheel bearing kit', 'suspension', '40.00'),
(600, 'car radiator', 'cooling system', '112.00'),
(610, 'water pump', 'cooling system', '139.00'),
(620, 'interior blower', 'cooling system', '124.00'),
(630, 'air conditioning condensor', 'cooling system', '407.00'),
(640, 'thermostats', 'cooling system', '13.00'),
(700, 'spark plugs', 'engine parts', '9.00'),
(710, 'v-ribbed belts', 'engine parts', '26.00'),
(720, 'ignition coil', 'engine parts', '49.00'),
(730, 'alternator', 'engine parts', '113.00'),
(740, 'engine montage', 'engine parts', '11.00'),
(750, 'Battery', 'engine parts', '250.00'),
(900, 'engine oil castrol 5w30l', 'fluids', '111.00'),
(901, 'engine oil winorince 5w30 full synthetic', 'fluids', '8.00'),
(902, 'motor oil castrol edge', 'fluids', '25.00'),
(903, 'air filter c 75 Mann', 'fluids', '14.00'),
(904, 'air filter c 912 Mann', 'fluids', '41.00'),
(905, 'air filter c 64/3 Mann', 'fluids', '11.00'),
(906, 'oil filter P7286 Bosch', 'fluids', '45.00'),
(907, 'oil filter 109627 FEBI', 'fluids', '14.00'),
(908, 'oil filter ADG02154 Blue Print', 'fluids', '17.00'),
(909, 'filter interior air Bosch', 'filters', '45.00'),
(910, 'filter interior air Blue Print', 'filters', '18.00'),
(911, 'filter interior air Frecious Plus', 'filters', '65.00'),
(912, 'cabin filter Purflux', 'filters', '59.00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `mechanics`
--

CREATE TABLE `mechanics` (
  `mechanic_id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `phone` varchar(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `mechanics`
--

INSERT INTO `mechanics` (`mechanic_id`, `fullname`, `phone`) VALUES
(1, 'Finbar Shanahan', '083 098 8890'),
(2, 'Dermot O\'Connell', '083 089 8890'),
(3, 'Colman Murphy', '083 088 9088'),
(4, 'Donagh Quinn', '083 097 8800');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(150) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `create_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `fullname`, `email`, `username`, `password`, `create_at`) VALUES
(1, 'Carlos Wilker', 'carlos@test.com', 'carlos', '123456', '2022-12-19'),
(4, 'Mario Bros', 'mario@test.com', 'mario', '$2y$10$7jVdfl6WLb7/ul/GqOLN0.CE.fUYEbv9WXFqW3.SmrqsknjdpIXAq', '2022-12-17'),
(5, 'Aoife Smith', 'aoifes@gmail.com', 'aoife', '$2y$10$Z73ZA4JZyNVyGAfbbXqDe.LIxdkbWG9/0NE/s9vLEMVDDAAuhGQAu', '2022-12-19'),
(7, 'Flavia de Oliveira', 'flavia@test.com', 'flavia', '$2y$10$7xZAXH6iRv8rsFCQ7VZnZeLcLHkU7yoeOFbd7xoCsb/I9cT0UZ/1e', '2022-12-29'),
(8, 'Augusto Torres', 'augusto@test.com', 'augusto', '$2y$10$OsouvoO5HrsAbbd01HaHdON0nVf2/njmftEeo.1VUklqZhvR6aWy6', '2022-12-29'),
(9, 'Mary Anne', 'marya@test.com', 'mary123', '$2y$10$VTV8CV6aPOC/mrgjB6h2oezcNVKjNH4QSktmnMMe0a/V21cWoHBDS', '2023-01-10'),
(10, 'Carlos Wilker', 'carlos@gmail.com', 'carloswilker', '$2y$10$tZdQeDEMsF8XsmmI0/9luud9yP3l7GZiZac9p8PJqzQyRYz2OpR4y', '2023-01-13'),
(11, 'Carlos Wilker', 'carloswilkersp@hotmail.com', 'carloswilker2', '$2y$10$l/q5ypEzp6Pho5H1EN3hM.l.KEG4GAEks3JliYvkcUURkrcxLOb0C', '2023-01-15'),
(12, 'Maria Costa', 'mariac@gmail.com', 'mariacosta', '$2y$10$qZFdRWR4t1.AMTWbBOyMe..UFSTDt3q9Q/3IgvjSsiXIa/LajoIJO', '2023-01-15'),
(13, 'Carlos Paulino', 'carlos@test.com', 'carlosp', '$2y$10$7KeeLi0d.mDqiTZM6VT9i.APhQ6DWi8RfuVQmYxLLYmlDK92nCbWe', '2023-01-15');

-- --------------------------------------------------------

--
-- Estrutura da tabela `vehicle_engine`
--

CREATE TABLE `vehicle_engine` (
  `engine_id` int(11) NOT NULL,
  `engine_desc` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `vehicle_engine`
--

INSERT INTO `vehicle_engine` (`engine_id`, `engine_desc`) VALUES
(10, 'diesel'),
(11, 'petrol'),
(12, 'hybrid'),
(13, 'eletric');

-- --------------------------------------------------------

--
-- Estrutura da tabela `vehicle_type`
--

CREATE TABLE `vehicle_type` (
  `type_id` int(10) NOT NULL,
  `type_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `vehicle_type`
--

INSERT INTO `vehicle_type` (`type_id`, `type_name`) VALUES
(1, 'SUV'),
(2, 'Crossover'),
(3, 'Hatchback'),
(4, 'Convertible'),
(5, 'Sedan'),
(6, 'Sports'),
(7, 'Coupe'),
(8, 'Minivan'),
(9, 'Station Wagon'),
(10, 'Pickup Truck'),
(11, 'Motorbike'),
(12, 'Small Truck'),
(13, 'Ford Mustang'),
(14, 'Honda Civic'),
(15, 'Nissan GT-R'),
(16, 'BMW M3'),
(17, 'Jeep Wrangler'),
(18, 'Chevrolet Camaro'),
(19, 'Chevrolet Corvette'),
(20, 'BMW M4'),
(21, 'Lamborghini Aventador'),
(22, 'Audi R8'),
(23, 'BMW M5'),
(24, 'Subaru Impreza'),
(25, 'Chevrolet Silverado'),
(26, 'Lamborghini Huracán'),
(27, 'Mini Cooper'),
(28, 'Porsche Carrera'),
(29, 'Porsche 911'),
(30, 'Honda Civic Type R'),
(31, 'Audi A4'),
(32, 'Toyota Corolla'),
(33, 'Vauxhall Corsa'),
(34, 'Mazda MX-5'),
(35, 'BMW M2'),
(36, 'Audi S3'),
(37, 'Volkswagen Golf'),
(38, 'Audi A3'),
(39, 'Audi A1'),
(40, 'BMW i8'),
(41, 'Fiat 500'),
(42, 'Audi TTS'),
(43, 'Harley Davidson FLHTK'),
(44, 'BMW R 1250 Rt'),
(45, 'Honda Gold Wing'),
(46, 'Kawasaki Vulcan S'),
(47, 'Royal Enfield Meteor'),
(48, 'Suzuki GSX-S750'),
(49, 'BMW R 1250 GS'),
(50, 'Honda CB 500 X'),
(51, 'other');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vehicle_type` (`vehicle_type`),
  ADD KEY `engine_type` (`engine_type`),
  ADD KEY `status` (`status`),
  ADD KEY `username_id` (`username_id`),
  ADD KEY `booking_type` (`booking_type`) USING BTREE;

--
-- Índices para tabela `booking_status`
--
ALTER TABLE `booking_status`
  ADD PRIMARY KEY (`status_id`);

--
-- Índices para tabela `booking_type`
--
ALTER TABLE `booking_type`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `invoice_order`
--
ALTER TABLE `invoice_order`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `mechanic_id` (`mechanic_id`),
  ADD KEY `booking_id` (`booking_id`);

--
-- Índices para tabela `invoice_order_item`
--
ALTER TABLE `invoice_order_item`
  ADD PRIMARY KEY (`order_item_id`);

--
-- Índices para tabela `invoice_user`
--
ALTER TABLE `invoice_user`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `itens`
--
ALTER TABLE `itens`
  ADD PRIMARY KEY (`product_id`);

--
-- Índices para tabela `mechanics`
--
ALTER TABLE `mechanics`
  ADD PRIMARY KEY (`mechanic_id`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `vehicle_engine`
--
ALTER TABLE `vehicle_engine`
  ADD PRIMARY KEY (`engine_id`);

--
-- Índices para tabela `vehicle_type`
--
ALTER TABLE `vehicle_type`
  ADD PRIMARY KEY (`type_id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de tabela `booking_status`
--
ALTER TABLE `booking_status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `booking_type`
--
ALTER TABLE `booking_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `invoice_order`
--
ALTER TABLE `invoice_order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=696;

--
-- AUTO_INCREMENT de tabela `invoice_order_item`
--
ALTER TABLE `invoice_order_item`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4397;

--
-- AUTO_INCREMENT de tabela `invoice_user`
--
ALTER TABLE `invoice_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123457;

--
-- AUTO_INCREMENT de tabela `itens`
--
ALTER TABLE `itens`
  MODIFY `product_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=913;

--
-- AUTO_INCREMENT de tabela `mechanics`
--
ALTER TABLE `mechanics`
  MODIFY `mechanic_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `vehicle_engine`
--
ALTER TABLE `vehicle_engine`
  MODIFY `engine_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `vehicle_type`
--
ALTER TABLE `vehicle_type`
  MODIFY `type_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `invoice_order`
--
ALTER TABLE `invoice_order`
  ADD CONSTRAINT `invoice_order_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `invoice_user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
