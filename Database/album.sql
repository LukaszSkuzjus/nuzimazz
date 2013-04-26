-- phpMyAdmin SQL Dump
-- version 2.6.1-pl3
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Jun 11, 2006 at 03:27 PM
-- Server version: 4.1.10
-- PHP Version: 5.0.4
-- 
-- Database: `album`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `album`
-- 

CREATE TABLE `album` (
  `AlbumId` int(100) NOT NULL auto_increment,
  `AlbumName` varchar(50) NOT NULL default '',
  `CreationDate` date NOT NULL default '0000-00-00',
  `Description` varchar(200) NOT NULL default '',
  PRIMARY KEY  (`AlbumId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

-- 
-- Dumping data for table `album`
-- 

INSERT INTO `album` VALUES (1, 'people', '2005-12-27', 'different people cultures etc..');
INSERT INTO `album` VALUES (2, 'Indian Culture', '2005-12-28', 'different kind of indian culture');
INSERT INTO `album` VALUES (3, 'Flowers', '2004-12-19', 'different flowers');
INSERT INTO `album` VALUES (4, 'miscellancious', '1999-06-12', 'other categories of albums');
INSERT INTO `album` VALUES (5, 'Places', '2005-12-15', 'different kind of pictures taken at different places');
INSERT INTO `album` VALUES (6, 'country', '2005-12-11', 'Different Countries around the world');
INSERT INTO `album` VALUES (7, 'Strange Events', '2006-01-16', 'X-files events, Top Secret CIA');
INSERT INTO `album` VALUES (8, 'Preferences', '2006-02-02', 'Most appreciated photos');
INSERT INTO `album` VALUES (9, 'Fotos', '2006-02-02', 'all kinds of pics');
INSERT INTO `album` VALUES (10, 'Birthday', '2006-02-10', 'any dates');
INSERT INTO `album` VALUES (11, 'Pics', '2006-06-04', 'all my Photos');
INSERT INTO `album` VALUES (12, 'Check sa', '2006-06-04', 'Fotos,nice ones and funny also');
INSERT INTO `album` VALUES (13, 'nu Foto', '2006-06-05', 'all in all time pics');
INSERT INTO `album` VALUES (14, 'Sa em Sa!', '2006-06-05', 'All kool pics');
INSERT INTO `album` VALUES (15, 'Kool', '2006-06-06', 'Having Fun');
INSERT INTO `album` VALUES (16, 'Great Pics', '2006-06-06', 'All my Favourites');
INSERT INTO `album` VALUES (17, 'Kenzo', '2006-06-06', 'Just pics i like');
INSERT INTO `album` VALUES (18, '777', '2006-06-06', 'All Zat is Gold!');
INSERT INTO `album` VALUES (19, 'Naks', '2006-06-06', 'Snaps of pics');
INSERT INTO `album` VALUES (20, 'Kool ashley', '2006-06-06', 'just Remind You of me!');
INSERT INTO `album` VALUES (21, 'All in all', '2006-06-06', 'Wat we care For!');

-- --------------------------------------------------------

-- 
-- Table structure for table `albumcontainsimages`
-- 

CREATE TABLE `albumcontainsimages` (
  `AlbumId` int(100) NOT NULL default '0',
  `ImageId` int(100) NOT NULL default '0',
  PRIMARY KEY  (`AlbumId`,`ImageId`),
  KEY `ImageId` (`ImageId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `albumcontainsimages`
-- 

INSERT INTO `albumcontainsimages` VALUES (1, 1);
INSERT INTO `albumcontainsimages` VALUES (2, 2);
INSERT INTO `albumcontainsimages` VALUES (1, 3);
INSERT INTO `albumcontainsimages` VALUES (1, 4);
INSERT INTO `albumcontainsimages` VALUES (6, 5);
INSERT INTO `albumcontainsimages` VALUES (5, 6);
INSERT INTO `albumcontainsimages` VALUES (3, 7);
INSERT INTO `albumcontainsimages` VALUES (4, 8);
INSERT INTO `albumcontainsimages` VALUES (7, 9);
INSERT INTO `albumcontainsimages` VALUES (7, 10);
INSERT INTO `albumcontainsimages` VALUES (1, 11);
INSERT INTO `albumcontainsimages` VALUES (1, 12);
INSERT INTO `albumcontainsimages` VALUES (1, 13);
INSERT INTO `albumcontainsimages` VALUES (1, 14);
INSERT INTO `albumcontainsimages` VALUES (1, 15);
INSERT INTO `albumcontainsimages` VALUES (1, 16);
INSERT INTO `albumcontainsimages` VALUES (1, 17);
INSERT INTO `albumcontainsimages` VALUES (1, 19);
INSERT INTO `albumcontainsimages` VALUES (8, 20);
INSERT INTO `albumcontainsimages` VALUES (8, 21);
INSERT INTO `albumcontainsimages` VALUES (8, 22);
INSERT INTO `albumcontainsimages` VALUES (8, 23);
INSERT INTO `albumcontainsimages` VALUES (8, 24);
INSERT INTO `albumcontainsimages` VALUES (8, 25);
INSERT INTO `albumcontainsimages` VALUES (8, 26);
INSERT INTO `albumcontainsimages` VALUES (9, 27);
INSERT INTO `albumcontainsimages` VALUES (9, 28);
INSERT INTO `albumcontainsimages` VALUES (9, 29);
INSERT INTO `albumcontainsimages` VALUES (9, 30);
INSERT INTO `albumcontainsimages` VALUES (9, 31);
INSERT INTO `albumcontainsimages` VALUES (9, 32);
INSERT INTO `albumcontainsimages` VALUES (9, 33);
INSERT INTO `albumcontainsimages` VALUES (9, 34);
INSERT INTO `albumcontainsimages` VALUES (9, 35);
INSERT INTO `albumcontainsimages` VALUES (9, 36);
INSERT INTO `albumcontainsimages` VALUES (9, 37);
INSERT INTO `albumcontainsimages` VALUES (9, 38);
INSERT INTO `albumcontainsimages` VALUES (9, 39);
INSERT INTO `albumcontainsimages` VALUES (9, 40);
INSERT INTO `albumcontainsimages` VALUES (9, 41);
INSERT INTO `albumcontainsimages` VALUES (9, 42);
INSERT INTO `albumcontainsimages` VALUES (9, 43);
INSERT INTO `albumcontainsimages` VALUES (9, 44);
INSERT INTO `albumcontainsimages` VALUES (9, 45);
INSERT INTO `albumcontainsimages` VALUES (9, 46);
INSERT INTO `albumcontainsimages` VALUES (9, 47);
INSERT INTO `albumcontainsimages` VALUES (9, 48);
INSERT INTO `albumcontainsimages` VALUES (9, 49);
INSERT INTO `albumcontainsimages` VALUES (9, 50);
INSERT INTO `albumcontainsimages` VALUES (9, 51);
INSERT INTO `albumcontainsimages` VALUES (9, 52);
INSERT INTO `albumcontainsimages` VALUES (10, 53);
INSERT INTO `albumcontainsimages` VALUES (2, 54);
INSERT INTO `albumcontainsimages` VALUES (2, 55);
INSERT INTO `albumcontainsimages` VALUES (2, 56);
INSERT INTO `albumcontainsimages` VALUES (2, 57);
INSERT INTO `albumcontainsimages` VALUES (2, 58);
INSERT INTO `albumcontainsimages` VALUES (2, 59);
INSERT INTO `albumcontainsimages` VALUES (11, 60);
INSERT INTO `albumcontainsimages` VALUES (11, 61);
INSERT INTO `albumcontainsimages` VALUES (11, 62);
INSERT INTO `albumcontainsimages` VALUES (12, 63);
INSERT INTO `albumcontainsimages` VALUES (12, 64);
INSERT INTO `albumcontainsimages` VALUES (12, 65);
INSERT INTO `albumcontainsimages` VALUES (12, 66);
INSERT INTO `albumcontainsimages` VALUES (12, 67);
INSERT INTO `albumcontainsimages` VALUES (12, 68);
INSERT INTO `albumcontainsimages` VALUES (12, 69);
INSERT INTO `albumcontainsimages` VALUES (13, 70);
INSERT INTO `albumcontainsimages` VALUES (13, 71);
INSERT INTO `albumcontainsimages` VALUES (13, 72);
INSERT INTO `albumcontainsimages` VALUES (11, 73);
INSERT INTO `albumcontainsimages` VALUES (14, 74);
INSERT INTO `albumcontainsimages` VALUES (14, 75);
INSERT INTO `albumcontainsimages` VALUES (14, 76);
INSERT INTO `albumcontainsimages` VALUES (13, 77);
INSERT INTO `albumcontainsimages` VALUES (8, 78);
INSERT INTO `albumcontainsimages` VALUES (14, 79);
INSERT INTO `albumcontainsimages` VALUES (14, 80);
INSERT INTO `albumcontainsimages` VALUES (9, 81);
INSERT INTO `albumcontainsimages` VALUES (9, 82);
INSERT INTO `albumcontainsimages` VALUES (9, 83);
INSERT INTO `albumcontainsimages` VALUES (15, 84);
INSERT INTO `albumcontainsimages` VALUES (16, 85);
INSERT INTO `albumcontainsimages` VALUES (17, 86);
INSERT INTO `albumcontainsimages` VALUES (18, 87);
INSERT INTO `albumcontainsimages` VALUES (18, 88);
INSERT INTO `albumcontainsimages` VALUES (19, 89);
INSERT INTO `albumcontainsimages` VALUES (19, 90);
INSERT INTO `albumcontainsimages` VALUES (19, 91);
INSERT INTO `albumcontainsimages` VALUES (19, 92);
INSERT INTO `albumcontainsimages` VALUES (19, 93);
INSERT INTO `albumcontainsimages` VALUES (19, 94);
INSERT INTO `albumcontainsimages` VALUES (20, 95);
INSERT INTO `albumcontainsimages` VALUES (20, 96);
INSERT INTO `albumcontainsimages` VALUES (21, 97);

-- --------------------------------------------------------

-- 
-- Table structure for table `comments`
-- 

CREATE TABLE `comments` (
  `CommentId` int(100) NOT NULL auto_increment,
  `Comments` varchar(100) NOT NULL default '',
  `Date` date NOT NULL default '0000-00-00',
  PRIMARY KEY  (`CommentId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

-- 
-- Dumping data for table `comments`
-- 

INSERT INTO `comments` VALUES (1, 'WoW!! This is a very beautiful Album', '2006-01-16');
INSERT INTO `comments` VALUES (2, 'that a nice gallery', '2006-01-08');
INSERT INTO `comments` VALUES (3, 'Not a bad Album', '2006-01-16');
INSERT INTO `comments` VALUES (4, 'How beautiful', '2006-01-12');
INSERT INTO `comments` VALUES (5, 'Wow Such a beautiful Album', '2006-02-28');
INSERT INTO `comments` VALUES (6, 'folwers', '2006-03-21');
INSERT INTO `comments` VALUES (7, 'flowers', '2006-03-21');
INSERT INTO `comments` VALUES (8, 'Bautiful Dancers and \nshow', '2006-03-21');

-- --------------------------------------------------------

-- 
-- Table structure for table `eventoccursinsites`
-- 

CREATE TABLE `eventoccursinsites` (
  `EventId` int(100) NOT NULL default '0',
  `SiteId` int(100) NOT NULL default '0',
  PRIMARY KEY  (`EventId`,`SiteId`),
  KEY `SiteId` (`SiteId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `eventoccursinsites`
-- 

INSERT INTO `eventoccursinsites` VALUES (6, 9);
INSERT INTO `eventoccursinsites` VALUES (5, 10);

-- --------------------------------------------------------

-- 
-- Table structure for table `events`
-- 

CREATE TABLE `events` (
  `EventId` int(100) NOT NULL auto_increment,
  `EventName` varchar(50) NOT NULL default '',
  `Description` varchar(200) NOT NULL default '',
  PRIMARY KEY  (`EventId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

-- 
-- Dumping data for table `events`
-- 

INSERT INTO `events` VALUES (1, 'Birthday', 'childhood and any ages celebrated');
INSERT INTO `events` VALUES (2, 'Sports day', 'medals,prizes');
INSERT INTO `events` VALUES (3, 'Graduation day', 'Certificates');
INSERT INTO `events` VALUES (4, 'Wedding day', 'married life');
INSERT INTO `events` VALUES (5, 'Holidays', 'Vacation period or school holidays');
INSERT INTO `events` VALUES (6, 'Cultural ceremony', 'Indian cultural ceremony celebration');
INSERT INTO `events` VALUES (7, 'Exams', 'Uom Exam days');

-- --------------------------------------------------------

-- 
-- Table structure for table `images`
-- 

CREATE TABLE `images` (
  `ImageId` int(100) NOT NULL auto_increment,
  `ImageName` varchar(50) NOT NULL default '',
  `DateUploaded` date NOT NULL default '0000-00-00',
  `Url` varchar(30) NOT NULL default '',
  `Description` varchar(200) NOT NULL default '',
  PRIMARY KEY  (`ImageId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=98 ;

-- 
-- Dumping data for table `images`
-- 

INSERT INTO `images` VALUES (1, 'Peter', '2005-12-27', '1/peter.jpg', 'peter on holiday');
INSERT INTO `images` VALUES (2, 'Troup', '2005-12-08', '3/anando_01.jpg', 'Troup performing');
INSERT INTO `images` VALUES (3, 'Sea sky', '2005-12-15', '1/1010.jpg', 'sea view,sky blue and rocks');
INSERT INTO `images` VALUES (4, 'karis', '2005-12-11', '1/karis.jpg', 'karis on roof');
INSERT INTO `images` VALUES (5, 'Australia', '2005-12-06', '1/australia.jpg', 'The pure sky of  Australia');
INSERT INTO `images` VALUES (6, 'la gaulette sss', '2005-04-04', '1/sss.jpg', 'view from la gaulette sss');
INSERT INTO `images` VALUES (7, 'roses', '2005-04-11', '1/roses.jpg', 'very  rare roses');
INSERT INTO `images` VALUES (8, 'brick', '2006-01-12', '1/brick.jpg', 'Past Architecture');
INSERT INTO `images` VALUES (9, 'Desert', '2006-01-18', '1/desert.jpg', 'Gust on mars');
INSERT INTO `images` VALUES (10, 'Space', '2006-01-16', '1/space.jpg', 'Strange phenomenon in space');
INSERT INTO `images` VALUES (11, 'la mer', '2006-01-17', '1/la_mer.jpg', 'Silvio opening coco for vinay, mira, varsha,shalawon at tamarin');
INSERT INTO `images` VALUES (12, 'island', '2006-01-17', '1/island.jpg', 'Beautiful island surrounded by the sea');
INSERT INTO `images` VALUES (13, 'Birthday', '2006-01-18', '1/birthday.jpg', 'Sara and mike celebrating their 1st wedding birthday');
INSERT INTO `images` VALUES (14, 'vinay at the beach', '2006-01-25', '1/flic_beach.jpg', 'vinay walking on the beach at flic en flac');
INSERT INTO `images` VALUES (15, 'Filaos', '2006-01-18', '1/images.jpg', 'filao trees at flic en flac');
INSERT INTO `images` VALUES (16, 'Tourist', '2006-01-15', '1/sand.jpg', 'tourist sun bathing at flic en flac');
INSERT INTO `images` VALUES (17, 'hotel  palmists', '2006-01-08', '1/paradis_beach.jpg', 'hotel le paradis.. magnificent view');
INSERT INTO `images` VALUES (18, 'Debarkader', '2006-01-09', '1/trou_grit.jpg', 'boats and tourists at the sea');
INSERT INTO `images` VALUES (19, 'map', '2006-01-25', '1/westmap.gif', 'location of the beaches we visited in Mauritius');
INSERT INTO `images` VALUES (20, 'Rochester', '2006-02-02', '2/205.jpg', 'Waterfalls,water,falling');
INSERT INTO `images` VALUES (21, 'Sunset', '2006-02-02', '2/502.jpg', 'Sun,sea');
INSERT INTO `images` VALUES (22, 'sunset', '2006-02-02', '2/583.jpg', 'sun, red clouds');
INSERT INTO `images` VALUES (23, 'sun', '2006-02-02', '2/588.jpg', 'Sun,white cloud,plants');
INSERT INTO `images` VALUES (24, 'sun', '2006-02-02', '2/image12.jpg', 'sunset,yellow sky');
INSERT INTO `images` VALUES (25, 'Car', '2006-02-02', '2/mf1251.jpg', 'red car');
INSERT INTO `images` VALUES (26, 'Snow', '2006-02-02', '2/mf0021.jpg', 'House,landscape,tree,snow');
INSERT INTO `images` VALUES (27, 'infrastructure', '2006-02-02', '4/hp3.jpg', 'water pool,buildings');
INSERT INTO `images` VALUES (28, 'Building', '2006-02-02', '4/hp7.jpg', 'Flowers,buildings,people');
INSERT INTO `images` VALUES (29, 'Diya', '2006-02-02', '4/hp8.jpg', 'Diya''s office,computer');
INSERT INTO `images` VALUES (30, 'Road', '2006-02-02', '4/pdr_0463.jpg', 'road,trees');
INSERT INTO `images` VALUES (31, 'Sea', '2006-02-02', '4/pdr_0464.jpg', 'blue sea with beach');
INSERT INTO `images` VALUES (32, 'Temple', '2006-02-02', '4/pdr_0468.jpg', 'temple at night,dark sky');
INSERT INTO `images` VALUES (33, 'Sesside', '2006-02-02', '4/pdr_0544.jpg', 'blue Sea,boats,beach');
INSERT INTO `images` VALUES (34, 'island', '2006-02-02', '4/pdr_0557.jpg', 'island,boat,sea');
INSERT INTO `images` VALUES (35, 'Sea', '2006-02-01', '4/pdr_0582.jpg', 'white clouds,blue sky,boat,sea');
INSERT INTO `images` VALUES (36, 'Sea', '2006-02-02', '4/pdr_0583.jpg', 'Blue sea,sand,coconut trees,kiosque,beach');
INSERT INTO `images` VALUES (37, 'Bungalows', '2006-02-02', '4/pdr_0584.jpg', 'Sea view,Bungalows,Palm,coconut trees');
INSERT INTO `images` VALUES (38, 'fish', '2006-02-02', '4/pdr_0598.jpg', 'fish in water');
INSERT INTO `images` VALUES (39, 'Lord Shiva', '2006-02-02', '4/pdr_0599.jpg', 'Shiv,lake');
INSERT INTO `images` VALUES (40, 'Temples', '2006-01-17', '4/pdr_0602.jpg', 'Near lake,2 temples');
INSERT INTO `images` VALUES (41, 'fishes', '2006-02-02', '4/pdr_0605.jpg', 'fishes in pond,lake');
INSERT INTO `images` VALUES (42, 'God Krsna', '2006-02-02', '4/pdr_0609.jpg', 'krsna,radha');
INSERT INTO `images` VALUES (43, 'sacred lake', '2006-02-02', '4/pdr_0615.jpg', 'lake view from top with temples');
INSERT INTO `images` VALUES (44, 'Crocodiile', '2006-02-02', '4/pdr_0616.jpg', '2 Crocodiiles,open mouth');
INSERT INTO `images` VALUES (45, 'Crocodiiles', '2006-02-02', '4/pdr_0618.jpg', 'Crocodiiles sleeping,swimming pond');
INSERT INTO `images` VALUES (46, 'Butterfly', '2006-02-02', '4/pdr_0619.jpg', 'most specifies of butterflies');
INSERT INTO `images` VALUES (47, 'Sea', '2006-02-02', '4/pdr_0622.jpg', 'sea,boat,island far away');
INSERT INTO `images` VALUES (48, 'Swimming pool', '2006-02-02', '4/pdr_0640.jpg', 'bungalow swimming pool');
INSERT INTO `images` VALUES (49, 'Swimming pool', '2006-02-02', '4/pdr_0641.jpg', 'Swimming pool,bungalow,coconut trees');
INSERT INTO `images` VALUES (50, 'Sea', '2006-02-02', '4/pdr_0664.jpg', 'Seaside with beach');
INSERT INTO `images` VALUES (51, 'Beach', '2006-02-02', '4/pdr_0671.jpg', 'design,drawings on sand,beach');
INSERT INTO `images` VALUES (52, 'boats', '2006-02-02', '4/pdr_0672.jpg', 'boats,sand,sea');
INSERT INTO `images` VALUES (53, 'Cake', '2006-02-02', '4/pdr_0680.jpg', 'white birhday cake,green cream with jelly');
INSERT INTO `images` VALUES (54, 'Coconut_workers', '2006-02-28', '3/jute-01.jpg', 'seaside coconut workers in boat in india');
INSERT INTO `images` VALUES (55, 'riksha', '2006-02-28', '3/riksha_28.jpg', 'riksha driver in india');
INSERT INTO `images` VALUES (56, 'riksha', '2006-02-28', '3/riksha_29.jpg', 'Riksha on display on glass in india');
INSERT INTO `images` VALUES (57, 'Beautiful_Riksha', '2006-02-28', '3/riksha_30.jpg', 'Riksha in indian culture');
INSERT INTO `images` VALUES (58, 'Riksha', '0000-00-00', '3/riksha_31.jpg', 'Riksha back view wheels');
INSERT INTO `images` VALUES (59, 'Riksha', '2006-02-28', '3/riksha_34.jpg', 'Riksha side view');
INSERT INTO `images` VALUES (60, 'Last exam pic', '2006-06-04', '5/dscf0039.jpg', 'friends at uom');
INSERT INTO `images` VALUES (61, 'Uom', '2006-06-04', '5/dscf0009.jpg', 'Last Exam Day');
INSERT INTO `images` VALUES (62, 'Perroquet', '2006-06-04', '5/dscf0034.jpg', 'Birds green');
INSERT INTO `images` VALUES (63, 'Moody', '2006-06-04', '6/dscf0031.jpg', 'All about living wiz friends');
INSERT INTO `images` VALUES (64, 'Caudan Front View', '2006-06-04', '6/57.jpg', 'Caudan Water Front');
INSERT INTO `images` VALUES (65, 'Green Sea', '2006-06-04', '6/73.jpg', 'View of waterfront');
INSERT INTO `images` VALUES (66, '''Le Caudan', '2006-06-04', '6/79.jpg', 'Top View of Waterfront');
INSERT INTO `images` VALUES (67, 'Garden at Caudan', '2006-06-04', '6/121.jpg', 'Flowers with palm tree and road in middle');
INSERT INTO `images` VALUES (68, '''Port louis', '2006-06-04', '6/122.jpg', 'Buildings at Caudan Waterfront');
INSERT INTO `images` VALUES (69, 'Mountain', '2006-06-04', '6/969.jpg', 'Far away view of gray mountain');
INSERT INTO `images` VALUES (70, 'Tanisha', '2006-06-05', '7/tani01.jpg', 'University photo at Seminar');
INSERT INTO `images` VALUES (71, 'Childhood', '2006-06-05', '7/tani02.jpg', 'Child');
INSERT INTO `images` VALUES (72, 'Green Mountain', '2006-06-05', '7/977.jpg', 'Nature as it is');
INSERT INTO `images` VALUES (73, 'water plants', '2006-06-05', '5/992.jpg', 'Trees');
INSERT INTO `images` VALUES (74, 'Friends Unite', '2006-06-05', '8/dscf0073.jpg', 'Drinking Coca Party');
INSERT INTO `images` VALUES (75, 'Chamarel', '2006-06-05', '8/981.jpg', '8 different earth color');
INSERT INTO `images` VALUES (76, 'Casino', '2006-06-05', '8/casino.jpg', 'Caudan at night casino');
INSERT INTO `images` VALUES (77, 'Sport', '2006-06-05', '7/fun.jpg', 'Descending Waterfall');
INSERT INTO `images` VALUES (78, 'Uom', '2006-06-05', '2/image035.jpg', 'Uom Engineering Building 2');
INSERT INTO `images` VALUES (79, 'Graduate', '2006-06-05', '8/graduation.jpg', 'Graduation significance');
INSERT INTO `images` VALUES (80, 'Petangue', '2006-06-05', '8/dscf0056.jpg', 'Game Petangue');
INSERT INTO `images` VALUES (81, 'Dolphin', '2006-06-05', '4/984.jpg', 'Dolphin in sea');
INSERT INTO `images` VALUES (82, 'wedding', '2006-06-05', '4/lagunarocks.jpg', 'Bride');
INSERT INTO `images` VALUES (83, 'Sea Rocks', '2006-06-05', '4/986.jpg', 'Island part in middle sea');
INSERT INTO `images` VALUES (84, 'Playing Game', '2006-06-06', '9/dscf0054.jpg', 'action throw ball');
INSERT INTO `images` VALUES (85, 'Uom Bridge', '2006-06-06', '10/dscf00.jpg', 'Kool pic at uom');
INSERT INTO `images` VALUES (86, 'Domino', '2006-06-06', '11/dscf0049.jpg', 'Playing Domino at Uom');
INSERT INTO `images` VALUES (87, 'Friends', '2006-06-06', '12/dscf0008.jpg', 'Sms on Mobile');
INSERT INTO `images` VALUES (88, 'Engineering Building', '2006-06-06', '12/image025.jpg', 'Engineering Building 2');
INSERT INTO `images` VALUES (89, 'Sea', '2006-06-06', '13/1006.jpg', 'Kiosque near sea');
INSERT INTO `images` VALUES (90, 'Mountain', '2006-06-06', '13/3081.jpg', 'Peter Both Mountain');
INSERT INTO `images` VALUES (91, 'Water Fall', '2006-06-06', '13/eaubleu.jpg', 'Water Fall');
INSERT INTO `images` VALUES (92, 'Views', '2006-06-06', '13/piton.jpg', 'Mountain View of Sky');
INSERT INTO `images` VALUES (93, 'Views', '2006-06-06', '13/3086.jpg', 'Blue Sky island surround');
INSERT INTO `images` VALUES (94, 'Sky View', '2006-06-06', '13/3087.jpg', 'natural surrounding');
INSERT INTO `images` VALUES (95, 'ashley', '2006-06-06', '14/ashali.jpg', 'Party Time');
INSERT INTO `images` VALUES (96, 'Party', '2006-06-06', '14/picture 030.jpg', 'Dance with me');
INSERT INTO `images` VALUES (97, 'Nice atmosphere', '2006-06-06', '15/p1010709.jpg', 'Melbourne in australia pics');

-- --------------------------------------------------------

-- 
-- Table structure for table `imagetakeninsites`
-- 

CREATE TABLE `imagetakeninsites` (
  `ImageId` int(100) NOT NULL default '0',
  `SiteId` int(100) NOT NULL default '0',
  PRIMARY KEY  (`ImageId`,`SiteId`),
  KEY `SiteId` (`SiteId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `imagetakeninsites`
-- 

INSERT INTO `imagetakeninsites` VALUES (73, 1);
INSERT INTO `imagetakeninsites` VALUES (38, 2);
INSERT INTO `imagetakeninsites` VALUES (41, 2);
INSERT INTO `imagetakeninsites` VALUES (44, 2);
INSERT INTO `imagetakeninsites` VALUES (45, 2);
INSERT INTO `imagetakeninsites` VALUES (46, 2);
INSERT INTO `imagetakeninsites` VALUES (11, 3);
INSERT INTO `imagetakeninsites` VALUES (70, 4);
INSERT INTO `imagetakeninsites` VALUES (74, 4);
INSERT INTO `imagetakeninsites` VALUES (78, 4);
INSERT INTO `imagetakeninsites` VALUES (85, 4);
INSERT INTO `imagetakeninsites` VALUES (86, 4);
INSERT INTO `imagetakeninsites` VALUES (87, 4);
INSERT INTO `imagetakeninsites` VALUES (88, 4);
INSERT INTO `imagetakeninsites` VALUES (20, 5);
INSERT INTO `imagetakeninsites` VALUES (32, 6);
INSERT INTO `imagetakeninsites` VALUES (39, 6);
INSERT INTO `imagetakeninsites` VALUES (40, 6);
INSERT INTO `imagetakeninsites` VALUES (42, 6);
INSERT INTO `imagetakeninsites` VALUES (43, 6);
INSERT INTO `imagetakeninsites` VALUES (27, 7);
INSERT INTO `imagetakeninsites` VALUES (28, 7);
INSERT INTO `imagetakeninsites` VALUES (29, 7);
INSERT INTO `imagetakeninsites` VALUES (37, 8);
INSERT INTO `imagetakeninsites` VALUES (48, 8);
INSERT INTO `imagetakeninsites` VALUES (49, 8);
INSERT INTO `imagetakeninsites` VALUES (57, 8);
INSERT INTO `imagetakeninsites` VALUES (2, 9);
INSERT INTO `imagetakeninsites` VALUES (54, 9);
INSERT INTO `imagetakeninsites` VALUES (55, 9);
INSERT INTO `imagetakeninsites` VALUES (56, 9);
INSERT INTO `imagetakeninsites` VALUES (58, 9);
INSERT INTO `imagetakeninsites` VALUES (59, 9);
INSERT INTO `imagetakeninsites` VALUES (95, 10);
INSERT INTO `imagetakeninsites` VALUES (96, 10);

-- --------------------------------------------------------

-- 
-- Table structure for table `imagetakenonevent`
-- 

CREATE TABLE `imagetakenonevent` (
  `ImageId` int(100) NOT NULL default '0',
  `EventId` int(100) NOT NULL default '0',
  PRIMARY KEY  (`ImageId`,`EventId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `imagetakenonevent`
-- 

INSERT INTO `imagetakenonevent` VALUES (2, 6);
INSERT INTO `imagetakenonevent` VALUES (11, 5);
INSERT INTO `imagetakenonevent` VALUES (43, 5);
INSERT INTO `imagetakenonevent` VALUES (53, 1);
INSERT INTO `imagetakenonevent` VALUES (54, 6);
INSERT INTO `imagetakenonevent` VALUES (55, 6);
INSERT INTO `imagetakenonevent` VALUES (56, 6);
INSERT INTO `imagetakenonevent` VALUES (57, 6);
INSERT INTO `imagetakenonevent` VALUES (58, 6);
INSERT INTO `imagetakenonevent` VALUES (59, 6);
INSERT INTO `imagetakenonevent` VALUES (62, 7);
INSERT INTO `imagetakenonevent` VALUES (77, 2);
INSERT INTO `imagetakenonevent` VALUES (78, 7);
INSERT INTO `imagetakenonevent` VALUES (79, 3);
INSERT INTO `imagetakenonevent` VALUES (80, 5);
INSERT INTO `imagetakenonevent` VALUES (81, 5);
INSERT INTO `imagetakenonevent` VALUES (82, 4);
INSERT INTO `imagetakenonevent` VALUES (83, 5);
INSERT INTO `imagetakenonevent` VALUES (84, 2);
INSERT INTO `imagetakenonevent` VALUES (90, 5);
INSERT INTO `imagetakenonevent` VALUES (93, 5);
INSERT INTO `imagetakenonevent` VALUES (96, 5);

-- --------------------------------------------------------

-- 
-- Table structure for table `invites`
-- 

CREATE TABLE `invites` (
  `InviteId` int(100) NOT NULL auto_increment,
  `PersonEmail` varchar(30) NOT NULL default '',
  `Date` date NOT NULL default '0000-00-00',
  PRIMARY KEY  (`InviteId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `invites`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `location`
-- 

CREATE TABLE `location` (
  `LocationId` int(100) NOT NULL auto_increment,
  `Country` varchar(30) NOT NULL default '',
  `Details` varchar(200) NOT NULL default '',
  `City/State` varchar(30) NOT NULL default '',
  PRIMARY KEY  (`LocationId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

-- 
-- Dumping data for table `location`
-- 

INSERT INTO `location` VALUES (1, 'Mauritius', 'island in indian ocean', 'Port Louis');
INSERT INTO `location` VALUES (2, 'Argentina', '', 'Buenos Aires');
INSERT INTO `location` VALUES (3, 'India', 'India great cultural country', 'New Delhi');
INSERT INTO `location` VALUES (4, 'Australia', '', 'Canberra');
INSERT INTO `location` VALUES (5, 'Belgium', '', 'Brussels');
INSERT INTO `location` VALUES (6, 'Canada', '', 'Ottawa');
INSERT INTO `location` VALUES (7, 'France', '', 'Paris');
INSERT INTO `location` VALUES (8, 'Madagascar', '', 'Antananarivo');
INSERT INTO `location` VALUES (9, 'Seychelles', 'archipelago in the Indian Ocean, northeast of Madagascar', 'Victoria');
INSERT INTO `location` VALUES (10, 'Switzerland', '', 'Bern');
INSERT INTO `location` VALUES (11, 'United Arab Emirates', '', 'Abu Dhabi');
INSERT INTO `location` VALUES (12, 'United Kingdom', '', 'London');
INSERT INTO `location` VALUES (13, 'United States', '', 'Washington D.C');
INSERT INTO `location` VALUES (14, 'Rodrigues', 'island of volcanic origin, some 550 kilometres to the north-east of the island of Mauritius.', 'Port Mathurin');
INSERT INTO `location` VALUES (15, 'Reunion', '', 'Saint-Denis');

-- --------------------------------------------------------

-- 
-- Table structure for table `locationcontainsites`
-- 

CREATE TABLE `locationcontainsites` (
  `LocationId` int(100) NOT NULL default '0',
  `SiteId` int(100) NOT NULL default '0',
  PRIMARY KEY  (`LocationId`,`SiteId`),
  KEY `SiteId` (`SiteId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `locationcontainsites`
-- 

INSERT INTO `locationcontainsites` VALUES (1, 1);
INSERT INTO `locationcontainsites` VALUES (1, 2);
INSERT INTO `locationcontainsites` VALUES (1, 3);
INSERT INTO `locationcontainsites` VALUES (1, 4);
INSERT INTO `locationcontainsites` VALUES (1, 5);
INSERT INTO `locationcontainsites` VALUES (1, 6);
INSERT INTO `locationcontainsites` VALUES (3, 7);
INSERT INTO `locationcontainsites` VALUES (1, 8);
INSERT INTO `locationcontainsites` VALUES (3, 9);
INSERT INTO `locationcontainsites` VALUES (12, 10);

-- --------------------------------------------------------

-- 
-- Table structure for table `member`
-- 

CREATE TABLE `member` (
  `Member_Id` int(100) NOT NULL auto_increment,
  `F_Name` varchar(50) NOT NULL default '',
  `L_Name` varchar(50) NOT NULL default '',
  `Address` varchar(100) NOT NULL default '',
  `Country` varchar(40) NOT NULL default '',
  `Email` varchar(30) NOT NULL default '',
  `DOB` date NOT NULL default '0000-00-00',
  `UserName` varchar(50) NOT NULL default '',
  `Password` varchar(30) NOT NULL default '',
  PRIMARY KEY  (`Member_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

-- 
-- Dumping data for table `member`
-- 

INSERT INTO `member` VALUES (1, 'vinay', 'mungra', 'Abbe de la caille curepipe', 'Mauritius', 'vinay9955@gmail.com', '1984-01-21', 'mike99', 'vinay');
INSERT INTO `member` VALUES (2, 'abhishek', 'Ramchuritter', 'RDuRempart', 'Mauritius', 'ramchurik@gmail.com', '1984-10-17', 'abhishek', 'arc');
INSERT INTO `member` VALUES (3, 'Prity', 'sanad', 'Qbornes', 'Mauritius', 'prity@hotmail.com', '1980-12-14', 'prity', 'prity');
INSERT INTO `member` VALUES (4, 'Divesh', 'Bachoo', 'Riviere du rempart', 'Mauritius', 'divesh16@servihoo.com', '1987-11-16', 'divesh16', 'humraaz');
INSERT INTO `member` VALUES (5, 'Visham', 'Tottoo', '', ' Mauritius', 'visham04@hotmail.com', '1984-06-25', 'Visham', 'visham');
INSERT INTO `member` VALUES (6, 'Vikram', 'Seeburn', 'Belle Vue Maurel', ' Mauritius', 'seeburnvik@gmail.com', '1984-07-12', 'Seeburn', 'jules');
INSERT INTO `member` VALUES (7, 'Tanisha', 'Ramchuritter', 'Plaines Des Roches', ' Mauritius', 'tani_15@hotmail.com', '1987-07-30', 'tanisha', 'tanisha');
INSERT INTO `member` VALUES (8, 'Anoop', 'Jheengut', '', ' Mauritius', 'anoop@hotmail.com', '1984-05-12', 'Anoop', 'anoop');
INSERT INTO `member` VALUES (9, 'Mozafer', 'Aukin', '', ' Mauritius', 'Moz@hotmail.com', '1984-06-25', 'aukin', 'mozafer');
INSERT INTO `member` VALUES (10, 'Vikram', 'Awator', '', ' Mauritius', 'vikram@yahoo.com', '1983-04-22', 'Awator', 'vikram');
INSERT INTO `member` VALUES (11, 'Kenny', 'Kain Fat', '', ' Mauritius', 'Kenny@hotmail.com', '1984-06-12', 'Kenny', 'kenny');
INSERT INTO `member` VALUES (12, 'Nadeem', 'Aulear', '', ' Mauritius', 'Nadeem777@yahoo.com', '1984-05-18', 'Nadeem', 'Nadeem');
INSERT INTO `member` VALUES (13, 'Vishal', 'Nakey', '', ' Mauritius', 'toemailmoi@yahoo.com', '1983-06-25', 'Vishal', 'Vishal');
INSERT INTO `member` VALUES (14, 'Asheley', 'Sooknah', 'Rempart', ' Mauritius', 'ashmax@yahoo.com', '1982-07-12', 'ashmax', 'devil');
INSERT INTO `member` VALUES (15, 'Roopesh', 'Juggoo', 'Rempart', ' Mauritius', 'tex@yahoo.com', '1984-06-26', 'Roupesh', 'texxas');

-- --------------------------------------------------------

-- 
-- Table structure for table `membersinimages`
-- 

CREATE TABLE `membersinimages` (
  `Mem_id` int(11) NOT NULL default '0',
  `Img_id` int(11) NOT NULL default '0',
  PRIMARY KEY  (`Mem_id`,`Img_id`),
  KEY `Img_id` (`Img_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `membersinimages`
-- 

INSERT INTO `membersinimages` VALUES (1, 3);
INSERT INTO `membersinimages` VALUES (1, 11);
INSERT INTO `membersinimages` VALUES (2, 63);
INSERT INTO `membersinimages` VALUES (2, 71);
INSERT INTO `membersinimages` VALUES (5, 74);
INSERT INTO `membersinimages` VALUES (11, 74);
INSERT INTO `membersinimages` VALUES (8, 86);

-- --------------------------------------------------------

-- 
-- Table structure for table `memprofile`
-- 

CREATE TABLE `memprofile` (
  `Mem_Id` int(100) NOT NULL default '0',
  `Image_Url` varchar(25) NOT NULL default '',
  `Sex` varchar(8) NOT NULL default '',
  `status` varchar(20) NOT NULL default '',
  `Interests` varchar(50) NOT NULL default '',
  `ThumbnailsView` varchar(5) NOT NULL default '',
  PRIMARY KEY  (`Mem_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `memprofile`
-- 

INSERT INTO `memprofile` VALUES (1, 'vinay.jpg', '', '', '', '');
INSERT INTO `memprofile` VALUES (2, 'abhi.jpg', '', '', '', '');
INSERT INTO `memprofile` VALUES (3, 'ros.jpg', '', '', '', '');
INSERT INTO `memprofile` VALUES (4, 'divesh.jpg', '', '', '', '');
INSERT INTO `memprofile` VALUES (5, 'visham.jpg', '', '', '', '');
INSERT INTO `memprofile` VALUES (6, 'dscf0045.jpg', '', '', '', '');
INSERT INTO `memprofile` VALUES (7, 'tani.jpg', '', '', '', '');
INSERT INTO `memprofile` VALUES (8, 'anoop.jpg', '', '', '', '');
INSERT INTO `memprofile` VALUES (9, 'dscf0047.jpg', '', '', '', '');
INSERT INTO `memprofile` VALUES (10, 'dscf0033.jpg', '', '', '', '');
INSERT INTO `memprofile` VALUES (11, 'dscf0040.jpg', '', '', '', '');
INSERT INTO `memprofile` VALUES (12, 'image033.jpg', '', '', '', '');
INSERT INTO `memprofile` VALUES (13, 'dscf0053.jpg', '', '', '', '');
INSERT INTO `memprofile` VALUES (14, 'ash.jpg', '', '', '', '');
INSERT INTO `memprofile` VALUES (15, 'p1010414.jpg', '', '', '', '');

-- --------------------------------------------------------

-- 
-- Table structure for table `networkinvite`
-- 

CREATE TABLE `networkinvite` (
  `From` int(100) NOT NULL default '0',
  `To` int(100) NOT NULL default '0',
  `Status` varchar(5) NOT NULL default '',
  PRIMARY KEY  (`From`,`To`),
  KEY `To` (`To`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `networkinvite`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `ownalbum`
-- 

CREATE TABLE `ownalbum` (
  `OwnerId` int(100) NOT NULL default '0',
  `AlbumId` int(100) NOT NULL default '0',
  PRIMARY KEY  (`OwnerId`,`AlbumId`),
  KEY `AlbumId` (`AlbumId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `ownalbum`
-- 

INSERT INTO `ownalbum` VALUES (1, 1);
INSERT INTO `ownalbum` VALUES (3, 2);
INSERT INTO `ownalbum` VALUES (1, 3);
INSERT INTO `ownalbum` VALUES (1, 4);
INSERT INTO `ownalbum` VALUES (1, 5);
INSERT INTO `ownalbum` VALUES (1, 6);
INSERT INTO `ownalbum` VALUES (1, 7);
INSERT INTO `ownalbum` VALUES (2, 8);
INSERT INTO `ownalbum` VALUES (4, 9);
INSERT INTO `ownalbum` VALUES (5, 11);
INSERT INTO `ownalbum` VALUES (6, 12);
INSERT INTO `ownalbum` VALUES (7, 13);
INSERT INTO `ownalbum` VALUES (8, 14);
INSERT INTO `ownalbum` VALUES (9, 15);
INSERT INTO `ownalbum` VALUES (10, 16);
INSERT INTO `ownalbum` VALUES (11, 17);
INSERT INTO `ownalbum` VALUES (13, 19);
INSERT INTO `ownalbum` VALUES (14, 20);
INSERT INTO `ownalbum` VALUES (15, 21);

-- --------------------------------------------------------

-- 
-- Table structure for table `postalbumcomments`
-- 

CREATE TABLE `postalbumcomments` (
  `MemberId` int(100) NOT NULL default '0',
  `AlbumId` int(100) NOT NULL default '0',
  `CommentId` int(100) NOT NULL default '0',
  PRIMARY KEY  (`MemberId`,`AlbumId`,`CommentId`),
  KEY `AlbumId` (`AlbumId`),
  KEY `CommentId` (`CommentId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `postalbumcomments`
-- 

INSERT INTO `postalbumcomments` VALUES (1, 1, 1);
INSERT INTO `postalbumcomments` VALUES (1, 1, 4);
INSERT INTO `postalbumcomments` VALUES (2, 1, 2);
INSERT INTO `postalbumcomments` VALUES (2, 1, 3);
INSERT INTO `postalbumcomments` VALUES (1, 2, 5);
INSERT INTO `postalbumcomments` VALUES (1, 3, 7);

-- --------------------------------------------------------

-- 
-- Table structure for table `postimagecomments`
-- 

CREATE TABLE `postimagecomments` (
  `MemberId` int(100) NOT NULL default '0',
  `ImageId` int(100) NOT NULL default '0',
  `CommentId` int(100) NOT NULL default '0',
  PRIMARY KEY  (`MemberId`,`ImageId`,`CommentId`),
  KEY `CommentId` (`CommentId`),
  KEY `ImageId` (`ImageId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `postimagecomments`
-- 

INSERT INTO `postimagecomments` VALUES (1, 1, 1);
INSERT INTO `postimagecomments` VALUES (1, 7, 6);
INSERT INTO `postimagecomments` VALUES (3, 2, 8);

-- --------------------------------------------------------

-- 
-- Table structure for table `rate`
-- 

CREATE TABLE `rate` (
  `ImageId` int(100) NOT NULL default '0',
  `RateCount` int(100) NOT NULL default '0',
  `UsersRated` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`ImageId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `rate`
-- 

INSERT INTO `rate` VALUES (1, 3, '2');
INSERT INTO `rate` VALUES (7, 3, '1');
INSERT INTO `rate` VALUES (9, 2, '1');
INSERT INTO `rate` VALUES (10, 3, '1');
INSERT INTO `rate` VALUES (54, 2, '1');
INSERT INTO `rate` VALUES (55, 4, '2');

-- --------------------------------------------------------

-- 
-- Table structure for table `relatedevents`
-- 

CREATE TABLE `relatedevents` (
  `EventId` int(100) NOT NULL default '0',
  `ERelatedId` int(100) NOT NULL default '0',
  PRIMARY KEY  (`EventId`,`ERelatedId`),
  KEY `ERelatedId` (`ERelatedId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `relatedevents`
-- 

INSERT INTO `relatedevents` VALUES (1, 5);

-- --------------------------------------------------------

-- 
-- Table structure for table `relatedmembers`
-- 

CREATE TABLE `relatedmembers` (
  `MemberId` int(100) NOT NULL default '0',
  `RelatedId` int(100) NOT NULL default '0',
  PRIMARY KEY  (`MemberId`,`RelatedId`),
  KEY `RelatedId` (`RelatedId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `relatedmembers`
-- 

INSERT INTO `relatedmembers` VALUES (2, 1);
INSERT INTO `relatedmembers` VALUES (3, 1);
INSERT INTO `relatedmembers` VALUES (1, 2);
INSERT INTO `relatedmembers` VALUES (4, 2);
INSERT INTO `relatedmembers` VALUES (6, 2);
INSERT INTO `relatedmembers` VALUES (7, 2);
INSERT INTO `relatedmembers` VALUES (1, 3);
INSERT INTO `relatedmembers` VALUES (2, 4);
INSERT INTO `relatedmembers` VALUES (14, 4);
INSERT INTO `relatedmembers` VALUES (6, 5);
INSERT INTO `relatedmembers` VALUES (8, 5);
INSERT INTO `relatedmembers` VALUES (2, 6);
INSERT INTO `relatedmembers` VALUES (5, 6);
INSERT INTO `relatedmembers` VALUES (2, 7);
INSERT INTO `relatedmembers` VALUES (5, 8);
INSERT INTO `relatedmembers` VALUES (9, 8);
INSERT INTO `relatedmembers` VALUES (10, 8);
INSERT INTO `relatedmembers` VALUES (11, 8);
INSERT INTO `relatedmembers` VALUES (8, 9);
INSERT INTO `relatedmembers` VALUES (8, 10);
INSERT INTO `relatedmembers` VALUES (11, 10);
INSERT INTO `relatedmembers` VALUES (8, 11);
INSERT INTO `relatedmembers` VALUES (10, 11);
INSERT INTO `relatedmembers` VALUES (4, 14);
INSERT INTO `relatedmembers` VALUES (15, 14);
INSERT INTO `relatedmembers` VALUES (14, 15);

-- --------------------------------------------------------

-- 
-- Table structure for table `sites`
-- 

CREATE TABLE `sites` (
  `SiteId` int(100) NOT NULL auto_increment,
  `SiteName` varchar(30) NOT NULL default '',
  `Address1` varchar(30) NOT NULL default '',
  `Address2` varchar(30) NOT NULL default '',
  `Description` varchar(200) NOT NULL default '',
  PRIMARY KEY  (`SiteId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

-- 
-- Dumping data for table `sites`
-- 

INSERT INTO `sites` VALUES (1, 'Botanical Garden', 'pamplemousses', '', 'exotic trees, plants,totoise,birds,animals');
INSERT INTO `sites` VALUES (2, 'Crocodile park', '', '', 'Birds and other animals park');
INSERT INTO `sites` VALUES (3, 'Flic en Flac Seaside', 'Flic en Flac', 'South', 'Sea views');
INSERT INTO `sites` VALUES (4, 'University of Mauritius', 'Reduit', '', 'Tertiary education');
INSERT INTO `sites` VALUES (5, 'Rochester Falls', 'Rochester Road', 'South', 'Waterfall');
INSERT INTO `sites` VALUES (6, 'Grand Bassin', '', '', 'Spiritual lake');
INSERT INTO `sites` VALUES (7, 'Hewlwtt Packard Company', 'Bangalore', '', 'Working place');
INSERT INTO `sites` VALUES (8, 'Hotels', 'Grand Baie', '', 'swiimming pools,sea view,Coconut tree,beach');
INSERT INTO `sites` VALUES (9, 'culcutta', '', '', 'Rich traditional village');
INSERT INTO `sites` VALUES (10, 'Teeside University', 'Teeside', 'Middlesborough', 'University of the Valley');

-- --------------------------------------------------------

-- 
-- Table structure for table `userrated`
-- 

CREATE TABLE `userrated` (
  `MemberId` int(100) NOT NULL default '0',
  `ImageId` int(100) NOT NULL default '0',
  PRIMARY KEY  (`MemberId`,`ImageId`),
  KEY `ImageId` (`ImageId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `userrated`
-- 

INSERT INTO `userrated` VALUES (1, 1);
INSERT INTO `userrated` VALUES (2, 7);
INSERT INTO `userrated` VALUES (2, 9);
INSERT INTO `userrated` VALUES (2, 10);
INSERT INTO `userrated` VALUES (2, 54);
INSERT INTO `userrated` VALUES (2, 55);
INSERT INTO `userrated` VALUES (3, 55);

-- --------------------------------------------------------

-- 
-- Table structure for table `view`
-- 

CREATE TABLE `view` (
  `ViewId` int(100) NOT NULL auto_increment,
  `Times` int(100) NOT NULL default '0',
  PRIMARY KEY  (`ViewId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=95 ;

-- 
-- Dumping data for table `view`
-- 

INSERT INTO `view` VALUES (1, 44);
INSERT INTO `view` VALUES (2, 45);
INSERT INTO `view` VALUES (3, 16);
INSERT INTO `view` VALUES (4, 24);
INSERT INTO `view` VALUES (5, 22);
INSERT INTO `view` VALUES (6, 30);
INSERT INTO `view` VALUES (7, 8);
INSERT INTO `view` VALUES (8, 8);
INSERT INTO `view` VALUES (9, 7);
INSERT INTO `view` VALUES (10, 17);
INSERT INTO `view` VALUES (11, 20);
INSERT INTO `view` VALUES (12, 28);
INSERT INTO `view` VALUES (13, 30);
INSERT INTO `view` VALUES (14, 3);
INSERT INTO `view` VALUES (15, 6);
INSERT INTO `view` VALUES (16, 8);
INSERT INTO `view` VALUES (17, 8);
INSERT INTO `view` VALUES (18, 19);
INSERT INTO `view` VALUES (19, 14);
INSERT INTO `view` VALUES (20, 17);
INSERT INTO `view` VALUES (21, 21);
INSERT INTO `view` VALUES (22, 9);
INSERT INTO `view` VALUES (23, 6);
INSERT INTO `view` VALUES (24, 9);
INSERT INTO `view` VALUES (25, 6);
INSERT INTO `view` VALUES (26, 1);
INSERT INTO `view` VALUES (27, 24);
INSERT INTO `view` VALUES (28, 18);
INSERT INTO `view` VALUES (29, 13);
INSERT INTO `view` VALUES (30, 10);
INSERT INTO `view` VALUES (31, 9);
INSERT INTO `view` VALUES (32, 8);
INSERT INTO `view` VALUES (33, 8);
INSERT INTO `view` VALUES (34, 3);
INSERT INTO `view` VALUES (35, 2);
INSERT INTO `view` VALUES (36, 1);
INSERT INTO `view` VALUES (37, 3);
INSERT INTO `view` VALUES (38, 5);
INSERT INTO `view` VALUES (39, 4);
INSERT INTO `view` VALUES (40, 4);
INSERT INTO `view` VALUES (41, 3);
INSERT INTO `view` VALUES (42, 2);
INSERT INTO `view` VALUES (43, 1);
INSERT INTO `view` VALUES (44, 17);
INSERT INTO `view` VALUES (45, 8);
INSERT INTO `view` VALUES (46, 11);
INSERT INTO `view` VALUES (47, 4);
INSERT INTO `view` VALUES (48, 2);
INSERT INTO `view` VALUES (49, 5);
INSERT INTO `view` VALUES (50, 4);
INSERT INTO `view` VALUES (51, 2);
INSERT INTO `view` VALUES (52, 12);
INSERT INTO `view` VALUES (53, 2);
INSERT INTO `view` VALUES (54, 3);
INSERT INTO `view` VALUES (55, 2);
INSERT INTO `view` VALUES (56, 7);
INSERT INTO `view` VALUES (57, 2);
INSERT INTO `view` VALUES (58, 1);
INSERT INTO `view` VALUES (59, 2);
INSERT INTO `view` VALUES (60, 1);
INSERT INTO `view` VALUES (61, 2);
INSERT INTO `view` VALUES (62, 1);
INSERT INTO `view` VALUES (63, 1);
INSERT INTO `view` VALUES (64, 3);
INSERT INTO `view` VALUES (65, 2);
INSERT INTO `view` VALUES (66, 2);
INSERT INTO `view` VALUES (67, 3);
INSERT INTO `view` VALUES (68, 4);
INSERT INTO `view` VALUES (69, 3);
INSERT INTO `view` VALUES (70, 2);
INSERT INTO `view` VALUES (71, 1);
INSERT INTO `view` VALUES (72, 1);
INSERT INTO `view` VALUES (73, 1);
INSERT INTO `view` VALUES (74, 1);
INSERT INTO `view` VALUES (75, 2);
INSERT INTO `view` VALUES (76, 1);
INSERT INTO `view` VALUES (77, 1);
INSERT INTO `view` VALUES (78, 1);
INSERT INTO `view` VALUES (79, 1);
INSERT INTO `view` VALUES (80, 2);
INSERT INTO `view` VALUES (81, 3);
INSERT INTO `view` VALUES (82, 2);
INSERT INTO `view` VALUES (83, 1);
INSERT INTO `view` VALUES (84, 1);
INSERT INTO `view` VALUES (85, 1);
INSERT INTO `view` VALUES (86, 2);
INSERT INTO `view` VALUES (87, 1);
INSERT INTO `view` VALUES (88, 8);
INSERT INTO `view` VALUES (89, 8);
INSERT INTO `view` VALUES (90, 6);
INSERT INTO `view` VALUES (91, 1);
INSERT INTO `view` VALUES (92, 1);
INSERT INTO `view` VALUES (93, 1);
INSERT INTO `view` VALUES (94, 1);

-- --------------------------------------------------------

-- 
-- Table structure for table `viewalbum`
-- 

CREATE TABLE `viewalbum` (
  `ViewId` int(100) NOT NULL default '0',
  `AlbumId` int(100) NOT NULL default '0',
  PRIMARY KEY  (`ViewId`,`AlbumId`),
  KEY `AlbumId` (`AlbumId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `viewalbum`
-- 

INSERT INTO `viewalbum` VALUES (1, 1);
INSERT INTO `viewalbum` VALUES (2, 2);
INSERT INTO `viewalbum` VALUES (3, 3);
INSERT INTO `viewalbum` VALUES (4, 4);
INSERT INTO `viewalbum` VALUES (5, 5);
INSERT INTO `viewalbum` VALUES (6, 6);
INSERT INTO `viewalbum` VALUES (7, 7);
INSERT INTO `viewalbum` VALUES (8, 8);
INSERT INTO `viewalbum` VALUES (10, 9);
INSERT INTO `viewalbum` VALUES (9, 10);
INSERT INTO `viewalbum` VALUES (57, 11);
INSERT INTO `viewalbum` VALUES (58, 12);
INSERT INTO `viewalbum` VALUES (56, 14);
INSERT INTO `viewalbum` VALUES (92, 15);
INSERT INTO `viewalbum` VALUES (76, 19);
INSERT INTO `viewalbum` VALUES (71, 20);
INSERT INTO `viewalbum` VALUES (69, 21);

-- --------------------------------------------------------

-- 
-- Table structure for table `viewimage`
-- 

CREATE TABLE `viewimage` (
  `ViewId` int(100) NOT NULL default '0',
  `ImageId` int(100) NOT NULL default '0',
  PRIMARY KEY  (`ViewId`,`ImageId`),
  KEY `ImageId` (`ImageId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `viewimage`
-- 

INSERT INTO `viewimage` VALUES (12, 1);
INSERT INTO `viewimage` VALUES (11, 2);
INSERT INTO `viewimage` VALUES (13, 3);
INSERT INTO `viewimage` VALUES (19, 4);
INSERT INTO `viewimage` VALUES (45, 5);
INSERT INTO `viewimage` VALUES (43, 6);
INSERT INTO `viewimage` VALUES (33, 7);
INSERT INTO `viewimage` VALUES (44, 8);
INSERT INTO `viewimage` VALUES (49, 9);
INSERT INTO `viewimage` VALUES (46, 10);
INSERT INTO `viewimage` VALUES (18, 11);
INSERT INTO `viewimage` VALUES (22, 12);
INSERT INTO `viewimage` VALUES (21, 13);
INSERT INTO `viewimage` VALUES (20, 14);
INSERT INTO `viewimage` VALUES (23, 15);
INSERT INTO `viewimage` VALUES (24, 16);
INSERT INTO `viewimage` VALUES (25, 17);
INSERT INTO `viewimage` VALUES (26, 19);
INSERT INTO `viewimage` VALUES (14, 20);
INSERT INTO `viewimage` VALUES (48, 21);
INSERT INTO `viewimage` VALUES (47, 22);
INSERT INTO `viewimage` VALUES (74, 23);
INSERT INTO `viewimage` VALUES (73, 24);
INSERT INTO `viewimage` VALUES (15, 27);
INSERT INTO `viewimage` VALUES (16, 28);
INSERT INTO `viewimage` VALUES (17, 29);
INSERT INTO `viewimage` VALUES (39, 30);
INSERT INTO `viewimage` VALUES (42, 31);
INSERT INTO `viewimage` VALUES (41, 32);
INSERT INTO `viewimage` VALUES (40, 33);
INSERT INTO `viewimage` VALUES (79, 34);
INSERT INTO `viewimage` VALUES (80, 35);
INSERT INTO `viewimage` VALUES (50, 36);
INSERT INTO `viewimage` VALUES (81, 37);
INSERT INTO `viewimage` VALUES (38, 38);
INSERT INTO `viewimage` VALUES (75, 39);
INSERT INTO `viewimage` VALUES (86, 41);
INSERT INTO `viewimage` VALUES (87, 42);
INSERT INTO `viewimage` VALUES (36, 43);
INSERT INTO `viewimage` VALUES (85, 44);
INSERT INTO `viewimage` VALUES (37, 45);
INSERT INTO `viewimage` VALUES (35, 46);
INSERT INTO `viewimage` VALUES (94, 48);
INSERT INTO `viewimage` VALUES (51, 50);
INSERT INTO `viewimage` VALUES (84, 51);
INSERT INTO `viewimage` VALUES (83, 52);
INSERT INTO `viewimage` VALUES (34, 53);
INSERT INTO `viewimage` VALUES (27, 54);
INSERT INTO `viewimage` VALUES (28, 55);
INSERT INTO `viewimage` VALUES (29, 56);
INSERT INTO `viewimage` VALUES (32, 57);
INSERT INTO `viewimage` VALUES (31, 58);
INSERT INTO `viewimage` VALUES (30, 59);
INSERT INTO `viewimage` VALUES (63, 60);
INSERT INTO `viewimage` VALUES (62, 61);
INSERT INTO `viewimage` VALUES (61, 62);
INSERT INTO `viewimage` VALUES (52, 63);
INSERT INTO `viewimage` VALUES (55, 64);
INSERT INTO `viewimage` VALUES (54, 65);
INSERT INTO `viewimage` VALUES (53, 66);
INSERT INTO `viewimage` VALUES (59, 68);
INSERT INTO `viewimage` VALUES (67, 69);
INSERT INTO `viewimage` VALUES (89, 71);
INSERT INTO `viewimage` VALUES (60, 73);
INSERT INTO `viewimage` VALUES (90, 74);
INSERT INTO `viewimage` VALUES (91, 80);
INSERT INTO `viewimage` VALUES (64, 81);
INSERT INTO `viewimage` VALUES (65, 82);
INSERT INTO `viewimage` VALUES (82, 83);
INSERT INTO `viewimage` VALUES (93, 84);
INSERT INTO `viewimage` VALUES (88, 86);
INSERT INTO `viewimage` VALUES (66, 89);
INSERT INTO `viewimage` VALUES (78, 90);
INSERT INTO `viewimage` VALUES (77, 91);
INSERT INTO `viewimage` VALUES (68, 92);
INSERT INTO `viewimage` VALUES (72, 95);
INSERT INTO `viewimage` VALUES (70, 97);

-- 
-- Constraints for dumped tables
-- 

-- 
-- Constraints for table `albumcontainsimages`
-- 
ALTER TABLE `albumcontainsimages`
  ADD CONSTRAINT `albumcontainsimages_ibfk_1` FOREIGN KEY (`AlbumId`) REFERENCES `album` (`AlbumId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `albumcontainsimages_ibfk_2` FOREIGN KEY (`ImageId`) REFERENCES `images` (`ImageId`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Constraints for table `eventoccursinsites`
-- 
ALTER TABLE `eventoccursinsites`
  ADD CONSTRAINT `eventoccursinsites_ibfk_1` FOREIGN KEY (`EventId`) REFERENCES `events` (`EventId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `eventoccursinsites_ibfk_2` FOREIGN KEY (`SiteId`) REFERENCES `sites` (`SiteId`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Constraints for table `imagetakeninsites`
-- 
ALTER TABLE `imagetakeninsites`
  ADD CONSTRAINT `imagetakeninsites_ibfk_1` FOREIGN KEY (`ImageId`) REFERENCES `images` (`ImageId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `imagetakeninsites_ibfk_2` FOREIGN KEY (`SiteId`) REFERENCES `sites` (`SiteId`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Constraints for table `locationcontainsites`
-- 
ALTER TABLE `locationcontainsites`
  ADD CONSTRAINT `locationcontainsites_ibfk_1` FOREIGN KEY (`LocationId`) REFERENCES `location` (`LocationId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `locationcontainsites_ibfk_2` FOREIGN KEY (`SiteId`) REFERENCES `sites` (`SiteId`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Constraints for table `membersinimages`
-- 
ALTER TABLE `membersinimages`
  ADD CONSTRAINT `membersinimages_ibfk_3` FOREIGN KEY (`Mem_id`) REFERENCES `member` (`Member_Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `membersinimages_ibfk_4` FOREIGN KEY (`Img_id`) REFERENCES `images` (`ImageId`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Constraints for table `memprofile`
-- 
ALTER TABLE `memprofile`
  ADD CONSTRAINT `memprofile_ibfk_1` FOREIGN KEY (`Mem_Id`) REFERENCES `member` (`Member_Id`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Constraints for table `networkinvite`
-- 
ALTER TABLE `networkinvite`
  ADD CONSTRAINT `networkinvite_ibfk_1` FOREIGN KEY (`From`) REFERENCES `member` (`Member_Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `networkinvite_ibfk_2` FOREIGN KEY (`To`) REFERENCES `member` (`Member_Id`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Constraints for table `ownalbum`
-- 
ALTER TABLE `ownalbum`
  ADD CONSTRAINT `ownalbum_ibfk_1` FOREIGN KEY (`OwnerId`) REFERENCES `member` (`Member_Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ownalbum_ibfk_2` FOREIGN KEY (`AlbumId`) REFERENCES `album` (`AlbumId`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Constraints for table `postalbumcomments`
-- 
ALTER TABLE `postalbumcomments`
  ADD CONSTRAINT `postalbumcomments_ibfk_1` FOREIGN KEY (`MemberId`) REFERENCES `member` (`Member_Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `postalbumcomments_ibfk_2` FOREIGN KEY (`AlbumId`) REFERENCES `album` (`AlbumId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `postalbumcomments_ibfk_3` FOREIGN KEY (`CommentId`) REFERENCES `comments` (`CommentId`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Constraints for table `postimagecomments`
-- 
ALTER TABLE `postimagecomments`
  ADD CONSTRAINT `postimagecomments_ibfk_1` FOREIGN KEY (`MemberId`) REFERENCES `member` (`Member_Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `postimagecomments_ibfk_2` FOREIGN KEY (`CommentId`) REFERENCES `comments` (`CommentId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `postimagecomments_ibfk_3` FOREIGN KEY (`ImageId`) REFERENCES `images` (`ImageId`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Constraints for table `rate`
-- 
ALTER TABLE `rate`
  ADD CONSTRAINT `rate_ibfk_1` FOREIGN KEY (`ImageId`) REFERENCES `images` (`ImageId`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Constraints for table `relatedevents`
-- 
ALTER TABLE `relatedevents`
  ADD CONSTRAINT `relatedevents_ibfk_1` FOREIGN KEY (`EventId`) REFERENCES `events` (`EventId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `relatedevents_ibfk_2` FOREIGN KEY (`ERelatedId`) REFERENCES `events` (`EventId`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Constraints for table `relatedmembers`
-- 
ALTER TABLE `relatedmembers`
  ADD CONSTRAINT `relatedmembers_ibfk_1` FOREIGN KEY (`MemberId`) REFERENCES `member` (`Member_Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `relatedmembers_ibfk_2` FOREIGN KEY (`RelatedId`) REFERENCES `member` (`Member_Id`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Constraints for table `userrated`
-- 
ALTER TABLE `userrated`
  ADD CONSTRAINT `userrated_ibfk_3` FOREIGN KEY (`MemberId`) REFERENCES `member` (`Member_Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `userrated_ibfk_4` FOREIGN KEY (`ImageId`) REFERENCES `images` (`ImageId`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Constraints for table `viewalbum`
-- 
ALTER TABLE `viewalbum`
  ADD CONSTRAINT `viewalbum_ibfk_1` FOREIGN KEY (`ViewId`) REFERENCES `view` (`ViewId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `viewalbum_ibfk_2` FOREIGN KEY (`AlbumId`) REFERENCES `album` (`AlbumId`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Constraints for table `viewimage`
-- 
ALTER TABLE `viewimage`
  ADD CONSTRAINT `viewimage_ibfk_1` FOREIGN KEY (`ViewId`) REFERENCES `view` (`ViewId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `viewimage_ibfk_2` FOREIGN KEY (`ImageId`) REFERENCES `images` (`ImageId`) ON DELETE CASCADE ON UPDATE CASCADE;
