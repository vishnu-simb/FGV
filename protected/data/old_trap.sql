/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

/*Table structure for table `trap` */

CREATE TABLE trap (
  trap_id INT(11) NOT NULL AUTO_INCREMENT,
  pest_id INT(10) UNSIGNED NOT NULL,
  block_id INT(11) NOT NULL,
  trap_name VARCHAR(100) DEFAULT NULL,
  PRIMARY KEY (trap_id),
  INDEX fk_pest_has_block_block1 (block_id),
  INDEX fk_pest_has_block_pest1 (pest_id),
  INDEX pest_block (pest_id, block_id),
  CONSTRAINT trap_ibfk_1 FOREIGN KEY (pest_id)
    REFERENCES pest(pest_id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT trap_ibfk_2 FOREIGN KEY (block_id)
    REFERENCES block(block_id) ON DELETE CASCADE ON UPDATE CASCADE
)
ENGINE = INNODB
AUTO_INCREMENT = 567
AVG_ROW_LENGTH = 128
CHARACTER SET latin1
COLLATE latin1_swedish_ci;

/*Data for the table `trap` */

INSERT INTO trap VALUES
(4, 1, 4, 'CM 6 - Pink Lady'),
(5, 2, 4, 'LBAM 6 - Pink Lady'),
(7, 2, 6, 'LBAM 10 - Gala'),
(9, 4, 4, 'HELIOTHIS P. 1 - Jazz'),
(10, 1, 7, 'CM 11 - Pink Lady'),
(11, 2, 7, 'LBAM 11 - Pink Lady'),
(12, 1, 8, 'CM 12 - Jonathan'),
(13, 2, 8, 'LBAM 12 - Jonathan'),
(14, 1, 6, 'CM 10 - Gala'),
(15, 4, 4, 'HELIOTHIS A. 1 - Jazz'),
(16, 1, 16, 'CM 18C - Pink Lady'),
(17, 2, 16, 'LBAM 18C - Pink Lady'),
(18, 4, 16, 'HELIOTHIS A. 18C - Pink Lady'),
(19, 4, 16, 'HELIOTHIS P. 18C - Pink Lady'),
(20, 1, 17, 'CM 18B - Fuji'),
(21, 2, 17, 'LBAM 18B - Fuji'),
(22, 1, 18, 'CM 19 - Pink Lady'),
(23, 2, 18, 'LBAM 19 - Pink Lady'),
(24, 1, 9, 'CM 1'),
(26, 1, 11, 'CM 1'),
(27, 4, 12, 'HELIOTHIS P'),
(28, 1, 12, 'CM 1'),
(30, 1, 13, 'CM 1'),
(31, 1, 14, 'CM 1'),
(32, 1, 19, 'CM 1'),
(33, 1, 20, 'CM 1'),
(34, 3, 21, 'OFM 1'),
(35, 1, 22, 'CM 1'),
(36, 1, 23, 'CM 1'),
(38, 1, 24, 'CM 1'),
(39, 1, 25, 'CM 1'),
(40, 1, 26, 'CM 1'),
(41, 1, 27, 'CM 1'),
(42, 1, 28, 'CM 1'),
(43, 1, 30, 'CM 1'),
(44, 1, 31, 'CM 1'),
(45, 2, 31, 'LBAM 1'),
(46, 1, 32, 'CM 1'),
(47, 2, 32, 'LBAM 1'),
(50, 1, 34, 'CM 1'),
(51, 2, 34, 'LBAM 1'),
(52, 1, 35, 'CM 1'),
(53, 2, 35, 'LBAM 1'),
(54, 1, 36, 'CM 1'),
(55, 2, 36, 'LBAM 1'),
(56, 1, 37, 'CM 1'),
(57, 2, 37, 'LBAM 1'),
(58, 1, 38, 'CM 1'),
(59, 2, 38, 'LBAM 1'),
(60, 1, 39, 'CM 1'),
(61, 2, 39, 'LBAM 1'),
(62, 1, 60, 'CM 1'),
(63, 2, 60, 'LBAM 1'),
(64, 1, 61, 'CM 1'),
(65, 2, 61, 'LBAM 1'),
(66, 1, 62, 'CM 1'),
(67, 2, 62, 'LBAM 1'),
(78, 1, 51, 'CM 1'),
(79, 2, 51, 'LBAM 1'),
(80, 1, 52, 'CM Row 13'),
(81, 2, 52, 'LBAM Row 13'),
(83, 1, 48, 'CM 1'),
(84, 2, 48, 'LBAM 1'),
(85, 1, 49, 'CM 1'),
(86, 2, 49, 'LBAM 1'),
(87, 1, 50, 'CM 6'),
(88, 2, 50, 'LBAM 6'),
(89, 1, 53, 'CM 1'),
(90, 2, 53, 'LBAM 1'),
(91, 1, 54, 'CM 1'),
(92, 2, 54, 'LBAM 1'),
(93, 1, 42, 'CM 1'),
(94, 2, 42, 'LBAM 1'),
(95, 1, 43, 'CM 1'),
(96, 2, 43, 'LBAM 1'),
(97, 1, 44, 'CM 1'),
(98, 2, 44, 'LBAM 1'),
(99, 1, 45, 'CM 1'),
(100, 2, 45, 'LBAM 1'),
(101, 1, 46, 'CM 1'),
(102, 2, 46, 'LBAM 1'),
(103, 1, 47, 'CM 1'),
(104, 2, 47, 'LBAM 1'),
(105, 1, 63, 'CM 1'),
(106, 3, 63, 'OFM 1'),
(107, 1, 64, 'CM 1'),
(108, 1, 83, 'CM 1'),
(109, 1, 84, 'CM 1'),
(110, 1, 85, 'CM 1'),
(111, 1, 86, 'CM 1'),
(112, 1, 87, 'CM 1'),
(113, 1, 88, 'OFM 1'),
(114, 1, 90, 'OFM 1'),
(115, 1, 89, 'OFM 1'),
(116, 1, 65, 'CM 1'),
(118, 3, 66, 'OFM 1'),
(119, 1, 67, 'CM 1'),
(120, 1, 68, 'CM 1'),
(121, 3, 68, 'OFM 1'),
(128, 1, 94, 'CM 1'),
(129, 2, 94, 'LBAM 1'),
(130, 1, 95, 'CM 1'),
(131, 2, 95, 'LBAM 1'),
(132, 1, 96, 'CM 1'),
(133, 2, 96, 'LBAM 1'),
(134, 1, 97, 'CM 1'),
(135, 2, 97, 'LBAM 1'),
(136, 1, 99, 'CM 1'),
(137, 2, 99, 'LBAM 1'),
(138, 1, 100, 'CM 1'),
(139, 2, 100, 'LBAM 1'),
(140, 1, 101, 'CM1'),
(141, 4, 101, 'HELIOTHIS'),
(142, 1, 102, 'CM 1'),
(143, 2, 102, 'LBAM 1'),
(144, 1, 103, 'CM 1'),
(145, 2, 103, 'LBAM 1'),
(146, 4, 103, 'HELIOTHIS'),
(149, 1, 104, 'CM 1'),
(150, 2, 104, 'LBAM 1'),
(151, 1, 105, 'CM 1'),
(152, 2, 105, 'LBAM 1'),
(153, 1, 106, 'CM 1'),
(154, 2, 106, 'LBAM 1'),
(155, 1, 107, 'CM 1'),
(156, 2, 107, 'LBAM 1'),
(157, 1, 108, 'CM 1'),
(158, 2, 108, 'LBAM'),
(159, 4, 108, 'HELIOTHIS'),
(160, 1, 69, 'CM 1'),
(161, 3, 69, 'OFM 1'),
(162, 1, 70, 'CM 1'),
(163, 1, 71, 'CM 1'),
(165, 1, 73, 'CM 1'),
(166, 1, 74, 'CM 1'),
(167, 1, 75, 'CM 1'),
(168, 3, 75, 'OFM 1'),
(169, 1, 76, 'CM 1'),
(170, 4, 76, 'HELIOTHIS 1'),
(171, 1, 77, 'CM 1'),
(172, 3, 77, 'OFM 1'),
(173, 1, 78, 'CM 1'),
(175, 1, 80, 'CM 1'),
(176, 1, 81, 'CM 1'),
(177, 1, 82, 'CM 1'),
(178, 1, 109, 'CM 1'),
(179, 1, 111, 'CM 1'),
(180, 1, 112, 'CM 1'),
(181, 1, 113, 'CM 1'),
(182, 1, 114, 'CM 1'),
(183, 1, 115, 'CM 1'),
(188, 1, 118, 'CM 1'),
(189, 1, 119, 'CM 1'),
(190, 3, 120, 'OFM 1'),
(191, 1, 121, 'CM 1'),
(192, 1, 122, 'CM 1'),
(193, 3, 123, 'OFM 1'),
(194, 3, 124, 'OFM 1'),
(195, 1, 125, 'CM 1'),
(196, 1, 126, 'OFM 1'),
(197, 3, 127, 'OFM 1'),
(198, 3, 128, 'OFM 1'),
(205, 3, 132, 'OFM 1'),
(206, 1, 133, 'CM 1'),
(207, 1, 134, 'CM 1'),
(208, 3, 135, 'OFM 1'),
(209, 1, 136, 'CM 1'),
(210, 1, 137, 'CM 1'),
(212, 1, 139, 'CM 1'),
(213, 3, 140, 'OFM 1'),
(214, 1, 141, 'CM 1'),
(215, 1, 142, 'CM 1'),
(216, 1, 143, 'CM 1'),
(217, 1, 144, 'CM 1'),
(221, 1, 148, 'CM 1'),
(223, 3, 166, 'OFM 1'),
(224, 3, 167, 'OFM 1'),
(225, 3, 168, 'OFM 1'),
(226, 3, 169, 'OFM 1'),
(227, 1, 170, 'CM 1'),
(228, 1, 171, 'CM 1'),
(229, 1, 172, 'CM 1'),
(230, 1, 173, 'CM 1'),
(231, 3, 174, 'OFM 1'),
(232, 3, 175, 'OFM 1'),
(233, 3, 176, 'OFM 1'),
(234, 3, 177, 'OFM 1'),
(235, 1, 178, 'CM 1'),
(236, 1, 179, 'CM 1'),
(237, 1, 180, 'CM 1'),
(238, 1, 181, 'CM 1'),
(239, 1, 182, 'CM 1'),
(240, 1, 183, 'CM 1'),
(241, 2, 183, 'LBAM 1'),
(242, 1, 184, 'CM 1'),
(243, 3, 184, 'OFM 1'),
(244, 1, 185, 'CM 1'),
(245, 2, 185, 'LBAM 1'),
(246, 3, 186, 'OFM 1'),
(247, 4, 183, 'HELIOTHIS P'),
(248, 4, 192, 'Heliothis P'),
(249, 1, 188, 'CM 1'),
(250, 2, 188, 'LBAM 1'),
(251, 1, 189, 'CM 1'),
(252, 2, 189, 'LBAM 1'),
(255, 1, 191, 'CM 1'),
(256, 2, 191, 'LBAM'),
(257, 4, 192, 'HELIO A.'),
(260, 1, 52, 'CM Row 18'),
(261, 2, 52, 'LBAM Row 18'),
(262, 3, 142, 'OFM 1'),
(263, 3, 29, 'OFM 1'),
(264, 2, 160, 'LBAM 1'),
(265, 4, 160, 'Heliothis P'),
(267, 2, 331, 'LBAM 1'),
(268, 1, 331, 'CM 1'),
(269, 1, 196, 'CM 1'),
(270, 2, 196, 'LBAM 1'),
(271, 2, 195, 'LBAM 1'),
(276, 1, 197, 'CM 1'),
(277, 3, 76, 'OFM 1'),
(278, 3, 78, 'OFM 1'),
(281, 1, 150, 'CM 1'),
(284, 3, 205, 'OFM 1'),
(285, 3, 206, 'OFM 2'),
(286, 3, 207, 'OFM 3'),
(287, 3, 208, 'OFM 4'),
(288, 3, 209, 'OFM 1'),
(289, 3, 210, 'OFM 2'),
(290, 3, 211, 'OFM 3'),
(291, 3, 212, 'OFM 1'),
(292, 3, 213, 'OFM 2'),
(293, 3, 214, 'OFM 3'),
(294, 3, 215, 'OFM 1'),
(295, 3, 216, 'OFM 2'),
(296, 3, 217, 'OFM 3'),
(297, 3, 218, 'OFM 1'),
(298, 3, 219, 'OFM 2'),
(299, 3, 220, 'OFM 1'),
(300, 3, 221, 'OFM 2'),
(301, 3, 222, 'OFM 3'),
(302, 3, 223, 'OFM 4'),
(303, 1, 224, 'CM 1'),
(304, 1, 225, 'CM 2'),
(305, 1, 226, 'CM 3'),
(306, 1, 227, 'CM 4'),
(316, 1, 238, 'CM1'),
(317, 1, 239, 'CM2'),
(318, 1, 240, 'CM3'),
(319, 1, 241, 'CM4'),
(320, 1, 242, 'CM5'),
(321, 1, 243, 'CM6'),
(322, 1, 244, 'CM7'),
(323, 1, 245, 'CM8'),
(324, 1, 246, 'CM1'),
(325, 1, 247, 'CM2'),
(326, 1, 248, 'CM3'),
(327, 1, 249, 'CM4'),
(328, 3, 250, 'OFM1'),
(329, 1, 251, 'CM1'),
(330, 1, 252, 'CM2'),
(331, 1, 253, 'CM1'),
(332, 1, 254, 'CM2'),
(333, 3, 255, 'OFM1'),
(334, 1, 256, 'CM1'),
(335, 1, 257, 'CM2'),
(336, 1, 258, 'CM3'),
(337, 3, 259, 'OFM1'),
(338, 1, 260, 'CM1'),
(339, 1, 261, 'CM2'),
(340, 3, 262, 'OFM1'),
(341, 3, 263, 'OFM2'),
(342, 1, 264, 'CM1'),
(343, 1, 265, 'CM2'),
(344, 1, 266, 'CM3'),
(345, 1, 267, 'CM4'),
(346, 1, 268, 'CM5'),
(347, 1, 269, 'CM1'),
(348, 1, 270, 'CM2'),
(349, 1, 271, 'CM3'),
(350, 1, 272, 'CM1'),
(351, 1, 273, 'CM2'),
(352, 1, 274, 'CM3'),
(353, 1, 278, 'CM1'),
(354, 1, 279, 'CM2'),
(355, 1, 280, 'CM3'),
(356, 1, 281, 'CM4'),
(357, 3, 282, 'OFM1'),
(358, 1, 275, 'CM1'),
(359, 1, 276, 'CM2'),
(360, 1, 277, 'CM3'),
(361, 1, 283, 'CM1'),
(362, 1, 284, 'CM2'),
(364, 1, 286, 'CM4'),
(365, 1, 287, 'CM5'),
(366, 1, 288, 'CM2'),
(367, 1, 289, 'CM1'),
(368, 1, 290, 'CM2'),
(369, 1, 291, 'CM1'),
(370, 1, 292, 'CM2'),
(371, 1, 293, 'CM1'),
(372, 1, 294, 'CM1'),
(373, 1, 295, 'CM2'),
(374, 1, 296, 'CM1'),
(375, 1, 297, 'CM2'),
(376, 2, 300, 'LBAM 1'),
(377, 3, 301, 'OFM1'),
(378, 2, 302, 'LBAM2'),
(379, 3, 303, 'OFM2'),
(380, 2, 304, 'LBAM3'),
(381, 3, 305, 'OFM3'),
(382, 1, 306, 'CM3'),
(383, 3, 307, 'OFM'),
(384, 1, 308, 'CM'),
(385, 1, 309, 'CM'),
(386, 3, 310, 'OFM'),
(387, 1, 311, 'CM'),
(388, 3, 312, 'OFM'),
(389, 1, 313, 'CM'),
(390, 1, 313, 'CM'),
(391, 1, 314, 'CM'),
(392, 3, 315, 'OFM'),
(393, 1, 316, 'CM'),
(394, 1, 317, 'CM'),
(395, 1, 318, 'CM'),
(396, 3, 319, 'OFM'),
(397, 1, 320, 'CM'),
(398, 3, 321, 'OFM'),
(399, 3, 322, 'OFM'),
(400, 3, 323, 'OFM'),
(401, 1, 324, 'CM'),
(402, 1, 325, 'CM'),
(403, 3, 326, 'OFM'),
(404, 3, 327, 'OFM1'),
(405, 1, 328, 'CM1'),
(406, 1, 329, 'CM2'),
(407, 1, 330, 'CM3'),
(408, 1, 4, 'CM 1 - Jazz'),
(409, 2, 4, 'LBAM 1 - Jazz'),
(410, 1, 6, 'CM 8 - Fuji'),
(411, 2, 6, 'LBAM 8 - Fuji'),
(412, 1, 6, 'CM 9 - Fuji'),
(413, 2, 6, 'LBAM 9 - Fuji'),
(414, 1, 7, 'CM 4 - Gala'),
(415, 2, 7, 'LBAM 4 - Gala'),
(416, 1, 7, 'CM 3 - Granny Smith'),
(417, 2, 7, 'LBAM 3 - Granny Smith'),
(418, 4, 7, 'HELIOTHIS P. 3 - Granny Smith'),
(419, 4, 7, 'HELIOTHIS A. 3 - Granny Smith'),
(420, 1, 8, 'CM 15 - Golden Delicious'),
(421, 2, 8, 'LBAM 15 - Golden Delicious'),
(422, 1, 17, 'CM 18A - Pink Lady'),
(423, 2, 17, 'LBAM 18A - Pink Lady'),
(424, 1, 16, 'CM 17 - Gala'),
(425, 2, 16, 'LBAM 17 - Gala'),
(426, 4, 16, 'HELIOTHIS P. 17 - Gala'),
(427, 4, 16, 'HELIOTHIS A. 17 - Gala'),
(428, 1, 332, 'CM'),
(429, 2, 332, 'LBAM'),
(430, 1, 334, 'CM'),
(431, 2, 334, 'LBAM'),
(432, 1, 335, 'CM'),
(433, 2, 335, 'LBAM'),
(434, 1, 336, 'CM'),
(435, 2, 336, 'LBAM'),
(436, 1, 337, 'CM'),
(437, 2, 337, 'LBAM'),
(438, 1, 338, 'CM'),
(439, 2, 338, 'LBAM'),
(440, 1, 339, 'CM'),
(441, 2, 339, 'LBAM'),
(442, 1, 340, 'CM'),
(443, 2, 340, 'LBAM'),
(445, 3, 342, 'OFM2'),
(446, 3, 343, 'OFM3'),
(449, 1, 345, 'CM1'),
(450, 1, 346, 'CM2'),
(451, 1, 347, 'CM1'),
(452, 1, 348, 'CM1'),
(453, 3, 349, 'OFM1'),
(454, 1, 350, 'CM2'),
(455, 1, 357, 'CM1'),
(456, 1, 358, 'CM1'),
(457, 1, 359, 'CODLING MOTH'),
(458, 1, 351, 'CM1 G. SMITH'),
(459, 1, 352, 'CM2 PEARS'),
(460, 3, 353, 'OFM3 PEACHES'),
(461, 1, 354, 'CM4'),
(462, 1, 355, 'CM 5 CORELLA'),
(463, 1, 356, 'CM6 MIXED APPLE'),
(464, 5, 205, 'DADS QFF'),
(465, 5, 209, 'DENSON QFF'),
(466, 5, 212, 'SUBSTATION QFF'),
(467, 5, 215, 'OKANES QFF'),
(468, 5, 219, 'SHED QFF'),
(469, 1, 360, 'CODLING MOTH A2'),
(470, 1, 361, 'CM1 YOUNG PKT'),
(471, 1, 362, 'CM1 FRONT SHED'),
(472, 1, 363, 'CM2 BACK PUMP'),
(473, 1, 364, 'CM1 BLOCK A'),
(474, 1, 365, 'CM2 BLOCK 10'),
(475, 1, 366, 'CM3 BLOCK 5'),
(476, 1, 367, 'CM4 BLOCK U'),
(477, 1, 368, 'CM1 DOG LEG'),
(478, 1, 369, 'CM2 HOUSE'),
(479, 1, 370, 'CM3 YOUNG GRANNY SMITH'),
(480, 1, 371, 'CM1 Deliza'),
(481, 1, 372, 'CM2 Deliza'),
(482, 2, 372, 'LBAM1 Deliza'),
(484, 5, 374, 'QFF 2 PLUMCOTS'),
(485, 5, 326, 'QFF 1 HOME NECTARINE'),
(486, 5, 312, 'QFF 2 EMINI NECTARINE'),
(487, 5, 315, 'QFF 3 TAIPES NECTARINES'),
(488, 5, 322, 'QFF 4 MACLAYS NECTARINES'),
(489, 5, 66, 'QFF 1 HIGHWAY PEACHES'),
(490, 5, 375, 'QFF 2 NECTARINES'),
(491, 5, 21, 'QFF 1 BACK PLUMS'),
(492, 3, 376, 'OFM 1 MIDDLE NECTARINES'),
(493, 5, 376, 'QFF 1 MIDDLE NECTARINES'),
(494, 5, 327, 'QFF 1 HOME BOSC'),
(495, 5, 13, 'QFF 1 2 ROWS RUBY'),
(496, 5, 135, 'QFF 1 FRONT PLUMS'),
(497, 5, 377, 'QFF 1 BLOCK B PLUMS'),
(498, 5, 378, 'QFF 1 L13 APRICOTS'),
(499, 5, 379, 'QFF 2 L19 SATSUMA'),
(500, 2, 380, 'LBAM 2 YOUNG TREES'),
(501, 5, 353, 'QFF3 PEACH'),
(502, 5, 349, 'QFF1 PEACH'),
(503, 5, 168, 'QFF TAYLOR QUEEN'),
(504, 5, 381, 'QFF JUNECREST'),
(505, 5, 382, 'QFF TREVATT 3'),
(506, 1, 383, 'CM 1'),
(507, 1, 384, 'CM 2'),
(508, 1, 385, 'CM 3 WBC'),
(509, 1, 386, 'CM 4'),
(510, 6, 241, 'AVE FRUIT SIZE NEW MODI '),
(511, 1, 387, 'CM 1'),
(512, 3, 388, 'OFM1'),
(513, 1, 389, 'CM1'),
(514, 1, 390, 'OFM2'),
(515, 3, 391, 'OFM'),
(516, 3, 392, 'OFM2'),
(517, 1, 393, 'CM1'),
(518, 1, 394, 'CM2'),
(519, 1, 395, 'CM3'),
(520, 1, 396, 'CM4'),
(521, 5, 397, 'QFF1'),
(522, 5, 398, 'QFF2'),
(524, 3, 71, 'OFM'),
(525, 3, 400, 'OFM'),
(526, 1, 401, 'CM1'),
(527, 1, 402, 'CM1'),
(528, 1, 403, 'CM1'),
(529, 1, 404, 'CM'),
(530, 1, 405, 'CM1'),
(531, 1, 406, 'CM1'),
(533, 1, 407, 'CM1'),
(534, 5, 9, 'QFF1'),
(535, 5, 11, 'QFF1'),
(536, 5, 12, 'QFF1'),
(537, 5, 14, 'QFF1'),
(538, 5, 385, 'QFF1 Nectarines'),
(539, 1, 408, 'CM1'),
(540, 1, 409, 'CM2'),
(541, 1, 410, 'CM3'),
(542, 1, 411, 'CM4'),
(543, 1, 412, 'CM5'),
(544, 1, 413, 'CM6'),
(545, 1, 414, 'CM1'),
(546, 5, 414, 'QFF1'),
(547, 1, 415, 'CM2'),
(548, 3, 415, 'OFM1'),
(549, 5, 415, 'QFF2'),
(550, 3, 416, 'OFM2'),
(551, 1, 417, 'CM3'),
(552, 1, 195, 'CM 1 - Codling Moth'),
(553, 3, 418, 'OFM3'),
(554, 3, 418, 'QFF3'),
(555, 1, 419, 'CM 1'),
(556, 1, 380, 'CM Young Trees'),
(557, 3, 380, 'OFM Young Trees'),
(558, 5, 380, 'QFF Young Trees'),
(559, 3, 372, 'OFM Deliza'),
(560, 5, 372, 'QFF Deliza'),
(561, 4, 340, 'HELIO'),
(562, 1, 420, 'CM3'),
(563, 4, 420, 'HELIO'),
(564, 5, 421, 'QFF'),
(565, 5, 422, 'QFF'),
(566, 5, 423, 'QFF');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
