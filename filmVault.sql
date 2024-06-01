-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 01, 2024 at 11:44 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `filmVault`
--

-- --------------------------------------------------------

--
-- Table structure for table `Country`
--

CREATE TABLE `Country` (
  `country_id` int(11) NOT NULL,
  `country_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Country`
--

INSERT INTO `Country` (`country_id`, `country_name`) VALUES
(501, 'USA'),
(502, 'Korea'),
(503, 'United Kingdom'),
(504, 'France'),
(505, 'India'),
(506, 'Japan');

-- --------------------------------------------------------

--
-- Table structure for table `Director`
--

CREATE TABLE `Director` (
  `director_id` int(11) NOT NULL,
  `director_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Director`
--

INSERT INTO `Director` (`director_id`, `director_name`) VALUES
(201, 'Michael Gracey'),
(202, 'Christopher Nolan'),
(203, 'Bong Joon Ho'),
(204, 'Anthony Russo'),
(205, 'Joe Russo'),
(206, 'Jonathan Demme'),
(207, 'Hayao Miyazaki'),
(208, 'Damien Chazelle'),
(209, 'Pete Docter'),
(210, 'Bob Peterson'),
(211, 'John Lasseter'),
(212, 'Todd Phillips'),
(213, 'Rajkumar Hirani'),
(214, 'Robert Wise'),
(215, 'Richard Curtis'),
(216, 'Nancy Meyers'),
(217, 'Pete Docter'),
(218, 'Ronnie Del Carmen'),
(219, 'Gabriele Muccino'),
(220, 'Jae-hyun Jang'),
(221, 'Wes Ball'),
(222, 'John Carney'),
(223, 'Ryan Coogler');

-- --------------------------------------------------------

--
-- Table structure for table `Genre`
--

CREATE TABLE `Genre` (
  `genre_id` int(11) NOT NULL,
  `genre_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Genre`
--

INSERT INTO `Genre` (`genre_id`, `genre_name`) VALUES
(701, 'Action'),
(702, 'Science fiction'),
(703, 'Romance'),
(704, 'Comedy'),
(705, 'Mystery'),
(706, 'Horror'),
(707, 'Drama'),
(708, 'Melodrama'),
(709, 'Fantasy'),
(710, 'Family'),
(711, 'Musical'),
(712, 'Thriller'),
(713, 'Crime'),
(714, 'Adventure');

-- --------------------------------------------------------

--
-- Table structure for table `Language`
--

CREATE TABLE `Language` (
  `language_id` int(11) NOT NULL,
  `language_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Language`
--

INSERT INTO `Language` (`language_id`, `language_name`) VALUES
(601, 'English'),
(602, 'Korean'),
(603, 'Japanese'),
(604, 'Indian');

-- --------------------------------------------------------

--
-- Table structure for table `Movie`
--

CREATE TABLE `Movie` (
  `movie_id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `overview` varchar(3000) DEFAULT NULL,
  `release_date` varchar(255) DEFAULT NULL,
  `runtime` varchar(255) DEFAULT NULL,
  `trailer` varchar(255) DEFAULT NULL,
  `movie_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Movie`
--

INSERT INTO `Movie` (`movie_id`, `title`, `overview`, `release_date`, `runtime`, `trailer`, `movie_image`) VALUES
(101, 'The Greatest Showman', 'Celebrates the birth of show business and tells of a visionary who rose from nothing to create a spectacle that became a worldwide sensation. \r\nOrphaned, penniless, but ambitious and with a mind crammed with imagination and fresh ideas, the American entertainer, Phineas Taylor Barnum, will always be remembered as the man with the gift to blur the line between reality and fiction. Thirsty for innovation and hungry for success, the son of a tailor manages to open a wax museum; however, he soon shifts focus to the unique and the peculiar, introducing extraordinary, never-seen-before live acts on the circus stage. Now, some people call Barnum\'s rich collection of oddities, an outright freak show; but, when Phineas, obsessed for cheers and respectability, gambles everything on the opera singer, Jenny Lind, to appeal to a high-brow audience, he will lose sight of the most crucial aspect of his life: his family. Will Barnum, the greatest showman, risk it all to be accepted?', '2017', '1h 45m', 'https://www.youtube.com/embed/AXCTMGYUg9A?si=5fefDuWiBUvAfGxC', './assets/MoviePoster/TGShowman.jpg'),
(102, 'The Dark Knight', 'When the menace known as the Joker wreaks havoc and chaos on the people of Gotham, Batman must accept one of the greatest psychological and physical tests of his ability to fight injustice.\r\nSet within a year after the events of Batman Begins (2005), Batman, Lieutenant James Gordon, and new District Attorney Harvey Dent successfully begin to round up the criminals that plague Gotham City, until a mysterious and sadistic criminal mastermind known only as \"The Joker\" appears in Gotham, creating a new wave of chaos. Batman\'s struggle against The Joker becomes deeply personal, forcing him to \"confront everything he believes\" and improve his technology to stop him. A love triangle develops between Bruce Wayne, Dent, and Rachel Dawes.', '2008', '2h 32m', 'https://www.youtube.com/embed/EXeTwQWrcwY?si=f6FbT0uIsSGcHSGS', './assets/MoviePoster/TheDarkKnight.jpeg'),
(103, 'Parasite', 'Greed and class discrimination threaten the newly-formed symbiotic relationship between the wealthy Park family and the destitute Kim clan.\r\nThe Kims - mother and father Chung-sook and Ki-taek, and their young adult offspring, son Ki-woo and daughter Ki-jung - are a poor family living in a shabby and cramped half basement apartment in a busy lower working class commercial district of Seoul. Ki-woo is the one who has dreams of getting out of poverty by one day going to university. Despite not having that university education, Ki-woo is chosen by his university student friend Min, who is leaving to go to school, to take over his tutoring job to Park Da-hye, who Min plans to date once he returns to Seoul and she herself is in university. The Parks are a wealthy family who for four years have lived in their modernistic house designed by and the former residence of famed architect Namgoong. While Mr. and Mrs. Park are all about status, Mrs. Park has a flighty, simpleminded mentality and temperament, which Min tells Ki-woo to feel comfortable in lying to her about his education to get the job. In getting the job, Ki-woo further learns that Mrs. Park is looking for an art therapist for the Parks\' adolescent son, Da-song, Ki-woo quickly recommending his professional art therapist friend \"Jessica\", really Ki-jung who he knows can pull off the scam in being the easiest liar of the four Kims. In Ki-woo also falling for Da-hye, he begins to envision himself in that house, and thus the Kims as a collective start a plan for all the Kims, like Ki-jung using assumed names, to replace existing servants in the Parks\' employ in orchestrating reasons for them to be fired. The most difficult to get rid of may be Moon-gwang, the Parks\' housekeeper who literally came with the house - she Namgoong\'s housekeeper when he lived there - and thus knows all the little nooks and crannies of it better than the Parks themselves. The question then becomes how far the Kims can take this scam in their quest to become their version of the Parks.', '2019', '2h 12m', 'https://www.youtube.com/embed/SEUXfv87Wpk?si=7xT206hIc7QIhkjF', './assets/MoviePoster/parasite.jpg'),
(104, 'Avengers: Endgame', 'After the devastating events of Avengers: Infinity War (2018), the universe is in ruins. With the help of remaining allies, the Avengers assemble once more in order to reverse Thanos\' actions and restore balance to the universe.', '2019', '3h 1m', 'https://www.youtube.com/embed/TcMBFSGVi1c?si=RdlozJf_M0z9iow5', './assets/MoviePoster/AvengersEndgame.jpeg'),
(105, 'The Silence of the Lambs', 'A young F.B.I. cadet must receive the help of an incarcerated and manipulative cannibal killer to help catch another serial killer, a madman who skins his victims.', '1991', '1h 58m', 'https://www.youtube.com/embed/6iB21hsprAQ?si=YOngnsntTmLDRrf_', './assets/MoviePoster/TheSilenceOfTheLambs.jpg'),
(106, 'Spirited Away', 'During her family\'s move to the suburbs, a sullen 10-year-old girl wanders into a world ruled by gods, witches and spirits, and where humans are changed into beasts.\r\nThe fanciful adventures of a ten-year-old girl named Chihiro, who discovers a secret world when she and her family get lost and venture through a hillside tunnel. When her parents undergo a mysterious transformation, Chihiro must fend for herself as she encounters strange spirits, assorted creatures and a grumpy sorceress who seeks to prevent her from returning to the human world.', '2001', '2h 5m', 'https://www.youtube.com/embed/ByXuk9QqQkk?si=hMfhs_e9eP7aOIlO', './assets/MoviePoster/SpiritedAway.jpg'),
(107, 'La La Land', 'While navigating their careers in Los Angeles, a pianist and an actress fall in love while attempting to reconcile their aspirations for the future.\r\nAspiring actress serves lattes to movie stars in between auditions and jazz musician Sebastian scrapes by playing cocktail-party gigs in dingy bars. But as success mounts, they are faced with decisions that fray the fragile fabric of their love affair, and the dreams they worked so hard to maintain in each other threaten to rip them apart.', '2016', '2h 8m', 'https://www.youtube.com/embed/je0aAf2f8XQ?si=traHURNyAO9cww6i', './assets/MoviePoster/La_La_Land.jpeg'),
(108, 'Up', '78-year-old Carl Fredricksen travels to Paradise Falls in his house equipped with balloons, inadvertently taking a young stowaway.\r\nAs a boy, Carl Fredricksen wanted to explore South America and find the forbidden Paradise Falls. About 64 years later he gets to begin his journey along with Boy Scout Russell by lifting his house with thousands of balloons. On their journey, they make many new friends including a talking dog, and figure out that someone has evil plans. Carl soon realizes that this evildoer is his childhood idol.', '2009', '1h 36m', 'https://www.youtube.com/embed/AkdXuDAP2Ts?si=ljHSQ9lCEYa4hR7u', './assets/MoviePoster/Up.jpeg'),
(109, 'Toy Story', 'A cowboy doll is profoundly threatened and jealous when a new spaceman action figure supplants him as top toy in a boy\'s bedroom.\r\nA little boy named Andy loves to be in his room, playing with his toys, especially his doll named \"Woody\". But, what do the toys do when Andy is not with them, they come to life. Woody believes that his life (as a toy) is good. However, he must worry about Andy\'s family moving, and what Woody does not know is about Andy\'s birthday party. Woody does not realize that Andy\'s mother gave him an action figure known as Buzz Lightyear, who does not believe that he is a toy, and quickly becomes Andy\'s new favorite toy. Woody, who is now consumed with jealousy, tries to get rid of Buzz. Then, both Woody and Buzz are now lost. They must find a way to get back to Andy before he moves without them, but they will have to pass through a ruthless toy killer, Sid Phillips.', '1995', '1h 21m', 'https://www.youtube.com/embed/v-PjgYDrg70?si=16FUFJ8YG_njh9s7', './assets/MoviePoster/ToyStory.jpeg'),
(110, 'Joker', 'During the 1980s, a failed stand-up comedian is driven insane and turns to a life of crime and chaos in Gotham City while becoming an infamous psychopathic crime figure.\r\nA socially inept clown for hire - Arthur Fleck aspires to be a stand up comedian among his small job working dressed as a clown holding a sign for advertising. He takes care of his mother, Penny Fleck, and as he learns more about his mental illness, he learns more about his past. Dealing with all the negativity and bullying from society, he heads downwards on a spiral, in turn showing how his alter ego, \"Joker,\" came to be.', '2019', '2h 2m', 'https://www.youtube.com/embed/zAGVQLHvwOY?si=uPF_sWMIl4QofSzI', './assets/MoviePoster/joker.jpeg'),
(111, '3 Idiots', 'Two friends are searching for their long lost companion. They revisit their college days and recall the memories of their friend who inspired them to think differently, even as the rest of the world called them \"idiots\".\r\nRancho is an engineering student. His two friends. Farhan and Raju, Rancho sees the world in a different way. Rancho goes somewhere one day. And his friends find him. When Rancho is found, he has become one of a great scientist in the world.', '2009', '2h 50m', 'https://www.youtube.com/embed/lbCRtrrMvSw?si=n6YOBeqR3CJEKPIX', './assets/MoviePoster/3Idiots.jpg'),
(112, 'The Sound of Music', 'A young novice is sent by her convent in 1930s Austria to become a governess to the seven children of a widowed naval officer.\r\nIn 1930s Austria, a young woman named Maria is failing miserably in her attempts to become a nun. When Navy Captain Georg Von Trapp writes to the abbey asking for a governess that can handle his seven mischievous children, Maria is given the job. His wife is dead, he is often away, and he runs the household as strictly as he does the ships he sails on. The children are unhappy and resentful of the governesses that he keeps hiring and have managed to run each of them off one by one. When Maria arrives, she is initially met with the same hostility, but her kindness, understanding, and sense of fun soon draws the children to her and brings some much-needed joy into all their lives, including the Captain\'s. Eventually he and Maria find themselves falling in love, even though he is already engaged to a Baroness named Elsa and Maria is still a postulant. The romance makes them both start questioning the decisions they have made. Their personal conflicts soon become overshadowed, however, by world events. Austria is about to come under Germany\'s control, and the Captain may soon find himself drafted into the German Navy and forced to fight against his own country.', '1965', '2h 52m', 'https://www.youtube.com/embed/bZNcqtx83Io?si=HPJfGg26DU8neoXN', './assets/MoviePoster/SoundOfMusic.jpeg'),
(113, 'Love Actually', 'Follows the lives of eight very different couples in dealing with their love lives in various loosely interrelated tales all set during a frantic month before Christmas in London, England.', '2003', '2h 15m', 'https://www.youtube.com/embed/H9Z3_ifFheQ?si=v0079rhgh3rYeopR', './assets/MoviePoster/LoveActually.jpeg'),
(114, 'The Parent Trap', 'Identical twins Annie and Hallie, separated at birth and each raised by one of their biological parents, discover each other for the first time at summer camp and make a plan to bring their wayward parents back together.\r\nWhen two pre-teens named Hallie and Annie meet at summer camp, their lives are rattled when they realize that they are identical twins. With parents, British mother aka famous dress designer Elizabeth and American father, a wine maker named Nick, living on different sides of the universe, the girls decide to make an identity swap in hopes of spending time with their other parent. The girls later choose to inform their guardians of the swap while at a hotel in San Francisco, which later reunites the divorced pair and they remarry.', '1998', '2h 8m', 'https://www.youtube.com/embed/PMAhVpgzmRU?si=x-YnTy6jfzyIA20m', './assets/MoviePoster/TheParentTrap.jpeg'),
(115, 'Inside Out', 'After young Riley is uprooted from her Midwest life and moved to San Francisco, her emotions - Joy, Fear, Anger, Disgust and Sadness - conflict on how best to navigate a new city, house, and school.\r\nGrowing up can be a bumpy road, and it\'s no exception for Riley, who is uprooted from her Midwest life when her father starts a new job in San Francisco. Like all of us, Riley is guided by her emotions - Joy, Fear, Anger, Disgust and Sadness. The emotions live in Headquarters, the control center inside Riley\'s mind, where they help advise her through everyday life. As Riley and her emotions struggle to adjust to a new life in San Francisco, turmoil ensues in Headquarters. Although Joy, Riley\'s main and most important emotion, tries to keep things positive, the emotions conflict on how best to navigate a new city, house and school.', '2015', '1h 35m', 'https://www.youtube.com/embed/yRUAzGQ3nSY?si=BXHlIKhamahhoF6k', './assets/MoviePoster/InsideOut.jpg'),
(116, 'The pursuit of Happyness', 'A struggling salesman takes custody of his son as he\'s poised to begin a life-changing professional career.\r\nBased on a true story about a man named Christopher Gardner. Gardner has invested heavily in a device known as a \"bone density scanner\". He feels like he has it made selling these devices. However, they do not sell well as they are marginally better than x-ray at a much higher price. As Gardner works to make ends meet, his wife leaves him and he loses his apartment. Forced to live out in the streets with his son, Gardner continues to sell bone density scanners while concurrently taking on an unpaid internship as a stockbroker, with slim chances for advancement to a paid position. Before he can receive pay, he needs to outshine the competition through 6 months of training, and to sell his devices to stay afloat.', '2006', '1h 57m', 'https://www.youtube.com/embed/DMOBlEcRuw8?si=5tHdWrUhHOrFc5YA', './assets/MoviePoster/ThePursuitOfHappyness.jpg'),
(117, 'Exhuma', 'The process of excavating an ominous grave unleashes dreadful consequences buried underneath.\r\nA wealthy family in Los Angeles experiences a series of bizarre supernatural events. The family contacts famous young shamans Hwa-Rim and Bong-Gil. After investigating, Hwa-Rim realizes that these events are related to the family\'s ancestor. Hwa-Rim asks Feng Shui export Sang-Deok and undertaker Young-Geun for help. They find the family’s ancestor\'s grave in a remote South Korean village and dig up the grave.', '2024', '2h 14m', 'https://www.youtube.com/embed/fRkOWmfZjkY?si=ESIzZhM5yZZ2CaGf', './assets/MoviePoster/Exhuma.jpeg'),
(118, 'The Maze Runner', 'Thomas is deposited in a community of boys after his memory is erased, soon learning they\'re all trapped in a maze that will require him to join forces with fellow \"runners\" for a shot at escape.\r\nAwakening in an elevator, remembering nothing of his past, Thomas emerges into a world of about thirty teenage boys, all without past memories, who have learned to survive under their own set of rules in a completely enclosed environment, subsisting on their own agriculture and supplies. With a new boy arriving every thirty days, the group has been in \"The Glade\" for three years, trying to find a way to escape through the Maze that surrounds their living space (patrolled by cyborg monsters named \'Grievers\'). They have begun to give up hope when a comatose girl arrives with a strange note, and their world begins to change with the boys dividing into two factions: those willing to risk their lives to escape and those wanting to hang onto what they\'ve got and survive.', '2014', '1h 53m', 'https://www.youtube.com/embed/AwwbhhjQ9Xk?si=OkclyBBJyC4B0k2k', './assets/MoviePoster/themaze.jpg'),
(119, 'Begin Again', 'A chance encounter between a down-and-out music business executive, and a young singer songwriter new to Manhattan, turns into a promising collaboration between the two talents.\r\nGretta (Keira Knightley) and her long-time boyfriend Dave (Adam Levine) are college sweethearts and songwriting partners who decamp for New York when he lands a deal with a major label. But the trappings of his new-found fame soon tempt Dave to stray, and a reeling, lovelorn Gretta is left on her own. Her world takes a turn for the better when Dan (Mark Ruffalo), a disgraced record-label exec, stumbles upon her performing on an East Village stage and is immediately captivated by her raw talent. From this chance encounter emerges an enchanting portrait of a mutually transformative collaboration, set to the soundtrack of a summer in New York City.', '2013', '1h 44m', 'https://www.youtube.com/embed/uTRCxOE7Xzc?si=zTFEgm66sKlwDhC6', './assets/MoviePoster/beginagain.jpeg'),
(120, 'Black Panther', 'T\'Challa, heir to the hidden but advanced kingdom of Wakanda, must step forward to lead his people into a new future and must confront a challenger from his country\'s past.\r\nAfter the events of Captain America: Civil War, Prince T\'Challa returns home to the reclusive, technologically advanced African nation of Wakanda to serve as his country\'s new king. However, T\'Challa soon finds that he is challenged for the throne from factions within his own country. When two foes conspire to destroy Wakanda, the hero known as Black Panther must team up with C.I.A. agent Everett K. Ross and members of the Dora Milaje, Wakandan special forces, to prevent Wakanda from being dragged into a world war.', '2018', '2h 14m', 'https://www.youtube.com/embed/xjDjIWPwcPU?si=rnaE40PTgmt7qY_h', './assets/MoviePoster/BlackPanther.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `Movie_Cast`
--

CREATE TABLE `Movie_Cast` (
  `movie_cast_id` int(11) NOT NULL,
  `movie_id` int(11) DEFAULT NULL,
  `person_id` int(11) DEFAULT NULL,
  `character_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Movie_Cast`
--

INSERT INTO `Movie_Cast` (`movie_cast_id`, `movie_id`, `person_id`, `character_name`) VALUES
(401, 101, 301, 'P.T. Barnum'),
(402, 101, 302, 'Charity Barnum'),
(403, 101, 303, 'Phillip Carlyle'),
(404, 102, 304, 'Bruce Wayne'),
(405, 102, 306, 'Joker'),
(406, 102, 307, 'Harvey Dent'),
(407, 103, 308, 'Ki Taek'),
(408, 103, 309, 'Dong Ik'),
(409, 103, 310, 'Yeon Kyo'),
(410, 104, 311, 'Tony Stark'),
(411, 104, 312, 'Steve Rogers'),
(412, 104, 313, 'Bruce Banner'),
(413, 105, 314, 'Clarice Starling'),
(414, 105, 315, 'Dr. Hannibal Lecter'),
(415, 106, 316, 'Chihiro (English version)'),
(416, 106, 317, 'Yubaba (English version)'),
(417, 106, 318, 'Haku'),
(418, 107, 319, 'Sebastian'),
(419, 107, 320, 'Mia'),
(420, 108, 321, 'Carl Fredricksen'),
(421, 108, 322, 'Russell'),
(422, 109, 323, 'Woody'),
(423, 109, 324, 'Buzz Lightyear'),
(424, 110, 325, 'Arthur Fleck'),
(425, 110, 326, 'Murray Franklin'),
(426, 110, 327, 'Sophie Dumond'),
(427, 111, 328, 'Farhan'),
(428, 111, 329, 'Rancho'),
(429, 111, 330, 'Mona'),
(430, 112, 331, 'Maria'),
(431, 112, 332, 'Captain Georg von Trapp'),
(432, 113, 333, 'The Prime Minister'),
(433, 113, 334, 'Natalie'),
(434, 113, 335, 'Daniel'),
(435, 114, 336, 'Hallie Parker, Annie James'),
(436, 114, 337, 'Nick Parker'),
(437, 114, 338, 'Elizabeth James'),
(438, 115, 339, 'Joy'),
(439, 115, 340, 'Fear'),
(440, 115, 341, 'Anger'),
(441, 116, 342, 'Chris Gardner'),
(442, 116, 343, 'Chris Gardner'),
(443, 117, 344, 'Hwarim'),
(444, 117, 345, 'Bong Gil'),
(445, 117, 346, 'Kim Sang Deok'),
(446, 118, 347, 'Thomas'),
(447, 118, 348, 'Gally'),
(448, 118, 349, 'Teresa'),
(449, 119, 350, 'Gretta'),
(450, 119, 313, 'Dan'),
(451, 120, 351, 'T\'Challa'),
(452, 120, 352, 'Nakia');

-- --------------------------------------------------------

--
-- Table structure for table `Movie_Director`
--

CREATE TABLE `Movie_Director` (
  `movie_id` int(11) NOT NULL,
  `director_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Movie_Director`
--

INSERT INTO `Movie_Director` (`movie_id`, `director_id`) VALUES
(101, 201),
(102, 202),
(103, 203),
(104, 204),
(104, 205),
(105, 206),
(106, 207),
(107, 208),
(108, 209),
(108, 210),
(109, 211),
(110, 212),
(111, 213),
(112, 214),
(113, 215),
(114, 216),
(115, 217),
(115, 218),
(116, 219),
(117, 220),
(118, 221),
(119, 222),
(120, 223);

-- --------------------------------------------------------

--
-- Table structure for table `Movie_Genre`
--

CREATE TABLE `Movie_Genre` (
  `movie_id` int(11) NOT NULL,
  `genre_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Movie_Genre`
--

INSERT INTO `Movie_Genre` (`movie_id`, `genre_id`) VALUES
(101, 711),
(101, 712),
(102, 701),
(102, 713),
(103, 704),
(103, 712),
(104, 701),
(104, 702),
(105, 706),
(105, 713),
(106, 709),
(106, 714),
(107, 703),
(107, 711),
(108, 704),
(108, 714),
(109, 704),
(109, 709),
(110, 712),
(110, 713),
(111, 703),
(111, 704),
(112, 703),
(112, 711),
(113, 703),
(113, 704),
(114, 704),
(114, 710),
(115, 704),
(115, 709),
(116, 707),
(116, 708),
(117, 705),
(117, 706),
(118, 701),
(118, 702),
(119, 703),
(119, 704),
(120, 701),
(120, 702);

-- --------------------------------------------------------

--
-- Table structure for table `Movie_Language`
--

CREATE TABLE `Movie_Language` (
  `movie_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Movie_Language`
--

INSERT INTO `Movie_Language` (`movie_id`, `language_id`) VALUES
(101, 601),
(102, 601),
(103, 602),
(104, 601),
(105, 601),
(106, 603),
(107, 601),
(108, 601),
(109, 601),
(110, 601),
(111, 604),
(112, 601),
(113, 601),
(114, 601),
(115, 601),
(116, 601),
(117, 602),
(118, 601),
(119, 601),
(120, 601);

-- --------------------------------------------------------

--
-- Table structure for table `Person`
--

CREATE TABLE `Person` (
  `person_id` int(11) NOT NULL,
  `person_name` varchar(255) DEFAULT NULL,
  `person_description` varchar(3000) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL CHECK (`gender` in ('Female','Male')),
  `person_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Person`
--

INSERT INTO `Person` (`person_id`, `person_name`, `person_description`, `gender`, `person_image`) VALUES
(301, 'Hugh Jackman', 'Hugh Michael Jackman is an Australian actor, singer, multi-instrumentalist, dancer and producer. Jackman has won international recognition for his roles in major films, notably as superhero, period, and romance characters. He is best known for his long-running role as Wolverine in the X-Men film series, as well as for his lead roles in the romantic-comedy fantasy Kate & Leopold (2001), the action-horror film Van Helsing (2004), the drama The Prestige and The Fountain (2006), the epic historical romantic drama Australia (2008), the film version of Les Misérables (2012), and the thriller Prisoners (2013). His work in Les Misérables earned him his first Academy Award nomination for Best Actor and his first Golden Globe Award for Best Actor - Motion Picture Musical or Comedy in 2013. In Broadway theatre, Jackman won a Tony Award for his role in The Boy from Oz. A four-time host of the Tony Awards themselves, he won an Emmy Award for one of these appearances. Jackman also hosted the 81st Academy Awards on 22 February 2009.', 'Male', './assets/Person/HughJackman2.jpeg'),
(302, 'Michelle Williams', 'A small-town girl born and raised in rural Kalispell, Montana, Michelle Ingrid Williams is the daughter of Carla Ingrid (Swenson), a homemaker, and Larry Richard Williams, a commodity trader and author. Her ancestry is Norwegian, as well as German, British Isles, and other Scandinavian. She was first known as bad girl Jen Lindley in the television series Dawson\'s Creek (1998). She appeared in the comedy film Dick (1999), which was a parody of the Watergate Scandal along with Kirsten Dunst, as well as Prozac Nation (2001) with Christina Ricci. Since then, Michelle has worked her way into the world of independent films such as The Station Agent (2003), Imaginary Heroes (2004), and The Baxter (2005). But her real success happened in 2005 when she starred in Ang Lee\'s Brokeback Mountain (2005) as Alma Beers Del Mar. A woman who realizes her husband is in love with another man. Her talent shown in Brokeback Mountain (2005) landed her an Academy Award nomination for Best Supporting Actress. In 2011, she received her first lead role Academy Award nomination for Blue Valentine (2010). She followed this in 2012 with a lead role Academy Award nomination for My Week with Marilyn (2011).', 'Female', './assets/Person/MichelleWilliams.jpeg'),
(303, 'Zak Efron', 'Zachary David Alexander Efron (born October 18, 1987) is an American actor. Efron began acting professionally in the early 2000s and rose to prominence as a teen idol for his leading role as Troy Bolton in the High School Musical trilogy (2006–2008). During this time, he also starred in the musical film Hairspray (2007) and the comedy film 17 Again (2009).\r\n\r\nEfron had starring roles in the films New Year\'s Eve (2011), The Lucky One (2012), The Paperboy (2012), Neighbors (2014), Dirty Grandpa (2016), Baywatch (2017), and The Greatest Showman (2017). He played Ted Bundy in Extremely Wicked, Shockingly Evil and Vile (2019) and Kevin Von Erich in The Iron Claw (2023). In 2021, he won a Daytime Emmy Award for hosting the Netflix travel show Down to Earth with Zac Efron (2020–2022). In 2024, he received a star on the Hollywood Walk of Fame.', 'Male', './assets/Person/ZakEfron2.jpeg'),
(304, 'Christian Bale', 'Christian Charles Philip Bale was born in Pembrokeshire, Wales, UK on January 30, 1974, to English parents Jennifer \"Jenny\" (James) and David Bale. His mother was a circus performer and his father, who was born in South Africa, was a commercial pilot. The family lived in different countries throughout Bale\'s childhood, including England, Portugal, and the United States. Bale acknowledges the constant change was one of the influences on his career choice.\r\nHis first acting job was a cereal commercial in 1983; amazingly, the next year, he debuted on the West End stage in \"The Nerd\". A role in the 1986 NBC mini-series Anastasia: The Mystery of Anna (1986) caught Steven Spielberg\'s eye, leading to Bale\'s well-documented role in Empire of the Sun (1987). For the range of emotions he displayed as the star of the war epic, he earned a special award by the National Board of Review for Best Performance by a Juvenile Actor.', 'Male', './assets/Person/ChristianBale.jpeg'),
(306, 'Heath Ledger', 'Heath Andrew Ledger (4 April 1979 – 22 January 2008) was an Australian actor. After playing roles in several Australian television and film productions during the 1990s, he moved to the United States in 1998 to further develop his film career. His work consisted of 20 films in a variety of genres, including 10 Things I Hate About You (1999), The Patriot (2000), A Knight\'s Tale (2001), Monster\'s Ball (2001), Casanova (2005), Lords of Dogtown (2005), Brokeback Mountain (2005), Candy (2006), I\'m Not There (2007), The Dark Knight (2008), and The Imaginarium of Doctor Parnassus (2009), the latter two of which were posthumously released. He also produced and directed music videos and aspired to be a film director.', 'Male', './assets/Person/HeathLedger.jpeg'),
(307, 'Aaron Eckhart', 'Aaron Edward Eckhart is an American actor. Born in Cupertino, California, Eckhart moved to the United Kingdom at an early age, when his father relocated the family. Several years later, he began his acting career by performing in school plays, before moving to Australia for his high school senior year. He left high school without graduating, but earned a diploma through a professional education course, and graduated from Brigham Young University (BYU) in 1994 with a Bachelor of Fine Arts (BFA) degree in film. For much of the mid-1990s, he lived in New York City as a struggling, unemployed actor.', 'Male', './assets/Person/AaronEckhart.jpeg'),
(308, 'Song Kang-Ho', 'Song Kang-Ho first worked in plays entering a troupe. And started working in film as supporting actor and minor roles that most people even couldn\'t notice. He caught his break through chance in \'Green Fish\' as a supporting role with major impact. In \'No. 3\' he actually created a syndrome from his role, when people started imitating his acting. He has always considered how sincere the director\'s message is portrayed within the film, and is now known as one of the best character actors in Korea.', 'Male', './assets/Person/SongKangHo2.jpeg'),
(309, 'Lee Sun-Kyun', 'Lee Sun-kyun was born on 2 March 1975 in Seoul, South Korea. He was an actor and manager, known for Parasite (2019), A Hard Day (2014) and Paju (2009). He was married to Jeon Hye-jin. He died on 27 December 2023 in Seoul, South Korea.', 'Male', './assets/Person/LeeSunKyun.jpeg'),
(310, 'Cho Yeo-Jeong', 'Cho Yeo-jeong was born on February 10, 1981 in South Korea. She is an actress, known for Parasite (2019), The Servant (2010) and Obsessed (2014).', 'Female', './assets/Person/ChoYeoJeong2.jpeg'),
(311, 'Robert Downey Jr.', 'Robert John Downey Jr. (born April 4, 1965) is an American actor. His films as a leading actor have grossed over $14 billion worldwide, making him one of the highest-grossing actors of all time. Downey\'s career has been characterized by some early success, a period of drug-related problems and run-ins with the law, and a surge in popular and commercial success in the 2000s.In 2008, Downey was named by Time magazine as one of the 100 most influential people in the world. From 2013 to 2015, he was listed by Forbes as Hollywood\'s highest-paid actor.', 'Male', './assets/Person/RobertDowneyJr.jpeg'),
(312, 'Chris Evans', 'Christopher Robert Evans (born June 13, 1981) is an American actor. He began his career with roles in television series such as Opposite Sex in 2000. Following appearances in several teen films, including 2001\'s Not Another Teen Movie, he gained attention for his portrayal of Marvel Comics character the Human Torch in Fantastic Four (2005) and Fantastic Four: Rise of the Silver Surfer (2007). Evans made further appearances in film adaptations of comic books and graphic novels: TMNT (2007), Scott Pilgrim vs. the World (2010), and Snowpiercer (2013).', 'Male', './assets/Person/ChrisEvans.jpeg'),
(313, 'Mark Ruffalo', 'Mark Alan Ruffalo (born November 22, 1967) is an American actor. He began acting in the early 1990s and first gained recognition for his work in Kenneth Lonergan\'s play This Is Our Youth (1996) and drama film You Can Count on Me (2000). He went on to star in the romantic comedies 13 Going on 30 (2004), Just like Heaven (2005) and the thrillers In the Cut (2003), Zodiac (2007), and Shutter Island (2010). He received a Tony Award nomination for his supporting role in the Broadway revival of Awake and Sing! in 2006. Ruffalo gained international recognition for playing Bruce Banner / Hulk since 2012 in the superhero franchise of the Marvel Cinematic Universe.\r\nRuffalo gained nominations for the Academy Award for Best Supporting Actor for playing a sperm-donor in the comedy-drama The Kids Are All Right (2010), Dave Schultz in the biopic Foxcatcher (2014), Michael Rezendes in the drama Spotlight (2015), and a debauched lawyer in the science fantasy Poor Things (2023). He won a Screen Actors Guild Award for Best Actor for playing a gay activist in the television drama film The Normal Heart (2015), and a Primetime Emmy Award for Outstanding Lead Actor for his dual role as identical twins in the miniseries I Know This Much Is True (2020).', 'Male', './assets/Person/MarkRuffalo.jpeg'),
(314, 'Jodie Foster', 'Jodie Foster started her career at the age of two. For four years she made commercials and finally gave her debut as an actress in the TV series Mayberry R.F.D. (1968). In 1975 Jodie was offered the role of prostitute Iris Steensma in the movie Taxi Driver (1976). This role, for which she received an Academy Award nomination in the \"Best Supporting Actress\" category, marked a breakthrough in her career. In 1980 she graduated as the best of her class from the College Lycée Français and began to study English Literature at Yale University, from where she graduated magna cum laude in 1985. One tragic moment in her life was March 30th, 1981 when John Warnock Hinkley Jr. attempted to assassinate the President of the United States, Ronald Reagan. Hinkley was obsessed with Jodie and the movie Taxi Driver (1976), in which Travis Bickle, played by Robert De Niro, tried to shoot presidential candidate Palantine. Despite the fact that Jodie never took acting lessons, she received two Oscars before she was thirty years of age. She received her first award for her part as Sarah Tobias in The Accused (1988) and the second one for her performance as Clarice Starling in The Silence of the Lambs (1991).', 'Female', './assets/Person/JodieFoster.jpg'),
(315, 'Anthony Hopkins', 'Anthony Hopkins was born on December 31, 1937, in Margam, Wales, to Muriel Anne (Yeats) and Richard Arthur Hopkins, a baker. His parents were both of half Welsh and half English descent. Influenced by Richard Burton, he decided to study at College of Music and Drama and graduated in 1957. In 1965, he moved to London and joined the National Theatre, invited by Laurence Olivier, who could see the talent in Hopkins. In 1967, he made his first film for television, A Flea in Her Ear (1967).\r\nFrom this moment on, he enjoyed a successful career in cinema and television. In 1968, he worked on The Lion in Winter (1968) with Timothy Dalton. Many successes came later, and Hopkins\' remarkable acting style reached the four corners of the world. In 1977, he appeared in two major films: A Bridge Too Far (1977) with James Caan, Gene Hackman, Sean Connery, Michael Caine, Elliott Gould and Laurence Olivier, and Maximilian Schell. In 1980, he worked on The Elephant Man (1980). Two good television literature adaptations followed: Othello (1981) and The Hunchback of Notre Dame (1982). In 1987 he was awarded with the Commander of the order of the British Empire. This year was also important in his cinematic life, with 84 Charing Cross Road (1987), acclaimed by specialists. In 1993, he was knighted.', 'Male', './assets/Person/AnthonyHopkins.jpeg'),
(316, 'Daveigh Chase', 'Daveigh Chase was born on July 24, 1990 in Las Vegas, Nevada. She was raised in the small town of Albany, Oregon; where she continues to spend much of her time. She began singing and dancing in her hometown and other local areas at community events and shows starting at age 3. After visiting Los Angeles, she did her first commercial for Campbell\'s Soup at age 7. At this time, she was also offered a starring role in the Musical Theatre production \"Utah!\". At age 8, she auditioned for the the voice of \"Lilo\", and tested at CBS network for her first television series. She continued to test and be cast as a series regular, working on many different television pilots, before finally FOX picked up the show Oliver Beene (2003) in which Daveigh starred as Oliver\'s quirky best friend \"Joyce\". In the meantime, she appeared in several movies, including Donnie Darko (2001), in which she played Donnie\'s youngest sister and was a member of the \"Sparkle Motion\" dance group; and \"R.L. Stines The Haunted Lighthouse\" which continues to show at various Busch Garden Theme Parks. In 2003, she won the \"Best Villian\" award at the MTV Movie Awards for her work as \"Samara\" in DreamWorks hit, The Ring (2002). She is the voice of \"Lilo\" from the hit animated and Oscar nominated Disney feature film, Lilo & Stitch (2002), and she continues to voice \"Lilo\" for the Disney Channel series, as well as various DVD\'s and video games. Daveigh is also cast as the English voice of the lead heroine \"Chihiro\" in Hayao Miyazaki and Studio Gibli\'s Spirited Away (2001) (aka Spirited Away) which won the 2002 Oscar for Best Animated Film.', 'Female', './assets/Person/DaveighChase.jpg'),
(317, 'Suzanne Pleshette', 'Suzanne Pleshette (January 31, 1937 – January 19, 2008) was an American actress. Pleshette was known for her roles in theatre, film, and television. She received nominations for three Emmy Awards and two Golden Globe Awards. For her role as Emily Hartley on the CBS sitcom The Bob Newhart Show (1972–1978) she received two nominations for the Primetime Emmy Award for Outstanding Lead Actress in a Comedy Series.\r\nPleshette started her career in the theatre before gaining attention for her role in Alfred Hitchcock\'s horror-thriller The Birds (1963). Her other notable film roles include Rome Adventure (1962), Support Your Local Gunfighter (1971), and Hot Stuff (1979). For her portrayal of Leona Helmsley in Leona Helmsley: The Queen of Mean (1990) she received nominations for the Primetime Emmy Award and Golden Globe Award for Best Actress in a Miniseries or Movie. She later voiced roles in The Lion King 2: Simba\'s Pride (1998) and Spirited Away (2001).', 'Female', './assets/Person/SuzannePleshette.jpeg'),
(318, 'Miyu Irino', 'Miyu Irino was born on February 19, 1988 in Tokyo, Japan. He is an actor, known for Spirited Away (2001), The Garden of Words (2013) and A Silent Voice (2016).', 'Male', './assets/Person/MiyuIrino.jpeg'),
(319, 'Ryan Gosling', 'Born Ryan Thomas Gosling on November 12, 1980, in London, Ontario, Canada, he is the son of Donna (Wilson), a secretary, and Thomas Ray Gosling, a traveling salesman. Ryan was the second of their two children, with an older sister, Mandi. His ancestry is French-Canadian, as well as English, Scottish, and Irish. The Gosling family moved to Cornwall, Ontario, where Ryan grew up and was home-schooled by his mother. He also attended Gladstone Public School and Cornwall Collegiate & Vocational School, where he excelled in Drama and Fine Arts. The family then relocated to Burlington, Ontario, where Ryan attended Lester B. Pearson High School.\r\nGosling reached a summit of his profession with his performance in Half Nelson (2006), which garnered him an Academy Award nomination as Best Actor. In a short time, he has established himself as one of the finest actors of his generation. Throughout the subsequent decade, he has become all three of an internet fixation, a box office star, and a critical darling, having headlined Blue Valentine (2010), Crazy, Stupid, Love. (2011), Drive (2011), The Ides of March (2011), The Place Beyond the Pines (2012), The Nice Guys (2016), and La La Land (2016). In 2017, he starred in the long-awaited science fiction sequel Blade Runner 2049 (2017), with Harrison Ford.', 'Male', './assets/Person/RyanGosling.jpeg'),
(320, 'Emma Stone', 'Emily Jean \"Emma\" Stone was born on November 6, 1988 in Scottsdale, Arizona to Krista Jean Stone (née Yeager), a homemaker & Jeffrey Charles \"Jeff\" Stone, a contracting company founder and CEO. She is of Swedish, German & British Isles descent. Stone began acting as a child as a member of the Valley Youth Theatre in Phoenix, Arizona, where she made her stage debut in a production of Kenneth Grahame\'s \"The Wind in the Willows\". She appeared in many more productions through her early teens until, at the age of fifteen, she decided that she wanted to make acting her career.', 'Female', './assets/Person/EmmaStone.jpeg'),
(321, 'Edward Asner', 'Eddie Asner (November 15, 1929 – August 29, 2021) was an American actor. He is most notable for portraying Lou Grant during the 1970s and early 1980s, on both The Mary Tyler Moore Show and its spin-off series Lou Grant, making him one of the few television actors to portray the same character in both a comedy and a drama.', 'Male', './assets/Person/EdwardAsner.jpg'),
(322, 'Jordan Nagai', 'Jordan Nagai was born on 5 February 2000 in Los Angeles, California, USA. He is an actor, known for Up (2009), Up (2009) and The Simpsons (1989).', 'Male', './assets/Person/JordanNagai.jpeg'),
(323, 'Tom Hanks', 'Thomas Jeffrey Hanks was born in Concord, California, to Janet Marylyn (Frager), a hospital worker, and Amos Mefford Hanks, an itinerant cook. His mother\'s family, originally surnamed \"Fraga\", was entirely Portuguese, while his father was of mostly English ancestry. Tom grew up in what he has called a \"fractured\" family. He moved around a great deal after his parents\' divorce, living with a succession of step-families. No problems, no alcoholism - just a confused childhood. He has no acting experience in college and credits the fact that he could not get cast in a college play with actually starting his career. He went downtown, and auditioned for a community theater play, was invited by the director of that play to go to Cleveland, and there his acting career started.', 'Male', './assets/Person/TomHanks.jpeg'),
(324, 'Tim Allen', 'Timothy Allen Dick was born on June 13, 1953, in Denver, Colorado, to Martha Katherine (Fox) and Gerald M. Dick. His father, a real estate salesman, was killed in a collision with a drunk driver while driving his family home from a University of Colorado football game, when Tim was eleven years old. His mother, a community service worker, remarried her high school sweetheart, an Episcopalian deacon, two years after Tim\'s father\'s death. He was raised with his many siblings and step-siblings. When Tim was young, his family moved to Birmingham, Michigan.\r\nIn high school, his favorite subject was shop, of course, and after high school, he attended Western Michigan University and graduated with a degree in Television Production in 1975. In 1978, he was arrested on drug charges and spent two years in jail. Upon his release, he had a new outlook on life and on a dare from a friend, started his comedy career at the Comedy Castle in Detroit. Later, he went on to do several cable specials, including, Comedy\'s Dirtiest Dozen (1988) and Tim Allen: Men Are Pigs (1990). In 1991, he became the star of his own hit television series on ABC called Home Improvement (1991). While continuing to film his television series throughout most of the 1990s, he starred in a string of blockbuster movies, including The Santa Clause (1994), Toy Story (1995), Toy Story 2 (1999) and Galaxy Quest (1999). In August 1996, he developed and unveiled his own signature line of power tools, manufactured by Ryobi. On top of all that, he has his own racing team, Tim Allen/Saleen RRRRacing. In May 1999, he ended his series Home Improvement (1991) after eight seasons and in 2001, he filmed.', 'Male', './assets/Person/TimAllen.jpeg'),
(325, 'Joaquin Phoenix', 'Joaquin Rafael Phoenix (born October 28, 1974) is an American actor. Known for his roles as dark, unconventional and eccentric characters in independent film, in particular period dramas, he has received various accolades, including an Academy Award, a British Academy Film Award, a Grammy Award, and two Golden Globe Awards. In 2020, The New York Times named him one of the greatest actors of the 21st century.', 'Male', './assets/Person/JoaquinPhoenix.jpg'),
(326, 'Robert De Niro', 'Robert Anthony De Niro (born August 17, 1943) is an American actor and film producer. Known for his collaborations with Martin Scorsese, he is considered to be one of the greatest and most influential actors of his generation.De Niro is the recipient of various accolades, including two Academy Awards, a Golden Globe Award, the Cecil B. DeMille Award, and a Screen Actors Guild Life Achievement Award. In 2009, De Niro received the Kennedy Center Honors, and earned a Presidential Medal of Freedom from U.S. President Barack Obama in 2016.', 'Male', './assets/Person/RobertDeNiro.jpg'),
(327, 'Zazie Beetz', 'Zazie Olivia Beetz (born June 1, 1991) is a German-born American actress. She is best known for her role in the FX comedy-drama series Atlanta (2016–2022), for which she received a nomination for the Primetime Emmy Award for Outstanding Supporting Actress in a Comedy Series. She starred in the Netflix anthology series Easy (2016–2019) and currently voices Amber Bennett in the adult animated superhero series Invincible (2021–present).', 'Female', './assets/Person/ZazieBeetz.jpeg'),
(328, 'Madhavan', 'Ranganathan Madhavan credited as R. Madhavan, informally known as Maddy, is an Indian actor, writer, director, and producer who predominantly appears in Tamil and Hindi films.', 'Male', './assets/Person/Madhavan.jpeg'),
(329, 'Aamir Khan', 'Mohammed Aamir Hussain Khan is an Indian actor, filmmaker, and television personality who works in Hindi films. ', 'Male', './assets/Person/AamirKhan.jpeg'),
(330, 'Mona Singh', 'Mona Singh is an Indian actress who works in Hindi films and series. Having first gained prominence in 2000s for playing the eponymous heroine in the soap opera series Jassi Jaissi Koi Nahin, she has since appeared in several other television and film roles.', 'Female', './assets/Person/MonaSingh.jpeg'),
(331, 'Julie Andrews', 'Dame Julie Andrews DBE is an English actress, singer, and author. She has garnered numerous accolades throughout her career spanning over seven decades, including an Academy Award, a BAFTA Award, two Emmy Awards, three Grammy Awards, and six Golden Globe Awards as well as nominations for three Tony Awards.', 'Female', './assets/Person/JulieAndrews.jpeg'),
(332, 'Christopher Plummer', 'Arthur Christopher Orme Plummer CC was a Canadian actor. His career spanned seven decades, gaining him recognition for his performances in film, stage, and television.', 'Male', './assets/Person/ChristopherPlummer.jpeg'),
(333, 'Hugh Grant', 'Hugh John Mungo Grant is an English actor. He established himself early in his career as a charming and vulnerable romantic leading man, and has since transitioned into a character actor. Hallmarks of Grant\'s comic skills include a nonchalant touch of sarcasm and characteristic physical mannerisms.', 'Male', './assets/Person/HughGrant.jpg'),
(334, 'Martine McCutcheon', 'Martine Kimberley Sherrie McCutcheon is an English actress and singer. She began appearing in television commercials at an early age and made her television debut in the children\'s television drama Bluebirds in 1989.', 'Female', './assets/Person/MartineMc.jpg'),
(335, 'Liam Neeson', 'William John Neeson OBE is an actor from Northern Ireland. He has received several accolades, including nominations for an Academy Award, a BAFTA Award, three Golden Globe Awards, and two Tony Awards. In 2020, he was placed seventh on The Irish Times list of Ireland\'s 50 Greatest Film Actors.', 'Male', './assets/Person/LiamNeeson.jpg'),
(336, 'Lindsay Lohan', 'Lindsay Dee Lohan is an American actress, singer-songwriter, producer, and entrepreneur. Born in New York City and raised on Long Island, Lohan was signed to Ford Models at age three. ', 'Female', './assets/Person/LindsayLohan.jpeg'),
(337, 'Dennis Quaid', 'Dennis William Quaid is an American actor and gospel singer. He is known for his leading man roles in film and television. The Guardian named him one of the best actors never to have received an Academy Award nomination.', 'Male', './assets/Person/DennisQuaid.jpg'),
(338, 'Natasha Richardson', 'Natasha Jane Richardson was an English actress. A member of the Redgrave family, Richardson was the daughter of actress Vanessa Redgrave and director/producer Tony Richardson and the granddaughter of Michael Redgrave and Rachel Kempson.', 'Female', './assets/Person/Natasha2.jpeg'),
(339, 'Amy Poehler', 'Amy Poehler is an American actress and comedian. After studying improv at Chicago\'s Second City and ImprovOlympic in the early 1990s, Poehler co-founded the improvisational-comedy troupe Upright Citizens Brigade.', 'Female', './assets/Person/AmyPoehler.jpeg'),
(340, 'Bill Hader', 'William Thomas Hader Jr. (born June 7, 1978) is an American actor, comedian, writer, producer, and director. Hader gained widespread attention for his eight-year stint as a cast member on the long-running NBC sketch comedy series Saturday Night Live from 2005 to 2013, for which he received four Primetime Emmy Award nominations and a Peabody Award. He became known for his impressions and especially for his work on the Weekend Update segments, where he played Stefon Meyers, a flamboyant New York City nightclub tour guide.', 'Male', './assets/Person/BillHader.jpeg'),
(341, 'Lewis Black', 'Lewis Niles Black is an American stand-up comedian and actor. His comedy routines often escalate into angry rants about history, politics, religion, and cultural trends.', 'Male', './assets/Person/LewisBlack.jpg'),
(342, 'Will Smith', 'Willard Carroll Smith II is an American actor, rapper and film producer. He has received multiple accolades, including an Academy Award, a Golden Globe Award, a Screen Actors Guild Award, a BAFTA Award, and four Grammy Awards.', 'Male', './assets/Person/WillSmith.jpg'),
(343, 'Jaden Smith', 'Jaden Christopher Syre Smith is an American rapper and actor. The son of Jada Pinkett-Smith and Will Smith, he has received various accolades, including a Teen Choice Award, an MTV Movie Award, a BET Award and a Young Artist Award.', 'Male', './assets/Person/JadenSmith.jpeg'),
(344, 'Kim Go-eun', 'Kim Go-eun is a South Korean actress. She debuted in the film Eungyo where she won several Best New Actress awards in South Korea.', 'Female', './assets/Person/KimGoEun.jpeg'),
(345, 'Lee Do-hyun', 'Lim Dong-hyun, known professionally as Lee Do-hyun, is a South Korean actor. He first gained recognition for his supporting role in Hotel del Luna. Lee went on to star in the television series 18 Again, Sweet Home, Youth of May, The Glory, and The Good Bad Mother, as well as the film Exhuma. ', 'Male', './assets/Person/LeeDoHyun.jpeg'),
(346, 'Choi Min-sik', 'Choi Min-sik is a South Korean actor. Best known for his role in Oldboy, the performance was critically acclaimed and won him the Best Actor prize at the 40th Baeksang Art Awards, the 24th Blue Dragon Awards, and the 41st Grand Bell Awards.', 'Male', './assets/Person/ChoiMinSik.jpeg'),
(347, 'Dylan O\'Brien', 'Dylan Rhodes O\'Brien is an American actor. His first major role was as Stiles Stilinski in the MTV supernatural series Teen Wolf. He achieved further prominence for his lead role in the science fiction Maze Runner trilogy, which led to more film appearances. ', 'Male', './assets/Person/DylanOBrien.jpeg'),
(348, 'Will Poulter', 'William Jack Poulter is a British actor. He first gained recognition for his role as Eustace Scrubb in the fantasy adventure film The Chronicles of Narnia: The Voyage of the Dawn Treader.', 'Male', './assets/Person/WillPoulter.jpg'),
(349, 'Kaya Scodelario', 'Kaya Rose Scodelario-Davis is a British actress. She first came to prominence co-starring on E4\'s Skins, receiving two Golden Nymph nominations for her portrayal of Effy Stonem. ', 'Female', './assets/Person/Kaya.jpeg'),
(350, 'Keira Knightley', 'Keira Christina Knightley OBE is an English actress. Known for her work in independent films and blockbusters, particularly period dramas, she has received numerous accolades, including nominations for two Academy Awards, three BAFTAs, three Golden Globes, and a Laurence Olivier Award. ', 'Female', './assets/Person/Keira.jpeg'),
(351, 'Chadwick Boseman', 'Chadwick Aaron Boseman was an American actor. During his two-decade career, Boseman received several accolades, including two Screen Actors Guild Awards, a Golden Globe Award, and a Primetime Emmy Award, along with an Academy Award nomination.', 'Male', './assets/Person/ChadwickBoseman2.jpeg'),
(352, 'Lupita Nyong\'o', 'Lupita Amondi Nyong\'o is a Kenyan-Mexican actress. She is the recipient of several accolades, including an Academy Award, and a Daytime Emmy Award with nominations for a Tony Award and a Golden Globe Award.', 'Female', './assets/Person/Lupita.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `Production_Country`
--

CREATE TABLE `Production_Country` (
  `movie_id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Production_Country`
--

INSERT INTO `Production_Country` (`movie_id`, `country_id`) VALUES
(101, 501),
(102, 501),
(102, 503),
(103, 502),
(104, 501),
(105, 501),
(106, 506),
(107, 501),
(108, 501),
(109, 501),
(110, 501),
(111, 505),
(112, 501),
(113, 501),
(113, 503),
(113, 504),
(114, 501),
(115, 501),
(116, 501),
(117, 502),
(118, 501),
(119, 501),
(120, 501);

-- --------------------------------------------------------

--
-- Table structure for table `Rating`
--

CREATE TABLE `Rating` (
  `rating_id` int(11) NOT NULL,
  `movie_id` int(11) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL CHECK (`rating` between 1 and 5),
  `review` varchar(3000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `user_email` varchar(255) DEFAULT NULL,
  `user_pwd` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`user_id`, `username`, `user_email`, `user_pwd`) VALUES
(800, 'admin', 'admin@mail.com', '123456789'),
(801, 'user_test', 'usertest@mail.com', 'user123'),
(802, 'Amie', 'amie@gmail.com', '$2y$10$dd3KiAdii9Byts.fmOLW9OfC3liNyvLCNGBFnWZrjqvrg8acTZbjy'),
(803, 'user1', 'user1@gmail.com', '$2y$10$w2pOTXofIQp0o9ztm4LhceYn3cqlqyUYv/C5Zqv/ILuzbhjclyBrG'),
(804, 'user2', 'user2@gmail.com', '$2y$10$TeX5JFASwedbpKuo7cs.1e.9rZsuFLpQyZjulsZnkBV4f2adhm64.'),
(805, 'user3', 'user3@gmail.com', '$2y$10$aD/HZs/ykcSOF.nA98HSyuVf7sfkT9fl.YZTg3gW8BFtymI5NT6K6');

-- --------------------------------------------------------

--
-- Table structure for table `Watchlist`
--

CREATE TABLE `Watchlist` (
  `watchlist_id` int(11) DEFAULT NULL,
  `movie_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `watchlist_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Country`
--
ALTER TABLE `Country`
  ADD PRIMARY KEY (`country_id`);

--
-- Indexes for table `Director`
--
ALTER TABLE `Director`
  ADD PRIMARY KEY (`director_id`);

--
-- Indexes for table `Genre`
--
ALTER TABLE `Genre`
  ADD PRIMARY KEY (`genre_id`);

--
-- Indexes for table `Language`
--
ALTER TABLE `Language`
  ADD PRIMARY KEY (`language_id`);

--
-- Indexes for table `Movie`
--
ALTER TABLE `Movie`
  ADD PRIMARY KEY (`movie_id`);

--
-- Indexes for table `Movie_Cast`
--
ALTER TABLE `Movie_Cast`
  ADD PRIMARY KEY (`movie_cast_id`),
  ADD KEY `movie_id` (`movie_id`),
  ADD KEY `person_id` (`person_id`);

--
-- Indexes for table `Movie_Director`
--
ALTER TABLE `Movie_Director`
  ADD PRIMARY KEY (`movie_id`,`director_id`),
  ADD KEY `director_id` (`director_id`);

--
-- Indexes for table `Movie_Genre`
--
ALTER TABLE `Movie_Genre`
  ADD PRIMARY KEY (`movie_id`,`genre_id`),
  ADD KEY `genre_id` (`genre_id`);

--
-- Indexes for table `Movie_Language`
--
ALTER TABLE `Movie_Language`
  ADD PRIMARY KEY (`movie_id`,`language_id`),
  ADD KEY `language_id` (`language_id`);

--
-- Indexes for table `Person`
--
ALTER TABLE `Person`
  ADD PRIMARY KEY (`person_id`);

--
-- Indexes for table `Production_Country`
--
ALTER TABLE `Production_Country`
  ADD PRIMARY KEY (`movie_id`,`country_id`),
  ADD KEY `country_id` (`country_id`);

--
-- Indexes for table `Rating`
--
ALTER TABLE `Rating`
  ADD PRIMARY KEY (`rating_id`),
  ADD KEY `movie_id` (`movie_id`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `Watchlist`
--
ALTER TABLE `Watchlist`
  ADD KEY `movie_id` (`movie_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Rating`
--
ALTER TABLE `Rating`
  MODIFY `rating_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=806;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Movie_Cast`
--
ALTER TABLE `Movie_Cast`
  ADD CONSTRAINT `movie_cast_ibfk_1` FOREIGN KEY (`movie_id`) REFERENCES `Movie` (`movie_id`),
  ADD CONSTRAINT `movie_cast_ibfk_2` FOREIGN KEY (`person_id`) REFERENCES `Person` (`person_id`);

--
-- Constraints for table `Movie_Director`
--
ALTER TABLE `Movie_Director`
  ADD CONSTRAINT `movie_director_ibfk_1` FOREIGN KEY (`movie_id`) REFERENCES `Movie` (`movie_id`),
  ADD CONSTRAINT `movie_director_ibfk_2` FOREIGN KEY (`director_id`) REFERENCES `Director` (`director_id`);

--
-- Constraints for table `Movie_Genre`
--
ALTER TABLE `Movie_Genre`
  ADD CONSTRAINT `movie_genre_ibfk_1` FOREIGN KEY (`movie_id`) REFERENCES `Movie` (`movie_id`),
  ADD CONSTRAINT `movie_genre_ibfk_2` FOREIGN KEY (`genre_id`) REFERENCES `Genre` (`genre_id`);

--
-- Constraints for table `Movie_Language`
--
ALTER TABLE `Movie_Language`
  ADD CONSTRAINT `movie_language_ibfk_1` FOREIGN KEY (`movie_id`) REFERENCES `Movie` (`movie_id`),
  ADD CONSTRAINT `movie_language_ibfk_2` FOREIGN KEY (`language_id`) REFERENCES `Language` (`language_id`);

--
-- Constraints for table `Production_Country`
--
ALTER TABLE `Production_Country`
  ADD CONSTRAINT `production_country_ibfk_1` FOREIGN KEY (`movie_id`) REFERENCES `Movie` (`movie_id`),
  ADD CONSTRAINT `production_country_ibfk_2` FOREIGN KEY (`country_id`) REFERENCES `Country` (`country_id`);

--
-- Constraints for table `Rating`
--
ALTER TABLE `Rating`
  ADD CONSTRAINT `rating_ibfk_1` FOREIGN KEY (`movie_id`) REFERENCES `Movie` (`movie_id`);

--
-- Constraints for table `Watchlist`
--
ALTER TABLE `Watchlist`
  ADD CONSTRAINT `watchlist_ibfk_1` FOREIGN KEY (`movie_id`) REFERENCES `Movie` (`movie_id`),
  ADD CONSTRAINT `watchlist_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `Users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
