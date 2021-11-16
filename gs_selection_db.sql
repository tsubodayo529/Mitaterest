-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost
-- 生成日時: 2021 年 6 月 16 日 02:43
-- サーバのバージョン： 5.7.32
-- PHP のバージョン: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `gs_selection_db`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `draw_table`
--

CREATE TABLE `draw_table` (
  `id` int(12) NOT NULL,
  `id_view` int(12) NOT NULL,
  `ru_id` varchar(128) NOT NULL,
  `ru_pw` varchar(128) NOT NULL,
  `ru_name` varchar(128) NOT NULL,
  `rtitle` varchar(128) DEFAULT NULL,
  `rnaiyou` text,
  `draw_img` varchar(256) NOT NULL,
  `rindate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `draw_table`
--

INSERT INTO `draw_table` (`id`, `id_view`, `ru_id`, `ru_pw`, `ru_name`, `rtitle`, `rnaiyou`, `draw_img`, `rindate`) VALUES
(1, 5, 'tsubo', 'tsubo', 'つぼ', '花さく', 'リゼロ', '202106091109261af814ee522db877f205bba2b85afd67.jpg', '2021-06-09 20:09:26'),
(8, 11, 'tsubo', 'tsubo', 'つぼ', '夜は短し', '飛べ飛べちょうちょ', '20210609122457bc014a6d107030db3d38e75463eee819.jpeg', '2021-06-09 21:24:57'),
(9, 10, 'tsubo', 'tsubo', 'つぼ', '夏といえば', '美味しそうな雲！', '2021060913395711752193765a89ead5ce0f6d42670490.jpg', '2021-06-09 22:39:57'),
(10, 12, 'tsubo', 'tsubo', 'つぼ', '汗だく', 'おおおおお', '20210610050951802f8846dadca04f77f1deddffc6f309.jpg', '2021-06-10 14:09:51'),
(11, 13, 'tsubo', 'tsubo', 'つぼ', 'サトシ', 'ピカチュウ', '2021061005344440caa2272793ec7e74d285e1a6facde5.jpg', '2021-06-10 14:34:44'),
(12, 13, 'tsubo', 'tsubo', 'つぼ', '目隠し', 'やばい', '20210610060717048108d3992ba25de8c50510f1920dc9.jpg', '2021-06-10 15:07:17'),
(13, 13, 'tsubo', 'tsubo', 'つぼ', 'プロポーズ', '僕をゲットしてください！', '2021061016270139c3138e9caeee763635ca47a0aec35c.jpg', '2021-06-11 01:27:01'),
(14, 13, 'tsubo', 'tsubo', 'つぼ', 'ピカ', 'テスト', '2021061316344664d1e08211020c7c404211465640c9f2.jpg', '2021-06-14 01:34:46'),
(15, 1, 'tsubo', 'tsubo', 'つぼ', 'うほっ', 'いいバナナ', '202106131807067cf41b27eb96a9c1de42dc952c8c1104.jpg', '2021-06-14 03:07:06'),
(16, 13, 'tsubo', 'tsubo', 'つぼ', '背後に気をつけて！', 'キューーッ！', '20210613181249aa1b79db80370a9857cea5f6e1efb21e.jpg', '2021-06-14 03:12:49'),
(17, 19, 'test', 'test', 'テスト', 'てsてs', 'テsつとsteams', '20210613181858498663dfe967b993a33238e686902108.jpg', '2021-06-14 03:18:58'),
(24, 10, 'tsubo', 'tsubo', 'つぼ', 'あの地平線', 'バルス！！', '20210614135049b8c8a57aa0c96650d88be685d8db732c.jpg', '2021-06-14 22:50:49'),
(25, 10, 'tsubo', 'tsubo', 'つぼ', '', '', '20210614135213380e3df5a44a979fe0279a300dc6f751.jpg', '2021-06-14 22:52:13'),
(26, 19, 'tsubo', 'tsubo', 'つぼ', '赤kjがお', 'ガオー', '202106141352444c537cc5d1f7ccdab48fd7283a3edb56.jpg', '2021-06-14 22:52:44'),
(27, 13, 'tsubo', 'tsubo', 'つぼ', 'げい', 'あhbづh', '202106141353230deeb67f576f5b16c58cdafba7851233.jpg', '2021-06-14 22:53:23'),
(28, 20, 'tsubo', 'tsubo', 'つぼ', 'ヒトデ', 'ヒトデ追加してみました', '2021061417280425eaa4de93f75486aabcf5ddfd032106.jpg', '2021-06-15 02:28:04'),
(29, 21, 'tsubo', 'tsubo', 'つぼ', '川にも住んでるチンアナゴ', 'ひょっこりしている姿がチンアナゴみたいに見えたので河川敷を海にしちゃいました笑\r\n癒されますね〜', '202106160218539b408bd2ef58a50c08277236417511d0.jpg', '2021-06-16 11:18:53'),
(30, 22, 'tsubo', 'tsubo', 'つぼ', '小宇宙を感じるか', '広がっている葉っぱが噴射しているみたいに見えたので、今にも空へ飛びそうなロケットにしてみました', '202106160224421a5982e577592fc23620d22ebc95d3cc.jpg', '2021-06-16 11:24:42');

-- --------------------------------------------------------

--
-- テーブルの構造 `good_draw_table`
--

CREATE TABLE `good_draw_table` (
  `id` int(12) NOT NULL,
  `id_draw` int(12) NOT NULL,
  `gu_id` varchar(128) NOT NULL,
  `gu_pw` varchar(256) NOT NULL,
  `gu_name` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `good_draw_table`
--

INSERT INTO `good_draw_table` (`id`, `id_draw`, `gu_id`, `gu_pw`, `gu_name`) VALUES
(1, 12, 'tsubo', 'tsubo', 'つぼ'),
(2, 11, 'tsubo', 'tsubo', 'つぼ'),
(3, 13, 'tsubo', 'tsubo', 'つぼ'),
(4, 13, 'test', 'test', 'テスト'),
(5, 14, 'tsubo', 'tsubo', 'つぼ'),
(6, 9, 'tsubo', 'tsubo', 'つぼ'),
(7, 15, 'tsubo', 'tsubo', 'つぼ'),
(8, 0, 'test', 'test', 'テスト'),
(9, 16, 'test', 'test', 'テスト'),
(10, 28, 'tsubo', 'tsubo', 'つぼ'),
(11, 30, 'tsubo', 'tsubo', 'つぼ');

-- --------------------------------------------------------

--
-- テーブルの構造 `good_view_table`
--

CREATE TABLE `good_view_table` (
  `id` int(12) NOT NULL,
  `id_view` int(12) NOT NULL,
  `gu_name` varchar(128) NOT NULL,
  `gu_id` varchar(128) NOT NULL,
  `gu_pw` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `good_view_table`
--

INSERT INTO `good_view_table` (`id`, `id_view`, `gu_name`, `gu_id`, `gu_pw`) VALUES
(1, 13, 'つぼ', 'tsubo', 'tsubo'),
(2, 10, 'つぼ', 'tsubo', 'tsubo'),
(3, 1, 'つぼ', 'tsubo', 'tsubo'),
(5, 13, 'テスト', 'test', 'test'),
(6, 18, 'テスト', 'test', 'test'),
(7, 1, 'テスト', 'test', 'test'),
(8, 10, 'テスト', 'test', 'test'),
(9, 20, 'つぼ', 'tsubo', 'tsubo');

-- --------------------------------------------------------

--
-- テーブルの構造 `login_table`
--

CREATE TABLE `login_table` (
  `id` int(12) NOT NULL,
  `u_id` varchar(128) NOT NULL,
  `u_pw` varchar(128) NOT NULL,
  `u_name` varchar(128) NOT NULL,
  `img` varchar(256) DEFAULT NULL,
  `profile` text,
  `indate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `login_table`
--

INSERT INTO `login_table` (`id`, `u_id`, `u_pw`, `u_name`, `img`, `profile`, `indate`) VALUES
(1, 'tsubo', 'tsubo', 'つぼ', '20210609040822d41d8cd98f00b204e9800998ecf8427e.gif', NULL, '2021-06-09 13:08:22'),
(2, 'test', 'test', 'テスト', '20210609134318d41d8cd98f00b204e9800998ecf8427e.jpg', NULL, '2021-06-09 22:43:18'),
(3, 'test2', 'test2', 'テスてす', '2', NULL, '2021-06-15 19:32:12');

-- --------------------------------------------------------

--
-- テーブルの構造 `main_table`
--

CREATE TABLE `main_table` (
  `id` int(12) NOT NULL,
  `u_id` varchar(128) NOT NULL,
  `u_pw` varchar(128) NOT NULL,
  `u_name` varchar(128) NOT NULL,
  `title` varchar(128) DEFAULT NULL,
  `view_img` varchar(256) NOT NULL,
  `naiyou` text,
  `indate` datetime NOT NULL,
  `location` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `main_table`
--

INSERT INTO `main_table` (`id`, `u_id`, `u_pw`, `u_name`, `title`, `view_img`, `naiyou`, `indate`, `location`) VALUES
(1, 'tsubo', 'tsubo', 'つぼ', 'ウホウホウホホホ', '20210609053320ca8a4fabcf23a7f6277c35e167301f7b.jpeg', 'ウホウホウホホウホホホウホホ\r\n（イカした横顔だぜ）', '2021-06-09 14:33:20', NULL),
(13, 'tsubo', 'tsubo', 'つぼ', 'ピカピカ', '2021061005130441321658334191fd23b5a7b03690773d.jpeg', 'ぴっか', '2021-06-10 14:13:04', 'Tokyo Met.,Koto Ward,Chuobohateiumetatechi'),
(21, 'tsubo', 'tsubo', 'つぼ', '荒川河川敷にて', '202106160212065f60fee107773c5242bf287bdb2250e0.JPG', 'ひょっこり地面から顔出してるみたい', '2021-06-16 11:12:06', 'Saitama Pref.,Asaka City,Kamiuchimagi'),
(22, 'tsubo', 'tsubo', 'つぼ', '道端に落ちていた何か', '202106160221148b7fd7daf291d60e8e430e4a2381b03d.JPG', '花弁でしょうか？分からないですがひっくり返っていて可愛かったので撮りました。', '2021-06-16 11:21:14', NULL);

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `draw_table`
--
ALTER TABLE `draw_table`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `good_draw_table`
--
ALTER TABLE `good_draw_table`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `good_view_table`
--
ALTER TABLE `good_view_table`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `login_table`
--
ALTER TABLE `login_table`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `main_table`
--
ALTER TABLE `main_table`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `draw_table`
--
ALTER TABLE `draw_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- テーブルの AUTO_INCREMENT `good_draw_table`
--
ALTER TABLE `good_draw_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- テーブルの AUTO_INCREMENT `good_view_table`
--
ALTER TABLE `good_view_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- テーブルの AUTO_INCREMENT `login_table`
--
ALTER TABLE `login_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- テーブルの AUTO_INCREMENT `main_table`
--
ALTER TABLE `main_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
