-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 17 nov 2023 om 15:39
-- Serverversie: 10.4.28-MariaDB
-- PHP-versie: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bibliotheek`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `translations`
--

CREATE TABLE `translations` (
  `id` int(11) NOT NULL,
  `location` text NOT NULL,
  `text_en` text NOT NULL DEFAULT 'UNAVAILABLE',
  `text_nl` text NOT NULL DEFAULT 'ONBESCHIKBAAR',
  `text_fr` text NOT NULL DEFAULT 'INDISPONIBLE'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `translations`
--

INSERT INTO `translations` (`id`, `location`, `text_en`, `text_nl`, `text_fr`) VALUES
(1, '***DISCLAIMER***', 'DO NOT DELETE ANY RECORDS IN THIS TABLE', 'DONT DELETE ANY', 'AT ALL'),
(2, 'nav', '2nd-chance auctions', '2dekans veilingen', '2ème-chance enchères'),
(3, 'nav', 'Log out', 'Log uit', 'Se déconnecter'),
(4, 'footer', 'Services', 'Diensten', 'Service'),
(5, 'footer', 'Branding', 'Branding', 'Marque'),
(6, 'footer', 'Design', 'Ontwerp', 'Design'),
(7, 'footer', 'Marketing', 'Marketing', 'Marketing'),
(8, 'footer', 'Advertisement', 'Advertentie', 'Publicité'),
(9, 'footer', 'Business', 'Bedrijf', 'Enterprise'),
(10, 'footer', 'About us', 'Over ons', 'A propos de nous'),
(11, 'footer', 'Contact', 'Contact', 'Contact'),
(12, 'footer', 'Vacancies', 'Vacatures', 'Postes vacants'),
(13, 'footer', 'Press kit', 'Perskit', 'Kit de presse'),
(14, 'footer', 'Legal', 'Juridisch', 'Juridique'),
(15, 'footer', 'Terms', 'Gebruiksvoorwaarden', 'Conditions d\'utilisation'),
(16, 'footer', 'Privacy Policy', 'Privacybeleid', 'Politique de confidentialité'),
(17, 'footer', 'Cookie Policy', 'Cookiebeleid', 'Politique de cookies'),
(18, 'nav', 'Auctions', 'Veilingen', 'Enchères'),
(19, 'nav', 'Location', 'Locatie', 'Emplacement'),
(20, 'nav', 'Products', 'Producten', 'Produits'),
(21, 'nav', 'test', 'test', 'test');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `updatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `firstname`, `lastname`, `updatedAt`, `createdAt`) VALUES
(1, 'Magdalena_Runolfsson67', 'Jazmyn_Batz24@hotmail.com', '$argon2id$v=19$m=65536,t=3,p=4$Q4lW8+tmLJZdV2ZqMN2CQQ$ZGwFeBw2EL/9usKExGZi69yb2esMigjM6ONbJengQi0', 'Connor', 'Dickens', '2023-11-10 12:58:34', '2023-11-10 12:58:34'),
(2, 'Allan_Hayes69', 'Hadley94@gmail.com', '$argon2id$v=19$m=65536,t=3,p=4$joV/HKbd3YmfNe6z01ub6Q$z//biFJ/BepfJ7F4mssSqVN3aJRHH74R410tjoEH5mk', 'Asia', 'Terry', '2023-11-10 12:58:34', '2023-11-10 12:58:34'),
(3, 'Pietro97', 'Magali88@hotmail.com', '$argon2id$v=19$m=65536,t=3,p=4$pbpTBGiIl74nqSLvH85cZg$JU/mqpeFjT3CyTg/6Nu2TExLJrfoREtjR7qYBgPnzjw', 'Janick', 'Fisher', '2023-11-10 12:58:34', '2023-11-10 12:58:34'),
(4, 'Erna71', 'Samir_Krajcik@gmail.com', '$argon2id$v=19$m=65536,t=3,p=4$evOei3wXlEWG4N1p5ydPmQ$x/tk1T584lJd8coKUMUbqJWFwzkOWB2BqMPUPZ8dI6c', 'Aurore', 'Cassin', '2023-11-10 12:58:34', '2023-11-10 12:58:34'),
(5, 'Aron.Mills89', 'Jeff.Will@hotmail.com', '$argon2id$v=19$m=65536,t=3,p=4$efzf5OpE0635NtZZlXyYbw$UjpMb/wsQMuNMO7BFCwNNaV6CchW7zOGW8PJGhuhv8c', 'Arjun', 'Towne', '2023-11-10 12:58:34', '2023-11-10 12:58:34'),
(6, 'Aiden.Mueller12', 'Murl.Hammes@hotmail.com', '$argon2id$v=19$m=65536,t=3,p=4$vteEF+aNxFwIPOQuruGZRw$F9A6dsORXIXuZlzNWw1IfBOwSPPj01FlmafPadz1ixA', 'Caleigh', 'Mann', '2023-11-10 12:58:34', '2023-11-10 12:58:34'),
(7, 'Ryder_Lueilwitz31', 'Dejah56@gmail.com', '$argon2id$v=19$m=65536,t=3,p=4$1bSUgwY9Tu39RieQMyp55A$G9aFFrNYN5MEzjtJ5cZ73O8tObTmjumo6j7ZY4RC3R4', 'Elsie', 'Roob', '2023-11-10 12:58:34', '2023-11-10 12:58:34'),
(8, 'Abbigail78', 'Brad75@yahoo.com', '$argon2id$v=19$m=65536,t=3,p=4$HgNEFqKBZWTEh95YYRVW3A$64myGrn7N/bysyYYZ4nW3S0d9OHx+SFLpEqt7/9Thnc', 'Rosanna', 'Green-Thompson', '2023-11-10 12:58:34', '2023-11-10 12:58:34'),
(9, 'Ike_Hand', 'Rosina.Kihn96@gmail.com', '$argon2id$v=19$m=65536,t=3,p=4$Sw284ZLfH3Bz6qEvaeMyfw$m6Ir2z+O37hZCitoyF7oslz+I4j+7VtjSGu0pukZAPM', 'Sandra', 'Waters', '2023-11-10 12:58:34', '2023-11-10 12:58:34'),
(10, 'Elaina.Prohaska87', 'Alexander29@yahoo.com', '$argon2id$v=19$m=65536,t=3,p=4$/KpRM3RnP9hkPBnNp8SwKg$8UJnzt5mPugHXe5r44MJPfbmSQ00lxchpBPsZi4b1s8', 'Whitney', 'Dare', '2023-11-10 12:58:34', '2023-11-10 12:58:34'),
(11, 'Aracely_Towne', 'Barton.Smitham-Rolfson45@yahoo.com', '$argon2id$v=19$m=65536,t=3,p=4$dq2H5hejSqah84Lev8sJjw$ziyIcQh70gMY0cBjfXlEisWu/Je+rjdqMhk+Qh/was8', 'Gerardo', 'Bernhard', '2023-11-10 12:58:34', '2023-11-10 12:58:34'),
(12, 'Kira.Tremblay8', 'Aryanna_Johns84@yahoo.com', '$argon2id$v=19$m=65536,t=3,p=4$j9ZGHihMPOBVZTkrWvWfeg$zxl+Yw3KJN3mH2yOKyo9w46owvjJ2CGc/fJ4s9Cbs7E', 'Elouise', 'Powlowski', '2023-11-10 12:58:34', '2023-11-10 12:58:34'),
(13, 'Frederik11', 'Elbert94@yahoo.com', '$argon2id$v=19$m=65536,t=3,p=4$48Vd/ZA+fCtz+4Ta9jLknA$beIL263aQe6oL+/641PfiqI22IRA2GLP6ThF8PZFTlE', 'Kris', 'Wisoky', '2023-11-10 12:58:34', '2023-11-10 12:58:34'),
(14, 'Bradly.Blick39', 'Shea_Bergnaum@gmail.com', '$argon2id$v=19$m=65536,t=3,p=4$LSyvXKVJ5X0qp0TjrWzZyw$HUor2hzbQMXUp/LtXGI35bj8IelVZBjJVlKn0eQY0lw', 'Jeromy', 'Ankunding-Wehner', '2023-11-10 12:58:34', '2023-11-10 12:58:34'),
(15, 'Lynn.Kertzmann23', 'Dusty36@yahoo.com', '$argon2id$v=19$m=65536,t=3,p=4$2IW3Bl57mGbb64XScWjMOA$MXtKh3xX0eg8Ppe2ArRrDJPtAuoVAa7/i+rTn210Zfw', 'Johnpaul', 'Koepp', '2023-11-10 12:58:34', '2023-11-10 12:58:34'),
(16, 'Emanuel71', 'Shannon_Goldner@hotmail.com', '$argon2id$v=19$m=65536,t=3,p=4$2mt3ppQH5JQ17WVmpIij7g$h2mkoNC+iFSgN0VjwmYqnM7CkcNcZDvXSYfjVqcSY7M', 'Morgan', 'Rempel', '2023-11-10 12:58:34', '2023-11-10 12:58:34'),
(17, 'Clemmie_Volkman', 'Jessica.Volkman64@hotmail.com', '$argon2id$v=19$m=65536,t=3,p=4$yRUzJFljoB/cWWUwBkCtFA$hmRJQAemDShc/JrBcCfc7YsUHYhKzGnNX5HLQ9j1GCc', 'Tania', 'Medhurst', '2023-11-10 12:58:34', '2023-11-10 12:58:34'),
(18, 'Wilbert53', 'Hope_Batz@yahoo.com', '$argon2id$v=19$m=65536,t=3,p=4$6WAaCbH0Oxh5UCgvmTGFeA$6HYJTjHF1AgRXuSDSptc6VMWJ/GpS9PjYBU95dO2qlE', 'Carmen', 'Hilpert', '2023-11-10 12:58:34', '2023-11-10 12:58:34'),
(19, 'Julien.Mosciski', 'Lamar_Doyle20@gmail.com', '$argon2id$v=19$m=65536,t=3,p=4$ZgJ/IF9bnmaq7IDnl6zuYA$R9MbfLUb0Ma7TqlUnN4xe+IlVOwfLQx0jqxYBRu5GD8', 'Ashlynn', 'Schumm', '2023-11-10 12:58:34', '2023-11-10 12:58:34'),
(20, 'Alphonso_Will76', 'Amara66@hotmail.com', '$argon2id$v=19$m=65536,t=3,p=4$Cv6Bp6cICNzj2lllfBOCXQ$qA8gf+UaeGTn6AwehOxUGogOPMHoz8Ft5vGVa1IakQw', 'Carlotta', 'Waelchi', '2023-11-10 12:58:34', '2023-11-10 12:58:34'),
(21, 'Bette19', 'Hazel94@gmail.com', '$argon2id$v=19$m=65536,t=3,p=4$q+AaGYkaCUSPcKXBt9hzpg$pHsvfBGPfuk0lPvRKXH6p+C5W1ObGtKQDjGd7lpeZpI', 'Alyce', 'Kuphal', '2023-11-10 12:58:34', '2023-11-10 12:58:34'),
(22, 'Faustino_Von35', 'Edison.Bashirian@yahoo.com', '$argon2id$v=19$m=65536,t=3,p=4$EK7eBq4sTEZFi2IX1zgdZw$Ub1pkcjz5QiquoXccgfX+MI4iYzD+whXkH77w2EDkyU', 'Melyna', 'Stehr', '2023-11-10 12:58:34', '2023-11-10 12:58:34'),
(23, 'Dorthy51', 'Tyler_Rutherford0@yahoo.com', '$argon2id$v=19$m=65536,t=3,p=4$659Iy7r0n2++gyIZe9jp4g$qmrvU+A4HfBkJVgvuGxTAMA5vi69h7GrmWXmxQzRb0k', 'Gregg', 'Abshire', '2023-11-10 12:58:34', '2023-11-10 12:58:34'),
(24, 'Tianna_Armstrong51', 'Dylan.VonRueden93@yahoo.com', '$argon2id$v=19$m=65536,t=3,p=4$X2whsKf3QcCiAAuh5SxD/g$hdWXR0Vzm3FP6y3fFe0nFZJb+HEKpnC0GEgFyJxgM+A', 'Gudrun', 'Kshlerin', '2023-11-10 12:58:34', '2023-11-10 12:58:34'),
(25, 'Adolfo6', 'Ophelia40@hotmail.com', '$argon2id$v=19$m=65536,t=3,p=4$o7QdGQ/mcsSVbM6VUyJ+MQ$pdzL4hnM8tEBinex0u3X8+Ws/+xv3vwHlA7hBS8s+KY', 'Reinhold', 'Harvey', '2023-11-10 12:58:34', '2023-11-10 12:58:34'),
(26, 'Murray.Schamberger79', 'Parker4@hotmail.com', '$argon2id$v=19$m=65536,t=3,p=4$POTTIQKZxYHl8dVxEtAgww$gKLJMDE9YrOY4qFEwnvR4VwPf2gcKG2W93a6rExwVMM', 'Amely', 'Ullrich', '2023-11-10 12:58:34', '2023-11-10 12:58:34'),
(27, 'Rico_Wolff3', 'Judson15@yahoo.com', '$argon2id$v=19$m=65536,t=3,p=4$y7wxhv1Kr2CKmT5LqPAiPA$9xb+tdmhyGwkwRwvOf+VB2AKgJ7N2JSd34PZXV4qGhs', 'Braxton', 'Hermiston', '2023-11-10 12:58:34', '2023-11-10 12:58:34'),
(28, 'Myrtie67', 'Nona41@yahoo.com', '$argon2id$v=19$m=65536,t=3,p=4$1mkxaYorN8ERrlALpEWC8g$/B/kyID+FiCPlGWwa8cXMDxQ/33hGrM0F9z/byBHMZk', 'Gaetano', 'Block', '2023-11-10 12:58:34', '2023-11-10 12:58:34'),
(29, 'Marisol_Osinski21', 'Laila.Nikolaus32@yahoo.com', '$argon2id$v=19$m=65536,t=3,p=4$WRlix6aDDkUsknj8to0wow$nzv3TFx4o6uTZY04KcikF5qhloTeBtgC6ePaAuUpELw', 'Ubaldo', 'Roob', '2023-11-10 12:58:34', '2023-11-10 12:58:34'),
(30, 'Berta_Rodriguez', 'Demetrius.Moore90@gmail.com', '$argon2id$v=19$m=65536,t=3,p=4$nYsgex+8mjwRRzNTtrl+yQ$KGmLNr6YU5hwXnFhYWRWoI4pwayRE+pWiryRZbjY70Q', 'Porter', 'Stokes', '2023-11-10 12:58:34', '2023-11-10 12:58:34'),
(31, 'Eva_Erdman7', 'Tad_Brekke58@yahoo.com', '$argon2id$v=19$m=65536,t=3,p=4$SkrzSn+0o0T0J0YehqMvVg$hUZxPIqQ7ZxsNnRebt1m7/J75qvbnSNBOLPO4CTKBog', 'Alize', 'Kub', '2023-11-10 12:58:34', '2023-11-10 12:58:34'),
(32, 'Ulises26', 'Felipa.West@hotmail.com', '$argon2id$v=19$m=65536,t=3,p=4$HwWwg/NjDqax7MTftpXlBg$Jq0vtse1Rxi9KJgtpxBiRViHTKcNO8ZlYj4SPxgvZzA', 'Eleonore', 'Pacocha', '2023-11-10 12:58:34', '2023-11-10 12:58:34'),
(33, 'Delia15', 'Barry_Crist6@yahoo.com', '$argon2id$v=19$m=65536,t=3,p=4$AVYBM5uCgAMUfL6yRDOOow$EdyMtqXtmtFLIN/ciN9ianbw7D0uybz1V5URf5PSvig', 'Buster', 'Yundt', '2023-11-10 12:58:34', '2023-11-10 12:58:34'),
(34, 'Valentin_Bartoletti79', 'Marta.Abernathy33@yahoo.com', '$argon2id$v=19$m=65536,t=3,p=4$BQqrz35j7Dg1cgJz5b2/WQ$hksHbzTqleHwo+ywnGhgpU/oZkmdADeZNfyyzoQTXbs', 'Alf', 'Nienow', '2023-11-10 12:58:34', '2023-11-10 12:58:34'),
(35, 'Manuel_Kris74', 'Samson_Batz@gmail.com', '$argon2id$v=19$m=65536,t=3,p=4$4Q4eZ2YMG4vNKGNHqCftRw$5RlpEBRPtg+gtZNqy4MdUEvAnueQH75fkQpm0YzzNC8', 'Rubie', 'McLaughlin', '2023-11-10 12:58:34', '2023-11-10 12:58:34'),
(36, 'Nick.Okuneva', 'Torrey30@gmail.com', '$argon2id$v=19$m=65536,t=3,p=4$xk73+/Cw86eMWn63dWhT0w$QcxwUmsnLv+BhoWR/3Ee49jlC6jq1yDEvk8Qz/uK4XY', 'Shea', 'Yost', '2023-11-10 12:58:34', '2023-11-10 12:58:34'),
(37, 'Amelia.Bode', 'Lauretta.Wehner@gmail.com', '$argon2id$v=19$m=65536,t=3,p=4$7rTcScvOwncfuGgq7IHGfQ$w3fOWl4V6+42i3JOe/7amRMBdWQMFrOpjtI+hYuTG9M', 'Leopoldo', 'Greenholt-Kiehn', '2023-11-10 12:58:34', '2023-11-10 12:58:34'),
(38, 'Eduardo.Marvin26', 'Olen42@gmail.com', '$argon2id$v=19$m=65536,t=3,p=4$O2Fh8Qe3P9rtFtTLlSL7pw$SmjJeDKxBIL+WVgy5qpZxeaWU/03+7dC17F5MOEEYFw', 'Jailyn', 'Schumm', '2023-11-10 12:58:34', '2023-11-10 12:58:34'),
(39, 'Lera_Sauer', 'Cristobal_Rutherford97@hotmail.com', '$argon2id$v=19$m=65536,t=3,p=4$EvBsiZlkGEaVtBibzNb70Q$1+Jo/Bib5EpwfwexFIHbkpa2rPJslg8NB2LFL2XzTOo', 'Danny', 'Smitham', '2023-11-10 12:58:34', '2023-11-10 12:58:34'),
(40, 'Bryana78', 'Zoey.Kutch@hotmail.com', '$argon2id$v=19$m=65536,t=3,p=4$maCAN3g5mPuhZfDuduw3Pg$8ZmL+uoM3glmGMuwjkOpxMRPzr2A/jx1Fra02Gtl6rA', 'Simeon', 'Schultz', '2023-11-10 12:58:34', '2023-11-10 12:58:34'),
(41, 'Gloria_Bins', 'Emil.Windler@gmail.com', '$argon2id$v=19$m=65536,t=3,p=4$r41ABRQ46FLfXwt399ahjw$eShozSCpf4EpHY+HSBSrmG6/X7HaxfoGvnVQeLYvTXs', 'Dedrick', 'Mueller', '2023-11-10 12:58:34', '2023-11-10 12:58:34'),
(42, 'Fleta.Erdman39', 'Jamel_Mills@gmail.com', '$argon2id$v=19$m=65536,t=3,p=4$on+sH28m6EwvXXVOtQTTfw$s3VlGZkeoiwvAG5L6BZU0ezCzcqvm9vsOff+DBqWSYQ', 'Zander', 'Gerhold', '2023-11-10 12:58:34', '2023-11-10 12:58:34'),
(43, 'Columbus_McGlynn53', 'Timothy_Funk-Shanahan50@hotmail.com', '$argon2id$v=19$m=65536,t=3,p=4$BvKAxp1QEmh4tSFpc728ig$RHDpfzZC9UWqJyFztYC7o4qRVnysaQwUiX21kQk1t/c', 'Layla', 'Cummings', '2023-11-10 12:58:34', '2023-11-10 12:58:34'),
(44, 'Adolfo.Pfannerstill', 'Hildegard.Christiansen@gmail.com', '$argon2id$v=19$m=65536,t=3,p=4$Dev4paSrsZbRvzOfxhQY6g$ZmN0haRHdJ5UGTzUNRyNmjZS0gqfyM+BDZy6ndykqwY', 'Reyna', 'Champlin', '2023-11-10 12:58:34', '2023-11-10 12:58:34'),
(45, 'Ralph_Kessler', 'Ryan12@hotmail.com', '$argon2id$v=19$m=65536,t=3,p=4$eJl3hvNuXv6HtgzHQgVQCQ$UVVxy1phkA9fPyK7wBlM4RsD5/ZZQWo1jg7KNXilEVY', 'Dandre', 'Keebler', '2023-11-10 12:58:34', '2023-11-10 12:58:34'),
(46, 'Maybelle.Hauck', 'Ellsworth_Gleason23@yahoo.com', '$argon2id$v=19$m=65536,t=3,p=4$Er+04qgcvLCiqD7SvdP77A$92eAAaMTuavpvGYC9SRAfLDUUG6MUKu7GM279XTBUt0', 'Rachel', 'Swaniawski', '2023-11-10 12:58:34', '2023-11-10 12:58:34'),
(47, 'Melany.Lebsack50', 'Loy.Bauch@gmail.com', '$argon2id$v=19$m=65536,t=3,p=4$fzBW9WJHnMzF7PaSjIQ9TQ$AmEt9SPjM5sbXqH3o+B9g7JgG9W3daWpHxVePddg0Hg', 'Sister', 'Robel', '2023-11-10 12:58:34', '2023-11-10 12:58:34'),
(48, 'Johnnie.Schaefer75', 'Mustafa.Swift@gmail.com', '$argon2id$v=19$m=65536,t=3,p=4$XeciBGpu7AVCrMcu4OjXKQ$LH31R9E3UPDcIjE7vakAVdZ0SKZxgSGhNhae1OND5cs', 'Drake', 'Kuhlman', '2023-11-10 12:58:34', '2023-11-10 12:58:34'),
(49, 'Sim_Considine', 'Frederick78@gmail.com', '$argon2id$v=19$m=65536,t=3,p=4$pJPIpY2mj8SVKcV2BoWJJQ$JuMeSCC2fM8Oorl+uWpisx6lnknOlg4zHU261WLO+l8', 'Luisa', 'Lebsack', '2023-11-10 12:58:34', '2023-11-10 12:58:34'),
(50, 'Annalise76', 'Shanny.Sporer75@gmail.com', '$argon2id$v=19$m=65536,t=3,p=4$MMsIvPE+zi/LHDYsQb3puQ$+T8kJsl/wLLgRKncyqH+YVRvjzwxa3ac8E0nPTsGVjY', 'Otto', 'Tremblay', '2023-11-10 12:58:34', '2023-11-10 12:58:34'),
(51, 'Testing Account', 'test@gmail.com', '$argon2id$v=19$m=65536,t=3,p=4$Fsrn7g0oJlrtBqeN688+aQ$I888DW8sXM01Miu0kNJl8u+yq1Lr3pd9Oj6Q5e8xJJc', 'Testing', 'Account', '2023-11-10 12:58:34', '2023-11-10 12:58:34'),
(52, 'xdfcvgjklm', 'john@johnson.com', '$argon2id$v=19$m=65536,t=4,p=1$MDV3VDFuSVhOZERjZFhpUg$ezaweTPW9LWN75hyEAikL8z/bzgn9hpBQx6OcM2Agq0', 'John', 'Johnson', '2023-11-10 12:59:33', '2023-11-10 12:59:33'),
(53, 'ezreer', 'ee@bb.com', '$argon2id$v=19$m=65536,t=4,p=1$NmhuYS4zT0o5M0l1ZDFTLw$yrYFpkm2T4Le2zio6PT0xTRunbElyL8LnySgQkRTREg', 'EE', 'EE', '2023-11-13 13:52:58', '2023-11-13 13:52:58'),
(54, 'ekemlkle', 'jebed@glg.com', '$argon2id$v=19$m=65536,t=4,p=1$RG5aQnU5Wjc4cEppV3J1dg$GInHoNs89z8Gd0S2RcgrtpdI6rP5LTc2MDw26n5+8o0', 'Jebed', 'RUEI', '2023-11-13 14:08:42', '2023-11-13 14:08:42'),
(55, 'eezgr', '3za@gm.com', '$argon2id$v=19$m=65536,t=4,p=1$blljM2dYQTdLUTdhRDFNcg$oW0xMO9zGCN+/5/wApxf93jRHcBbsmXpdYxlzjHfFcw', 'Gebee', 'GREG', '2023-11-17 13:33:46', '2023-11-17 13:33:46');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `user_profile`
--

