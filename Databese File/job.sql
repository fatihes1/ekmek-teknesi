-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 17 Haz 2021, 13:52:24
-- Sunucu sürümü: 10.4.19-MariaDB
-- PHP Sürümü: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `job`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `application`
--

CREATE TABLE `application` (
  `app_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `app_status` varchar(15) COLLATE utf8mb4_turkish_ci NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `application`
--

INSERT INTO `application` (`app_id`, `user_id`, `job_id`, `app_status`) VALUES
(1, 12, 2, '2'),
(42, 12, 3, '1'),
(43, 11, 10, '2'),
(44, 11, 11, '2'),
(45, 13, 10, '1'),
(46, 14, 12, '1'),
(47, 17, 14, '1'),
(48, 17, 12, '1');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `job`
--

CREATE TABLE `job` (
  `job_id` int(11) NOT NULL,
  `job_title` varchar(100) COLLATE utf8mb4_turkish_ci NOT NULL,
  `job_company` varchar(40) COLLATE utf8mb4_turkish_ci NOT NULL,
  `job_experience` varchar(15) COLLATE utf8mb4_turkish_ci DEFAULT NULL,
  `job_create_date` date DEFAULT current_timestamp(),
  `job_kind` varchar(100) COLLATE utf8mb4_turkish_ci DEFAULT NULL,
  `job_category` varchar(255) COLLATE utf8mb4_turkish_ci DEFAULT NULL,
  `job_city` varchar(255) COLLATE utf8mb4_turkish_ci DEFAULT NULL,
  `job_detail` text COLLATE utf8mb4_turkish_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `job`
--

INSERT INTO `job` (`job_id`, `job_title`, `job_company`, `job_experience`, `job_create_date`, `job_kind`, `job_category`, `job_city`, `job_detail`, `user_id`) VALUES
(2, 'Elektrik Teknisyeni Aranıyor', 'TEDAŞ', '3', '2021-06-12', 'Full-time', 'Teknisyen', 'İstanbul', 'Elektrik teknisyeni lazım. İletişime geçeceğiz sizlerle !', 11),
(3, 'Deneme', 'Deneme Şirket', '5', '2021-06-12', 'Part-time', 'Muhassebe', 'Ankara', 'Ankara da yaşıyor olmalısınız.', 11),
(10, 'Pazarlama Müdürü', 'AB Şirket ', '7', '2021-06-13', 'Full-time', 'Pazarlama', 'Ankara', 'Pazarlama müdürü alımı yapılacaktır. Ankara da yaşayan adaylar için uygundur.', 12),
(11, 'Diyetisyen Aranıyor', 'Ülker', '4', '2021-06-13', 'Full-time', 'Diğer', 'Bursa', 'Personel yemeklerinden sorumlu olacak diyetisyen aranmaktadır. Güncellendi', 12),
(12, 'Microsoft Summer Internship', 'Microsoft', '0', '2021-06-15', 'Stajyer', 'Bilişim', 'İstanbul', 'Online olarak planlanan Microsoft Summer Internship 2021\'e davetlisiniz. ', 15),
(13, 'Hürriyet Emlak Part-time Çalışan Arıyor', 'Hürriyet Emlak', '4', '2021-06-15', 'Part-time', 'Emlak', 'Bursa', 'Bursa şehrinde yaşayan finans üzerine bilgi sahibi olan. İlgili bölümlerden mezun veya ilgili bölümlerde 3 veya 4. yılında olan üniversite öğrenciler başvuru yapabilir.', 11),
(14, 'Amazon Student Program 2021', 'Amazon Türkiye', '0', '2021-06-15', 'Stajyer', 'Bilişim', 'İstanbul', 'Amazon student program 2021 kapsamında zorunlu yaz stajı bulunan öğrencilerin başvurusuna açıktır. Lütfen başvurunuzu yaptıktan sonra belirli aralıklarla mail adresinizi kontrol etmeyi unutmayınız.', 16),
(15, 'Mersin Limanı Lojistik Uzmanı', 'Ekol Lojistik', '5', '2021-06-16', 'Full-time', 'Diğer', 'Mersin', 'Mersin limanında çalışmak üzere Lojistik uzmanı aranmaktadır. Tercihen Mersin-Adana illerinden başvurulara öncelik verilecektir.', 17);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) COLLATE utf8mb4_turkish_ci NOT NULL,
  `user_email` varchar(255) COLLATE utf8mb4_turkish_ci NOT NULL,
  `user_password` varchar(255) COLLATE utf8mb4_turkish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `user_email`, `user_password`) VALUES
(11, 'es', 'es@gmail.com', '09cd68a2a77b22a312dded612dd0d9988685189f'),
(12, 'es1', 'es1@gmail.com', 'edfdb76c9de9f193fe68b67e83f9337fc7e90a27'),
(13, 'yeni', 'yeni@gmail.com', 'aa342f5cc82d97b096efc2df70651a8a2de6b06f'),
(14, 'Fuat_Kaya', 'fuatkaya@gmail.com', 'd5d06328057baa30b9f3fc29a4593091ae8b8c88'),
(15, 'kadircelik', 'kadircelik@microsoft.com', 'bdc76a569440c5af42bb7b725da089898953cfea'),
(16, 'birolaslan', 'birolaslan@amazon.com', 'e83dea51b9176694cc5516e095716a0467bc49ec'),
(17, 'fatihes', 'fatihes@gmail.com', 'e809b138dc29a527f7b0d74f1c8a9e1eabcc97ab');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `application`
--
ALTER TABLE `application`
  ADD PRIMARY KEY (`app_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `job_id` (`job_id`);

--
-- Tablo için indeksler `job`
--
ALTER TABLE `job`
  ADD PRIMARY KEY (`job_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Tablo için indeksler `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `application`
--
ALTER TABLE `application`
  MODIFY `app_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- Tablo için AUTO_INCREMENT değeri `job`
--
ALTER TABLE `job`
  MODIFY `job_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Tablo için AUTO_INCREMENT değeri `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `application`
--
ALTER TABLE `application`
  ADD CONSTRAINT `application_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `application_ibfk_2` FOREIGN KEY (`job_id`) REFERENCES `job` (`job_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Tablo kısıtlamaları `job`
--
ALTER TABLE `job`
  ADD CONSTRAINT `job_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
