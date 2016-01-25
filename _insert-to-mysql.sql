SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for comment
-- ----------------------------
DROP TABLE IF EXISTS `comment`;
CREATE TABLE `comment` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `content_id` int(10) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `comment` text,
  `timecreate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `active` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for content
-- ----------------------------
DROP TABLE IF EXISTS `content`;
CREATE TABLE `content` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT '',
  `published` tinyint(1) DEFAULT '0',
  `favorite` tinyint(1) DEFAULT '0',
  `ordering` int(10) NOT NULL DEFAULT '0',
  `catid` int(10) unsigned NOT NULL DEFAULT '0',
  `h1` varchar(255) NOT NULL DEFAULT '',
  `h1Small` varchar(1024) NOT NULL,
  `h1Description` varchar(1024) NOT NULL,
  `introText` mediumtext NOT NULL,
  `full_text` text,
  `fileName` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `hits` int(10) unsigned NOT NULL DEFAULT '0',
  `readmore` text,
  `images` text NOT NULL,
  `urls` text NOT NULL,
  `params` text NOT NULL,
  `metaTitle` varchar(255) NOT NULL,
  `metaKeywords` varchar(255) NOT NULL,
  `metaDescription` varchar(255) NOT NULL,
  `metaOgTitle` varchar(255) NOT NULL,
  `metaOgType` varchar(255) NOT NULL,
  `metaOgSiteName` varchar(255) NOT NULL,
  `metaOgDescription` varchar(255) NOT NULL,
  `metaOgSection` varchar(255) NOT NULL,
  `metaOgTag` varchar(255) NOT NULL,
  `metaData` text NOT NULL,
  `lang` varchar(32) NOT NULL DEFAULT 'ru',
  PRIMARY KEY (`id`),
  KEY `idx_published` (`published`),
  KEY `idx_catid` (`catid`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for extension
-- ----------------------------
DROP TABLE IF EXISTS `extension`;
CREATE TABLE `extension` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `type` varchar(50) NOT NULL,
  `fileName` varchar(255) NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `params` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `element` (`fileName`),
  KEY `element_folder` (`fileName`,`enabled`),
  KEY `extension` (`type`,`fileName`,`enabled`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for link
-- ----------------------------
DROP TABLE IF EXISTS `link`;
CREATE TABLE `link` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `module` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for menu
-- ----------------------------
DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menutype_id` int(11) NOT NULL DEFAULT '1',
  `extension_id` int(11) NOT NULL DEFAULT '2' COMMENT 'The type of link: Component, URL, Alias, Separator',
  `link_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT 'FK to #__extensions.id',
  `title` varchar(255) NOT NULL COMMENT 'The display title of the menu item.',
  `alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'The SEF alias of the menu item.',
  `path` varchar(1024) NOT NULL COMMENT 'The computed path of the menu item based on the alias field.',
  `method` varchar(1024) NOT NULL DEFAULT 'GET' COMMENT 'The actually link the menu item refers to.',
  `function` varchar(255) NOT NULL DEFAULT 'commonPageCtrl',
  `published` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'The published state of the menu link.',
  `img` varchar(255) NOT NULL COMMENT 'The image of the menu item.',
  `home` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT 'Indicates if this menu item is the home or default page.',
  `params` text NOT NULL COMMENT 'JSON encoded data for the menu item.',
  `parent_id` int(10) unsigned NOT NULL DEFAULT '1' COMMENT 'The parent menu item in the menu tree.',
  `level` int(10) unsigned NOT NULL DEFAULT '1' COMMENT 'The relative level in the tree.',
  `lft` int(11) NOT NULL DEFAULT '0' COMMENT 'Nested set lft.',
  `rgt` int(11) NOT NULL DEFAULT '0' COMMENT 'Nested set rgt.',
  `lang` varchar(32) NOT NULL DEFAULT 'ru',
  `pos` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_componentid` (`link_id`,`menutype_id`,`published`),
  KEY `idx_menutype` (`menutype_id`),
  KEY `idx_left_right` (`lft`,`rgt`),
  KEY `idx_alias` (`alias`),
  KEY `idx_path` (`path`(255)),
  KEY `id_parent` (`parent_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for menutype
