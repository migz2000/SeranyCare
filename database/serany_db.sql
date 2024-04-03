-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 16, 2024 at 07:36 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `serany_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `title` varchar(60) NOT NULL,
  `detail` varchar(500) NOT NULL,
  `date` date NOT NULL,
  `venue` varchar(120) NOT NULL,
  `phone` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `detail`, `date`, `venue`, `phone`) VALUES
(3, 'There are many variations of passages', 'Please fill details to save a new Event', '0000-00-00', 'Church', ''),
(11, 'new event testing only', '<p>Testing only ....</p>\r\n', '0000-00-00', 'Angono, Rizal', '09999999999'),
(15, 'sample2', '<p>sample2</p>\r\n', '2024-02-17', 'sample2', 'sample2'),
(16, 'sample3', '<p>sample3</p>\r\n', '2024-02-18', 'sample3', 'sample3'),
(17, 'sample4', '<p>sample4</p>\r\n', '2024-02-19', 'sample4', 'sample4');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `caption` varchar(225) NOT NULL,
  `file` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `caption`, `file`) VALUES
(12, 'Brigada Eskwela 2023', 'efac_212a3defbfb9a595cc54c26bf510549d.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `inkind`
--

CREATE TABLE `inkind` (
  `id` int(255) NOT NULL,
  `donor` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` int(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `inkind_donate_date` date NOT NULL,
  `inkind_status` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inkind`
--

INSERT INTO `inkind` (`id`, `donor`, `email`, `phone_number`, `type`, `description`, `inkind_donate_date`, `inkind_status`) VALUES
(2, 'emm el', 'qell9690@gmail.com', 2147483647, 'medicalSupplies', 'test2', '0000-00-00', 2),
(50, 'Franz Fajardo', 'migzfajardo27@gmail.com', 2147483647, 'Medical Supplies', 'test 7', '2024-02-17', 1),
(51, 'Franz Fajardo', 'migzfajardo27@gmail.com', 2147483647, 'Food', 'test 8', '2024-03-27', 0);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `contact_number` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `first_name`, `last_name`, `address`, `contact_number`, `email`, `password`, `status`) VALUES
(1, 'Franz', 'Fajardo', '2 magiliw st.', '09472528101', 'migzfajardo27@gmail.com', '$2y$10$WhgReA5TMJDbAxB//cxYDOFkTvleV60MQUe77k9/0NloLCA5huppG', 1),
(3, 'emm', 'llav', 'hgfhgf', '09990989878', 'qepllavore@tip.edu.ph', '$2y$10$t1spDMt1cKgPZwSjlXjPiOqXjH7zQwHaFRuiRuTXGaxvd5bDefdWG', 1),
(6, 'emm', 'el', 'Manila', '09959771515', 'qell9690@gmail.com', '$2y$10$StpCq8UU1XQZHvXuQ6VHPuapV6AECiwY1rSErdVAOk/w8qHHhUjti', 1);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(70) NOT NULL,
  `news_title` varchar(200) NOT NULL,
  `news_detail` varchar(5000) NOT NULL,
  `file` varchar(150) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `news_title`, `news_detail`, `file`, `date`) VALUES
(10, 'Mumunting Hakbang ng Pangarap 2023', '<p>Nakarating po ang mga tsinelas at sapatos kahapon sa Mahabang Parang Daycare-Elementary School kahapon sa pakikipagtulungan po natin kay Ma&rsquo;am Edna Baylon Cabatic at ng kanyang pamilya. Salamat po ma&rsquo;am sa oras at tiyaga, upang maibahagi po natin ang mga donasyon para sa mga taga-upland.</p>\r\n', 'efac_3ae05aafb17442661e503634b81ed2e0.jpg', '2023-11-29'),
(11, 'BRIGADA ESKWELA 2023', '<p>Salamat po sa mga paaralan sa kanilang mainit na pag-tanggap, ganun din sa mga tumulong sa amin na mag-buhat at makaraan sa masisikip na kalsada.</p>\r\n\r\n<p>Ganun din kay Kuya Guard <img alt=\"?\" src=\"https://static.xx.fbcdn.net/images/emoji.php/v9/tb0/1.5/16/1f609.png\" style=\"height:16px; width:16px\" />&hellip; Salamat sa iyo.</p>\r\n\r\n<p>&ldquo;Drop-off lang po, hindi po kami mag-tatagal&rdquo;</p>\r\n\r\n<p>Kitang-kita po namin ang ngiti at tuwa ng mga guro at punong-guro sa kanilang mga natanggap, ganun din sa mga magulang na kasalukuyang tumutulong sa pag-aayos ng paaralan. Mag-BRIGADA NA TAYO!</p>\r\n', 'efac_2e071e8044bb6b2c23a420d7a596c7c8.jpg', '2023-11-29'),
(13, 'Walang Hanggang Paglingap', '<p>Sa bawa&rsquo;t paglalakbay, may katuwang tayo - mga kasama na totoong nais tumulong at mapagmahal sa kapwa. <img alt=\"?\" src=\"https://static.xx.fbcdn.net/images/emoji.php/v9/t7b/1.5/16/2728.png\" style=\"height:16px; width:16px\" /><img alt=\"??\" src=\"https://static.xx.fbcdn.net/images/emoji.php/v9/td2/1.5/16/1f64c_1f3fc.png\" style=\"height:16px; width:16px\" /></p>\r\n\r\n<p>Taos puso po ang aming pasasalamat sa bumubuo ng Binangonan Bakers and Home Cooks, kasama ang kanilang Presidente, Ma&rsquo;am Edna Cabatic - para sa kanilang individual pledges para makapagbigay tayo ng 2,500pcs ng pandesal sa Sitio Wawa ng Brgy. Libis, Sitio Bautista ng Brgy. Tagpos at Sitio De Lumen at Sitio Valentin/Manggahan ng Brgy. Pantok.</p>\r\n\r\n<p>Kitang-kita ang ngiti ng bawa&rsquo;t isa.</p>\r\n\r\n<p>Nagpapasalamat din po kami sa mga volunteers natin na nagbigay ng oras at tumulong upang maipaabot ang merienda na talaga namang pinaghirapan ibake ni Ate Jenny of BHBC (sa loob ng pitong oras). Salamat po.</p>\r\n', 'efac_70a2747d867e13324eee75cc39aa8b85.jpg', '2023-11-29'),
(21, 'testing 1', '<p>12/15/2023</p>\r\n', 'serany_7fb6b4b39ba78344c83a9295c46de3bf.jpg', '2023-12-15'),
(22, 'sample 1', '<p>sample 1</p>\r\n', 'serany_9b5b5fe56a328f5c8f53b34677b32e75.png', '2024-02-17'),
(23, 'sample 1', '<p>sample 1</p>\r\n', 'serany_0bb1a6f36b41c7f700562139c093ea4c.png', '2024-02-17'),
(24, 'sample 2', '<p>sample 2</p>\r\n', 'serany_4b0109381689fcc47f0535dde9592917.png', '2024-02-17');

-- --------------------------------------------------------

--
-- Table structure for table `quote`
--

CREATE TABLE `quote` (
  `id` int(11) NOT NULL,
  `quote` varchar(300) NOT NULL,
  `quote_by` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quote`
--

INSERT INTO `quote` (`id`, `quote`, `quote_by`) VALUES
(1, 'For God did not send his Son into the world to condemn the world, but to save the world through him.', ' John 3:17');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `site_name` varchar(45) NOT NULL,
  `site_title` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `site_desc` varchar(350) NOT NULL,
  `site_keyword` varchar(250) NOT NULL,
  `google_code` varchar(1000) NOT NULL,
  `street` varchar(100) NOT NULL,
  `city` varchar(60) NOT NULL,
  `country` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `facebook` varchar(45) NOT NULL,
  `twitter` varchar(34) NOT NULL,
  `linkedin` varchar(45) NOT NULL,
  `status` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `site_name`, `site_title`, `email`, `site_desc`, `site_keyword`, `google_code`, `street`, `city`, `country`, `phone`, `facebook`, `twitter`, `linkedin`, `status`) VALUES
