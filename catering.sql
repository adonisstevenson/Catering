-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Czas generowania: 01 Sty 2022, 23:37
-- Wersja serwera: 10.4.21-MariaDB
-- Wersja PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `catering`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Kategorie`
--

CREATE TABLE `Kategorie` (
  `id` int(11) NOT NULL,
  `name` varchar(30) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `Kategorie`
--

INSERT INTO `Kategorie` (`id`, `name`) VALUES
(1, 'Napoje'),
(2, 'Fast-food'),
(3, 'Alkohol'),
(4, 'Pizza');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Klienci`
--

CREATE TABLE `Klienci` (
  `id` int(11) NOT NULL,
  `name` varchar(20) COLLATE utf8_polish_ci NOT NULL,
  `surname` varchar(30) COLLATE utf8_polish_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `city` varchar(30) COLLATE utf8_polish_ci NOT NULL,
  `postal_code` varchar(6) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `Klienci`
--

INSERT INTO `Klienci` (`id`, `name`, `surname`, `email`, `city`, `postal_code`) VALUES
(20, 'Daniel', 'Gromak', 'huntadonis@gmail.com', 'Pruszków', '05-800');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Koszyki`
--

CREATE TABLE `Koszyki` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `Koszyki`
--

INSERT INTO `Koszyki` (`id`, `user_id`) VALUES
(48, 20);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `koszyk_produkt`
--

CREATE TABLE `koszyk_produkt` (
  `id` int(11) NOT NULL,
  `cart_id` int(11) NOT NULL,
  `dish_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `koszyk_produkt`
--

INSERT INTO `koszyk_produkt` (`id`, `cart_id`, `dish_id`) VALUES
(51, 48, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Potrawy`
--

CREATE TABLE `Potrawy` (
  `id` int(11) NOT NULL,
  `name` varchar(25) COLLATE utf8_polish_ci NOT NULL,
  `description` text COLLATE utf8_polish_ci NOT NULL,
  `category_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `img_src` varchar(30) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `Potrawy`
--

INSERT INTO `Potrawy` (`id`, `name`, `description`, `category_id`, `price`, `img_src`) VALUES
(1, 'Coca-cola', 'Wysoka zawartość kofeiny (9.60 mg/100 ml)', 1, 7, 'cocacola.jpg'),
(2, 'Kuflowe mocne', 'Zawartość alkoholu: 7,2%, Barwa: 7 EBC', 3, 3, 'kuflowe.jpg'),
(3, 'Hamburger', 'Do wyboru: stopień wysmażenia rare, stopień wysmażenia medium-rare, stopień wysmażenia medium, stopień wysmażenia medium-well, stopień wysmażenia well done i więcej.', 2, 12, 'burger.png'),
(4, 'Frytki', '200g', 2, 8, 'fries.jpg'),
(5, 'Tyskie', 'Zawartość alkoholu: 5,2%, Barwa: 9 EBC', 3, 5, 'tyskie.jpeg'),
(6, 'Cheeseburger', 'Do wyboru: stopień wysmażenia rare, stopień wysmażenia medium-rare, stopień wysmażenia medium, stopień wysmażenia medium-well, stopień wysmażenia well done i więcej.', 2, 13, 'cheeseburger.jpg'),
(7, 'Pizza Cappriciosa', 'Ciasto, sos pomidorowy, ser, szynka, pieczarki, oregano', 4, 23, 'cappriciosa.jpg'),
(8, 'Pizza Peperoni', 'Ciasto, sos pomidorowy, ser, salami pepperoni, oregano ', 4, 23, 'peperoni.jpg'),
(9, 'Sprite', 'Wysoka zawartość kofeiny (7.20 mg/100 ml)', 1, 7, 'sprite.jpg');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Zamowienia`
--

CREATE TABLE `Zamowienia` (
  `id` int(11) NOT NULL,
  `cart_id` int(11) NOT NULL,
  `order_date` int(11) NOT NULL,
  `delivery_date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `Zamowienia`
--

INSERT INTO `Zamowienia` (`id`, `cart_id`, `order_date`, `delivery_date`) VALUES
(15, 48, 1638549962, 1638551162);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `Kategorie`
--
ALTER TABLE `Kategorie`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `Klienci`
--
ALTER TABLE `Klienci`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `Koszyki`
--
ALTER TABLE `Koszyki`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeksy dla tabeli `koszyk_produkt`
--
ALTER TABLE `koszyk_produkt`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_id` (`cart_id`),
  ADD KEY `dish_id` (`dish_id`);

--
-- Indeksy dla tabeli `Potrawy`
--
ALTER TABLE `Potrawy`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indeksy dla tabeli `Zamowienia`
--
ALTER TABLE `Zamowienia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_id` (`cart_id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `Kategorie`
--
ALTER TABLE `Kategorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `Klienci`
--
ALTER TABLE `Klienci`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT dla tabeli `Koszyki`
--
ALTER TABLE `Koszyki`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT dla tabeli `koszyk_produkt`
--
ALTER TABLE `koszyk_produkt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT dla tabeli `Potrawy`
--
ALTER TABLE `Potrawy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT dla tabeli `Zamowienia`
--
ALTER TABLE `Zamowienia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `Koszyki`
--
ALTER TABLE `Koszyki`
  ADD CONSTRAINT `Koszyki_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `Klienci` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `koszyk_produkt`
--
ALTER TABLE `koszyk_produkt`
  ADD CONSTRAINT `koszyk_produkt_ibfk_1` FOREIGN KEY (`cart_id`) REFERENCES `Koszyki` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `koszyk_produkt_ibfk_2` FOREIGN KEY (`dish_id`) REFERENCES `Potrawy` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `Potrawy`
--
ALTER TABLE `Potrawy`
  ADD CONSTRAINT `Potrawy_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `Kategorie` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `Zamowienia`
--
ALTER TABLE `Zamowienia`
  ADD CONSTRAINT `Zamowienia_ibfk_1` FOREIGN KEY (`cart_id`) REFERENCES `Koszyki` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
