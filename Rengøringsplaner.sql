	SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
	SET time_zone = "+00:00";


	/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
	/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
	/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
	/*!40101 SET NAMES utf8 */;

	-- --------------------------------------------------------

	CREATE TABLE IF NOT EXISTS `rengøringsplan` (
	  `id` int(11) NOT NULL AUTO_INCREMENT,
	  `dato` varchar(100) NOT NULL,
	  `virksomhed` varchar(100) NOT NULL,
	  `opgaver` varchar(255) NOT NULL,
	  `ansvarlig` varchar(100) NOT NULL,
	  PRIMARY KEY (`id`)
	) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

	INSERT INTO `rengøringsplan` (`id`, `dato`, `virksomhed`, `opgaver`, `ansvarlig`) VALUES
	(1, '09/04/2022', 'UCL','Tørre borde af, støvsuge', 'Søren Hansen'),
	(2, '08/04/2022', 'UCL','Tørre borde af, støvsuge, vaske gulv', 'Søren Hansen'),
	(3, '09/04/2022', 'House of code','Tørre borde af, støvsuge', 'Søren Hansen'),
    (4, '08/04/2022', 'House of code','Tørre borde af, støvsuge', 'Søren Hansen'),
    (5, '07/04/2022', 'House of code','Tørre borde af, støvsuge', 'Søren Hansen'),
    (6, 'Alle dage', 'Dataforståelse','Undervise i softwarekonstruktion og systemudvikling', 'Kim Mogensen :)'),
    (7, '06/04/2022', 'House of code','Tørre borde af, støvsuge, vaske gulv, rense toiletter', 'Søren Hansen');

	/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
	/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
	/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
