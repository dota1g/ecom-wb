-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2023 at 03:29 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecom`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `adminID` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `adminpassword` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`adminID`, `username`, `firstName`, `lastname`, `email`, `adminpassword`) VALUES
(1, 'admin', 'Peter', 'Nikita', 'psp1g@brickedup.com', '519a5595d315eff75f5a2b26c8093549313d4fb91fdb61e20753677166113897');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cartID` int(5) NOT NULL,
  `userID` int(11) NOT NULL,
  `productID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cartID`, `userID`, `productID`) VALUES
(8, 2, 2),
(9, 2, 2),
(10, 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `email`
--

CREATE TABLE `email` (
  `emailID` int(5) NOT NULL,
  `userID` int(11) NOT NULL,
  `emailSubject` varchar(255) NOT NULL DEFAULT '(blank)',
  `emailContent` longtext NOT NULL,
  `didUserReadMsg` tinyint(4) NOT NULL DEFAULT 0,
  `didAdminReadMsg` tinyint(4) NOT NULL DEFAULT 0,
  `isFromAdmin` tinyint(4) NOT NULL DEFAULT 0,
  `productID` int(11) DEFAULT NULL,
  `orderID` int(11) DEFAULT NULL,
  `dateSent` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `email`
--

INSERT INTO `email` (`emailID`, `userID`, `emailSubject`, `emailContent`, `didUserReadMsg`, `didAdminReadMsg`, `isFromAdmin`, `productID`, `orderID`, `dateSent`) VALUES
(3, 3, '.THIS AINT COLUMN DUMBASS.', '.ASDASDASDASDASD.', 0, 1, 0, NULL, NULL, '2023-05-16 15:17:04'),
(4, 3, 'test', 'more of that testing shit', 1, 1, 0, NULL, NULL, '2023-05-16 15:19:41'),
(5, 3, 'yo', 'i want the really good one the one like the brooklyn nets kinda shit. thanks', 0, 1, 0, NULL, NULL, '2023-05-16 17:54:20'),
(6, 3, 'yo', 'plz', 0, 1, 0, NULL, 5, '2023-05-16 17:59:52'),
(8, 3, 'test', 'heat in 4', 0, 1, 0, NULL, NULL, '2023-05-17 08:17:07'),
(9, 3, 'test', 'nuggets in 4', 0, 1, 0, NULL, NULL, '2023-05-17 08:19:47'),
(10, 3, 'hey', 'what court you want cuh', 1, 1, 1, NULL, 4, '2023-05-17 22:14:15'),
(11, 3, 'UI/UX Design', 'tf website you want', 1, 1, 1, NULL, 6, '2023-05-18 13:59:05'),
(12, 3, 'UI/UX Design', 'i want the uhhhhhhhhh good one', 0, 1, 0, NULL, 6, '2023-05-18 14:42:35'),
(13, 3, 'UI/UX Design', 'bitchass give me an idea', 1, 0, 1, NULL, 6, '2023-05-18 15:19:44'),
(14, 2, 'Billboard Design', 'uhh, we receive this order so what you need', 1, 0, 1, NULL, 7, '2023-05-18 21:08:02'),
(15, 2, 'Billboard Design', 'uhh kinda like this: https://midwestbillboards.com/wp-content/uploads/2021/09/29045-Town-East-Beauty-1500.jpg', 0, 1, 0, NULL, 7, '2023-05-18 21:09:28'),
(16, 2, 'Billboard Design', 'aight say no more', 1, 0, 1, NULL, 7, '2023-05-18 21:10:04'),
(17, 2, 'Billboard Design', 'hey how bout this: https://graphicsfamily.com/wp-content/uploads/edd/2022/12/Big-Billboard-Banner-Design-Template-scaled.jpg', 1, 0, 1, NULL, 7, '2023-05-18 21:11:48'),
(18, 2, 'Billboard Design', 'yeah i fucc wit it.', 0, 1, 0, NULL, 7, '2023-05-18 21:12:24'),
(19, 2, 'Billboard Design', 'ok consider it done cuh', 1, 0, 1, NULL, 7, '2023-05-18 21:12:50');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderID` int(5) NOT NULL,
  `userID` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  `dateOrdered` datetime NOT NULL DEFAULT current_timestamp(),
  `orderStatus` tinyint(4) NOT NULL DEFAULT 0,
  `dateDelivered` datetime DEFAULT NULL,
  `isDelivered` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderID`, `userID`, `productID`, `dateOrdered`, `orderStatus`, `dateDelivered`, `isDelivered`) VALUES
(4, 3, 2, '2023-05-01 15:59:24', 3, NULL, 0),
(5, 3, 2, '2023-05-01 17:01:50', 4, NULL, 0),
(6, 3, 5, '2023-05-17 09:23:51', 4, NULL, 0),
(7, 2, 6, '2023-05-18 21:06:52', 3, NULL, 0),
(8, 2, 8, '2023-05-18 21:31:08', 4, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `productID` int(4) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `productShortDesc` varchar(255) NOT NULL,
  `productDesc` longtext DEFAULT NULL,
  `productPrice` float NOT NULL,
  `isProductAvailable` tinyint(4) NOT NULL,
  `productImg` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`productID`, `productName`, `productShortDesc`, `productDesc`, `productPrice`, `isProductAvailable`, `productImg`) VALUES
(1, 'Brochures', 'The thing you give then they throw away', 'We offer a professional brochure design service that will help you create a brochure that is both informative and visually appealing. Our team of experienced designers will work with you to create a brochure that meets your specific needs and budget.', 1200, 1, 'bro.jpg'),
(2, 'NBA 2K14 Custom Court', 'A custom court for your NBA favorite team, or your own.', 'Make your home feel like more home! We will create a court in any style, from plain to City Connect style!', 252, 1, 'court.png'),
(4, 'Social Media Cover', 'A large image thing that makes your SM profile presentable', 'Make your social media profile more pleasing to your visitors&#039; -- or stalker&#039;s eye! We accept commissions on different sizes depends on what social media platform the image will be used.', 1200, 1, 'covers.jpg'),
(5, 'Web/Mobile UI/UX Design', 'A mockup design for your dream web/mobile app!', 'Our team of experienced designers and developers work closely with you to understand your business goals and create a design that meets your specific requirements. We use a variety of design methodologies and tools to ensure that our products are both visually appealing and easy to use.', 1500, 1, 'ui.png'),
(6, 'Billboard Design', 'Something to distract drivers with', 'Our billboard design service will help you create eye-catching and effective billboards that will reach your target audience. We have a team of experienced designers who will work with you to create a design that meets your specific needs and budget. If you are looking for a billboard design service that will help you create an effective and eye-catching billboard, then our service is the perfect choice for you. Contact us today to learn more about our services and to get started on your billboard design project. NOTE: Only design, we do not offer ad spaces.', 3500, 1, 'billboard.jpg'),
(7, 'Photo Enhancement', 'Blur, gone!', 'Introducing our revolutionary Photo Enhancement Service, designed to bring out the best in your precious memories. Whether you&#039;re a professional photographer, a social media influencer, or simply an individual looking to enhance your personal photos, our service is tailored to meet all your photo editing needs. Our service covers a wide range of enhancements, including color correction, exposure adjustment, noise reduction, sharpening, and more. We understand that every photo has its unique story, and we work closely with you to ensure that your vision is brought to life. Whether you want to add a touch of vibrancy to your landscapes, restore old photographs, or create stunning portraits, our team is dedicated to providing impeccable results.', 599, 1, 'Photographic_enhancement.jpg'),
(8, 'Youtube Thumbnails', 'The thing where you see people always look shocked', 'YouTube Thumbnail Creation Service, designed to grab attention and skyrocket the success of your YouTube videos. As the saying goes, &quot;Don&#039;t judge a book by its cover,&quot; but when it comes to YouTube, first impressions are everything. That&#039;s why having an eye-catching thumbnail is crucial for attracting viewers and driving engagement.\r\n\r\nWith our expert team of creative designers and cutting-edge technology, we offer a seamless and professional thumbnail creation service that will make your videos stand out in the crowded YouTube landscape. We understand the power of visual appeal and know exactly how to craft thumbnails that captivate audiences, increase click-through rates, and ultimately boost your channel&#039;s growth.\r\n\r\nWhat sets our YouTube Thumbnail Creation Service apart is our commitment to tailoring each thumbnail to the unique essence of your videos. We take into account your brand identity, target audience, and video content to ensure that every thumbnail reflects your channel&#039;s personality and entices viewers to click. Whether you&#039;re creating educational content, gaming videos, beauty tutorials, or vlogs, our versatile design team can cater to your specific needs.', 250, 1, 'youtube-thumbnail-templates.jpg'),
(9, 'Web Ad Banners', 'We&#039;ll try to not show that ad again - Ad closed by Google', 'Introducing our exceptional Ad Banner Design Service, where creativity meets effective marketing!Are you looking to capture your target audience&#039;s attention and drive impressive results for your business? Look no further! Our Ad Banner Design Service is meticulously crafted to deliver captivating, eye-catching banners that will make your brand shine and leave a lasting impact on potential customers.', 999, 0, 'c4d8692b2dc435156e08ce5c549da4e3.png'),
(10, 'Movie Banner', 'Lights, camera, action!', 'Lights, camera, action! Your film deserves an unforgettable first impression, and our expert team of graphic designers is here to make it happen. With our Movie Poster Design Service, we bring your vision to life, capturing the essence of your film and captivating audiences at a glance.\r\n\r\nWhy settle for a generic poster when you can have a custom-made masterpiece? Our designers are passionate about movies and possess a keen eye for storytelling. They understand that a movie poster is not just a piece of artwork; it&#039;s a powerful marketing tool that can make or break the success of your film.', 1999, 1, '265-poster_umir-krvi.jpg'),
(11, 'Minimalist Logo', 'A simple logo for your company to startup', 'Introducing our Minimalist Logo Design Service: Captivating Simplicity and Timeless Elegance. Our team of skilled designers specializes in crafting minimalistic logos that capture the essence of your brand in a visually compelling manner. We believe that less is more, and our minimalist approach ensures that every element of your logo serves a purpose, conveying your brand message concisely and memorably. Elevate your brand with the power of simplicity and elegance. Choose our Minimalist Logo Design Service and let us create a captivating visual representation that will leave a lasting impression on your audience. Contact us today to embark on a design journey that combines the beauty of minimalism with the strength of impactful branding.', 899, 1, 'thumb-60.jpg'),
(12, 'Vector Mobile App Icon', 'Something that make your app unique, at least', 'Introducing our App Icon Design Service: The Perfect Blend of Creativity and Functionality. Your app&#039;s icon is the face of your brand in the digital world, the first impression that captures users&#039; attention and entices them to explore what you have to offer. At WB, we understand the critical role a visually appealing and engaging app icon plays in the success of your mobile application. That&#039;s why we&#039;re thrilled to present our top-notch App Icon Design Service, dedicated to helping you make a lasting impact. Our team of experienced designers is well-versed in the art and science of creating remarkable app icons that align with your brand identity and encapsulate your app&#039;s essence. We combine our creative expertise with an in-depth understanding of user psychology and platform-specific guidelines to craft icons that stand out in the crowded app marketplaces. Stand out from the crowd with an app icon that captivates users and represents your brand with excellence. Trust our App Icon Design Service to bring your app to life visually. Contact us today to discuss your project and let our talented designers work their magic!', 499, 1, 'sample-app-icons-aarhcreative.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `userPassword` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `username`, `firstName`, `lastname`, `email`, `userPassword`) VALUES
(2, 'wade', 'Dwayne', 'Wade', 'dwayne@iblockedbron', 'b54b5f46c15865b12924bb2f6a0352fbd079838af2c92f359b8da7b5a22f9cb7'),
(3, 'bina', 'Damselette', 'Columbina', 'ayo@a', '519a5595d315eff75f5a2b26c8093549313d4fb91fdb61e20753677166113897'),
(6, 'komi', 'Kokomi', 'Sangonomiya', 'idk@gmail.com', '45c62324c5436873cbe66544127c9c7e5ea736f25aec98f58a00d9fec06dbc3f'),
(7, 'adavis', 'Anthony', 'Davis', 'adavis@g.com', '45c62324c5436873cbe66544127c9c7e5ea736f25aec98f58a00d9fec06dbc3f');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`adminID`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cartID`);

--
-- Indexes for table `email`
--
ALTER TABLE `email`
  ADD PRIMARY KEY (`emailID`),
  ADD KEY `userID` (`userID`),
  ADD KEY `productID` (`productID`),
  ADD KEY `orderID` (`orderID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderID`),
  ADD KEY `userID` (`userID`),
  ADD KEY `productID` (`productID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`productID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `adminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cartID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `email`
--
ALTER TABLE `email`
  MODIFY `emailID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `productID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `email`
--
ALTER TABLE `email`
  ADD CONSTRAINT `email_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`),
  ADD CONSTRAINT `email_ibfk_2` FOREIGN KEY (`productID`) REFERENCES `products` (`productID`),
  ADD CONSTRAINT `email_ibfk_3` FOREIGN KEY (`orderID`) REFERENCES `orders` (`orderID`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`productID`) REFERENCES `products` (`productID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
