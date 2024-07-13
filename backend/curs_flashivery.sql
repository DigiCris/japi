-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 13-07-2024 a las 02:01:42
-- Versión del servidor: 10.3.35-MariaDB
-- Versión de PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `curs_flashivery`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `order`
--

CREATE TABLE `order` (
  `id` int(16) NOT NULL COMMENT 'autoincremental | 1 unique id for each order',
  `shop` varchar(32) DEFAULT NULL COMMENT 'Shopping name',
  `shopId` int(16) DEFAULT NULL COMMENT 'Shopping identifier',
  `order` varchar(512) DEFAULT NULL COMMENT 'What people asked for',
  `shipDate` date DEFAULT NULL COMMENT 'when people ordered it',
  `Status` varchar(32) DEFAULT 'pendiente' COMMENT 'If it''s delivered or not',
  `price` varchar(16) DEFAULT NULL COMMENT 'total price of the order',
  `pickAddress` varchar(32) DEFAULT NULL COMMENT 'shopping location',
  `deliveryAddress` varchar(32) DEFAULT NULL COMMENT 'users location',
  `quarrelDescription` varchar(512) DEFAULT NULL COMMENT 'Description if there was a problem',
  `quarrelPicture` varchar(1024) DEFAULT NULL COMMENT 'base64 picture if there was a problem',
  `reviewDescription` varchar(512) DEFAULT NULL COMMENT 'user''s comments for shop reputation',
  `reviewLevel` int(1) DEFAULT NULL COMMENT 'How many stars users gave',
  `deliveryId` int(32) DEFAULT NULL COMMENT 'Id of the delivery guy',
  `deliveryMoney` varchar(16) DEFAULT NULL COMMENT 'How much of price goes to delivery',
  `userId` int(16) DEFAULT NULL COMMENT 'Id of the user that ordered'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `order`
--

INSERT INTO `order` (`id`, `shop`, `shopId`, `order`, `shipDate`, `Status`, `price`, `pickAddress`, `deliveryAddress`, `quarrelDescription`, `quarrelPicture`, `reviewDescription`, `reviewLevel`, `deliveryId`, `deliveryMoney`, `userId`) VALUES
(6, 'Mc Donalds', 12345, 'Hamburguesa con queso, papas fritas, Cocacola', '2024-03-29', 'pendiente', '$29.99', '10 15', '10 16', '', '', '', 6, 987654, '$5.00', 123);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sectors`
--

CREATE TABLE `sectors` (
  `id` int(11) NOT NULL COMMENT 'Auto-incremental unique id for each sector',
  `sectorsName` varchar(32) DEFAULT NULL COMMENT 'Sectors being offered (gastronomics, cloth, etc)',
  `moreUsed` int(32) DEFAULT 0 COMMENT 'How many times were used (for statistics)'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sectors`
--

INSERT INTO `sectors` (`id`, `sectorsName`, `moreUsed`) VALUES
(1, 'Gastronomico', 11),
(3, 'Ropa', 10),
(4, 'Farmacia', 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(16) NOT NULL COMMENT 'autoincremental | 1 unique id for each user',
  `username` varchar(32) DEFAULT '' COMMENT 'Unique username for users',
  `firstName` varchar(32) DEFAULT '' COMMENT 'User''s name',
  `lastName` varchar(32) DEFAULT '' COMMENT 'User''s lastname',
  `email` varchar(512) DEFAULT NULL COMMENT 'rsa | user''s email encoded by rsa',
  `password` varchar(256) DEFAULT '' COMMENT 'PASSWORD_BCRYPT | user''s password by bcrypt',
  `phone` varchar(512) DEFAULT NULL COMMENT 'rsa | user''s phone encoded by rsa',
  `country` varchar(32) DEFAULT '' COMMENT 'user''s location',
  `state` varchar(32) DEFAULT '' COMMENT 'user''s location',
  `city` varchar(32) DEFAULT '' COMMENT 'user''s location',
  `rol` int(8) DEFAULT 0 COMMENT 'worker / shop / normal user',
  `kyc` int(2) DEFAULT 0 COMMENT 'know the user',
  `tarjeta` varchar(256) DEFAULT '' COMMENT 'card wallet',
  `cuenta` varchar(256) DEFAULT '' COMMENT 'wallet in app',
  `admin` int(2) DEFAULT 0 COMMENT 'is it admin or a user',
  `priceKm` int(16) DEFAULT NULL COMMENT 'price by km for workers',
  `zona1` varchar(64) DEFAULT '' COMMENT 'border to deliver (top left)',
  `zona2` varchar(64) DEFAULT '' COMMENT 'border to deliver (top right)',
  `zona3` varchar(64) DEFAULT '' COMMENT 'border to deliver  (bottom left)',
  `zona4` varchar(64) DEFAULT '' COMMENT 'border to deliver  (bottom right)'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `username`, `firstName`, `lastName`, `email`, `password`, `phone`, `country`, `state`, `city`, `rol`, `kyc`, `tarjeta`, `cuenta`, `admin`, `priceKm`, `zona1`, `zona2`, `zona3`, `zona4`) VALUES
(8, 'Cris', 'Cristian', 'Mar', 'E9aJZjN06svs1onaJvIEQaVHM6tNuo+4ola4PtKzspVaMwgUPWc2pIM2Qnt4qP8T+fCKSvV0T7LvatMPAPXgInV45ZR4IzI8qmJYlgNTDziL0BYEdRprsM3rsj5kVpgr81VN+OOWORZoK1ZVpj5S4JFDJ5E/sQT/Gf4sBTrlknzuWvItfBSEXN4euCJB6OJndJ/UdFWWBmVZnaTdvAN3RHrmF1xBvS+mnUXUOJiMe6s4qEkKCQW97Q/uUQJ1CLFBWXinVmd02gnspvqvzLC/MRzA8EYgxNW9aiFqYlgB0XDnUYPhXJE65xpNpDVkAEwi15PBFDSGZfHutouABJiN5Q==', '$2y$10$hv639oFQlm6zGSVg8CVS8e4zN8HCvAIXmnV7R7MydyptJr.DkzZn2', 'eh8Zz3khuQWYYff+jUH7jP14Tx6q8gsJudhGro2V4wAIe7/zt9a3kHaFa4POtvd6ECIBrOLEZZhIamipX6KxpA8/MSRxXHNL5zXSaqcoWKf2be2W0zV9oZSgFoOGHAltMFAkrR7U9Tjwo/VpL/TColeI1oVGDR2Ze3Jx/u1tFyBi4i18I81NbfB9hSwxq1rZ+nrWsXmEeLCPj+JTct0b6sgwIIj+33TIXOwN5NtJxkKrI6Dl9g6sG8H//nWy4nfvgwzZxYCLudmIU/UATIbu7jsMTfYnkm8XiPDjLD91skzDLdlGGfHaf5lDBKBSWuJCIUUwXSIzGPszCiRSom+8ZQ==', 'Arg', 'Bs. As.', 'Flor', 0, 0, '0x32183798231', '0x32183798231', 1, 3, '45.93', '35.23', '25.45', '15.56'),
(9, 'Mar', 'Martin', 'Mar', 'OjX+tlwBtBBawneFHbHOO1Z0oWA3PyBDDmH8B//8tk0M0UlKc/wKhE1m/yo3HQEX+mV/R6ra/fuwZIzVMcda8WFeIRCPRJ/AsakUbMGe/IxAPDHIklIyJf+kExDm5YiF4rXISBfg8XvgMBt4jwmcx2xhSSdY5hZ9QkxOAgKm22jhRyTq2HBNn468ecxHE5KVGS7KohWO7cT3cMaH9rZ+nPn9n0uhGQ748WRkeclyqBa3x72fEUt3twDsFTFNBuRVkhOgxDQmwIwtUqtAGSevqy3P8y8oIM0nTSutFieSy3xcpoL8KhWB8M18/8tnlQp5x95F6Bzloq3crVT69fCY6A==', '$2y$10$yOkc1OdN3W3tAqO0zqSEu.9sB09Kb9DusaJ4OUB1Qg9MT/yHXRd7K', 'MMxOzZgFxuY3Mwf0mdcXSVubnM3Q6UruzgOgJpayw6wJPi5/2fFHzqOUPu+2jUZbhyUJjUmRj3k7nsFfh3dYR0AsRV2i3xjZPRj9xm94lbhpyoGZgpUCSQtngqRZ8u8v2EXxl319ZjPG9lCbL6qSLhA3BEWxPQCu1SfswKtPV9Vm+iOakFjgg5XXOydNl3Fg1uAWR/3nfuKWUyP2+i/pQUfT0Ad/lqT8kXpNXFksy9KVEesfozto4l+jc7zk2oyvnI5LVJue6quLvtNuIp/GJh8zegvruaI6HkazeEB+btNSwybZEY91QW1TkQ+ko8lZhiwSd62Cx2NZwze3C9lGhA==', 'Arg', 'Bs. As.', 'Flor', 0, 0, '0x32183798231', '0x32183798231', 1, 3, '45.93', '35.23', '25.45', '15.56'),
(10, 'Cris10', 'Cristian10', 'Mar', 'Ul/qFiYUWOOgt8QCG7IBtXMotmx/vVrMG4jDDhQox4xVlZb8dBkQzgAPjsnwCiW6yklwGcmrHkfyfwUitrLC5/6Bu0a9TVn5qPM0votGosfyJ5xwlIjglrAo3CyXMXzjiKLw3PsNSLplf/Kr86uzT/U83U+0bCYd0khExRD7DpZo5/WSpPCODuDC0YKgly5XXntiTSVEaUQkisVs5u14vrYqKx5Eho/M+J8A5vFB1wQpWGYrWD7X/b2+9yD1Ww0MzVWimRGYJ/5ZeM/b49ZBEMMInPnYgXeE4Y5zAvOKqK44UyoXijCCRbLNklyC0E8NJg6q+Eg2vUEQ7yqD6rJztQ==', '$2y$10$nOYip9cZOAGRaRhZYVb8uecjn//PHfikke6I6jzm2hxUrMvPpYJlK', 'InwBkKau6e6cUl9hXbbjgA00fqc132ndvEeYMf6pcf6dIcDSJ7vLEa3zA88evADo6+GN0FUwvJRBY1UIo0Ea5Z0oRC7HUr/ITJ0BBHroqJ5/m6DTNEyuz8ntj5PAAwzKlZ07xj2sylMVJg/h8e0QB6pEQWln5K+MV5fC9mWzJG0PY1BAiWxZHgij7OruSopfEA4zYjs6PqrY+XI5jWWUX/kaXsC67sH4EPP77mlMoVVRubdxTsd5JiCZEH0hVg150V7bc4mJGiQFdali0UK08xHRkVXzJWSoIKbTnKBhUJ/KP61hTojaYRBd93qSt49apLgybZ6lvT5fOyU5X0inSQ==', 'Arg', 'Bs. As.', 'Flor', 0, 0, '0x32183798231', '0x32183798231', 0, 3, '45.93', '35.23', '25.45', '15.56'),
(11, 'Hector11', 'Hector', 'Hector', 'Z+a7G5qa3DVKU+h+70OEa68RX/eALRt7XgJa13uSn9Q2GgdTpCZDeIN7DuDHaxQoNY75CX+D0WrEHn5tMEpp74KohwgUy6V8mhFIIYhIISEE7nPOyY/qLYGDnGT83yz3ZIUydYWbBz/i6IlGw41gck1WCanp4kERl1sacSqix07k2jQOyiE/cRmZfB8zKRl41l5V/gDrB709rU98RUwN1rk+gelZgAIjGlMK19ukcQJ42Pw8sdpqGqZW6wh8Cdfgdk/R4DEy4g5VAinTe+ZZb03NuxZcIKx73dZX3nWKubcriQaBwHQ6Oq+Qjc2OU/x9CvaLn6OrUoO4XSROviSfiQ==', '$2y$10$JamZxwUevLfTI5woUMx/c.tGcImJN13YrelO3/2IwyGjU.GGYjEJ2', 'kv8jysEa0FLO/zwd7yOT1hwJCrK8tZLiUDS0LlY5SIhE9LFFqC4HlNIhgT8AbyLyq7ugAOYKgTk6mckvuCT2hQUt789vwKl5zOiGK+Nb8Hm6vcA00uRdmHuwMe8R/SzDkmyEcWlqTkLnAoOKIi4K0wrB6H+SimjgQiMiBM+KVXgBz2SeHtcBqthz9QxQS6SLtc2k3GMH64Y4yGZQlnQ47oZgFWZBfXBRenKKSwmytFkNNceMT1A5hnwS44FcZ2ar1/s/+nk7ED3AF8PM7/2mF1rV9+dTrz8xGLUZBtLYyrCBKDK7Z7jp07zdZz+pyEy6OQV07owO21SStMiDyxmohA==', 'Arg', 'Bs. As.', 'Flor', 0, 0, '0x32183798231', '0x32183798231', 0, 3, '45.93', '35.23', '25.45', '15.56'),
(12, 'Mar', 'Martin', 'Mar', 'Was3yE80QusIZwKxcrdweBBopgpc1DtYGQXpdTX6G0tS8eD5kGOQYFrdy5SeklWEmcpVDqx5v0KkjQMQ8EhLieMlwJG/5phxOa/c6Nqt83krgmlM9OZqkG6hxZ7/eImdn1/w3DKVJQs6rmO9O+4Ek07XzD62ABHiuZI1Hf/EQOaRPh0rdEfCTG8NVWS4rBw3ayZLBsQtPmUUOPwCLwmK0yPUYvthHDVm8+eBSbHdcOQtefTWIryfwVycLfsG3H5y1/DPPjMCOE2JMfrVLQBthsh3MJd7nERRefmG4t7VaX88m1KeSVKIeiw5ZjK+ALJHj9t/vgKzTpPxKbwcn7kv0g==', '$2y$10$X8Iw8u3VUUfXngkOyKaKyehoGJ/WBtpon1qOKPj1b1s/KVJE053B.', 'atvkmh2X90EETV/BV77AYbKgWv15GHFgf/FPEOt7Oi5QDNfVThgmTqjrVvU4xHSPBcVWHwCw1xsRXgNJy5cS9sI3QuJ6k2MKj1MznLlVHhm0Fm8YkkX6ceXE/7UJDt7msPnb6wWP8ghw1IlYz5eTD6h0x3TdiMaYYiBpvypCHXVoYYU3gpoX780u916B7qXIo5lfDLzmSBY5APKdMl9yVWWLN+KLq/1LbQDLBoH8snslwC8Emxphzhh29Uy8s9mAabqnLf1+IYisxxSBHVw6MVvteAEyFa6dP7sIacTm1dM2DGwWkd+/A7llgC2YcN0r68EPmBpmnXc0YiKg01G9Xw==', 'Arg', 'Bs. As.', 'Flor', 0, 0, '0x32183798231', '0x32183798231', 0, 3, '45.93', '35.23', '25.45', '15.56'),
(13, 'Mar', 'Martin', 'Mar', 'YzJIlrZnDMft3ZpCO3Bm99iz1LqCGTDQmEbeZk+hITC/mbJe4zYUJ8YNiLjpN7QSMXGfAX16kpnJegTz6HeqfwKLS5+MAkQDK/o+NQs+0YkLadMY3PU1/+uupIOvITIo5RUNRB9TrVozGEwrwKCeB3s/KVkPcI8cq6OhL8YIA24dXH37FV4Ea+qh3sYE5IjfpH3gwU9g1hxP6xjPuat9z9wYO4GIlyVVZhI7gYHGutkQAs9dRsOuzAlOX0pYL0wrGnM8R0qPclUyueB7jKD6mhj9dB3j/nDVF0GG65IfACpCwBNaHGUQxLbhdninaSC89q87c7lu9XYIyVAsTiY3aQ==', '$2y$10$6Ju.cjrR5YVV8pKRqhMc8u529zL7vxBcHCgGaNHWBaqYB1Y97p8YC', 'VtQFLrKPf1jICq8h76AGx8KsDHDbZg0M6rYQjGA9eXoVO9k68mLuXeDwJJtT7nCAQ29gTYtQ7zuCo9ltA+gCzfMTlZWhxrjDPtz9vU6d0H/QWUEbSTy9dleObkUsUh8Li750bAMjbdldOn7H2/qcLOl3XDGC5oNUXbQ0K6oZsTDtALjzK7K9llmp29R5k4J0RlJT+31gcnzGemDhrsY4LjaHOyNdx+WYtaQidRxtGUjNhrTmfJ9C4O0T9CShUsVC2KZbwVY201/KyzNvGkH85xzmbueYkGqOw2oVWpn/INTRx1imTbXdjkM9H7mHdQg3Hx8MBQD2Kiw7qes9wt6lyA==', 'Arg', 'Bs. As.', 'Flor', 0, 0, '0x32183798231', '0x32183798231', 0, 3, '45.93', '35.23', '25.45', '15.56'),
(14, 'Mar', 'Martin', 'Mar', 'fupJXId0A7E98TgzOYY2L5CzHSf0V6oZ+m24y9e9IFO1v8GZdEodGziJE3CbfRTv02UfYgHw59ezYywXv0nb+tMDm3COKIuHwLf3MF/IL+xPunTEg6hgYfWz3XV9Q7wlYPJKF4XCLqyxOUKAUl3iLgMTUhJwDC1cYqcsPuo241hU00OLi67zB0ICqsTsmHv8Bgr8Hr+v0jD3CAK9vfOPD6P4YVlEnG4IuXpBU/Xvcbwh9vpAEdtgXhZ1hXkaPlaTga38VR8IMSXPRGts6Y35KzdNspOzp1SF/ly9TfE6tg5CKTWIhkX+0YQA2qoreAIf56MW+HrkWN/pSqzVjpp06w==', '$2y$10$pDBDoiKBnanwsJ6RLNZhg.e3pkhZ58s2yqQXuiQFPH/Q8XcGRau9.', 'I6g4XIu2Ej6APz8X6kPKsvqYoSz1Q5bVWXcAT849qijjn+WSwUJ5KYZ8h269l5GsOLaXvKHxbdQe2WO/t48DfFvWRNgfaLzfHoqAm1/T/eSoGGgPFQ3LEG9gojJTzOozDM3tmkla0nZqW3dbhbI8Ynb65BAwSiIanIbel/4qhKs2TxQLXT4CqiK33qrYs95ZCPdPL5voEKmikJ2+y7YyMrXogmLJxDFqAsV0q54idONR0sFfjQOeN7cu67544eLyswfOy8fQTbRmxK4b1Vr6esezc0cW+nHE1PT0RgbOwv+1+qX3QjvMZY/u8AGTAUE73QfyRw8e7glMk1iEk2ZAQg==', 'Arg', 'Bs. As.', 'Flor', 0, 0, '0x32183798231', '0x32183798231', 0, 3, '45.93', '35.23', '25.45', '15.56'),
(15, 'Mar2', 'Martin', 'Mar', 'S3DWR8yXUXZA9eRH0kMZWEuL7Sm+VB9WruHyM7BHb7GnMHGajV5AiA4r/+HtQn6dSxzEQ3ojtF0y5NbEWL6ogCfOjBb4GQytGQcjhq2mII9JDIDYzZV0XsfScyS0O1gdzX98I8s3JLibcaDrKO71KDo+I3HKiM3OWMhUiYOLDButnW16IYJb+ZJaZrb1fwWVBgaXkqXl+n4a4Xdu5u/x6lOj0E/FlxQjYq+Dt35r9LO1tVtuVW4iebeynK3x/eNnJOPrsDwKAG5+c6ZG2BGUOs+6/rlpPIfz42h0SYdr0azK2ixQuaeAUsn0md9XTeP4zaCrNM1hAgYN/zK69HBUiQ==', '$2y$10$JY6uBtP0l7sW0kHcZVwXcefsxqdtyT1L8iuENMKVoPdSoqdUWiQTK', 'Criy4fIjf4mUuJjBrAg7AEaF7wDYxcOHoxdwnwcf0i+qoL7VLHzQXQQ2kzVzsw+l4dPAHpnluBwSdhxUa/6gt0OxiUDHtcAeeO+iQ+3q4lwddWWHkcf/4uHG1O5X0ZnkrelspGgUSs9L4rqxUhDJqVCSTIT/vtZh4duDlgttH09JNGuXWHHwLdW7ZzNM4owGWX2cfA8QKt+jIk4EFWLnFGcCMY7tgNTIIh6bWaK0PYNeXcmPu4t3RI3hqOYhMyNYCPJ6aEOe7U3fYmqLHGrhroYFfaVn9e/6ymhpqHEDHxIRn1pKA0q+d9ClTPvjlEDbTtEz5uK0dfJTCYHsOZsa2g==', 'Arg', 'Bs. As.', 'Flor', 0, 0, '0x32183798231', '0x32183798231', 0, 3, '45.93', '35.23', '25.45', '15.56'),
(16, 'Mar3', 'Martin', 'Mar', 'QeZhRu3gOeApxhI4mGSg6SzBLqS4S0Kh2tzEiPjvYoS4BsL52F/D1tjzqw6owBYvXs9Gtj/+Q+gp0ijkwVsvuCSPXtU+8y7+97zvRz6izfwwjnQVEH7CUTB264NGHeZhHrg7UXaJ7BPJhi8vehzjf7ENaThkUb7NLhgqWpUgC2gtrx/EOAyqs/QubSml4+4YEu/6G+ebkHEHnsFk/5TH+blUO1mk1isM1jHEh1h8uU2ih7UJ8G/81m22CyEjOeBT1/3GJpbPh2LwNZqGcV3rvOwHiFo7Y5PJffvxI0K1AxN+dowBAC26HUITg9lVJcNZfxTjXf5lWSoPJhjUYgUwdQ==', '$2y$10$8OmXvE.y4En4mzZb.bMxMOydYFvdwQ3IO0cx5aPoJaWmWmKy.lag6', 'mweHuHZ/Vu2xDsK+qJLMpOP3vcaIq1eJJWWG995rZy1Tpc6zwbcCFL3L/f2FpJO4TLSlIhT9dYQCKpTNxQHAnSezK4HvmFSwVRqTiRnXZ4n1cUg4XtQmdywtEnZF83iozRSAiDHfJmOo38DEcr1Takf6WmupDZA7+uHoSEDMxFEumdsFJKj0YH1rxlzPKieHPlx3T3gkmJhGwY82xjKAi/KtCBQg2RkMsv0ircjgxfQUZHiV7diWKUxSg05N2xJb6K7Yt8CfemqrT+tDoMSmFoVsdl7XhtQxFKPs0KbZHo4TNfC6myAFu5CoFOPsmqJ60xgjfahstx6DNsflLppecw==', 'Arg', 'Bs. As.', 'Flor', 0, 0, '0x32183798231', '0x32183798231', 0, 3, '45.93', '35.23', '25.45', '15.56'),
(17, 'Mar13', 'Cristian', 'Mar', 'VuiabG+7gq6w2ON82e+IQPADhkic9BUZMMDRdPUNRlcSLMjaRM6HprsuHnO1CIAXf55tsTw1gTU/2x7I+CxvWwSHgUHz3SdJUSYeqvLii6d1xhYgGN3DEUGTxGkbpXL8NnILdCF5WmaBC7Lk7eKwguPPDKQOQtk3gza7WX1VitAHBFLFkIIu90X1pLXnwmb5t0C2u0OpxO5FjvY/mc3BBfOOfue80JBE2K2h3Z3HUSXGGufA1PFjlLzFiGpKFa4iyOOfE5ZpoPBTdo7CfRkJ6VkqsPNDQC0UvLtXvfyGDa09bwoRRyodEMAbdquaBaIVQ2Tk7arSDp/a4xbhWkUxGw==', '$2y$10$LPQrvrvdirwAwAzmmBwJ8uWksQbMcHaV2Vzry0ODzNii1UXXTNuby', 'IA8vyV7mL23wyJP+ezmNjEN+nLq+E9MGFBqduDOYYCcGYI13Qxfl22/scExL3lq8uSgnUcU8H5D/7Bt3oSNeAjB6zCq575kuD7vENGduvOpbo0CEAvZKNqgUGvFItdIcJTLBa6SBd5F3zWoMeeOXC/iLZxQN7wjw9BP0M7eqzeOyb2PmfWzPJpE9clgRi6DixBGjFtgrwga1tRnbwbCSDDOL9qolGGDVzmSJlbyO1Ra2HP0GU6QUH6KLbEFWV6IKb+DmZSwupj16OkrUsvX38EZUOb/N1Zk+Nmv+V7NXuldfJYgmiBIIDToyTkucGapDvpzBWkFmmPiICEJb5y4Dhw==', 'Arg', 'Bs. As.', 'Flor', 0, 0, '0x32183798231', '0x32183798231', 0, 3, '45.93', '35.23', '25.45', '15.56'),
(18, 'criptocris', 'Martin', 'Cristian', 'mi2f59lCxwG+3Bl06ZgDm8ublgaVHQ1y2j2MA305O4gDKNllfVLdPTBwuy1xThGM7ypTnqPoKOR1pVWzTaTiZ+M5LO/mjy3UJoiaxyh9fF9Ar0Yu839CuodMSWJ4jilEHOSILLgUq6Ll7O83B1OunDGSi32bOOkinl386PM1N/iZQdxnU75FNbHgs66OlwKHHOfL4PN6cYdpiDU9PYJGz2Cf0m6DYJ+crw0K0luI1YPdv3TWAUh4IK1ogiJCPfXXN6Xeboj/WYMN2MsRWsJYGgCUYleWUl4tQLy3Et+v11h3GCev6wAj8fiUAGP1x1YVOwurQTCUmIcoe0hWY7P2Qw==', '$2y$10$3KjZFgrconWdE1JqjE1BNefu.Rxqei7/MVDT5CPp3oRQB4OC4oiu.', 'S++ldXgBBqQoDsNDhyjPZ5Cg2Gfd3BGTZ5UGvROui2Wic/JZmjQ4DXLz3xw9xlk0yjfnr/qYCUjDs0Y+jG/vqQ2u2psgzV1vd9z2IsPmQjpjLDufqWfs7M24VqyZQa0tNiM6vZ0jx9zttBOAG0JWPbI7j+e2C4FvNTUBQvs6Qo0wWiUWXqiRwoxy76vvniBSmZQvokbvLw8k3eIydT65wjcCKBV5++re4NAOvC0LMOtj2j2HbzO2RjUscy4gN4Xae2VT+BOwa1ES8dpKRHvfAzvcMXebhLfz551ocJtOWb621aefuzI4ZD7sYXukdRefjqi86JZpyHY/D+um5E9KPA==', 'argentina', 'bs as', 'aca 1234', 0, 0, '0x0', '0x0', 0, 3, '45.93', '35.23', '25.45', '15.56'),
(19, 'Rotceh', 'Rotceh', 'Killer', 'Z32cbmg018PgtYWXl/ZX1dFDGPxenWLcDkOIWvzPW0Xkyh0RRZ82R+qpn89ez3al4NMV/sd54S8lu++HnTBQXfcAmdUQu4bUIZpdnJsemAzz1qH+mNkVvIFRLa9rXStxUhqASJM2prcgLNen1gI4FTB1W33DdIh0/pMW7vicl8kjco9rpceNLDAC2q9t5o8440ddLcVSiVDWjUhmRFJzvLYDEQlfwUSD4tXPeUiT7XBMRIKYMFk1ZZG0qaGEb90+kT0QxdOBtO2XXWPyeRXcGZUhV0P3P2NtromI0eOiiHxNSfZaZtbG2h2bmvhC3bC9ISshKOrsRRYNdOroe4+EFQ==', '$2y$10$4OxzuWNnoXTmX.R9VDOgtOBemrCsa5bihn5UvCzmYRfYmKO0cv.Aq', 'n94+j+Oy7xekqAmM/HfeASrvUfmuaz94s5WzMTcRFR+hkwhVdf2vivOjxzVJz0daJhyRaD/hnKkxFZOXkiGd5OCTgFpzJqCzRbqp930IBake0ds5msKXIBCyRfWQY+geajYvdxVVBhjhIc3H48v4qnRucPeVwmilqduIccgB5M9lSHwt/s8viJceqbmtLKRa/w7OXe9zA4vtNvM9ZfdRlk50vygaL77TWOTPNjQ40mwCkw2u2Fg8psgUIjdrVCg1yKO3iecc3ux7yvX9B5psPNqeTRpmC8bgqB6dWGSM2CJ8bvrkzwbfMuicZEggt2n4AH+xjLx8WVFatwakbQ15PQ==', 'argentina', 'Buenos Aires ', 'Caseros 5738', 0, 0, '0x0', '0x0', 0, 3, '45.93', '35.23', '25.45', '15.56'),
(20, 'Rotceh', 'Rotceh', 'Killer', 'HgZmVBp9Dz8knVOshJ4PgagL/m+GkUQkUo7hpkSkvJTZIIHqWaemUvSi/G15AfW7CkY4TixkGNUGa9FKiophiq40y8YzPXa0h6nVS4FWY2TMlzXl2AS83DHdnaoQOo6j52kPoNGHk+X/BgxKrd/uS6sWrUdYiIBRZf+WDum6HP1552984p3vK8L2j6TpJZXSiiVLLiEfGXxuGKVZNz3hdJKPn8ofnVvy5H3+7pP0PQ/iAdMRaFul9FFcD5WCl1AY0b8GgvHw8hvafYBWYrB9Wk9xxqnJAFEacRZXtmKlkvUymjCeuh0jgAop8TDahXzYzC/YCCh8nSaBCw84xPalBg==', '$2y$10$ap0pQVv8n1UHi6a5DLKXBO96.iOIxJmMgQfj1fn/AAmeiKT.T2Yhy', 'TtvRc/nug1g28gkWPhz9QwBB5wCafDydXQyYytub6ZUCqncXAC0zVw3VsjI5hNkPuFW+uYBZFdDjDDhnlFnS02HR6bKS058M9wrwrvTraza7Bf9v/KirtQ/4zWIjUJy1yoxRVR1BZMG2lvBZI+ZnCEVpN7J68ADZtlCAdonic4TpOnsjjcJVkLY7QoxH4xQHkAq2rpdocWo/shlsk9y5QNcW3B+w44TxG7yk2ZQLQGJVhB1yqvjcBDipGDnhT27fKywSLffBsIkn3yp3A60xpVb5PVqG7zrQZd95t9KBfHUA67VR9Zuu0e4KKPZCyvOTP85clyZ0rsVcYQTFPGjaPw==', 'argentina', 'Buenos Aires ', 'Caseros 5738', 0, 0, '0x0', '0x0', 0, 3, '45.93', '35.23', '25.45', '15.56');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sectors`
--
ALTER TABLE `sectors`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `order`
--
ALTER TABLE `order`
  MODIFY `id` int(16) NOT NULL AUTO_INCREMENT COMMENT 'autoincremental | 1 unique id for each order', AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `sectors`
--
ALTER TABLE `sectors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Auto-incremental unique id for each sector', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(16) NOT NULL AUTO_INCREMENT COMMENT 'autoincremental | 1 unique id for each user', AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
