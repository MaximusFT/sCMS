SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for category
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categorytype_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `path` varchar(255) DEFAULT NULL,
  `fileName` varchar(255) DEFAULT NULL,
  `function` int(11) DEFAULT NULL,
  `published` tinyint(1) DEFAULT '0' COMMENT 'The published state of the menu link.',
  `params` text,
  `lang` varchar(32) DEFAULT 'ru',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of category
-- ----------------------------
INSERT INTO `category` VALUES ('1', '2', 'Only file', null, null, 'only_file', null, '1', null, 'ru');
INSERT INTO `category` VALUES ('2', '2', 'Static', null, null, 'static_one', null, '1', '{\"aside\":\"left\"}', 'ru');
INSERT INTO `category` VALUES ('3', '2', 'Articles', 'articles', null, 'category_one', null, '1', '{\"aside\":\"left\",\"noPath\":false}', 'ru');
INSERT INTO `category` VALUES ('4', '2', 'News', 'news', null, 'category_one', null, '1', '{\"aside\":\"right\",\"noPath\":false}', 'ru');
INSERT INTO `category` VALUES ('5', '2', 'Blog', 'blog', null, 'category_one', null, '1', '{\"aside\":\"right\",\"noPath\":false}', 'ru');

-- ----------------------------
-- Table structure for categorytype
-- ----------------------------
DROP TABLE IF EXISTS `categorytype`;
CREATE TABLE `categorytype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `lang` varchar(32) DEFAULT 'ru',
  `params` text,
  `published` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of categorytype
-- ----------------------------
INSERT INTO `categorytype` VALUES ('1', 'tech', 'TechCat', 'tech', 'ru', '[]', '0');
INSERT INTO `categorytype` VALUES ('2', 'main', 'MainCat', 'tech', 'ru', '[]', '0');

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
-- Records of comment
-- ----------------------------

-- ----------------------------
-- Table structure for content
-- ----------------------------
DROP TABLE IF EXISTS `content`;
CREATE TABLE `content` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT '',
  `published` tinyint(1) DEFAULT '0',
  `favorite` tinyint(1) DEFAULT '0',
  `category_id` int(10) unsigned NOT NULL DEFAULT '0',
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
  `image` text NOT NULL,
  `imageThumbnail` text NOT NULL,
  `urls` text NOT NULL,
  `lang` varchar(8) NOT NULL DEFAULT 'ru',
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
  PRIMARY KEY (`id`),
  KEY `idx_published` (`published`),
  KEY `idx_catid` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of content
-- ----------------------------
INSERT INTO `content` VALUES ('1', 'article-1', '1', '1', '2', 'article-1', 'h1-small - article-1', 'h1-Description - article-1', 'Она предупредила его: «В моей стране все переписывается по несколько раз. Единственное, что от меня осталось, это приставка «и». Возвращайся ты лучше в свою безопасную страну». Не послушавшись рукописи, наш текст продолжил свой путь. Вскоре ему повстречался коварный составитель рекламных текстов, напоивший его языком и речью и заманивший в свое агенство, которое использовало его снова и снова в своих проектах. И если его не переписали, то живет он там до сих пор.', '<h1>Jumbotron</h1><p style=\"text-align: center;\" data-mce-style=\"text-align: center;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae ultrices accumsan. Aliquam ornare lacus adipiscing, posuere lectus et, fringilla augue. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae ultrices accumsan. Aliquam ornare lacus adipiscing.</p><h2><strong>Learn more</strong></h2><p>Jumbotron</p><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae ultrices accumsan. Aliquam ornare lacus adipiscing, posuere lectus et, fringilla augue. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae ultrices accumsan. Aliquam ornare lacus adipiscing.</p><p>Learn more</p><p>&nbsp;<img src=\"/images/1/children-01.jpg\" alt=\"\" data-mce-src=\"/images/1/children-01.jpg\" width=\"682\" height=\"384\"><br></p><p>Jumbotron<br>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae ultrices accumsan. Aliquam ornare lacus adipiscing, posuere lectus et, fringilla augue. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae ultrices accumsan. Aliquam ornare lacus adipiscing.</p><p>Learn more</p><p>&nbsp;<br></p>', '', '2014-11-03 15:07:09', '2014-11-01 21:50:11', '0000-00-00 00:00:00', '15371', 'http://scms.io/images/9/y6.jpg', 'http://scms.io/images/9/thumbnail/y6.jpg', '', 'ru', '{\"readmore\":{\"19\":19,\"9\":9}}', 'Тайтл — Основной заголовок', 'Кейворды если нужны', 'Мета описание', '', '', '', '', '', '', '');
INSERT INTO `content` VALUES ('2', 'article-2', '1', '0', '2', 'article-2', 'h1-small - article-2', 'h1-Description - article-2', 'Она предупредила его: «В моей стране все переписывается по несколько раз. Единственное, что от меня осталось, это приставка «и». Возвращайся ты лучше в свою безопасную страну». Не послушавшись рукописи, наш текст продолжил свой путь. Вскоре ему повстречался коварный составитель рекламных текстов, напоивший его языком и речью и заманивший в свое агенство, которое использовало его снова и снова в своих проектах. И если его не переписали, то живет он там до сих пор.', '<h1>Jumbotron</h1><p style=\"text-align: center;\" data-mce-style=\"text-align: center;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae ultrices accumsan. Aliquam ornare lacus adipiscing, posuere lectus et, fringilla augue. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae ultrices accumsan. Aliquam ornare lacus adipiscing.</p><h2><strong>Learn more</strong></h2><p>Jumbotron</p><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae ultrices accumsan. Aliquam ornare lacus adipiscing, posuere lectus et, fringilla augue. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae ultrices accumsan. Aliquam ornare lacus adipiscing.</p><p>Learn more</p><p></p><p>Jumbotron<br>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae ultrices accumsan. Aliquam ornare lacus adipiscing, posuere lectus et, fringilla augue. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae ultrices accumsan. Aliquam ornare lacus adipiscing.</p><p>Learn more</p><p></p><p></p>', '', '2014-11-03 15:07:10', '2014-11-02 21:50:11', '0000-00-00 00:00:00', '103', 'http://scms.io/images/19/q1.jpg', 'http://scms.io/images/19/thumbnail/q1.jpg', '', 'ru', '{\"readmore\":{\"19\":19,\"9\":9,\"14\":14}}', 'Тайтл — Основной заголовок', 'Кейворды если нужны', 'Мета описание', '', '', '', '', '', '', '');
INSERT INTO `content` VALUES ('3', 'article-3', '1', '0', '10', 'article-3', 'h1-small - article-3', 'h1-Description - article-3', 'Она предупредила его: «В моей стране все переписывается по несколько раз. Единственное, что от меня осталось, это приставка «и». Возвращайся ты лучше в свою безопасную страну». Не послушавшись рукописи, наш текст продолжил свой путь. Вскоре ему повстречался коварный составитель рекламных текстов, напоивший его языком и речью и заманивший в свое агенство, которое использовало его снова и снова в своих проектах. И если его не переписали, то живет он там до сих пор.', '<h1>Jumbotron</h1><p style=\"text-align: center;\" data-mce-style=\"text-align: center;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae ultrices accumsan. Aliquam ornare lacus adipiscing, posuere lectus et, fringilla augue. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae ultrices accumsan. Aliquam ornare lacus adipiscing.</p><h2><strong>Learn more</strong></h2><p>Jumbotron</p><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae ultrices accumsan. Aliquam ornare lacus adipiscing, posuere lectus et, fringilla augue. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae ultrices accumsan. Aliquam ornare lacus adipiscing.</p><p>Learn more</p><p></p><p>Jumbotron<br>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae ultrices accumsan. Aliquam ornare lacus adipiscing, posuere lectus et, fringilla augue. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae ultrices accumsan. Aliquam ornare lacus adipiscing.</p><p>Learn more</p><p></p><p></p>', '', '2014-11-03 15:07:10', '2014-11-02 21:50:11', '0000-00-00 00:00:00', '126', 'http://scms.io/images/24/e3.jpg', 'http://scms.io/images/24/thumbnail/e3.jpg', '', 'ru', '{\"readmore\":{\"19\":19,\"9\":9}}', 'Тайтл — Основной заголовок', 'Кейворды если нужны', 'Мета описание', '', '', '', '', '', '', '');
INSERT INTO `content` VALUES ('4', 'article-4', '1', '0', '11', 'article-4', 'h1-small - article-4', 'h1-Description - article-4', 'Она предупредила его: «В моей стране все переписывается по несколько раз. Единственное, что от меня осталось, это приставка «и». Возвращайся ты лучше в свою безопасную страну». Не послушавшись рукописи, наш текст продолжил свой путь. Вскоре ему повстречался коварный составитель рекламных текстов, напоивший его языком и речью и заманивший в свое агенство, которое использовало его снова и снова в своих проектах. И если его не переписали, то живет он там до сих пор.', '<h1>Jumbotron</h1><p style=\"text-align: center;\" data-mce-style=\"text-align: center;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae ultrices accumsan. Aliquam ornare lacus adipiscing, posuere lectus et, fringilla augue. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae ultrices accumsan. Aliquam ornare lacus adipiscing.</p><h2><strong>Learn more</strong></h2><p>Jumbotron</p><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae ultrices accumsan. Aliquam ornare lacus adipiscing, posuere lectus et, fringilla augue. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae ultrices accumsan. Aliquam ornare lacus adipiscing.</p><p>Learn more</p><p></p><p>Jumbotron<br>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae ultrices accumsan. Aliquam ornare lacus adipiscing, posuere lectus et, fringilla augue. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae ultrices accumsan. Aliquam ornare lacus adipiscing.</p><p>Learn more</p><p></p><p></p>', '', '2014-11-03 15:07:11', '2014-11-02 21:50:12', '2016-06-09 16:48:58', '18', 'http://scms.io/images/4/r4.jpg', 'http://scms.io/images/4/thumbnail/r4.jpg', '', 'ru', '{\"readmore\":{\"19\":19,\"9\":9}}', 'Тайтл — Основной заголовок', 'Кейворды если нужны', 'Мета описание', '', '', '', '', '', '', '');
INSERT INTO `content` VALUES ('5', 'article-5', '1', '0', '10', 'article-5', 'h1-small - article-5', 'h1-Description - article-5', 'Она предупредила его: «В моей стране все переписывается по несколько раз. Единственное, что от меня осталось, это приставка «и». Возвращайся ты лучше в свою безопасную страну». Не послушавшись рукописи, наш текст продолжил свой путь. Вскоре ему повстречался коварный составитель рекламных текстов, напоивший его языком и речью и заманивший в свое агенство, которое использовало его снова и снова в своих проектах. И если его не переписали, то живет он там до сих пор.', '<h1>Jumbotron</h1><p style=\"text-align: center;\" data-mce-style=\"text-align: center;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae ultrices accumsan. Aliquam ornare lacus adipiscing, posuere lectus et, fringilla augue. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae ultrices accumsan. Aliquam ornare lacus adipiscing.</p><h2><strong>Learn more</strong></h2><p>Jumbotron</p><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae ultrices accumsan. Aliquam ornare lacus adipiscing, posuere lectus et, fringilla augue. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae ultrices accumsan. Aliquam ornare lacus adipiscing.</p><p>Learn more</p><p></p><p>Jumbotron<br>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae ultrices accumsan. Aliquam ornare lacus adipiscing, posuere lectus et, fringilla augue. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae ultrices accumsan. Aliquam ornare lacus adipiscing.</p><p>Learn more</p><p></p><p></p>', '', '2014-11-03 15:07:11', '2014-11-02 21:50:12', '0000-00-00 00:00:00', '144', 'http://scms.io/images/5/t5.jpg', 'http://scms.io/images/5/thumbnail/t5.jpg', '', 'ru', '{\"readmore\":{\"19\":19,\"9\":9}}', 'Тайтл — Основной заголовок', 'Кейворды если нужны', 'Мета описание', '', '', '', '', '', '', '');

-- ----------------------------
-- Table structure for extension
-- ----------------------------
DROP TABLE IF EXISTS `extension`;
CREATE TABLE `extension` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `type` varchar(50) NOT NULL,
  `fileName` varchar(255) NOT NULL,
  `function` varchar(255) DEFAULT NULL,
  `published` tinyint(1) NOT NULL,
  `params` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `element` (`fileName`),
  KEY `element_folder` (`fileName`,`published`),
  KEY `extension` (`type`,`fileName`,`published`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of extension
-- ----------------------------
INSERT INTO `extension` VALUES ('1', 'Static', 'component', 'static_one', 'comStaticPageCtrl', '1', '');
INSERT INTO `extension` VALUES ('2', 'Article', 'component', 'article_one', 'comArticleOnePageCtrl', '0', '');
INSERT INTO `extension` VALUES ('3', 'Articles', 'component', 'article_list', 'comArticleListPageCtrl', '0', '');
INSERT INTO `extension` VALUES ('4', 'Category', 'component', 'category_one', 'comCategoryOnePageCtrl', '1', '');
INSERT INTO `extension` VALUES ('5', 'CategoryType', 'component', 'category_list', 'comCategoryListPageCtrl', '1', '');
INSERT INTO `extension` VALUES ('6', 'Only file', 'component', 'only_file', 'comOnlyFilePageCtrl', '1', '');
INSERT INTO `extension` VALUES ('7', 'Post request', 'component', 'post_request', 'comPostRequestPageCtrl', '0', '');
INSERT INTO `extension` VALUES ('8', 'SitemapXML', 'component', 'sitemap-xml', 'comSitemapXLMPageCtrl', '0', '');
INSERT INTO `extension` VALUES ('9', 'Table of Content', 'module', 'toc', null, '1', '');
INSERT INTO `extension` VALUES ('10', 'Полезные ссылки', 'module', 'link-useful', null, '1', '');
INSERT INTO `extension` VALUES ('11', 'Советуем почитать', 'module', 'readmore', null, '0', '');
INSERT INTO `extension` VALUES ('12', 'Custom HTML', 'module', 'custom-html', null, '0', '');
INSERT INTO `extension` VALUES ('13', 'Избранное', 'module', 'link-favorite', null, '1', '');
INSERT INTO `extension` VALUES ('14', 'Подписка', 'module', 'subscribe', null, '0', '');
INSERT INTO `extension` VALUES ('15', 'Комментарии', 'module', 'comment', null, '0', '');
INSERT INTO `extension` VALUES ('16', 'Menu', 'module', 'menu', null, '1', '');
INSERT INTO `extension` VALUES ('17', 'Хлебные крошки', 'module', 'breadcrumb', null, '1', '');
INSERT INTO `extension` VALUES ('18', 'Новые публикаци', 'module', 'link-latest', null, '1', '');
INSERT INTO `extension` VALUES ('19', 'External Link', 'component', 'external_link', 'comExternalLinkPageCtrl', '1', '');
INSERT INTO `extension` VALUES ('20', 'Snippet', 'module', 'snippet', null, '1', '');


-- ----------------------------
-- Table structure for menu
-- ----------------------------
DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menutype_id` int(11) NOT NULL DEFAULT '1',
  `extension_id` int(11) NOT NULL DEFAULT '2' COMMENT 'The type of link: Component, URL, Alias, Separator',
  `category_id` int(11) NOT NULL DEFAULT '0',
  `link_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT 'FK to #__extensions.id',
  `title` varchar(255) NOT NULL COMMENT 'The display title of the menu item.',
  `alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL COMMENT 'The SEF alias of the menu item.',
  `path` varchar(1024) DEFAULT '' COMMENT 'The computed path of the menu item based on the alias field.',
  `method` varchar(1024) DEFAULT 'GET' COMMENT 'The actually link the menu item refers to.',
  `lang` varchar(32) NOT NULL DEFAULT 'ru',
  `published` tinyint(1) DEFAULT '0' COMMENT 'The published state of the menu link.',
  `img` varchar(255) DEFAULT NULL COMMENT 'The image of the menu item.',
  `home` tinyint(1) unsigned DEFAULT '0' COMMENT 'Indicates if this menu item is the home or default page.',
  `params` text COMMENT 'JSON encoded data for the menu item.',
  PRIMARY KEY (`id`),
  KEY `idx_componentid` (`link_id`,`menutype_id`,`published`),
  KEY `idx_menutype` (`menutype_id`),
  KEY `idx_alias` (`alias`),
  KEY `idx_path` (`path`(255))
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of menu
-- ----------------------------
INSERT INTO `menu` VALUES ('4', '5', '4', '3', '0', 'Статьи', 'stati', '/stati/', 'GET', 'ru', '1', null, '0', '{\"fileName\":\"\"}');
INSERT INTO `menu` VALUES ('10', '5', '19', '0', '0', 'Задать вопрос', 'https://sofona.com', '/asking/', 'GET', 'ru', '1', null, '0', null);
INSERT INTO `menu` VALUES ('14', '5', '1', '0', '22', 'Контакты', 'contacts', '/contacts/', 'GET', 'ru', '1', null, '0', null);
INSERT INTO `menu` VALUES ('15', '5', '4', '4', '0', 'Новости', 'news', '/news/', 'GET', 'ru', '1', null, '0', null);
INSERT INTO `menu` VALUES ('30', '5', '1', '0', '18', 'Задать вопрос', 'asking-do', '/asking-do/', 'GET', 'ru', '1', null, '0', '{\"fileName\":\"\"}');
INSERT INTO `menu` VALUES ('46', '5', '6', '0', '0', 'Sofona.com', 'sofona', '/sofona/', 'GET', 'ru', '1', null, '0', '{\"fileName\":\"myfirststat.php\"}');
INSERT INTO `menu` VALUES ('54', '1', '1', '0', '1', 'Главная', 'home', '/', 'GET', 'ru', '1', null, '1', '{\"fileName\":\"\"}');

