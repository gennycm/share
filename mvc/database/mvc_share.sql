-- phpMyAdmin SQL Dump
-- version 4.2.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Apr 23, 2015 at 07:16 PM
-- Server version: 5.5.38
-- PHP Version: 5.6.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `mvc_share`
--

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE `friends` (
  `id_user` int(255) NOT NULL,
  `id_friend` int(255) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`id_user`, `id_friend`, `status`) VALUES
(1, 8, 1),
(1, 11, 1),
(1, 10, 1),
(1, 9, 1),
(9, 11, 1),
(17, 11, 1),
(17, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
`id_post` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `filepath` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id_post`, `id_user`, `description`, `filepath`) VALUES
(1, 1, '', 'city.png'),
(2, 1, 'El atardecer :)', 'sunset.png'),
(3, 11, '', 'ControlAereo.png'),
(4, 11, 'Este es un ejemplo de un mapa mental', 'ejemploMapaMental.png'),
(5, 11, 'Ejemplo ', 'ejemplo.png'),
(6, 8, 'Cascadas', 'watetfalls.jpg'),
(7, 8, 'Jennifer Lawrence', '7.fw.png'),
(8, 11, '', '1.jpg'),
(9, 11, '', '1.jpg'),
(10, 11, '', 'Snoop Dogg ft The Doors - Riders on the Storm (Need For Speed Underground 2 Soundtrack) [Full HD].mp3'),
(11, 11, '', 'MT-MatrizTrazabilidadv1.0.docx'),
(12, 11, '', '11112933_691654510935389_6270303254465132544_n.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
`id_user` int(100) NOT NULL,
  `username` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `name` varchar(1000) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `email`, `name`, `password`) VALUES
(1, 'gennycm13', 'gennycm@gmail.com', 'Genny Andrea Centeno Metri', '123456'),
(2, 'gennyandrea', 'gennycm@gmail.com', 'Genny Andrea', 'fcea920f7412b5da7be0cf42b8c93759'),
(4, 'usuario123', 'usuarioprueba@gmail.com', 'Usuario Prueba', '834d1cb63a03acfe3d4ec81e290258b3'),
(5, 'testUser', 'testUser@gmail.com', 'Test User', 'e10adc3949ba59abbe56e057f20f883e'),
(8, 'tianafrog', 'tiana@gmail.com', 'Tiana', '12345'),
(9, 'karimychable', 'karimychable@gmail.com', 'Karimy ChablÃ©', '123456'),
(10, 'mvilla', 'mvilla@gmail.com', 'Maya Villanueva', '123456'),
(11, 'bheftye', 'bheftye@gmail.com', 'Brent Heftye', 'e10adc3949ba59abbe56e057f20f883e'),
(17, 'admin', 'no_me_lo_se@gmail.com', 'Rodrigo Esparza', '21232f297a57a5a743894a0e4a801fc3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `friends`
--
ALTER TABLE `friends`
 ADD KEY `id_user` (`id_user`,`id_friend`), ADD KEY `id_friend` (`id_friend`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
 ADD PRIMARY KEY (`id_post`), ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
MODIFY `id_post` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `id_user` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `friends`
--
ALTER TABLE `friends`
ADD CONSTRAINT `id_friend_pk` FOREIGN KEY (`id_friend`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `id_user_pk` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `post`
--
ALTER TABLE `post`
ADD CONSTRAINT `id_user_pk_posts` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;