(1, 'Serany Foundation Inc., ', 'Serany Foundation Inc., ', 'seranyfoundationinc@gmail.com', 'Non-Governmental Organization (NGO)', '', '', '725-A J Ynares Extension, Brgy. San Carlos', 'Binangonan', 'Philippines', ' 0917 152 9351', 'seranyfoundationinc', '', ' 0917 152 9351', '');

-- --------------------------------------------------------

--
-- Table structure for table `table_admin`
--

CREATE TABLE `table_admin` (
  `id` int(20) NOT NULL,
  `name` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `file` varchar(567) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `table_admin`
--

INSERT INTO `table_admin` (`id`, `name`, `email`, `username`, `password`, `file`) VALUES
(3, 'AdegbemiGa Y1', 'atme@you.u', 'Alagbaka', 'mememem', 'efac_d8ba6926d6b1c5c485411c9f99a948a0.png'),
(4, 'tester', 'tester@dispostable.com', 'tester', 'tester1', 'efac_b8b0d7464b55213c435110abcb5e2e45.php'),
(5, 'Emman', 'emman2@gmail.com', 'emman123', '1234567890', 'serany_6d8ffeeb4b02bb81034ee1d721bb70d6.png');

-- --------------------------------------------------------

--
-- Table structure for table `table_ads`
--

CREATE TABLE `table_ads` (
  `id` int(20) NOT NULL,
  `header_ads` varchar(500) NOT NULL,
  `side_ads` varchar(500) NOT NULL,
  `footer_ads` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `table_ads`
--

INSERT INTO `table_ads` (`id`, `header_ads`, `side_ads`, `footer_ads`) VALUES
(1, '<!-- Adtall - Ad Display Code -->\r\n<script type=\"text/javascript\" src=\"//www.adtall.com/display/js/ads.js?822&522&728&90&0\"></script>\r\n<!-- Adtall - Ad Display Code -->', '<!-- Adtall - Ad Display Code -->\r\n<script type=\"text/javascript\" src=\"//www.adtall.com/display/js/ads.js?821&522&300&250&0\"></script>\r\n<!-- Adtall - Ad Display Code -->', 'Footer ads code here');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_about`
--

CREATE TABLE `tbl_about` (
  `id` int(11) NOT NULL,
  `body` varchar(2500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_about`
--

INSERT INTO `tbl_about` (`id`, `body`) VALUES
(4, '<h2><strong>111About Serany Foundation Inc.</strong></h2>\r\n\r\n<p>We are choosing to continue to provide medical, educational and livelihood assistance to indigent families with the help of its partners, public and private sectors. We also conduct regular nutrition programs and scholarship grants for students as well as alternative learning and training activities for our out of school youths.</p>\r\n\r\n<p>Above it all, we continue to conduct relief operations for calamity-stricken areas in Rizal, specially during this time, we are in a pandemic, we continue to help thousands of families rise up and recover while providing a sense of hope. While supporting more than their basic needs, our projects are aimed to empower the beneficiaries, and inspire them to help their community as well.</p>\r\n\r\n<p>14 Years and counting and for us, there is nothing more fulfilling than giving your life in service to those who need it most, our senior citizens, persons with disabilities, the urban poor families, families in the remote areas, LGBT community, unemployed citizens and most of all the children. They all matter.</p>\r\n\r\n<p>It is great to see and know that those who we have helped, now supporting our causes, people give their time, effort and resources to make a difference in the lives of others, for us, that is how we will rise together, by support amongst your community for the community. For our future endeavors, the NGO is more dedicated than ever to uplift more lives and build a more empowered and better Binangonan.</p>\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_resources`
--

CREATE TABLE `tbl_resources` (
  `id` int(11) NOT NULL,
  `body` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_resources`
--

INSERT INTO `tbl_resources` (`id`, `body`) VALUES
(1, '<h2><strong>WHAT WE DO</strong></h2>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus. Vivamus diam purus, cursus a, commodo non, facilisis vitae, nulla. Aenean dictum lacinia tortor. Nunc iaculis, nibh non iaculis aliquam, orci felis euismod neque, sed ornare massa mauris sed velit. Nulla pretium mi et risus. Fusce mi pede, tempor id, cursus ac, ullamcorper nec, enim.Curabitur molestie. Duis velit augue, condimentum at, ultrices a, luctus ut, orci. Donec pellentesque egestas eros. Integer cursus, augue in cursus faucibus, eros pede bibendum sem, in tempus tellus justo quis ligula. Etiam eget tortor. Vestibulum rutrum, est ut placerat elementum, lectus nisl aliquam velit, tempor aliquam eros nunc nonummy metus. In eros metus, gravida a, gravida sed, lobortis id, turpis. Ut ultrices, ipsum at venenatis fringilla, sem nulla lacinia tellus, eget aliquet turpis mauris non enim. Nam turpis. Suspendisse lacinia. Curabitur ac tortor ut ipsum egestas elementum. Nunc imperdiet gravida mauris.</p>\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `user_online`
--

CREATE TABLE `user_online` (
  `session` varchar(100) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_online`
--

INSERT INTO `user_online` (`session`, `time`) VALUES
('qcotvvi268d7irofeoehiaj364', 1500896285),
('6jmm0l8uvu2hrmbmll5pstnv54', 1500896318),
('qcotvvi268d7irofeoehiaj364', 1500896285),
('6jmm0l8uvu2hrmbmll5pstnv54', 1500896318),
('qcotvvi268d7irofeoehiaj364', 1500896285),
('6jmm0l8uvu2hrmbmll5pstnv54', 1500896318);

-- --------------------------------------------------------

--
-- Table structure for table `volunteers`
--

CREATE TABLE `volunteers` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `contact_number` varchar(20) NOT NULL,
  `event` varchar(255) NOT NULL,
  `event_date` date NOT NULL,
  `event_venue` varchar(120) NOT NULL,
  `volunteer_status` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `volunteers`
--

INSERT INTO `volunteers` (`id`, `email`, `first_name`, `last_name`, `address`, `contact_number`, `event`, `event_date`, `event_venue`, `volunteer_status`) VALUES
(1, 'migzfajardo27@gmail.com', 'Franz', 'Fajardo', '2 magiliw st.', '09472528101', 'There are many variations of passages', '0000-00-00', 'Church', 0),
(2, 'migzfajardo27@gmail.com', 'Franz', 'Fajardo', '2 magiliw st.', '09472528101', 'new event testing only', '0000-00-00', 'Angono, Rizal', 0);

-- --------------------------------------------------------

--
-- Table structure for table `welcome`
--

CREATE TABLE `welcome` (
  `id` int(11) NOT NULL,
  `body` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `welcome`
--

INSERT INTO `welcome` (`id`, `body`) VALUES
(1, 'Welcome to the Foundation! We\'re more than an organization; we\'re a catalyst for change, a driving force behind progress, and a community dedicated to making a meaningful difference. Our foundation stands on pillars of compassion, innovation, and collaboration, striving to create a brighter future for all.\n\nAt the heart of our mission is the belief that every individual holds the power to inspire, create, and transform. We focus on initiatives that span education, healthcare, environmental sustainability, social justice, and beyond, aiming to address pressing global challenges with empathy and expertise.\n\nDriven by a collective passion for positive change, we collaborate with partners, experts, and changemakers worldwide to amplify our impact. Together, we envision a world where every person has access to opportunity, where communities thrive in harmony with nature, and where compassion and understanding flourish.\n\nJoin us on this incredible journey of empowerment and progress. Together, let\'s build a foundation for a better tomorrow.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inkind`
--
ALTER TABLE `inkind`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quote`
--
ALTER TABLE `quote`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `table_admin`
--
ALTER TABLE `table_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `table_ads`
--
ALTER TABLE `table_ads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_about`
--
ALTER TABLE `tbl_about`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_resources`
--
ALTER TABLE `tbl_resources`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `volunteers`
--
ALTER TABLE `volunteers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `welcome`
--
ALTER TABLE `welcome`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `inkind`
--
ALTER TABLE `inkind`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(70) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `quote`
--
ALTER TABLE `quote`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `table_admin`
--
ALTER TABLE `table_admin`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_about`
--
ALTER TABLE `tbl_about`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_resources`
--
ALTER TABLE `tbl_resources`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `volunteers`
--
ALTER TABLE `volunteers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `welcome`
--
ALTER TABLE `welcome`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