-- ----------------------------
-- Table structure for menutype
-- ----------------------------
DROP TABLE IF EXISTS `menutype`;
CREATE TABLE `menutype` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(24) NOT NULL,
  `title` varchar(48) NOT NULL,
  `position` varchar(50) DEFAULT 'tech',
  `lang` varchar(4) NOT NULL DEFAULT 'ru',
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `params` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_menutype` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of menutype
-- ----------------------------
INSERT INTO `menutype` VALUES ('1', 'tech', 'Technical menu', 'tech', 'ru', '1', '[]');
INSERT INTO `menutype` VALUES ('2', 'tech_en', 'Technical menu EN', 'tech', 'en', '1', '[]');
INSERT INTO `menutype` VALUES ('5', 'mainmenu', 'Main Menu', 'nav-top', 'ru', '1', '[]');
INSERT INTO `menutype` VALUES ('6', 'mainmenu_en', 'Main Menu EN', 'nav-top', 'en', '1', '[]');

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
  `lang` varchar(8) DEFAULT 'ru',
  `view` varchar(255) NOT NULL DEFAULT 'default',
  `visible` varchar(4096) DEFAULT '{"typeVis":1}',
  `params` varchar(4096) DEFAULT '{\n}',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of module
-- ----------------------------
INSERT INTO `module` VALUES ('1', '10', 'Полезные ссылки', 'Модуль выводящий полезные статьи', '1', '1', 'aside-2', 'ru', 'default', '{\"typeVis\":1,\"visArticle\":[],\"primary\":\"menu\"}', '{\"links\":{\"19\":19,\"10\":10,\"24\":24,\"25\":25}}');
INSERT INTO `module` VALUES ('3', '15', 'Оставить комментарий', 'Комментарии оставленные нашими читателями', '0', '1', 'after-content-2', 'ru', 'default', '{\"typeVis\":1}', '{}');
INSERT INTO `module` VALUES ('30', '20', 'Содержание', 'Через снипет', '1', '1', 'snippet-toc', 'ru', 'default', '{\"typeVis\":1}', '{\"snipetContent\":\"&lt;div class=&quot;panel panel-info toc&quot;&gt;&lt;div class=&quot;panel-heading&quot;&gt;Content&lt;\\/div&gt;&lt;\\/div&gt;\"}');
INSERT INTO `module` VALUES ('2', '13', 'Избранные статьи', 'Самые интересные и полезные статьи, которые оценили наши посетители', '1', '1', 'aside-1', 'ru', 'default', '{\"primary\":\"menu\",\"typeVis\":1,\"visMenu\":{\"4\":\"4\",\"15\":\"15\",\"46\":\"46\",\"3\":3},\"visCat\":{\"11\":\"11\",\"12\":\"12\",\"17\":\"17\",\"18\":\"18\"},\"visArticle\":{\"3\":\"3\",\"4\":\"4\",\"14\":\"14\",\"23\":\"23\",\"24\":\"24\",\"1\":1}}', '{}');
INSERT INTO `module` VALUES ('4', '11', 'Советуем почитать', 'Советуем почитать', '1', '1', 'after-content-1', 'ru', 'default', '{\"typeVis\":1}', '{}');
INSERT INTO `module` VALUES ('5', '14', 'E-mail подписка', 'Подписка', '1', '2', 'aside-2', 'ru', 'default', '{\"typeVis\":1}', '{}');
INSERT INTO `module` VALUES ('18', '9', 'Содержание', 'Навигация по статье', null, '1', 'aside-1', 'ru', 'default', '{\"typeVis\":3,\"visArticle\":{\"25\":25},\"primary\":\"article\"}', '{}');
INSERT INTO `module` VALUES ('12', '10', 'Рекомендуем', 'Статьи по теме, подобранные для вас.', '0', '1', 'aside-1', 'ru', 'default', '{\"typeVis\":1}', '{}');
INSERT INTO `module` VALUES ('13', '10', 'Новое в разделе', 'Статьи по теме, подобранные для вас.', '0', '1', 'aside-1', 'ru', 'default', '{\"typeVis\":1}', '{}');
INSERT INTO `module` VALUES ('14', '10', 'Рекомендуем', 'Статьи по теме, подобранные для вас.', '0', '1', 'aside-1', 'ru', 'default', '{\"typeVis\":1}', '{}');
INSERT INTO `module` VALUES ('15', '10', 'Рекомендуем', 'Статьи по теме, подобранные для вас.', '0', '1', 'aside-1', 'ru', 'default', '{\"typeVis\":1}', '{}');
INSERT INTO `module` VALUES ('19', '16', 'Menu', 'Ru', '1', '1', 'nav-top', 'ru', 'default', '{\"typeVis\":1}', '{\"menutype\":5}');
INSERT INTO `module` VALUES ('20', '16', 'Menu', 'En', '1', '1', 'nav-top', 'en', 'default', '{\"typeVis\":1,\"primary\":\"menu\"}', '{\"menutype\":6}');
INSERT INTO `module` VALUES ('21', '16', 'Category Menu', 'ru', '1', '3', 'aside-2', 'ru', 'category', '{\"typeVis\":1,\"primary\":\"menu\",\"visMenu\":{\"30\":30,\"54\":54,\"12\":12},\"visArticle\":{\"21\":21,\"20\":20,\"10\":10,\"8\":8,\"18\":18,\"25\":25},\"visCat\":{\"11\":11,\"23\":23}}', '{\"categorytype\":3}');
INSERT INTO `module` VALUES ('22', '17', 'Breadcrumb', 'Хлебные', '1', '1', 'breadcrumb', 'ru', 'default', '{\"typeVis\":1}', '{\n}');
INSERT INTO `module` VALUES ('29', '18', 'Новые публикации', 'В категории', '1', '2', 'aside-1', 'ru', 'default', '{\"typeVis\":1}', '{\n}');

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
) ENGINE=MyISAM AUTO_INCREMENT=2716 DEFAULT CHARSET=utf8;

-- ----------------------------
-- View structure for vAdminModule
-- ----------------------------
DROP VIEW IF EXISTS `vAdminModule`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `vAdminModule` AS select `module`.`id` AS `id`,`module`.`extension_id` AS `extension_id`,`extension`.`title` AS `extension_title`,`module`.`title` AS `title`,`module`.`description` AS `description`,`module`.`published` AS `published`,`module`.`ordering` AS `ordering`,`module`.`position` AS `position`,`module`.`lang` AS `lang`,`module`.`view` AS `view`,`module`.`visible` AS `visible`,`module`.`params` AS `params` from (`module` join `extension` on((`module`.`extension_id` = `extension`.`id`))) ;