CREATE TABLE `user_profile` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `profilePictureUrl` varchar(255) NOT NULL,
  `about` text NOT NULL,
  `theme` text NOT NULL DEFAULT 'light',
  `language` text NOT NULL DEFAULT 'text_en'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `user_profile`
--

INSERT INTO `user_profile` (`id`, `userid`, `profilePictureUrl`, `about`, `theme`, `language`) VALUES
(1, 17, 'https://avatars.githubusercontent.com/u/56205165', 'Aro congregatio decumbo abscido vilis arcesso aggredior tonsor comptus. Accommodo odit auctus thesaurus virgo porro cruciamentum caelum canis. Abundans angelus admitto solium.', 'dark', 'text_en'),
(2, 26, 'https://cloudflare-ipfs.com/ipfs/Qmd3W5DuhgHirLHGVixi6V76LhCkZUz6pnFt5AJBiyvHye/avatar/577.jpg', 'Vindico casus contigo accusantium deputo concido illo versus tabesco. Territo textilis sodalitas viscus repudiandae colligo patior theca. Assentator tondeo quo succurro vespillo esse benevolentia.', 'light', 'text_en'),
(3, 6, 'https://cloudflare-ipfs.com/ipfs/Qmd3W5DuhgHirLHGVixi6V76LhCkZUz6pnFt5AJBiyvHye/avatar/654.jpg', 'Aequitas unus video termes provident pauper centum corrumpo beatus. Aduro aperte concido votum truculenter suppellex reiciendis aeneus vergo antiquus. Coepi doloribus depopulo vester.', 'light', 'text_nl'),
(4, 50, 'https://avatars.githubusercontent.com/u/28494631', 'Verbum necessitatibus pectus iure sophismata considero stipes. Tunc spectaculum tam ancilla nesciunt adeptio degenero timidus addo. Vos tollo abstergo magnam totus deduco.', 'dark', 'text_fr'),
(5, 25, 'https://cloudflare-ipfs.com/ipfs/Qmd3W5DuhgHirLHGVixi6V76LhCkZUz6pnFt5AJBiyvHye/avatar/186.jpg', 'Tam videlicet claudeo. Accusator voluptates laboriosam tergeo aegrotatio debitis esse deprimo adfectus deporto. Nisi aedificium caelum deficio acer perspiciatis aegrotatio infit.', 'dark', 'text_fr'),
(6, 48, 'https://avatars.githubusercontent.com/u/33005645', 'Conventus teneo summopere cornu autem delibero cohaero denuo dolore. Provident volva arbustum caries vaco cubo vulariter. Theca aranea cui denego.', 'light', 'text_fr'),
(7, 22, 'https://cloudflare-ipfs.com/ipfs/Qmd3W5DuhgHirLHGVixi6V76LhCkZUz6pnFt5AJBiyvHye/avatar/1147.jpg', 'Calco dens enim velut ante. Paens debitis sollicito fuga cotidie decor. Quibusdam aliquid alioqui absum sopor varietas adamo tertius temperantia arcus.', 'dark', 'text_nl'),
(8, 32, 'https://avatars.githubusercontent.com/u/56998642', 'Minima comptus quae tamquam uxor agnosco. Tres sodalitas debilito alienus ater quisquam annus vinco earum ago. Caries adinventitias adstringo crux crinis dolor.', 'light', 'text_en'),
(9, 13, 'https://avatars.githubusercontent.com/u/85869182', 'Aestus tenuis sopor amaritudo varius audentia. Id audax adsuesco suasoria defendo arma supra tergo adiuvo. Corrumpo dicta maiores adaugeo vester.', 'light', 'text_nl'),
(10, 29, 'https://avatars.githubusercontent.com/u/43902816', 'Via tendo tollo thesis. Attonbitus crapula desolo varietas nesciunt. Quod aegrus perferendis tenetur curiositas synagoga caste.', 'dark', 'text_en'),
(11, 45, 'https://cloudflare-ipfs.com/ipfs/Qmd3W5DuhgHirLHGVixi6V76LhCkZUz6pnFt5AJBiyvHye/avatar/832.jpg', 'Carpo supellex odio debeo tamquam vociferor. Ipsa voluptatem trans. Creta conventus usus sum sed depereo.', 'light', 'text_nl'),
(12, 43, 'https://cloudflare-ipfs.com/ipfs/Qmd3W5DuhgHirLHGVixi6V76LhCkZUz6pnFt5AJBiyvHye/avatar/422.jpg', 'Quas arto sol sollicito trepide ventito cursus adstringo teres uredo. Advenio ars agnosco bonus fugiat solus theca. Bellum vicissitudo utrimque excepturi sollicito stips fugiat tendo.', 'dark', 'text_nl'),
(13, 10, 'https://avatars.githubusercontent.com/u/94832879', 'Valens caveo spargo. Infit vespillo vigilo coaegresco aranea conor accusantium. Sint vergo astrum atrocitas saepe cunctatio aegre thesaurus.', 'light', 'text_nl'),
(14, 23, 'https://avatars.githubusercontent.com/u/48510588', 'Omnis odit ratione ipsam. Ars degusto iusto soluta terminatio supplanto. Venio odio ambitus.', 'light', 'text_nl'),
(15, 34, 'https://avatars.githubusercontent.com/u/15912345', 'Explicabo aperio possimus cognatus. Ex ager vestigium texo terebro laborum corona vehemens spiculum deporto. Aetas totus adstringo eaque urbanus tabula vorax tum.', 'light', 'text_nl'),
(16, 4, 'https://avatars.githubusercontent.com/u/22076672', 'Uberrime ambulo solium victus una arma aegrus vos terreo. Vapulus vespillo celer arcus defendo surgo dens vulgaris claudeo. Degusto vomito absorbeo chirographum summopere tondeo abduco temptatio a cena.', 'dark', 'text_en'),
(17, 30, 'https://cloudflare-ipfs.com/ipfs/Qmd3W5DuhgHirLHGVixi6V76LhCkZUz6pnFt5AJBiyvHye/avatar/46.jpg', 'Crustulum decet quia ambulo pax spiculum astrum talus concedo. Et defleo conturbo ulciscor possimus demulceo ager adeo id. Concedo arbitro nisi cresco.', 'light', 'text_en'),
(18, 11, 'https://avatars.githubusercontent.com/u/50611344', 'Alioqui voluntarius delectus coadunatio abundans theologus spiritus vivo laboriosam itaque. Debilito ea adfectus thema vulpes. Ad deripio succurro.', 'light', 'text_fr'),
(19, 27, 'https://cloudflare-ipfs.com/ipfs/Qmd3W5DuhgHirLHGVixi6V76LhCkZUz6pnFt5AJBiyvHye/avatar/28.jpg', 'Fugit arto strenuus quo enim porro apostolus cattus subiungo vitiosus. Suggero aeneus deprimo maxime cado. Callide tumultus attonbitus inventore ait abbas suggero solvo.', 'light', 'text_en'),
(20, 28, 'https://cloudflare-ipfs.com/ipfs/Qmd3W5DuhgHirLHGVixi6V76LhCkZUz6pnFt5AJBiyvHye/avatar/216.jpg', 'Celebrer cinis sophismata caecus. Callide compello defungo tumultus coepi concedo ultio vinitor abutor. Antiquus verbera apparatus aro suspendo exercitationem antiquus subseco damnatio termes.', 'light', 'text_nl'),
(21, 19, 'https://cloudflare-ipfs.com/ipfs/Qmd3W5DuhgHirLHGVixi6V76LhCkZUz6pnFt5AJBiyvHye/avatar/1086.jpg', 'Tredecim dolor viduo sulum cohors sono eum delego natus. Alioqui caterva repudiandae corrumpo usque expedita aptus sit. Surculus ancilla pecus acidus taceo conculco utroque appono.', 'light', 'text_en'),
(22, 3, 'https://cloudflare-ipfs.com/ipfs/Qmd3W5DuhgHirLHGVixi6V76LhCkZUz6pnFt5AJBiyvHye/avatar/1163.jpg', 'Vociferor cohibeo aggero numquam. Tumultus quae coruscus solitudo viscus cum patruus. Somniculosus totidem conspergo adeptio constans toties acerbitas.', 'dark', 'text_en'),
(23, 18, 'https://avatars.githubusercontent.com/u/500023', 'Cresco vigilo aperio tam vita comprehendo caelum iure vociferor aperiam. Uxor tristis absque ceno beatus. Cum acervus minus odio adamo corrumpo adfectus vesper tremo carmen.', 'dark', 'text_nl'),
(24, 21, 'https://avatars.githubusercontent.com/u/79698501', 'Tempus bonus vestrum est. Circumvenio tergeo nulla custodia asporto clamo clarus depulso trans. Comis tibi adfero adhaero iusto coadunatio cultellus.', 'dark', 'text_nl'),
(25, 42, 'https://avatars.githubusercontent.com/u/57907670', 'Tristis thorax defero claustrum magnam. Vulpes cedo cimentarius vix tenus celer suggero casso debeo. Solitudo bene cinis dens cohaero deduco sursum adimpleo thema.', 'light', 'text_fr'),
(26, 33, 'https://avatars.githubusercontent.com/u/11075766', 'Terreo venio cibus. Carcer impedit verus canonicus. Sufficio provident defaeco synagoga verecundia succedo delego neque.', 'dark', 'text_fr'),
(27, 44, 'https://cloudflare-ipfs.com/ipfs/Qmd3W5DuhgHirLHGVixi6V76LhCkZUz6pnFt5AJBiyvHye/avatar/945.jpg', 'Vix ullus maxime paens. Capillus deludo quod ab. Tenetur artificiose patrocinor defetiscor.', 'dark', 'text_fr'),
(28, 39, 'https://cloudflare-ipfs.com/ipfs/Qmd3W5DuhgHirLHGVixi6V76LhCkZUz6pnFt5AJBiyvHye/avatar/209.jpg', 'Unus curiositas laboriosam colo utroque abstergo usus. Venia sophismata conduco cubo non. Derideo pauci terra debeo apto astrum non sonitus.', 'dark', 'text_en'),
(29, 36, 'https://avatars.githubusercontent.com/u/73610086', 'Arcesso dens carpo natus terreo cilicium. Amet avarus culpo. Exercitationem textilis copiose viridis provident statua abeo libero coruscus.', 'dark', 'text_fr'),
(30, 15, 'https://avatars.githubusercontent.com/u/11804482', 'A sperno officia cubo cribro adversus amitto arto. Minus corroboro excepturi contigo admoneo. Et suppono celo calamitas.', 'dark', 'text_fr'),
(31, 9, 'https://avatars.githubusercontent.com/u/76168054', 'Via argumentum conicio in decretum crur odio tamquam audacia tabula. Ducimus thymbra demergo vulgivagus culpa vulnero. Veritas subseco admitto.', 'dark', 'text_nl'),
(32, 38, 'https://cloudflare-ipfs.com/ipfs/Qmd3W5DuhgHirLHGVixi6V76LhCkZUz6pnFt5AJBiyvHye/avatar/470.jpg', 'Desidero vinitor tersus soluta demonstro tepesco commodo eaque ancilla summopere. Dedico ulciscor tribuo claudeo vesco strues articulus. Sit agnitio vobis doloremque cedo substantia defero comprehendo vox defetiscor.', 'light', 'text_fr'),
(33, 24, 'https://avatars.githubusercontent.com/u/91617531', 'Spectaculum denuncio sed audentia cimentarius laborum. Celebrer aperte theologus arcus. Subnecto tum delectus sub baiulus desidero tremo.', 'dark', 'text_fr'),
(34, 37, 'https://avatars.githubusercontent.com/u/98879760', 'Talis et pel deporto centum tribuo. Cunae tamisium adeptio tabella pel vos decerno terminatio coma volubilis. Vespillo armarium complectus supra cibo tenax delinquo fugit eos.', 'light', 'text_nl'),
(35, 5, 'https://cloudflare-ipfs.com/ipfs/Qmd3W5DuhgHirLHGVixi6V76LhCkZUz6pnFt5AJBiyvHye/avatar/234.jpg', 'Avarus fugiat aureus ad ipsam repellendus ademptio. Talio synagoga voco vinculum crepusculum sufficio clam terror. Canonicus amplus tum.', 'light', 'text_nl'),
(36, 7, 'https://avatars.githubusercontent.com/u/10590960', 'Curto talio tripudio solitudo cometes. Accommodo voluptatem admiratio tremo celebrer adeo textus. Concido theologus recusandae stips super tredecim.', 'dark', 'text_fr'),
(37, 20, 'https://cloudflare-ipfs.com/ipfs/Qmd3W5DuhgHirLHGVixi6V76LhCkZUz6pnFt5AJBiyvHye/avatar/66.jpg', 'Ter torqueo tubineus ventosus apparatus. Nam similique defendo officiis debeo aliquam tactus basium annus sollers. Deleo acquiro nobis toties administratio appositus solitudo.', 'dark', 'text_en'),
(38, 1, 'https://cloudflare-ipfs.com/ipfs/Qmd3W5DuhgHirLHGVixi6V76LhCkZUz6pnFt5AJBiyvHye/avatar/1071.jpg', 'Aeternus somniculosus verto umbra decipio angulus soleo contabesco calco despecto. Usus timidus vel tolero aliquam caelestis via bene causa campana. Deleo terra temeritas confugo vicissitudo officiis.', 'light', 'text_fr'),
(39, 49, 'https://avatars.githubusercontent.com/u/59890924', 'Alo in assentator caelum. Delibero veritatis creator a adinventitias ascisco summopere. Tamdiu supellex arguo tonsor vulgus quos adfero.', 'light', 'text_nl'),
(40, 2, 'https://avatars.githubusercontent.com/u/68575903', 'Urbs timidus deripio calco. Verbum carcer odit demoror. Victus arcus volo conduco.', 'light', 'text_en'),
(41, 14, 'https://avatars.githubusercontent.com/u/55103935', 'Sollers theologus socius sequi vos animus libero antea candidus. Depopulo demitto ulterius clibanus eos totus aeneus quo odit. Dicta venustas hic abscido sustineo caecus beneficium vado vere.', 'dark', 'text_nl'),
(42, 16, 'https://avatars.githubusercontent.com/u/8895378', 'Virtus crux vitium abeo conforto vomica altus. Apostolus terebro cado charisma tot fugiat cupiditas comptus umquam temporibus. Tyrannus degusto carbo.', 'dark', 'text_nl'),
(43, 40, 'https://avatars.githubusercontent.com/u/88790081', 'Decerno adsum curiositas aestus. Caput soleo alter aranea similique. Colo cupiditas amplus vomer sub.', 'dark', 'text_en'),
(44, 12, 'https://avatars.githubusercontent.com/u/21929462', 'Suppellex velut ademptio appello dolorem causa tergo. Constans beatae pauci carpo auctus victus. Auctus crux vulgaris creator caput adipiscor venio terra.', 'dark', 'text_nl'),
(45, 31, 'https://avatars.githubusercontent.com/u/59432103', 'Vester angustus architecto sint cursim adstringo pauper advoco canonicus. Advoco animadverto corona. Urbanus derideo crudelis odio ter valens cogito summisse bellum.', 'dark', 'text_fr'),
(46, 47, 'https://cloudflare-ipfs.com/ipfs/Qmd3W5DuhgHirLHGVixi6V76LhCkZUz6pnFt5AJBiyvHye/avatar/72.jpg', 'Culpa appositus amor adipiscor vinum trepide curvo tracto tyrannus. Antepono teneo triumphus sustineo. Comis copiose sollicito.', 'dark', 'text_nl'),
(47, 46, 'https://avatars.githubusercontent.com/u/81184388', 'Tabella ager vilicus audeo velum carbo repudiandae aliquam animus candidus. Arbor itaque aegrus adinventitias adnuo auxilium cupiditate. Ulterius coaegresco magni civitas sumo tardus utpote rerum cohors.', 'dark', 'text_en'),
(48, 35, 'https://cloudflare-ipfs.com/ipfs/Qmd3W5DuhgHirLHGVixi6V76LhCkZUz6pnFt5AJBiyvHye/avatar/44.jpg', 'Vel ventosus civitas maiores cupio testimonium. Culpa agnitio solus aptus degusto valde. Claro excepturi cilicium infit calco infit taceo commodi totidem deficio.', 'light', 'text_fr'),
(49, 41, 'https://cloudflare-ipfs.com/ipfs/Qmd3W5DuhgHirLHGVixi6V76LhCkZUz6pnFt5AJBiyvHye/avatar/133.jpg', 'Volo spiculum valeo bos dignissimos rerum tutamen solvo tero. Trepide tametsi advenio paens admoneo acies tempore corporis desidero. Amicitia reprehenderit cultura calco calamitas cur assentator tollo.', 'dark', 'text_nl'),
(50, 8, 'https://cloudflare-ipfs.com/ipfs/Qmd3W5DuhgHirLHGVixi6V76LhCkZUz6pnFt5AJBiyvHye/avatar/228.jpg', 'Cimentarius tristis deprecator allatus est fugiat subnecto. Ducimus admitto vitae tibi ut cruciamentum. Derelinquo cursim deludo.', 'dark', 'text_fr'),
(51, 51, 'https://avatars.githubusercontent.com/u/76388079', 'Testing Account', 'light', 'text_en'),
(52, 52, 'https://avatars.githubusercontent.com/u/64209400?v=4', 'Hello!', 'dark', 'text_en'),
(53, 53, 'https://avatars.githubusercontent.com/u/64209400?v=4', 'Hello!', 'light', 'text_en'),
(54, 54, 'https://avatars.githubusercontent.com/u/64209400?v=4', 'Hello!', 'light', 'text_en'),
(55, 55, 'https://avatars.githubusercontent.com/u/64209400?v=4', 'Hello!', 'light', 'text_en');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `user_roles`
--