-- ----------------------------
DROP TABLE IF EXISTS `menutype`;
CREATE TABLE `menutype` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(24) NOT NULL,
  `title` varchar(48) NOT NULL,
  `description` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_menutype` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for module
-- ----------------------------
DROP TABLE IF EXISTS `module`;
CREATE TABLE `module` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `extension_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `published` tinyint(1) DEFAULT NULL,
  `ordering` int(11) DEFAULT '1',
  `position` varchar(50) NOT NULL,
  `view` varchar(255) NOT NULL DEFAULT 'default',
  `visible` varchar(4096) DEFAULT '{}',
  `params` varchar(4096) DEFAULT '{}',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for statistics
-- ----------------------------
DROP TABLE IF EXISTS `statistics`;
CREATE TABLE `statistics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime DEFAULT '0000-00-00 00:00:00',
  `ip` varchar(255) DEFAULT NULL,
  `os` text,
  `host` text,
  `page` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=55 DEFAULT CHARSET=utf8;


-- ----------------------------
-- Records of content
-- ----------------------------
INSERT INTO `content` VALUES ('1', 'home', '1', '0', '0', '0', 'Основной заголовок', '', '', '', '', 'mainpage', '2014-11-03 15:07:09', '2014-11-01 21:50:11', '0000-00-00 00:00:00', '14947', null, '', '', '', 'Тайтл — Основной заголовок', 'Кейворды если нужны', 'Мета описание', '', '', '', '', '', '', '', 'ru');
INSERT INTO `content` VALUES ('2', 'sitemap', '1', '0', '0', '0', 'Карта сайта', '', '', '', '', 'sitemap', '2014-11-03 15:07:10', '2014-11-02 21:50:11', '0000-00-00 00:00:00', '84', null, '', '', '', 'Тайтл — Карта сайта', 'Кейворды если нужны', 'Мета описание', '', '', '', '', '', '', '', 'ru');
INSERT INTO `content` VALUES ('3', 'articles', '1', '0', '0', '0', 'Все статьи вашего сайта', '', '', '', '', 'articles', '2014-11-03 15:07:10', '2014-11-02 21:50:11', '0000-00-00 00:00:00', '5', null, '', '', '', 'Тайтл — Все статьи вашего сайта', 'Кейворды если нужны', 'Мета описание', '', '', '', '', '', '', '', 'ru');
INSERT INTO `content` VALUES ('4', 'subscribe', '1', '0', '0', '0', 'Подписка', '', '', '', '', 'subscribe', '2014-11-03 15:07:11', '2014-11-02 21:50:12', '0000-00-00 00:00:00', '0', null, '', '', '', 'Тайтл — Подписка', 'Кейворды если нужны', 'Мета описание', '', '', '', '', '', '', '', 'ru');
INSERT INTO `content` VALUES ('5', 'asking', '1', '0', '0', '0', 'Задать вопрос', '', '', '', '', 'asking', '2014-11-03 15:07:11', '2014-11-02 21:50:12', '0000-00-00 00:00:00', '131', null, '', '', '', 'Тайтл — Задать вопрос', 'Кейворды если нужны', 'Мета описание', '', '', '', '', '', '', '', 'ru');
INSERT INTO `content` VALUES ('7', 'article-1', '1', '1', '0', '1', 'Основная первая статья', 'Подзаголовок раскрывающий смысл вашей статьи', 'Взобравшись на первую вершину курсивных гор, бросил он последний взгляд назад, на силуэт своего родного города Буквоград, на заголовок деревни Алфавит и на подзаголовок своего переулка Строчка.', 'Она предупредила его: «В моей стране все переписывается по несколько раз. Единственное, что от меня осталось, это приставка «и». Возвращайся ты лучше в свою безопасную страну». Не послушавшись рукописи, наш текст продолжил свой путь. Вскоре ему повстречался коварный составитель рекламных текстов, напоивший его языком и речью и заманивший в свое агенство, которое использовало его снова и снова в своих проектах. И если его не переписали, то живет он там до сих пор.', '', 'article-1', '2014-11-03 15:03:50', '2014-11-02 21:50:13', '0000-00-00 00:00:00', '2691', '8,9,10,17', '', '', '', 'Тайтл — Статьи 1', 'Кейворды если нужны', 'Мета описание', '', '', '', '', '', '', '', 'ru');
INSERT INTO `content` VALUES ('8', 'article-2', '1', '1', '0', '1', 'Очень интересная и познавательная статья по тематике вашего сайта', 'Подзаголовок раскрывающий смысл вашей статьи', 'Она предупредила его: «В моей стране все переписывается по несколько раз. Единственное, что от меня осталось, это приставка «и». Возвращайся ты лучше в свою безопасную страну». Не послушавшись рукописи, наш текст продолжил свой путь.', 'Она предупредила его: «В моей стране все переписывается по несколько раз. Единственное, что от меня осталось, это приставка «и». Возвращайся ты лучше в свою безопасную страну». Не послушавшись рукописи, наш текст продолжил свой путь. Вскоре ему повстречался коварный составитель рекламных текстов, напоивший его языком и речью и заманивший в свое агенство, которое использовало его снова и снова в своих проектах. И если его не переписали, то живет он там до сих пор.', '', 'article-2', '2014-11-03 15:03:51', '2014-11-03 21:50:13', '0000-00-00 00:00:00', '2064', '7,9,10,16', '', '', '', 'Тайтл — Статьи 2', 'Кейворды если нужны', 'Мета описание', '', '', '', '', '', '', '', 'ru');
INSERT INTO `content` VALUES ('9', 'article-3', '1', '1', '0', '1', 'Статья которая раскрывает тематику вашего сайта', 'Подзаголовок раскрывающий смысл вашей статьи', 'Вскоре ему повстречался коварный составитель рекламных текстов, напоивший его языком и речью и заманивший в свое агенство, которое использовало его снова и снова в своих проектах. И если его не переписали, то живет он там до сих пор.', 'Она предупредила его: «В моей стране все переписывается по несколько раз. Единственное, что от меня осталось, это приставка «и». Возвращайся ты лучше в свою безопасную страну». Не послушавшись рукописи, наш текст продолжил свой путь. Вскоре ему повстречался коварный составитель рекламных текстов, напоивший его языком и речью и заманивший в свое агенство, которое использовало его снова и снова в своих проектах. И если его не переписали, то живет он там до сих пор.', '', 'article-3', '2014-11-03 15:03:53', '2014-11-04 21:50:14', '0000-00-00 00:00:00', '17176', '7,8,10,11', '', '', '', 'Тайтл — Статьи 3', 'Кейворды если нужны', 'Мета описание', '', '', '', '', '', '', '', 'ru');
INSERT INTO `content` VALUES ('10', 'article-4', '1', '1', '0', '1', 'Важные рекомендация для посетителей вашего сайта', 'Подзаголовок раскрывающий смысл вашей статьи', 'Эта парадигматическая страна, в которой жаренные члены предложения залетают прямо в рот. Даже всемогущая пунктуация не имеет власти над рыбными текстами, ведущими безорфографичный образ жизни. Однажды одна маленькая строчка рыбного текста по имени Lorem ipsum решила выйти в большой мир грамматики.', 'Она предупредила его: «В моей стране все переписывается по несколько раз. Единственное, что от меня осталось, это приставка «и». Возвращайся ты лучше в свою безопасную страну». Не послушавшись рукописи, наш текст продолжил свой путь. Вскоре ему повстречался коварный составитель рекламных текстов, напоивший его языком и речью и заманивший в свое агенство, которое использовало его снова и снова в своих проектах. И если его не переписали, то живет он там до сих пор.', '', 'article-4', '2014-11-03 15:03:54', '2014-11-05 21:50:14', '0000-00-00 00:00:00', '1585', '7,8,9,11', '', '', '', 'Тайтл — Статьи 4', 'Кейворды если нужны', 'Мета описание', '', '', '', '', '', '', '', 'ru');
INSERT INTO `content` VALUES ('14', 'unsubscribe', '1', '0', '0', '0', 'Отменить подписку', '', '', '', '', 'unsubscribe', '2014-11-03 15:07:08', '2014-11-02 21:50:15', '0000-00-00 00:00:00', '20', null, '', '', '', 'Тайтл — Отменить подписку', 'Кейворды если нужны', 'Мета описание', '', '', '', '', '', '', '', 'ru');
INSERT INTO `content` VALUES ('18', 'articles-more', '1', '0', '0', '0', 'Больше статей', '', '', '', '', 'articles-more', '2014-11-07 19:27:43', '2014-11-02 21:50:15', '0000-00-00 00:00:00', '4', null, '', '', '', 'Тайтл — Больше статей', 'Кейворды если нужны', 'Мета описание', '', '', '', '', '', '', '', 'ru');
INSERT INTO `content` VALUES ('19', 'sitemap.xml', '1', '0', '0', '0', 'SitemapXML', '', '', '', '', 'sitemap-xml', '2014-11-21 17:25:14', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '162', null, '', '', '', 'Тайтл — SitemapXML', 'Кейворды если нужны', 'Мета описание', '', '', '', '', '', '', '', 'ru');

-- ----------------------------
-- Records of extension
-- ----------------------------
INSERT INTO `extension` VALUES ('1', 'Static', 'component', 'static_one', '1', '{\"aside\":\"left\"}');
INSERT INTO `extension` VALUES ('2', 'Article', 'component', 'article_one', '1', '{\"aside\":\"right\"}');
INSERT INTO `extension` VALUES ('3', 'Полезные ссылки', 'module', 'link-useful', '1', '{\"file\":\"/sadmin/ajax/extension-link-useful.php\"}');
INSERT INTO `extension` VALUES ('4', 'Избранное', 'module', 'link-favorite', '1', '');
INSERT INTO `extension` VALUES ('5', 'Подписка', 'module', 'subscribe', '1', '');
INSERT INTO `extension` VALUES ('6', 'Советуем почитать', 'module', 'readmore', '1', '');
INSERT INTO `extension` VALUES ('8', 'Only file', 'component', '', '1', '');
INSERT INTO `extension` VALUES ('9', 'Post request', 'component', '', '1', '');
INSERT INTO `extension` VALUES ('10', 'Комментарии', 'module', 'comment', '1', '');
INSERT INTO `extension` VALUES ('11', 'Custom HTML', 'module', 'custom-html', '1', '');
INSERT INTO `extension` VALUES ('12', 'SitemapXML', 'component', '', '1', '');
INSERT INTO `extension` VALUES ('13', 'Table of Content', 'module', 'toc', '1', '');
INSERT INTO `extension` VALUES ('14', 'Google Adv', 'snippet', 'google-adv', '1', 'alert(\"google-adv\");');
INSERT INTO `extension` VALUES ('15', 'Articles', 'component', 'article_list', '1', '');
INSERT INTO `extension` VALUES ('16', 'Categories', 'component', 'category_list', '1', '');
INSERT INTO `extension` VALUES ('17', 'Category', 'component', 'category_one', '1', '');

-- ----------------------------
-- Records of link
-- ----------------------------
INSERT INTO `link` VALUES ('1', 'Основная первая статья', '/article-1/', 'mod_usefullinks');
INSERT INTO `link` VALUES ('2', 'Очень интересная и познавательная статья по тематике вашего сайта', '/article-2/', 'mod_usefullinks');
INSERT INTO `link` VALUES ('3', 'Статья которая раскрывает тематику вашего сайта', '/article-3/', 'mod_usefullinks');
INSERT INTO `link` VALUES ('4', 'Важные рекомендация для посетителей вашего сайта', '/article-4/', 'mod_usefullinks');
INSERT INTO `link` VALUES ('5', 'Основная первая статья', '/article-1/', 'mod_usefullinks');
INSERT INTO `link` VALUES ('6', 'Очень интересная и познавательная статья по тематике вашего сайта', '/article-2/', 'mod_usefullinks');
INSERT INTO `link` VALUES ('7', 'Статья которая раскрывает тематику вашего сайта', '/article-3/', 'mod_usefullinks');
INSERT INTO `link` VALUES ('8', 'Важные рекомендация для посетителей вашего сайта', '/article-4/', 'mod_usefullinks');
INSERT INTO `link` VALUES ('9', 'Основная первая статья', '/article-1/', 'mod_usefullinks');
INSERT INTO `link` VALUES ('10', 'Очень интересная и познавательная статья по тематике вашего сайта', '/article-2/', 'mod_usefullinks');
INSERT INTO `link` VALUES ('11', 'Статья которая раскрывает тематику вашего сайта', '/article-3/', 'mod_usefullinks');
INSERT INTO `link` VALUES ('12', 'Важные рекомендация для посетителей вашего сайта', '/article-4/', 'mod_usefullinks');
INSERT INTO `link` VALUES ('13', 'Основная первая статья', '/article-1/', 'mod_usefullinks');
INSERT INTO `link` VALUES ('14', 'Очень интересная и познавательная статья по тематике вашего сайта', '/article-2/', 'mod_usefullinks');
INSERT INTO `link` VALUES ('15', 'Статья которая раскрывает тематику вашего сайта', '/article-3/', 'mod_usefullinks');
INSERT INTO `link` VALUES ('16', 'Важные рекомендация для посетителей вашего сайта', '/article-4/', 'mod_usefullinks');
INSERT INTO `link` VALUES ('17', 'Основная первая статья', '/article-1/', 'mod_usefullinks');
INSERT INTO `link` VALUES ('18', 'Очень интересная и познавательная статья по тематике вашего сайта', '/article-2/', 'mod_usefullinks');
INSERT INTO `link` VALUES ('19', 'Статья которая раскрывает тематику вашего сайта', '/article-3/', 'mod_usefullinks');
INSERT INTO `link` VALUES ('20', 'Важные рекомендация для посетителей вашего сайта', '/article-4/', 'mod_usefullinks');
INSERT INTO `link` VALUES ('21', 'Основная первая статья', '/article-1/', 'mod_usefullinks');
INSERT INTO `link` VALUES ('22', 'Очень интересная и познавательная статья по тематике вашего сайта', '/article-2/', 'mod_usefullinks');
INSERT INTO `link` VALUES ('23', 'Статья которая раскрывает тематику вашего сайта', '/article-3/', 'mod_usefullinks');
INSERT INTO `link` VALUES ('24', 'Важные рекомендация для посетителей вашего сайта', '/article-4/', 'mod_usefullinks');
INSERT INTO `link` VALUES ('25', 'Основная первая статья', '/article-1/', 'mod_usefullinks');
INSERT INTO `link` VALUES ('26', 'Очень интересная и познавательная статья по тематике вашего сайта', '/article-2/', 'mod_usefullinks');
INSERT INTO `link` VALUES ('27', 'Статья которая раскрывает тематику вашего сайта', '/article-3/', 'mod_usefullinks');
INSERT INTO `link` VALUES ('28', 'Важные рекомендация для посетителей вашего сайта', '/article-4/', 'mod_usefullinks');
INSERT INTO `link` VALUES ('29', 'Основная первая статья', '/article-1/', 'mod_usefullinks');
INSERT INTO `link` VALUES ('30', 'Очень интересная и познавательная статья по тематике вашего сайта', '/article-2/', 'mod_usefullinks');
INSERT INTO `link` VALUES ('31', 'Статья которая раскрывает тематику вашего сайта', '/article-3/', 'mod_usefullinks');
INSERT INTO `link` VALUES ('32', 'Важные рекомендация для посетителей вашего сайта', '/article-4/', 'mod_usefullinks');
INSERT INTO `link` VALUES ('33', 'Основная первая статья', '/article-1/', 'mod_usefullinks');
INSERT INTO `link` VALUES ('34', 'Очень интересная и познавательная статья по тематике вашего сайта', '/article-2/', 'mod_usefullinks');
INSERT INTO `link` VALUES ('35', 'Статья которая раскрывает тематику вашего сайта', '/article-3/', 'mod_usefullinks');

-- ----------------------------
-- Records of menu
-- ----------------------------
INSERT INTO `menu` VALUES ('1', '0', '0', '0', 'Root', 'root', '', '', 'none', '1', '', '0', '', '0', '0', '1', '35','ru','0');
INSERT INTO `menu` VALUES ('2', '1', '1', '1', 'Главная страница', 'home', '/', 'GET', 'mainPageCtrl', '1', '', '1', '', '1', '1', '2', '3','ru','0');
INSERT INTO `menu` VALUES ('3', '3', '8', '2', 'Карта сайта', 'sitemap', '/sitemap/', 'GET', 'sitemapCtrl', '1', '', '0', '', '1', '1', '4', '5','ru','0');
INSERT INTO `menu` VALUES ('4', '1', '1', '3', 'Статьи', 'articles', '/articles/', 'GET', 'articlesPageCtrl', '0', '', '0', '', '1', '1', '6', '7','ru','0');
INSERT INTO `menu` VALUES ('9', '4', '1', '4', 'Подписка', 'subscribe', '/subscribe/', 'POST', 'subscribeCtrl', '1', '', '0', '', '1', '1', '27', '28','ru','0');
INSERT INTO `menu` VALUES ('10', '2', '1', '5', 'Задать вопрос', 'asking', '/asking/', 'GET', 'askingCtrl', '1', '', '0', '', '1', '1', '31', '32','ru','0');
INSERT INTO `menu` VALUES ('11', '4', '9', '0', 'Комментарии', 'comment', '/comment/', 'POST', 'commentCtrl', '1', '', '0', '', '1', '1', '13', '14','ru','0');
INSERT INTO `menu` VALUES ('12', '1', '1', '7', 'Основная первая статья', 'article-1', '/article-1/', 'GET', 'commonPageCtrl', '1', '', '1', '', '1', '2', '7', '8','ru','0');
INSERT INTO `menu` VALUES ('13', '1', '1', '8', 'Очень интересная и познавательная статья по тематике вашего сайта', 'article-2', '/article-2/', 'GET', 'commonPageCtrl', '1', '', '0', '', '1', '2', '9', '10','ru','0');
INSERT INTO `menu` VALUES ('14', '1', '1', '9', 'Статья которая раскрывает тематику вашего сайта', 'article-3', '/article-3/', 'GET', 'commonPageCtrl', '1', '', '0', '', '1', '2', '11', '12','ru','0');
INSERT INTO `menu` VALUES ('15', '1', '1', '10', 'Важные рекомендация для посетителей вашего сайта', 'article-4', '/article-4/', 'GET', 'commonPageCtrl', '1', '', '0', '', '1', '2', '13', '14','ru','0');
INSERT INTO `menu` VALUES ('19', '1', '1', '14', 'Отменить подписку', 'unsubscribe', '/unsubscribe/', 'GET', 'unsubscribeCtrl', '1', '', '0', '', '1', '1', '29', '30','ru','0');
INSERT INTO `menu` VALUES ('29', '4', '9', '18', 'Больше статей', 'articles-more', '/articles/more/', 'POST', 'mainPageMoreCtrl', '1', '', '0', '', '1', '1', '33', '34','ru','0');
INSERT INTO `menu` VALUES ('30', '4', '9', '0', 'Задать вопрос', 'asking-do', '/asking/do/', 'POST', 'askingDoCtrl', '1', '', '0', '', '1', '0', '0', '0','ru','0');
INSERT INTO `menu` VALUES ('31', '1', '12', '19', 'sitemap.xml', 'sitemap.xml', '/sitemap.xml', 'GET', 'sitemapXMLCtrl', '1', '', '0', '', '1', '0', '0', '0','ru','0');

-- ----------------------------
-- Records of menutype
-- ----------------------------
INSERT INTO `menutype` VALUES ('1', 'tech', 'Technical menu', '');
INSERT INTO `menutype` VALUES ('2', 'mainmenu', '', '');
INSERT INTO `menutype` VALUES ('3', 'footermenu', '', '');
INSERT INTO `menutype` VALUES ('4', 'postmenu', 'Post', '');

-- ----------------------------
-- Records of module
-- ----------------------------
INSERT INTO `module` VALUES ('1', '3', 'Полезные ссылки', 'Модуль выводящий полезные статьи', '0', '1', 'aside-2', 'default', '{\"2\":\"2\"}', '{\"file\":\"\\/sadmin\\/ajax\\/module-link-useful.php\",\"links\":[]}');
INSERT INTO `module` VALUES ('3', '10', 'Оставить комментарий', 'Комментарии оставленные нашими читателями', '1', '1', 'after-content-2', 'default', '{\"28\":\"28\",\"27\":\"27\",\"20\":\"20\",\"18\":\"18\",\"17\":\"17\",\"16\":\"16\",\"15\":\"15\",\"14\":\"14\",\"13\":\"13\",\"12\":\"12\",\"32\":\"32\",\"33\":\"33\",\"34\":\"34\",\"35\":\"35\"}', '{}');
INSERT INTO `module` VALUES ('2', '4', 'Избранные статьи', 'Самые интересные и полезные статьи, которые оценили наши посетители', '1', '1', 'aside-2', 'default', '{}', '{}');
INSERT INTO `module` VALUES ('4', '6', 'Советуем почитать', 'Советуем почитать', '1', '1', 'after-content-1', 'default', '{\"12\":\"12\",\"13\":\"13\",\"14\":\"14\",\"15\":\"15\",\"16\":\"16\",\"17\":\"17\",\"18\":\"18\",\"20\":\"20\",\"27\":\"27\",\"28\":\"28\",\"32\":\"32\",\"33\":\"33\",\"34\":\"34\",\"35\":\"35\"}', '{}');
INSERT INTO `module` VALUES ('5', '5', 'E-mail подписка', 'Подписка', '0', '2', 'aside-2', 'default', '{}', '{}');
INSERT INTO `module` VALUES ('18', '13', 'Содержание', 'Навигация по статье', '1', '2', 'aside-2', 'default', '{\"12\":\"12\",\"13\":\"13\",\"14\":\"14\",\"15\":\"15\"}', '{}');
INSERT INTO `module` VALUES ('12', '3', 'Рекомендуем', 'Статьи по теме, подобранные для вас.', '1', '1', 'aside-1', 'default', '{\"12\":\"12\"}', '{\"file\":\"\\/sadmin\\/ajax\\/module-link-useful.php\",\"links\":{\"1\":\"24\",\"2\":\"25\",\"3\":\"26\",\"4\":\"27\"}}');
INSERT INTO `module` VALUES ('13', '3', 'Рекомендуем', 'Статьи по теме, подобранные для вас.', '1', '1', 'aside-1', 'default', '{\"13\":\"13\"}', '{\"file\":\"\\/sadmin\\/ajax\\/module-link-useful.php\",\"links\":{\"1\":\"28\",\"2\":\"29\"}}');
INSERT INTO `module` VALUES ('14', '3', 'Рекомендуем', 'Статьи по теме, подобранные для вас.', '1', '1', 'aside-1', 'default', '{\"14\":\"14\"}', '{\"file\":\"\\/sadmin\\/ajax\\/module-link-useful.php\",\"links\":{\"1\":\"30\"}}');
INSERT INTO `module` VALUES ('15', '3', 'Рекомендуем', 'Статьи по теме, подобранные для вас.', '1', '1', 'aside-1', 'default', '{\"15\":\"15\"}', '{\"file\":\"\\/sadmin\\/ajax\\/module-link-useful.php\",\"links\":{\"1\":\"31\",\"2\":\"32\"}}');