CREATE TABLE `user_roles` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `user_roles`
--

INSERT INTO `user_roles` (`id`, `name`) VALUES
(3, 'admin'),
(1, 'guest'),
(2, 'member');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `user_role_mapping`
--

CREATE TABLE `user_role_mapping` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `roleid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `user_role_mapping`
--

INSERT INTO `user_role_mapping` (`id`, `userid`, `roleid`) VALUES
(1, 41, 1),
(2, 5, 2),
(3, 39, 1),
(4, 36, 3),
(5, 12, 3),
(6, 17, 2),
(7, 24, 2),
(8, 10, 2),
(9, 50, 1),
(10, 6, 1),
(11, 20, 1),
(12, 11, 1),
(13, 47, 2),
(14, 34, 2),
(15, 40, 1),
(16, 9, 3),
(17, 13, 3),
(18, 23, 2),
(19, 28, 2),
(20, 4, 3),
(21, 2, 1),
(22, 3, 3),
(23, 15, 2),
(24, 35, 1),
(25, 25, 2),
(26, 16, 3),
(27, 38, 1),
(28, 32, 2),
(29, 1, 1),
(30, 45, 3),
(31, 14, 1),
(32, 37, 3),
(33, 49, 2),
(34, 7, 1),
(35, 48, 3),
(36, 31, 1),
(37, 44, 3),
(38, 46, 3),
(39, 33, 1),
(40, 43, 3),
(41, 29, 3),
(42, 18, 1),
(43, 30, 3),
(44, 8, 2),
(45, 26, 2),
(46, 19, 3),
(47, 22, 3),
(48, 21, 2),
(49, 27, 1),
(50, 42, 1);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `translations`
--
ALTER TABLE `translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexen voor tabel `user_profile`
--
ALTER TABLE `user_profile`
  ADD PRIMARY KEY (`id`),
  ADD KEY `profile_userid` (`userid`);

--
-- Indexen voor tabel `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexen voor tabel `user_role_mapping`
--
ALTER TABLE `user_role_mapping`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_mapping_roleid` (`roleid`),
  ADD KEY `role_mapping_userid` (`userid`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `translations`
--
ALTER TABLE `translations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT voor een tabel `user_profile`
--
ALTER TABLE `user_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT voor een tabel `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT voor een tabel `user_role_mapping`
--
ALTER TABLE `user_role_mapping`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `user_profile`
--
ALTER TABLE `user_profile`
  ADD CONSTRAINT `profile_userid` FOREIGN KEY (`userid`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
