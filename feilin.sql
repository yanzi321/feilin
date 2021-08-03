/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : feilin

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2021-08-03 13:53:53
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for activity_summer_camps
-- ----------------------------
DROP TABLE IF EXISTS `activity_summer_camps`;
CREATE TABLE `activity_summer_camps` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '姓名',
  `tel` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '电话',
  `wants_country` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '意向国家',
  `ip` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'IP地址',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int(10) unsigned DEFAULT NULL COMMENT '报名用户的 user_id 呀',
  `from_id` int(10) unsigned DEFAULT NULL COMMENT '来源id',
  `from` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '来源场景',
  `consult_at` datetime DEFAULT NULL COMMENT '咨询时间',
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '头像',
  `place` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '地区',
  `remark` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '备注',
  `sex` tinyint(3) unsigned DEFAULT '3' COMMENT '性别：1 男 2 女 3 其他',
  `age` tinyint(3) unsigned DEFAULT '0' COMMENT '年龄',
  `grade` tinyint(3) unsigned DEFAULT '0' COMMENT '所在年级',
  `school` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '所在学校',
  `language_level` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '语言成绩',
  `parent_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '父母姓名',
  `parent_tel` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '父母电话',
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '邮箱',
  `organization_id` int(10) unsigned DEFAULT NULL COMMENT '如果是机构推广，此处显示机构id',
  `extern_salesman_id` int(10) unsigned DEFAULT NULL COMMENT '外部业务员id',
  PRIMARY KEY (`id`),
  KEY `activity_summer_camps_organization_id_index` (`organization_id`)
) ENGINE=InnoDB AUTO_INCREMENT=120 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of activity_summer_camps
-- ----------------------------
INSERT INTO `activity_summer_camps` VALUES ('114', '高天', '18947796677', '白鹭替报', '121.57.128.149', null, '2019-12-07 09:52:26', '2019-12-07 09:52:26', null, null, '1', null, null, null, null, '3', '0', '0', '', '', '', '', '', '20', null);
INSERT INTO `activity_summer_camps` VALUES ('115', '六六', '13365236525', null, '101.233.231.127', null, '2019-12-09 23:11:37', '2019-12-09 23:11:37', null, null, '1', null, null, null, null, '3', '0', '0', '', '', '', '', '', '13', null);
INSERT INTO `activity_summer_camps` VALUES ('116', '张淼', '13817095009', null, '223.104.212.222', null, '2019-12-16 17:47:31', '2019-12-16 17:47:31', null, null, '2', null, null, null, null, '3', '0', '0', '', '', '', '', '', '13', null);
INSERT INTO `activity_summer_camps` VALUES ('117', 'charlie', '15021857115', 'password changed', '172.58.238.232', null, '2019-12-17 10:05:41', '2019-12-17 10:05:41', null, null, '1', null, null, null, null, '3', '0', '0', '', '', '', '', '', '10', null);
INSERT INTO `activity_summer_camps` VALUES ('118', 'cccc', '15021857115', 'testing again', '172.58.238.232', null, '2019-12-17 10:42:05', '2019-12-17 10:42:05', null, null, '1', null, null, null, null, '3', '0', '0', '', '', '', '', '', null, null);
INSERT INTO `activity_summer_camps` VALUES ('119', '邓鸣明', '13701114341', null, '123.123.103.101', null, '2020-08-30 10:25:33', '2020-08-30 10:25:33', null, null, '3', null, null, null, null, '3', '0', '0', '', '', '', '', '', null, null);

-- ----------------------------
-- Table structure for admins
-- ----------------------------
DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '姓名',
  `tel` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '手机',
  `job_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '工号',
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '邮箱',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_email_unique` (`email`),
  UNIQUE KEY `admins_tel_unique` (`tel`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of admins
-- ----------------------------
INSERT INTO `admins` VALUES ('1', 'Chen, Charlie', '15021857115', '0001', 'shanghai@steptousa.com', null, '$2y$10$RVNs9LbdVtBgwllWs.reYuCrcoYX8Yc4Ogo/aH5iGCr69RaOQWrS.', '1', null, '2019-03-24 22:26:37', '2019-05-31 08:37:49', null);
INSERT INTO `admins` VALUES ('2', 'user', '', '', 'user@app.com', null, '$2y$10$P0YgTuqVwY8lPT8STPFp..XPOUaSKG0TdtusCZx0zymi5vTCAX3PG', '1', null, '2019-03-24 22:26:37', '2019-03-24 22:26:37', null);
INSERT INTO `admins` VALUES ('3', 'Cherry Pan', '19821599597', '001', 'pyy.cherry@steptousa.com', null, '$2y$10$jlsl.S1ZeOHABP4z.VUYiOjHuzxgMSEAGOTodC9sbKudzD4gBYURO', '1', null, '2019-03-27 11:51:26', '2019-04-22 10:13:10', null);
INSERT INTO `admins` VALUES ('4', 'Yvonne Zhou', '19821599707', '002', 'zbr.yvonne@steptousa.com', null, '$2y$10$YqsvWF1oHv5IshyC5LS.ee5AStqAd9llikpKzor0Jhd4x175nRbq2', '1', null, '2019-03-27 11:59:57', '2019-04-22 10:12:56', null);
INSERT INTO `admins` VALUES ('5', 'test', '15012341234', '007', 'boss1@app.com', null, '$2y$10$RVNs9LbdVtBgwllWs.reYuCrcoYX8Yc4Ogo/aH5iGCr69RaOQWrS.', '1', null, '2019-04-19 19:15:03', '2019-04-19 19:15:47', '2019-04-19 19:15:47');
INSERT INTO `admins` VALUES ('6', 'test-jixiang', '15023452345', '007', 'test@gmail.com', null, '$2y$10$u1P10dQHrHs2DwiRFJK2zuoabJp1k62sQDcArpoI8PxDMm8ipCVFy', '1', null, '2019-04-19 19:19:40', '2019-04-29 13:11:24', null);
INSERT INTO `admins` VALUES ('7', 'demon', '13376250246', null, 'demon@mufan.design', null, '$2y$10$VaOga3oLXIuOGp44IZgKRe6tA3g.aQDbljXmfbq2BhliyXxro4E4e', '1', null, '2019-04-22 10:22:44', '2019-11-18 10:51:53', null);
INSERT INTO `admins` VALUES ('8', 'rovast', '15651825273', null, 'rovast@163.com', null, '$2y$10$LwEZ95MZhZpeavrSKvvUXOeSpkMSi0DyCCAbrqqEvUKopoNyQEe1m', '1', null, '2019-04-29 13:28:25', '2019-08-22 11:01:16', null);
INSERT INTO `admins` VALUES ('9', 'debug', '15651825000', 'debug001', 'debug@admin.com', null, '$2y$10$5miItB1xLkNoqoGBdWUo3OoT9XUmHPNYaslpmJRSy3HGdPL37ReNS', '1', null, '2019-08-22 11:04:32', '2019-08-22 11:04:32', null);

-- ----------------------------
-- Table structure for articles
-- ----------------------------
DROP TABLE IF EXISTS `articles`;
CREATE TABLE `articles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `words` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '字数',
  `voice` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '语音地址',
  `category_id` int(10) unsigned NOT NULL COMMENT '所属分类',
  `articles_no` int(11) DEFAULT NULL COMMENT '新闻编码',
  `author` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '作者',
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '文章标题',
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '新闻类型',
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '文章简介',
  `cover` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '文章封面',
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '文章内容',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '文章状态',
  `sort` int(11) NOT NULL DEFAULT '999' COMMENT '排序，值越小排序越靠前',
  `published_at` datetime NOT NULL COMMENT '发布时间',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `is_recommend` tinyint(1) NOT NULL COMMENT '是否是推荐位',
  `memo` text COLLATE utf8mb4_unicode_ci COMMENT '备注',
  `tab` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '标签',
  `is_show` tinyint(1) DEFAULT '1' COMMENT '是否展示1为展示，0为不展示',
  `is_important` tinyint(1) DEFAULT '1' COMMENT '是否重要，1为重要，0为不重要',
  `abstract` text COLLATE utf8mb4_unicode_ci COMMENT '摘要',
  `fast_read` text COLLATE utf8mb4_unicode_ci COMMENT '速读',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of articles
-- ----------------------------
INSERT INTO `articles` VALUES ('1', null, null, '1', null, 'IVY小编', '艺术生有多难？', null, '大多数艺术生都抱有很美好的憧憬，但现实往往很残酷，必须明白几点，做到心中有数，以更好的心态应对。', 'http://api.steptousa.cn/storage/cover/L3jLRsHjQIvudlTw8PwfzZTX0Rl2cuq2iN7WlcHI.jpeg', '<p><span style=\"color: rgb(51, 51, 51);\">很多学生选择学习艺术，是因为本身自己很感兴趣，更多的原因是艺术生考试能以相对较低的分数被好的大学录取。其实艺术生这条路是很艰辛的，也承受着更大的压力，甚至还要被其他学生看不起。大多数艺术生都抱有很美好的憧憬，但现实往往很残酷，必须明白几点，做到心中有数，以更好的心态应对。</span></p><p><img src=\"http://api.steptousa.cn/storage/editor/bWIh1K99W8on6OurAtld9SzV5GdnCMa1Mxe8i8Nn.jpeg\"></p><p class=\"ql-align-justify\"><span style=\"color: rgb(51, 51, 51);\">1、艺术老师说起艺术生的时候往往过于强调优点，300多分就能考上二本，对于那些成绩不是很好尤其是300多分的学生来说当然心动。其实如果一个300来分水平的学生，只有两个原因，一是学习能力确实有问题，二是根本对学习没兴趣。艺术只会让你更加松懈，六七月集训时间不用学习文化课，回到学校理考高考就也3个月时间，这时要马上投入到学习中去，对于懒散惯了的学生是很难的。</span></p><p class=\"ql-align-justify\"><br></p><p class=\"ql-align-justify\"><span style=\"color: rgb(51, 51, 51);\">2、成绩在300多分的学生，如果不是对艺术有浓厚的兴趣，而只是单纯的想考个大学的学生，真不建议学艺术，艺术生是有些优势，但不比文化生轻松，艺术需要有悟性。既没有兴趣对艺术也没有悟性的学生学习起来简直是灾难。</span></p><p class=\"ql-align-justify\"><br></p><p class=\"ql-align-justify\"><span style=\"color: rgb(51, 51, 51);\">3、如果一个学校没有专门开设艺术班的话，意味着艺术生的复习进度和其他同学的不一样。除非老师专门给你开小灶或者你不太需要老师有自己的一套复习计划和复习方法，但几个艺术生有这个能力呢？</span></p><p class=\"ql-align-justify\"><br></p><p class=\"ql-align-justify\"><span style=\"color: rgb(51, 51, 51);\">4、你的对手不只有当届艺术生，还有强大复读生和从小爱好艺术学习艺术的。首先复读生，有复读一年的，也有复读两年三年的，他们都是很牛的。复读的压力很大，有来自家里人期盼的压力，已经考上大学的同学的压力，还有自己心里的压力，这些压力促使他们拼命地学，也愿意花更多的时间攻克自己的弱项。从爱好艺术的人更强大，功底就在那，为了梦想，人家还特别努力。但也不是要你放弃，有些人天生悟性好，再加上有好的老师提点，也是能在竞争中取胜的。我们总不能因为对手太强大就自己放弃了吧？</span></p><p class=\"ql-align-justify\"><br></p><p class=\"ql-align-justify\"><span style=\"color: rgb(51, 51, 51);\">5、艺术生一开始往往把目标订得过高，把自己的实力和潜力想得过大。比如说有的美术生刚入门就想着以后去哪个美院好的。过了高一高二，到高三的时候发现落差极大，心里的失落感有时候对学习就会产生消极的情绪。</span></p><p class=\"ql-align-justify\"><br></p><p class=\"ql-align-justify\"><span style=\"color: rgb(51, 51, 51);\">6、对于美术生都有个集训，集训的时候一定要带复习资料去，每天都需要抽出时间背下，做几道题，等回到学校攻文化科的时候也好轻松应对。集训的时候可以很轻松同样也可以很辛苦，一定要不怕苦，辛苦过后可能会是甘甜，但是轻轻松松堕落下去的话也就没机会品尝甘甜了。如果特别厌恶文化课，想着可以摆脱了，就大错特错了，因为几个月后你总要面对，会天天对着文化科，到时候你会更加痛苦。</span></p><p class=\"ql-align-justify\"><br></p><p class=\"ql-align-justify\"><span style=\"color: rgb(51, 51, 51);\">7、美术生来说，高一高二学的只是一些基础的理论，学校老师的美术教学在实践方面不如外面画室的老师好。外面画室老师教学方法是快准狠的，对画画小白来说可以非常快的提高自己的能力，有更加可以提高自己的功底。高一高二一定要抽出时间和精力去画室学习，对个人提高绝对有很大作用。也能提早适应和了解画室生活。</span></p><p class=\"ql-align-justify\"><br></p><p class=\"ql-align-justify\"><span style=\"color: rgb(51, 51, 51);\">8、美术生经常一坐就是三四个小时，有时候画得太入迷，除非上厕所就一直坐在凳子上，凳子坐久了和坐姿固定久了会很难受，最好一个小时起身稍微活动一下。也许你站在不同的位置和不同的距离会发现自己作品更多问题，以及带来更多灵感。注意提高效率，晚上不要赶画到太晚，早上也要早起，而且联考那天都要早起的。经常适当锻炼下身体。</span></p><p><br></p><p><span style=\"color: rgb(51, 51, 51);\">9、联考分数很重要，但文化课也很重要，切记，很重要。最后考试冲刺阶段都是在学校的三个月，这段时间一定做好最艰苦的打算，这段时间用好了提分很迅速的，300多分水平，依靠最后时段努力高考400多500多的大有人在。</span></p><p><br></p><p><span style=\"color: rgb(51, 51, 51);\">艺术生是很艰难的，尤其是美术生。更大的学习开销只为能开辟另一条上更好大学的道路。甚至有的人会嘲笑或是看不起艺术生，得不到其他人的理解让艺术生承受更大的压力。总之，艺术生请保持自信，一定要相信自己的强大能开辟出自己想要的未来。</span></p><p><br></p><p class=\"ql-align-center\"><strong><span class=\"ql-cursor\">﻿</span>如果您对美国留学感兴趣，</strong></p><p class=\"ql-align-center\"><strong>如果您想给孩子多一个选择，多一个未来，</strong></p><p class=\"ql-align-center\"><strong>欢迎联系IVY教育顾问！</strong></p><p class=\"ql-align-center\"><strong>在IVY，每一个学生都是独特的个体，</strong></p><p class=\"ql-align-center\"><strong>我们将全心为每个孩子量身定制申请方案，</strong></p><p class=\"ql-align-center\"><strong>为孩子的海外留学保驾护航！</strong></p><p class=\"ql-align-center\">▼</p><p class=\"ql-align-center\">更多精彩推荐，请关注我们</p><p class=\"ql-align-center\">▼</p><p class=\"ql-align-center\"><strong style=\"color: rgb(0, 176, 80);\">	安唯（中国）IVY (China) Study Abroad Service Center</strong><span style=\"color: rgb(0, 176, 80);\">&nbsp;和位于美国纽约的总公司协同开展业务，旨在提供基于美国的优越教育资源，为全球来美学生提供全方位留学服务。我们面向各国学生提供来美学校申请、住宿寄宿、课程补习、课外实践、心理辅导等方面的完整解决方案，可根据不同的需求及侧重点做个性化调整。</span></p><p class=\"ql-align-center\"><strong>	</strong><strong style=\"color: rgb(0, 176, 80);\">微信公众号：IVY 留学护航</strong></p><p class=\"ql-align-center\"><img src=\"http://api.steptousa.cn/storage/editor/NrYqUNBKiqmOVc7uAirjAxSemDXwxdSJiymQyB4n.jpeg\"></p><p class=\"ql-align-center\"><br></p><p><br></p><p>&nbsp;</p>', '1', '9998', '2019-04-01 17:14:33', '2019-04-01 17:14:33', '2019-09-06 11:09:46', null, '1', null, null, '1', null, null, null);
INSERT INTO `articles` VALUES ('2', null, null, '3', null, 'IVY小编', '拒签反败为胜，步入吉他殿堂', null, '刘先生已经于 2012年国内大学本科双学位毕业，之后在国内银行工作多年，后辗转到非洲工作一年，并在美国使馆办理了B1B2签证。由于一直痴迷于吉他，在朋友推荐下认识了台湾一位知名的吉他老师，并在这位老师的启发下，毅然决然放弃了在非洲的工作，选择申请老师推荐的一所位于LA的吉他专业最强的音乐学院。', 'http://api.steptousa.cn/storage/cover/hwec8DHd8e3EeLXyKka7U5LnnugvtVTP55jVPJFf.jpeg', '<p class=\"ql-align-justify\">2017年11月份，刘先生找到我，希望借助我的帮助获得签证。首先我看了他所有的材料，意识到被拒签的原因有以下几点：</p><p class=\"ql-align-justify\">1、&nbsp;<strong>准备不足，未解释清去美国的必要性、迫切性；</strong></p><p class=\"ql-align-justify\">2、&nbsp;<strong>过度自信，并没有了解面签说话的艺术，说了不该说的话；</strong></p><p class=\"ql-align-justify\">3、&nbsp;<strong>不符合距离开学日 120天内去面签的规定（2018年4月开学）；</strong></p><p class=\"ql-align-justify\">4、&nbsp;<strong>面签材料混乱，并未提供充足的材料作为支持性材料；</strong></p><p class=\"ql-align-justify\">跟刘先生充分沟通后，我分析了他的情况，认为完全有可能获得签证。只要按照我的方案一步步进行，通过的可能性非常大。这次签证一定要深入挖掘上次面签时出现的问题，整个方案必须形成一条完整的主线：去美国的唯一目的就是去学习专业的吉他课程，以技能训练为主，获得学位并非直接目的。有足够的资金以及学习能力确保顺利完成学业，并如期回国。抓住了主线，接下来在我和签证老师的帮助下，顺利研究出来一套完整的签证方案。同时，我建议刘先生拿着之前 B1B2签证去一次美国，产生出入境记录。经过一系列精心准备，最终在2月末成功获签。</p><p class=\"ql-align-justify\">心得体会：</p><p class=\"ql-align-justify\">美国不会拒绝任何一个怀揣音乐梦想的申请人。只要能让签证官了解并信服你的真实想法，签证并不难。本科毕业跨专业读 Associate学位，没什么不可能。同样背景的申请人，循规蹈矩按照固定的方式去面签，并不能保证都获签，因为签证是一门艺术，而非科学。</p><p class=\"ql-align-justify\"><br></p><p class=\"ql-align-center\"><strong>如果您对美国留学感兴趣，</strong></p><p class=\"ql-align-center\"><strong>如果您想给孩子多一个选择，多一个未来，</strong></p><p class=\"ql-align-center\"><strong>欢迎联系IVY教育顾问！</strong></p><p class=\"ql-align-center\"><strong>在IVY，每一个学生都是独特的个体，</strong></p><p class=\"ql-align-center\"><strong>我们将全心为每个孩子量身定制申请方案，</strong></p><p class=\"ql-align-center\"><strong>为孩子的海外留学保驾护航！</strong></p><p class=\"ql-align-center\">▼</p><p class=\"ql-align-center\">更多精彩推荐，请关注我们</p><p class=\"ql-align-center\">▼</p><p class=\"ql-align-center\"><strong style=\"color: rgb(0, 176, 80);\">	安唯（中国）IVY (China) Study Abroad Service Center</strong><span style=\"color: rgb(0, 176, 80);\">&nbsp;和位于美国纽约的总公司协同开展业务，旨在提供基于美国的优越教育资源，为全球来美学生提供全方位留学服务。我们面向各国学生提供来美学校申请、住宿寄宿、课程补习、课外实践、心理辅导等方面的完整解决方案，可根据不同的需求及侧重点做个性化调整。</span></p><p class=\"ql-align-center\"><strong>	</strong><strong style=\"color: rgb(0, 176, 80);\">微信公众号：IVY 留学护航</strong></p><p class=\"ql-align-center\"><img src=\"http://api.steptousa.cn/storage/editor/NrYqUNBKiqmOVc7uAirjAxSemDXwxdSJiymQyB4n.jpeg\"></p><p class=\"ql-align-center\"><br></p><p class=\"ql-align-justify\"><br></p>', '1', '9999', '2019-03-31 04:05:06', '2019-04-01 17:15:58', '2019-09-06 11:10:31', null, '1', null, null, '1', null, null, null);
INSERT INTO `articles` VALUES ('3', null, null, '3', null, 'IVY小编', '高考不是唯一成功的选择，美国留学给你新起点！', null, '有人说，高考是改变命运的唯一机会，有人说，高考是改变所谓社会固化阶级的唯一道路，有人说，高考是走向成功的唯一途径。其实并不尽然，升学，尤其是高等教育，其实并不只是只有高考这一条道路。', 'http://api.steptousa.cn/storage/cover/DoyP9SEKtIh9yRi9A7Dv2bOUyDjBhVkeaDORSOiL.jpeg', '<p class=\"ql-align-justify\">马上又是一年一度的高考了，有人说，高考是改变命运的唯一机会，有人说，高考是改变所谓社会固化阶级的唯一道路，有人说，高考是走向成功的唯一途径。其实并不尽然，因为高考“一考定终身”的特性，注定会有很多学生因为这个制度而束缚，有的学生可能平常学习很好但是因为高考而发挥失常，或者有的学生压根就不适应高考的这种应试模式，然后被高考这个大框架所限制迷茫。但是，<strong style=\"color: rgb(0, 138, 0);\">其实升学，尤其是高等教育，其实并不只是只有高考这一条道路。</strong>放眼全世界，拥有优质的高等教育资源的美国留学更加关注学生在高中期间的整体发展，而并不是仅仅只有一次的分数。美国的大学的申请制度也给了学生更多的进入高等教育机会。</p><p class=\"ql-align-justify\"><br></p><p class=\"ql-align-justify\">说实话，现在这个时间节点，想要申请到 18 年 9 月入学的美国顶尖名校，确实是来不及了，一般诸如康奈尔加州大学伯克利分校这样的顶级学校，都是需要提前一年甚至更久就要开始做全方位的规划和准备，但是，今年 9 月入学不了顶级名校，并不意味着你再也没有拿到这个学校毕业证的机会。事实上，你不是仅仅只有这一次机会，这就是美国教育的一个巨大的优势，就是转学制。要知道，美国的教育以灵活作为强大的优势之一，无论是转学还是学校，只要你足够优秀，总能找到你最合适的，要是到，就连普林斯顿这样的顶级名校也在 2017 年开放了转学申请，所以可见，越来越多的美国顶级名校开始将转学作为一个重要的招生途径。</p><p class=\"ql-align-justify\"><br></p><p class=\"ql-align-justify\">那么一定会有学生会问，那我应该如何准备？如果你已经有了这个想法，恭喜你，我们可以开始我们的规划了。首先你要找到一位安唯教育老师，和他详细咨询转学的要求的目标，制定一个完整的规划，你早一天，就会比别人多一分的成功的机会。现在没有雅思或者托福等语言成绩没关系，安唯教育强大的平台资源可以给你争取到学校英语内测的机会，这样，一开始你可以进入一个美国综合排名前 5% 的优质大学进行国际大一的学习，然后经过安唯教育老师的专业规划和你的努力，我们完全可以在大二年级进行转学的申请，如果一切顺利，大三你就可以进入到你的 dream school 学习，最后拿到一个美国前 30 甚至常青藤的毕业证！这不是异想天开，事实上，已经有很多安唯的学生通过这种方式进入到了自己的 dream school ，开始了新的成功之路。</p><p class=\"ql-align-justify\"><br></p><p class=\"ql-align-justify\">高考从来都不是决定你人生的唯一道路，能成功的路有千万条，但是不变的是需要你一直勤奋努力，一直坚定目标，安唯教育的老师愿意成为你认证道路的助力，帮助你规避留学中的各种问题，告诉你已经成功的同学的经验，帮你去成就你自己的人生。</p><p class=\"ql-align-justify\"><br></p><p class=\"ql-align-center\"><strong>如果您对美国留学感兴趣，</strong></p><p class=\"ql-align-center\"><strong>如果您想给孩子多一个选择，多一个未来，</strong></p><p class=\"ql-align-center\"><strong>欢迎联系IVY教育顾问！</strong></p><p class=\"ql-align-center\"><strong>在IVY，每一个学生都是独特的个体，</strong></p><p class=\"ql-align-center\"><strong>我们将全心为每个孩子量身定制申请方案，</strong></p><p class=\"ql-align-center\"><strong>为孩子的海外留学保驾护航！</strong></p><p class=\"ql-align-center\">▼</p><p class=\"ql-align-center\">更多精彩推荐，请关注我们</p><p class=\"ql-align-center\">▼</p><p class=\"ql-align-center\"><strong style=\"color: rgb(0, 176, 80);\">	安唯（中国）IVY (China) Study Abroad Service Center</strong><span style=\"color: rgb(0, 176, 80);\">&nbsp;和位于美国纽约的总公司协同开展业务，旨在提供基于美国的优越教育资源，为全球来美学生提供全方位留学服务。我们面向各国学生提供来美学校申请、住宿寄宿、课程补习、课外实践、心理辅导等方面的完整解决方案，可根据不同的需求及侧重点做个性化调整。</span></p><p class=\"ql-align-center\"><strong>	</strong><strong style=\"color: rgb(0, 176, 80);\">微信公众号：IVY 留学护航</strong></p><p class=\"ql-align-center\"><img src=\"http://api.steptousa.cn/storage/editor/NrYqUNBKiqmOVc7uAirjAxSemDXwxdSJiymQyB4n.jpeg\"></p><p class=\"ql-align-center\"><br></p><p class=\"ql-align-justify\"><br></p>', '1', '9998', '2019-04-01 17:17:02', '2019-04-01 17:17:02', '2019-09-06 11:10:08', null, '1', null, null, '1', null, null, null);
INSERT INTO `articles` VALUES ('4', null, null, '3', null, 'IVY小编', '决定申请美国研究生之前，一定要想清楚这几点', null, '对本科学校或专业不满意、专业上想要继续深造获得在学术研究上更多的教育资源、或者想提升一下“钱途”，去美国念硕士就是很好的选择。本文就学生的专业选择、毕业的后的计划、资金情况、需要花费的时间、毕业几年后再深造的地位进行了细致的分析。', 'http://api.steptousa.cn/storage/cover/czKkFC9rbbWvJK6RpNuQ3WVv5EWGIyEttERpLEa9.jpeg', '<p class=\"ql-align-justify\">决定申请美国研究生之前，一定要想清楚这几点：</p><p class=\"ql-align-justify\"><strong>对本科学校或专业不满意、专业上想要继续深造获得在学术研究上更多的教育资源、或者想提升一下“钱途”，去美国念硕士就是很好的选择。</strong></p><p class=\"ql-align-justify\">相对来说，读个美国研究生时间短，花费少，获得奖学金的几率高，那么去美国读个 MS ，你准备好了么？</p><p class=\"ql-align-justify\"><br></p><p class=\"ql-align-justify\"><strong style=\"color: rgb(255, 255, 255); background-color: rgb(102, 185, 102);\">选择你喜欢的专业方向</strong></p><p class=\"ql-align-justify\">申请前你不需要了解你论文研究的具体题目，但必须要对你要研究的领域有个清晰的认知，当然还要有兴趣。会有人选择在申请研究生时跨专业，但如果想要录取的可能性高，那就一定要对新转入的专业有认识、有深入、有实践。选定好喜欢的方向后，还要对这个专业的排名、心仪院校的相关信息进行初步了解。</p><p class=\"ql-align-justify\">&nbsp;</p><p class=\"ql-align-justify\">不论是在申请前还是申请中，“为什么选择这个专业”肯定是会被问到，而且在你的文书及面试中也都属于肯定会被提及的问题。你对专业的兴趣也会体现在你在学术研究中的热情，也是预测你能在这个领域深入多少的隐形指标之一。所以选择一个擅长而又感兴趣的专业非常重要。</p><p class=\"ql-align-justify\">&nbsp;</p><p class=\"ql-align-justify\"><strong style=\"background-color: rgb(102, 185, 102); color: rgb(255, 255, 255);\">硕士毕业后你要去做什么 ?</strong></p><p class=\"ql-align-justify\">&nbsp;</p><p class=\"ql-align-justify\">虽然可能你还不想为了研究生毕业后的去路发愁，但是这是个不得不考虑的问题。硕士毕业后，你将就业还是读博？如果是就业，那么像法律经济和药剂学这类应用专业等可以不那么焦灼，毕竟是大热门，也有很多固定对口的工作。但如果是走学术路线，进攻博士，将会面临狼多肉少的学术职位。</p><p class=\"ql-align-justify\">&nbsp;</p><p class=\"ql-align-justify\"><strong style=\"background-color: rgb(102, 185, 102); color: rgb(255, 255, 255);\">钱备够了么？</strong></p><p class=\"ql-align-justify\">&nbsp;</p><p class=\"ql-align-justify\">很多博士项目都有全额奖金来承担你的生活费用，相比之下研究生项目会提供一些少量的经济援助。但很多学校会提供一些奖学金、助教职位等。各个院校及专业的学费略有不同，但平均看来一年的学费生活费要在 30 万以上（最近汇率又涨了，费用也是水涨船高）。资金证明是申请期、签证和发送 I-20 表格前都要准备好的。存款证明要求是定期存款，股票和基金是不可以用的，存款数额也至少要比第一年需要花费的学费和生活费高出一些。此外房产是不可以代替存款证明的，如果实在捉襟见肘可以把房产抵押成存款来开取证明。</p><p class=\"ql-align-justify\">&nbsp;</p><p class=\"ql-align-center\"><img src=\"https://images.jjl.cn/ugc/2018/0801/20180801214203794.jpeg\">&nbsp;</p><p class=\"ql-align-center\"><br></p><p class=\"ql-align-justify\"><strong style=\"background-color: rgb(102, 185, 102); color: rgb(255, 255, 255);\">需要花费你多长时间？</strong></p><p class=\"ql-align-justify\">&nbsp;</p><p class=\"ql-align-justify\">不管你选择什么学校什么专业，至少几个月的工夫是肯定要花的。你要在这段日子理准备好你的托福、 GRE 、 GMAT 等标准化成绩的考试，跟教授套辞、选校选专业，准备文书、面试等等。如果 GPA 过低、或者其他科研、社会实践等软实力不足的话，你还需要一段时间来提升这些，让你在众多申请者中闪闪发光，让你被录取的可能性更高。</p><p class=\"ql-align-justify\">&nbsp;</p><p class=\"ql-align-justify\">如果想要有条不紊的进入较好的学校学习，最好从大一开始便进行规划并一步步施行 。</p><p class=\"ql-align-justify\">&nbsp;</p><p class=\"ql-align-center\"><img src=\"https://images.jjl.cn/ugc/2018/0801/20180801214314990.jpeg\"></p><p class=\"ql-align-center\"><br></p><p class=\"ql-align-justify\"><strong style=\"background-color: rgb(102, 185, 102); color: rgb(255, 255, 255);\">如果是毕业几年准备翻回头继续深造的要不要焦虑一下？</strong></p><p class=\"ql-align-justify\">&nbsp;</p><p class=\"ql-align-justify\">完全没必要。很多学校科研项目可能反而更欣赏有一定工作经验的人士。在某一领域的职业工作中拥有一定的经验和见解可以造就（对此专业）很多独特的思考。这类经历也会成为申请中亮丽的一点。</p><p class=\"ql-align-justify\"><br></p><p class=\"ql-align-justify\"><br></p><p class=\"ql-align-center\"><strong>如果您对美国留学感兴趣，</strong></p><p class=\"ql-align-center\"><strong>如果您想给孩子多一个选择，多一个未来，</strong></p><p class=\"ql-align-center\"><strong>欢迎联系IVY教育顾问！</strong></p><p class=\"ql-align-center\"><strong>在IVY，每一个学生都是独特的个体，</strong></p><p class=\"ql-align-center\"><strong>我们将全心为每个孩子量身定制申请方案，</strong></p><p class=\"ql-align-center\"><strong>为孩子的海外留学保驾护航！</strong></p><p class=\"ql-align-center\">▼</p><p class=\"ql-align-center\">更多精彩推荐，请关注我们</p><p class=\"ql-align-center\">▼</p><p class=\"ql-align-center\"><strong style=\"color: rgb(0, 176, 80);\">	安唯（中国）IVY (China) Study Abroad Service Center</strong><span style=\"color: rgb(0, 176, 80);\">&nbsp;和位于美国纽约的总公司协同开展业务，旨在提供基于美国的优越教育资源，为全球来美学生提供全方位留学服务。我们面向各国学生提供来美学校申请、住宿寄宿、课程补习、课外实践、心理辅导等方面的完整解决方案，可根据不同的需求及侧重点做个性化调整。</span></p><p class=\"ql-align-center\"><strong>	</strong><strong style=\"color: rgb(0, 176, 80);\">微信公众号：IVY 留学护航</strong></p><p class=\"ql-align-center\"><img src=\"http://api.steptousa.cn/storage/editor/NrYqUNBKiqmOVc7uAirjAxSemDXwxdSJiymQyB4n.jpeg\"></p><p class=\"ql-align-center\"><br></p><p class=\"ql-align-justify\"><br></p>', '1', '9997', '2019-04-12 14:43:49', '2019-04-12 14:43:49', '2019-09-06 11:09:29', null, '1', null, null, '1', null, null, null);
INSERT INTO `articles` VALUES ('5', null, null, '3', null, 'IVY 小编', '【IVY原创】中高考后，留学首选——美国', null, '六月即将来临，中高考纷纷进入倒计时阶段。高考之外，留学不失为一个好的升学途径。在众多海外国家中，美国一直是最受国际学生欢迎的留学目的地，今天就跟随IVY小编了解美国教育与美国大学的优势。给孩子多一个选择，多一个未来！', 'http://api.steptousa.cn/storage/cover/ZDmwU0Nyaqy3B90hsmUCshWvjAGkFCtIQkMLj3Lc.jpeg', '<p><br></p><p><img src=\"http://api.steptousa.cn/storage/editor/cFM5f91z9hxlVp91lP7JY2qPPEgvLf3bI4fgIDgu.jpeg\"></p><p class=\"ql-align-justify\">现阶段，为高考的孩子规划留学，正当时。给孩子多一个选择，多一个未来！根据不同条件与需求的孩子和家庭，大致可参考以下几个留学方案：</p><p><img src=\"http://api.steptousa.cn/storage/editor/KWOhqy0wqx7MskcTqNFsd7g5a7DlnKGTPR5ypZhu.png\"></p><p><br></p><p><br></p><p class=\"ql-align-center\"><strong>如果您对美国留学感兴趣，</strong></p><p class=\"ql-align-center\"><strong>如果您想给孩子多一个选择，多一个未来，</strong></p><p class=\"ql-align-center\"><strong>欢迎联系IVY教育顾问！</strong></p><p class=\"ql-align-center\"><strong>在IVY，每一个学生都是独特的个体，</strong></p><p class=\"ql-align-center\"><strong>我们将全心为每个孩子量身定制申请方案，</strong></p><p class=\"ql-align-center\"><strong>为孩子的海外留学保驾护航！</strong></p><p class=\"ql-align-center\">▼</p><p class=\"ql-align-center\">更多精彩推荐，请关注我们</p><p class=\"ql-align-center\">▼</p><p class=\"ql-align-center\"><strong style=\"color: rgb(0, 176, 80);\">	安唯（中国）IVY (China) Study Abroad Service Center</strong><span style=\"color: rgb(0, 176, 80);\">&nbsp;和位于美国纽约的总公司协同开展业务，旨在提供基于美国的优越教育资源，为全球来美学生提供全方位留学服务。我们面向各国学生提供来美学校申请、住宿寄宿、课程补习、课外实践、心理辅导等方面的完整解决方案，可根据不同的需求及侧重点做个性化调整。</span></p><p class=\"ql-align-center\"><strong>	</strong><strong style=\"color: rgb(0, 176, 80);\">微信公众号：IVY 留学护航</strong></p><p class=\"ql-align-center\"><img src=\"http://api.steptousa.cn/storage/editor/NrYqUNBKiqmOVc7uAirjAxSemDXwxdSJiymQyB4n.jpeg\"></p><p class=\"ql-align-center\"><strong>	</strong></p><p><img src=\"http://api.steptousa.cn/storage/editor/0hfkswb3KZhwLKkT6Z2Nt6TAnokfFR3C3kWcP5hS.jpeg\"></p>', '1', '9996', '2019-05-28 15:35:27', '2019-08-23 15:35:27', '2019-09-06 11:03:17', null, '1', null, null, '1', null, null, null);
INSERT INTO `articles` VALUES ('6', null, null, '3', null, '吉祥', '这是一条测试文章，请忽略', null, '这是一条测试文章，请忽略；这是一条测试文章，请忽略；这是一条测试文章，请忽略。', 'http://api.steptousa.cn/storage/cover/zww6F8VoPnPOWVPaTf5YsSiRU2GrCLSCsk2dYSAW.jpeg', '<p>这是一条测试文章，请忽略；这是一条测试文章，请忽略；这是一条测试文章，请忽略。</p>', '0', '1', '2019-08-24 10:49:35', '2019-08-24 10:49:35', '2019-08-24 11:06:04', null, '0', null, null, '1', null, null, null);
INSERT INTO `articles` VALUES ('7', null, null, '3', null, 'IVY小编', '【IVY原创】认识美国教育（上篇）', null, '端午假期里，小编的朋友圈被“高考数学卷难出天际线”刷屏了！\n\n在一片怨声中，不乏有一些家长注意到了另一条出路——留学。在出分前的空挡期，赶一下留学的末班车或是寻找对孩子未来更好的可替代方案，无疑是明智之举。接下来中考也将拉开大幕。此时，不妨关注我们，了解认识美国教育。', 'http://api.steptousa.cn/storage/cover/mhEa4guTl6D8x31ZfuEPFGyJCeh8ZO7tfr09lX0o.jpeg', '<p><br></p><p><img src=\"http://api.steptousa.cn/storage/editor/3JvLh6f7ANOtueLGkXGUE4TsTkRw2vFHFxmTfCm4.jpeg\"></p>', '1', '9995', '2019-06-13 00:00:00', '2019-08-26 10:49:32', '2019-09-06 10:56:52', null, '1', null, null, '1', null, null, null);
INSERT INTO `articles` VALUES ('8', null, null, '3', null, 'IVY小编', '【IVY原创】认识美国教育（下篇）', null, '前天，小编给大家科普了美国的教育结构、评分制度和学年的划分【回顾请戳：认识美国教育（上篇）】。今天，继续给大家介绍美国的高等教育体系。', 'http://api.steptousa.cn/storage/cover/fkigV1HdUOLsoF8kaHYUz9IkFpTCWnREcWdpXo1s.jpeg', '<p><br></p><p><img src=\"http://api.steptousa.cn/storage/editor/WErEeRW9qcLhv9OKZGQrMSGNo8Vx5VRp6h3kCWQM.jpeg\"><img src=\"http://api.steptousa.cn/storage/editor/s7kGwCMl0w2iCH4LTiL65kLvhdLUPU7nHyNQWPxA.jpeg\"></p>', '1', '9994', '2019-06-14 00:00:00', '2019-08-26 11:04:32', '2019-09-06 10:09:39', null, '1', null, null, '1', null, null, null);
INSERT INTO `articles` VALUES ('9', null, null, '1', null, 'IVY原创', '【IVY原创】美高小伙伴行前准备攻略', null, '在即将来临的八月，不少已经拿到录取和签证的初高中小伙伴们即将出发前往新学校。这份行前准备攻略，这份行前攻略希望对你有帮助。', 'http://api.steptousa.cn/storage/cover/l3vgu9BdHLxR9AePTGVXnXkjUd32OPLorokPwDyN.jpeg', '<p><img src=\"http://api.steptousa.cn/storage/editor/urqzm3rzMCSk0eU7xptedwpHdREisudvBsD2AolR.jpeg\"></p><p><img src=\"http://api.steptousa.cn/storage/editor/b2QaaE2pbEC4a145y1ARGlWIAHJv42WXGF7QSktr.jpeg\"></p>', '1', '9993', '2019-07-24 00:00:00', '2019-08-26 11:32:26', '2019-09-05 14:43:16', null, '1', null, null, '1', null, null, null);
INSERT INTO `articles` VALUES ('10', null, null, '3', null, 'IVY小编', '【IVY原创】美高留学注意事项', null, '8月，即将前往美国高中入学的童鞋们，你们准备好了吗？\n\n来看看就读美高的一些“规矩”吧！', 'http://api.steptousa.cn/storage/cover/qKvEAG4rDeTQfiXz85YxyiRkUKmrDjhSOwxz7MKI.jpeg', '<p><br></p><p><img src=\"http://api.steptousa.cn/storage/editor/bc2ims1lstOv9m1KRpYVybBC0yNVcZkOfL0vMJ2Z.jpeg\"></p>', '1', '9992', '2019-08-01 00:00:00', '2019-08-26 11:56:49', '2019-09-05 14:32:02', null, '1', null, null, '1', null, null, null);
INSERT INTO `articles` VALUES ('11', null, null, '5', null, 'IVY小编', '【安唯夏令营】第1天~华盛顿网红打卡', null, '安唯夏令营的第1天', 'http://api.steptousa.cn/storage/cover/MXU1p7LdlaQa9rJ4zHZrSr4vbzRKWbG6gQL6Lxtb.jpeg', '<p><br></p><p class=\"ql-align-center\"><strong class=\"ql-size-large\">安唯夏令营的第1天</strong></p><p><br></p><p class=\"ql-align-center\"><strong class=\"ql-size-large\">​?&nbsp;</strong><strong style=\"background-color: rgb(215, 227, 188); color: rgb(0, 0, 0);\" class=\"ql-size-large\">幸运的开端~</strong></p><p class=\"ql-align-center\"><span class=\"ql-size-large\">8月5日周一 香港大罢工</span></p><p class=\"ql-align-center\"><span class=\"ql-size-large\">200多个进出航班被取消</span></p><p class=\"ql-align-center\"><span class=\"ql-size-large\">我们的飞行路线：上海 - 香港 - 华盛顿</span></p><p class=\"ql-align-center\"><span class=\"ql-size-large\">很幸运，我们的团未受影响</span></p><p class=\"ql-align-center\"><span class=\"ql-size-large\">航班正常起降，顺利抵达华盛顿</span></p><p class=\"ql-align-center\"><span class=\"ql-size-large\">入住&nbsp;Best Western 酒店</span></p><p class=\"ql-align-center\"><img src=\"http://api.steptousa.cn/storage/editor/lT53Vjwixf1GxXfd7QTGjbrb3TwsUyPaITR1Jup4.jpeg\"></p><p class=\"ql-align-center\"><span style=\"color: rgb(0, 32, 96);\">如果您对美国留学感兴趣，</span></p><p class=\"ql-align-center\"><span style=\"color: rgb(0, 32, 96);\">如果您的孩子有赴美求学的打算，</span></p><p class=\"ql-align-center\"><span style=\"color: rgb(0, 32, 96);\">如果您想给孩子的未来多一个选择，</span></p><p class=\"ql-align-center\"><span style=\"color: rgb(0, 32, 96);\">点击</span><a href=\"https://mp.weixin.qq.com/cgi-bin/appmsg?t=media/appmsg_edit&amp;action=edit&amp;type=10&amp;appmsgid=100000127&amp;isMul=1&amp;token=767305476&amp;lang=zh_CN\" target=\"_blank\" style=\"color: rgb(87, 107, 149); background-color: rgb(255, 251, 0);\"><strong>在线报名</strong></a><strong style=\"color: rgb(0, 32, 96); background-color: rgb(255, 251, 0);\">&nbsp;</strong><span style=\"color: rgb(0, 32, 96);\">安唯IVY专属顾问将与您联系！</span></p><p class=\"ql-align-center\"><span style=\"color: rgb(0, 32, 96);\">在安唯IVY，每个孩子都是独特的个体，</span></p><p class=\"ql-align-center\"><span style=\"color: rgb(0, 32, 96);\">我们将全心为每个孩子量身定制申请方案，</span></p><p class=\"ql-align-center\"><span style=\"color: rgb(0, 32, 96);\">为孩子的海外留学保驾护航！</span></p><p class=\"ql-align-center\"><br></p><p class=\"ql-align-center\"><strong>扫码关注我们</strong></p><p class=\"ql-align-center\"><strong>了解更多留学资讯</strong></p><p class=\"ql-align-center\"><img src=\"http://api.steptousa.cn/storage/editor/EExtwXnlywHIipxde14cBPC0o4OPeVeiE3TQe5ls.jpeg\"></p><p class=\"ql-align-center\"><span style=\"color: rgb(0, 32, 96); background-color: rgba(255, 255, 255, 0.16);\">安唯（中国）IVY (China) Study Abroad Service Center 和位于美国纽约的总公司协同开展业务，旨在提供基于美国的优越教育资源，为全球来美学生提供全方位留学服务。我们面向各国学生提供来美学校申请、住宿寄宿、课程补习、课外实践、心理辅导等方面的完整解决方案，可根据不同的需求及侧重点做个性化调整。</span></p>', '1', '9991', '2019-08-06 00:00:00', '2019-08-26 13:55:05', '2019-09-05 14:25:11', null, '1', null, null, '1', null, null, null);
INSERT INTO `articles` VALUES ('12', null, null, '5', null, 'IVY小编', '【安唯夏令营】第2天~打卡世界名校-普林斯顿', null, '安唯夏令营的第2天', 'http://api.steptousa.cn/storage/cover/Q6WFi2WXmo85o1eP5gMjEVxFaUfyyVSEFweZfdFq.jpeg', '<p class=\"ql-align-center\"><br></p><p class=\"ql-align-center\"><strong class=\"ql-size-large\">安唯夏令营的第2天</strong></p><p><br></p><p class=\"ql-align-center\"><strong class=\"ql-size-large\">?&nbsp;</strong><strong class=\"ql-size-large\" style=\"background-color: rgb(215, 227, 188); color: rgb(0, 0, 0);\">出发 费城~</strong></p><p class=\"ql-align-center\"><span class=\"ql-size-large\">告别首都华盛顿 Bye~Bye~~</span></p><p class=\"ql-align-center\"><span class=\"ql-size-large\">前往曾经的首都费城 ? ? ?</span></p><p class=\"ql-align-center\"><span class=\"ql-size-large\">初识 Philiadelphia</span></p><p class=\"ql-align-center\"><span class=\"ql-size-large\">是那部奥斯卡获奖影片 【费城故事】</span></p><p class=\"ql-align-center\"><strong class=\"ql-size-large\" style=\"color: rgb(112, 48, 160);\">「费城这个城市是人权的象征。」</strong></p><p class=\"ql-align-center\"><span class=\"ql-size-large\">这是影片中的一句台词，</span></p><p class=\"ql-align-center\"><span class=\"ql-size-large\">这座城市在美国独立战争时，</span></p><p class=\"ql-align-center\"><span class=\"ql-size-large\">是独立运动的重要中心，</span></p><p class=\"ql-align-center\"><span class=\"ql-size-large\">它的历史意义代表了一切~</span></p><p class=\"ql-align-center\"><span class=\"ql-size-large\">古老的城区诉说着它值得骄傲的历史</span></p><p class=\"ql-align-center\"><img src=\"http://api.steptousa.cn/storage/editor/e37v7hJgsIZVWcWWoJZChc8MAeLm9x3nCx6ejV9P.jpeg\"></p><p class=\"ql-align-center\"><span class=\"ql-size-large\">?&nbsp;</span><strong style=\"color: rgb(0, 0, 0); background-color: rgb(215, 227, 188);\" class=\"ql-size-large\">名校第1站 - 普林斯顿大学</strong></p><p class=\"ql-align-center\"><br></p><p class=\"ql-align-center\"><span class=\"ql-size-large\">短暂停留费城后，</span></p><p class=\"ql-align-center\"><span class=\"ql-size-large\">我们驱车前往世界名校普林斯顿大学。</span></p><p class=\"ql-align-center\"><img src=\"http://api.steptousa.cn/storage/editor/0lNARGT3uM2e5J9OpQmpT2yPPIL06EPqwyT0rdhJ.jpeg\"></p><p class=\"ql-align-center\"><strong style=\"color: rgb(255, 255, 255);\">学校简介：</strong></p><p class=\"ql-align-center\"><span class=\"ql-size-large\" style=\"color: rgb(0, 32, 96);\">如果您对美国留学感兴趣，</span></p><p class=\"ql-align-center\"><span class=\"ql-size-large\" style=\"color: rgb(0, 32, 96);\">如果您的孩子有赴美求学的打算，</span></p><p class=\"ql-align-center\"><span class=\"ql-size-large\" style=\"color: rgb(0, 32, 96);\">如果您想给孩子的未来多一个选择，</span></p><p class=\"ql-align-center\"><span class=\"ql-size-large\" style=\"color: rgb(0, 32, 96);\">点击</span><a href=\"https://mp.weixin.qq.com/cgi-bin/appmsg?t=media/appmsg_edit&amp;action=edit&amp;type=10&amp;appmsgid=100000153&amp;isMul=1&amp;token=767305476&amp;lang=zh_CN\" target=\"_blank\" class=\"ql-size-large\" style=\"color: rgb(87, 107, 149); background-color: rgb(255, 251, 0);\"><strong>在线报名</strong></a><span class=\"ql-size-large\" style=\"color: rgb(0, 32, 96);\">安唯IVY专属顾问将与您联系！</span></p><p class=\"ql-align-center\"><span class=\"ql-size-large\" style=\"color: rgb(0, 32, 96);\">在安唯IVY，每个孩子都是独特的个体，</span></p><p class=\"ql-align-center\"><span class=\"ql-size-large\" style=\"color: rgb(0, 32, 96);\">我们将全心为每个孩子量身定制申请方案，</span></p><p class=\"ql-align-center\"><span class=\"ql-size-large\" style=\"color: rgb(0, 32, 96);\">为孩子的海外留学保驾护航！</span></p><p class=\"ql-align-center\"><br></p><p class=\"ql-align-center\"><br></p><p class=\"ql-align-center\"><strong class=\"ql-size-large\">扫码关注我们</strong></p><p class=\"ql-align-center\"><strong class=\"ql-size-large\">了解更多留学资讯</strong></p><p class=\"ql-align-center\"><strong class=\"ql-size-large\">﻿</strong></p><p class=\"ql-align-center\"><span class=\"ql-size-large\"><img src=\"http://api.steptousa.cn/storage/editor/tGpJBsESl2aAYRTFpmys16Pf1MxjePqBjUg2RqKg.jpeg\"></span></p><p class=\"ql-align-center\"><span class=\"ql-size-large\" style=\"color: rgb(0, 32, 96); background-color: rgba(255, 255, 255, 0.16);\">安唯（中国）IVY (China) Study Abroad Service Center 和位于美国纽约的总公司协同开展业务，旨在提供基于美国的优越教育资源，为全球来美学生提供全方位留学服务。我们面向各国学生提供来美学校申请、住宿寄宿、课程补习、课外实践、心理辅导等方面的完整解决方案，可根据不同的需求及侧重点做个性化调整。</span></p>', '1', '9990', '2019-08-07 00:00:00', '2019-08-26 14:06:17', '2019-09-05 14:21:49', null, '1', null, null, '1', null, null, null);
INSERT INTO `articles` VALUES ('13', null, null, '5', null, 'IVY小编', '【安唯夏令营】第3天~走访世界名校-耶鲁大学', null, '安唯夏令营的第3天', 'http://api.steptousa.cn/storage/cover/pF7V8s60Mmanbe4dU89WDkuGzCy9DNdji3EnSNnE.jpeg', '<p><br></p><p class=\"ql-align-center\"><strong class=\"ql-size-large\">安唯夏令营的第3天</strong></p><p><br></p><p class=\"ql-align-center\"><strong class=\"ql-size-large\">?&nbsp;</strong><strong style=\"background-color: rgb(155, 187, 89); color: rgb(0, 0, 0);\" class=\"ql-size-large\">HELLO YALE~</strong></p><p class=\"ql-align-center\"><br></p><p class=\"ql-align-center\"><span class=\"ql-size-large\">世界名校第2站&nbsp;</span></p><p class=\"ql-align-center\"><span class=\"ql-size-large\">我们来到了位于纽黑文的耶鲁大学</span></p><p class=\"ql-align-center\"><span class=\"ql-size-large\">在耶鲁学长的引导下</span></p><p class=\"ql-align-center\"><span class=\"ql-size-large\">种草了这所常春藤名校</span></p><p class=\"ql-align-center\"><span class=\"ql-size-large\">古典、秀丽的哥特式建筑</span></p><p class=\"ql-align-center\"><span class=\"ql-size-large\">完全可以和普林斯顿媲美</span></p><p class=\"ql-align-center\"><span class=\"ql-size-large\">阳光斜照在百年历史的古典建筑物上</span></p><p class=\"ql-align-center\"><span class=\"ql-size-large\">使整个校园处处弥漫着古典浪漫气息</span></p><p class=\"ql-align-center\"><img src=\"http://api.steptousa.cn/storage/editor/AfUUb2tiXTQH6KCvyzJBgmLyRykSCR00mEHyG02o.jpeg\"></p><p class=\"ql-align-center\"><img src=\"http://api.steptousa.cn/storage/editor/nY2isXQNcxKJgDvIOX8liLWq7F83mzsWEkKPf6w6.jpeg\"></p><p class=\"ql-align-center\"><br></p><p class=\"ql-align-center\"><span class=\"ql-size-large\">?&nbsp;</span><strong style=\"background-color: rgb(215, 227, 188);\" class=\"ql-size-large\">波士顿，我们来啦</strong></p><p class=\"ql-align-center\"><br></p><p class=\"ql-align-center\"><span class=\"ql-size-large\">告别耶鲁大学</span></p><p class=\"ql-align-center\"><span class=\"ql-size-large\">我们驱车前往波士顿</span></p><p class=\"ql-align-center\"><img src=\"http://api.steptousa.cn/storage/editor/VhYQRrIhoWbXL8TbNiypQanpnef62eXaSW34eBgt.jpeg\"></p><p class=\"ql-align-center\"><br></p><p class=\"ql-align-center\"><span style=\"color: rgb(0, 32, 96);\" class=\"ql-size-large\">如果您对美国留学感兴趣，</span></p><p class=\"ql-align-center\"><span style=\"color: rgb(0, 32, 96);\" class=\"ql-size-large\">如果您的孩子有赴美求学的打算，</span></p><p class=\"ql-align-center\"><span style=\"color: rgb(0, 32, 96);\" class=\"ql-size-large\">如果您想给孩子的未来多一个选择，</span></p><p class=\"ql-align-center\"><span style=\"color: rgb(0, 32, 96);\" class=\"ql-size-large\">点击</span><a href=\"https://mp.weixin.qq.com/cgi-bin/appmsg?t=media/appmsg_edit&amp;action=edit&amp;type=10&amp;appmsgid=100000166&amp;isMul=1&amp;token=767305476&amp;lang=zh_CN\" target=\"_blank\" style=\"color: rgb(87, 107, 149);\" class=\"ql-size-large\">在线报名</a><span style=\"color: rgb(0, 32, 96);\" class=\"ql-size-large\">安唯IVY专属顾问将与您联系！</span></p><p class=\"ql-align-center\"><span style=\"color: rgb(0, 32, 96);\" class=\"ql-size-large\">在安唯IVY，每个孩子都是独特的个体，</span></p><p class=\"ql-align-center\"><span style=\"color: rgb(0, 32, 96);\" class=\"ql-size-large\">我们将全心为每个孩子量身定制申请方案，</span></p><p class=\"ql-align-center\"><span style=\"color: rgb(0, 32, 96);\" class=\"ql-size-large\">为孩子的海外留学保驾护航！</span></p><p class=\"ql-align-center\"><br></p><p class=\"ql-align-center\"><br></p><p class=\"ql-align-center\"><strong class=\"ql-size-large\">扫码关注我们</strong></p><p class=\"ql-align-center\"><strong class=\"ql-size-large\">了解更多留学资讯</strong></p><p class=\"ql-align-center\"><span class=\"ql-size-large\"><img src=\"http://api.steptousa.cn/storage/editor/kK1cDJxQD7e7oC6zIaa05MRfPzkyheRSJw6zkybw.jpeg\"></span></p><p class=\"ql-align-center\"><span style=\"background-color: rgba(255, 255, 255, 0.16); color: rgb(0, 32, 96);\" class=\"ql-size-large\">安唯（中国）IVY (China) Study Abroad Service Center 和位于美国纽约的总公司协同开展业务，旨在提供基于美国的优越教育资源，为全球来美学生提供全方位留学服务。我们面向各国学生提供来美学校申请、住宿寄宿、课程补习、课外实践、心理辅导等方面的完整解决方案，可根据不同的需求及侧重点做个性化调整。</span></p>', '1', '9989', '2019-08-08 00:00:00', '2019-08-26 15:19:20', '2019-09-05 14:13:49', null, '1', null, null, '1', null, null, null);
INSERT INTO `articles` VALUES ('14', null, null, '5', null, 'IVY小编', '【安唯夏令营】第4天~探访顶级学府Harvard & MIT', null, '安唯夏令营的第4天', 'http://api.steptousa.cn/storage/cover/3HTDvsT7qcFvlaxcIwGrqBo43R6b7xtc3A9hlX7Y.jpeg', '<p class=\"ql-align-center\"><br></p><p class=\"ql-align-center\"><strong>安唯夏令营的第4天</strong></p><p><br></p><p class=\"ql-align-center\"><strong>?&nbsp;</strong><strong style=\"background-color: rgb(155, 187, 89);\">Harvard~</strong></p><p class=\"ql-align-center\"><br></p><p class=\"ql-align-center\">&nbsp;波士顿的周边有着众多名校</p><p class=\"ql-align-center\">今天我们就前往剑桥城</p><p class=\"ql-align-center\">走访常春藤八校之一的哈佛大学</p><p class=\"ql-align-center\"><img src=\"http://api.steptousa.cn/storage/editor/hIcgBmGoIZDluxuAif354scD9uyAoaErj7xfrMGE.jpeg\"></p><p class=\"ql-align-center\"><img src=\"http://api.steptousa.cn/storage/editor/6xAbzCE361Yx3GU08uG9KFs8Es0ASr3xoYEDXRuu.jpeg\"></p><p><img src=\"http://api.steptousa.cn/storage/editor/5aLfPlU4aYoyJGyMv7WqkO6zYFC9Ucnt5WLOAgGd.jpeg\"></p><p><img src=\"http://api.steptousa.cn/storage/editor/JuXrOYy3SQToe5dpzklov1Z4jau7izbJLg1i6HD5.jpeg\"></p><p class=\"ql-align-center\"><br></p><p class=\"ql-align-center\"><span style=\"color: rgb(0, 32, 96);\">如果您对美国留学感兴趣，</span></p><p class=\"ql-align-center\"><span style=\"color: rgb(0, 32, 96);\">如果您的孩子有赴美求学的打算，</span></p><p class=\"ql-align-center\"><span style=\"color: rgb(0, 32, 96);\">如果您想给孩子的未来多一个选择，</span></p><p class=\"ql-align-center\"><span style=\"color: rgb(0, 32, 96);\">点击</span><a href=\"https://mp.weixin.qq.com/cgi-bin/appmsg?t=media/appmsg_edit&amp;action=edit&amp;type=10&amp;appmsgid=100000172&amp;isMul=1&amp;token=767305476&amp;lang=zh_CN\" target=\"_blank\" style=\"color: rgb(87, 107, 149); background-color: rgb(255, 251, 0);\"><strong>在线报名</strong></a><span style=\"color: rgb(0, 32, 96);\">安唯IVY专属顾问将与您联系！</span></p><p class=\"ql-align-center\"><span style=\"color: rgb(0, 32, 96);\">在安唯IVY，每个孩子都是独特的个体，</span></p><p class=\"ql-align-center\"><span style=\"color: rgb(0, 32, 96);\">我们将全心为每个孩子量身定制申请方案，</span></p><p class=\"ql-align-center\"><span style=\"color: rgb(0, 32, 96);\">为孩子的海外留学保驾护航！</span></p><p class=\"ql-align-center\"><br></p><p class=\"ql-align-center\"><br></p><p class=\"ql-align-center\"><strong>扫码关注我们</strong></p><p class=\"ql-align-center\"><strong>了解更多留学资讯</strong></p><p class=\"ql-align-center\"><img src=\"http://api.steptousa.cn/storage/editor/snGE7LADadGXRzkAXzZSDHavBrF6Ma1dTNGzUB6y.jpeg\"></p><p class=\"ql-align-center\"><br></p><p class=\"ql-align-center\"><span style=\"background-color: rgba(255, 255, 255, 0.16); color: rgb(0, 32, 96);\">安唯（中国）IVY (China) Study Abroad Service Center 和位于美国纽约的总公司协同开展业务，旨在提供基于美国的优越教育资源，为全球来美学生提供全方位留学服务。我们面向各国学生提供来美学校申请、住宿寄宿、课程补习、课外实践、心理辅导等方面的完整解决方案，可根据不同的需求及侧重点做个性化调整。</span></p>', '1', '9988', '2019-08-09 00:00:00', '2019-08-26 15:56:48', '2019-09-05 14:06:18', null, '1', null, null, '1', null, null, null);
INSERT INTO `articles` VALUES ('15', null, null, '5', null, 'IVY小编', '【安唯夏令营】第5天~纽约~纽约~', null, '安唯夏令营的第5天', 'http://api.steptousa.cn/storage/cover/vpeiKOSl2zlfA7n02eCJ4HNxYmHUbylMkbyMgxng.jpeg', '<p><br></p><p class=\"ql-align-center\"><strong class=\"ql-size-large\">安唯夏令营的第5天</strong></p><p><br></p><p class=\"ql-align-center\"><strong class=\"ql-size-large\">?&nbsp;</strong><strong style=\"background-color: rgb(155, 187, 89);\" class=\"ql-size-large\">纽约~纽约~</strong></p><p class=\"ql-align-center\"><img src=\"http://api.steptousa.cn/storage/editor/lf2jj8cwmrjv45iAHoiEeS85OfDxkpMXQu6kKIVj.jpeg\"></p><p><br></p><p class=\"ql-align-center\"><strong class=\"ql-size-large\">这座城市有着不可抗拒的魔力</strong></p><p class=\"ql-align-center\"><strong class=\"ql-size-large\">终于可以亲自体验一回</strong></p><p class=\"ql-align-center\"><strong class=\"ql-size-large\">它的文艺、前卫、包容</strong></p><p class=\"ql-align-center\"><strong class=\"ql-size-large\">它的繁华、自由、独特</strong></p><p class=\"ql-align-center\"><strong class=\"ql-size-large\">它的冷漠、混乱、怪诞</strong></p><p class=\"ql-align-center\"><span class=\"ql-size-large\">……</span></p><p><img src=\"http://api.steptousa.cn/storage/editor/P7CXZEY3Jg4ug4qddB5qs2ERmagcP3JQlQHHJBMa.jpeg\"><img src=\"http://api.steptousa.cn/storage/editor/cLPdc7dH888PwPwQJ2OwZ1KPcb9deoNV6dz2VrYv.jpeg\"></p><p class=\"ql-align-justify\"><img src=\"http://api.steptousa.cn/storage/editor/PlpqyowJMMtEwf9PIlsICWZeLOKbbbgjYuGoZ1Ld.jpeg\"><img src=\"http://api.steptousa.cn/storage/editor/mT6SBgIGzzAzVsLXRWNyXOKWJCTyCBWtc9DXkTSR.jpeg\"><img src=\"http://api.steptousa.cn/storage/editor/0uwRE9EjmJUFWjNIeEZ893YdPlY5qY7aKGpTdiDw.jpeg\"><img src=\"http://api.steptousa.cn/storage/editor/b80H6dm7gUyWicXHaZeQgo9rjv2VvzcZL0TQX6lc.jpeg\"></p><p><img src=\"http://api.steptousa.cn/storage/editor/HUysPPgfJnTCRr22QHWI4bKzcZwPdwLtcayZjlPI.jpeg\"></p><p class=\"ql-align-center\"><br></p><p class=\"ql-align-center\"><br></p><p class=\"ql-align-center\"><span style=\"color: rgb(0, 32, 96);\" class=\"ql-size-large\">如果您对美国留学感兴趣，</span></p><p class=\"ql-align-center\"><span style=\"color: rgb(0, 32, 96);\" class=\"ql-size-large\">如果您的孩子有赴美求学的打算，</span></p><p class=\"ql-align-center\"><span style=\"color: rgb(0, 32, 96);\" class=\"ql-size-large\">如果您想给孩子的未来多一个选择，</span></p><p class=\"ql-align-center\"><span style=\"color: rgb(0, 32, 96);\" class=\"ql-size-large\">点击</span><a href=\"https://mp.weixin.qq.com/cgi-bin/appmsg?t=media/appmsg_edit&amp;action=edit&amp;type=10&amp;appmsgid=100000177&amp;isMul=1&amp;token=767305476&amp;lang=zh_CN\" target=\"_blank\" style=\"color: rgb(87, 107, 149);\" class=\"ql-size-large\"><strong>在线报名</strong></a><span style=\"color: rgb(0, 32, 96);\" class=\"ql-size-large\">安唯IVY专属顾问将与您联系！</span></p><p class=\"ql-align-center\"><span style=\"color: rgb(0, 32, 96);\" class=\"ql-size-large\">在安唯IVY，每个孩子都是独特的个体，</span></p><p class=\"ql-align-center\"><span style=\"color: rgb(0, 32, 96);\" class=\"ql-size-large\">我们将全心为每个孩子量身定制申请方案，</span></p><p class=\"ql-align-center\"><span style=\"color: rgb(0, 32, 96);\" class=\"ql-size-large\">为孩子的海外留学保驾护航！</span></p><p class=\"ql-align-center\"><br></p><p class=\"ql-align-center\"><br></p><p class=\"ql-align-center\"><strong class=\"ql-size-large\">扫码关注我们</strong></p><p class=\"ql-align-center\"><strong class=\"ql-size-large\">了解更多留学资讯</strong></p><p class=\"ql-align-center\"><span class=\"ql-size-large\"><img src=\"http://api.steptousa.cn/storage/editor/hBQaUWfI8qHiM33udTn5Q3JjgYoe5WnxcyIKuttc.jpeg\"></span></p><p class=\"ql-align-center\"><span style=\"background-color: rgba(255, 255, 255, 0.16); color: rgb(0, 32, 96);\" class=\"ql-size-large\">安唯（中国）IVY (China) Study Abroad Service Center 和位于美国纽约的总公司协同开展业务，旨在提供基于美国的优越教育资源，为全球来美学生提供全方位留学服务。我们面向各国学生提供来美学校申请、住宿寄宿、课程补习、课外实践、心理辅导等方面的完整解决方案，可根据不同的需求及侧重点做个性化调整。</span></p>', '1', '9987', '2019-08-10 00:00:00', '2019-08-26 16:18:39', '2019-09-05 11:26:33', null, '1', null, null, '1', null, null, null);
INSERT INTO `articles` VALUES ('16', null, null, '5', null, 'IVY小编', '【安唯夏令营】第6天~大都会艺术博物馆 & YMCA入营', null, '安唯夏令营的第6天', 'http://api.steptousa.cn/storage/cover/COxW5t8DEqFUjhPIBQ7VO3T0eQdhx1KpOEDMO4Lk.jpeg', '<p><br></p><p class=\"ql-align-center\"><strong>安唯夏令营的第6天</strong></p><p><br></p><p class=\"ql-align-center\"><strong>?&nbsp;</strong><strong style=\"background-color: rgb(155, 187, 89);\">大都会艺术博物馆</strong></p><p class=\"ql-align-center\"><br></p><p class=\"ql-align-center\">纽约，世界当代艺术的中心</p><p class=\"ql-align-center\">所有艺术爱好者的天堂</p><p class=\"ql-align-center\">今天，我们来到美国最大的艺术博物馆</p><p class=\"ql-align-center\">Metropolitan Museum of Art</p><p class=\"ql-align-center\">​享受一场艺术盛宴</p><p class=\"ql-align-center\"><img src=\"http://api.steptousa.cn/storage/editor/gea45LbLqGBkmzgOk2sYnAVDnCzXJgZTzfYRX3Wp.jpeg\"></p><p><br></p><p><br></p><p><strong>	</strong><strong style=\"color: rgb(51, 51, 51);\">Metropolitan Museum of Art</strong></p><p>大都会艺术博物馆是美国最大的艺术博物馆，也是世界著名博物馆，位于美国纽约第五大道的82号大街，记录了人类自身的文明史的发展。该博物馆占地面积为13万平方米，它是与北京的故宫、伦敦的大英博物馆、巴黎的卢浮宫、圣彼得堡的艾尔米塔什博物馆齐名的世界五大博物馆之一，馆藏超过三百万件艺术品。包括许多出众的古典艺术品、古埃及艺术品、几乎所有欧洲大师的油画及大量美国视觉艺术和现代艺术作品。博物馆还收藏有丰富的非洲、亚洲、大洋洲、拜占庭和伊斯兰艺术品，同时也是世界乐器、服装、饰物、武器、盔甲的大总汇。室内设计模仿不同历史时期的风格，从1世纪的罗马风格延续至现代美国。</p><p><img src=\"http://api.steptousa.cn/storage/editor/7auNUOevaTXWLQUhs93LJshSy5Tw2n7fJKH56uZD.jpeg\"></p><p><strong style=\"color: rgb(127, 127, 127);\">认真读指南，专心看展品</strong></p><p><img src=\"http://api.steptousa.cn/storage/editor/IIkGiT2a3K0ztqc8hQ20oh471hAmpyhzapmpKiyS.jpeg\"></p><p><img src=\"http://api.steptousa.cn/storage/editor/Mwc3gNaPAOKunDGsCM3Vdh5IuYGjsSAHSZCEMvh3.jpeg\"></p><p class=\"ql-align-center\">走马观花地欣赏了半天</p><p class=\"ql-align-center\">就要匆匆离开了</p><p class=\"ql-align-center\">意犹未尽</p><p class=\"ql-align-center\">下一次留足时间再细细品味 ❤</p><p class=\"ql-align-center\"><br></p><p class=\"ql-align-center\"><strong>?&nbsp;</strong><strong style=\"background-color: rgb(155, 187, 89);\">YMCA~我们来啦</strong></p><p class=\"ql-align-center\"><br></p><p class=\"ql-align-center\">离开大都会</p><p class=\"ql-align-center\">孩子们启程前往YMCA营地</p><p class=\"ql-align-center\">本次夏令营的后半段重头戏</p><p class=\"ql-align-center\">营地探索之旅正式开启 ✌</p><p class=\"ql-align-center\"><br></p><p class=\"ql-align-center\"><strong style=\"background-color: rgb(215, 227, 188);\">入住小木屋，遇见新伙伴</strong></p><p class=\"ql-align-center\"><img src=\"http://api.steptousa.cn/storage/editor/JmxXRGYnuGWwSw54w3xJIZ4yvisvq43shv0uwCLn.jpeg\"></p><p class=\"ql-align-center\"><br></p><p class=\"ql-align-center\"><strong>营地的活动非常丰富</strong></p><p class=\"ql-align-center\"><strong>第一个任务</strong></p><p class=\"ql-align-center\"><strong style=\"background-color: rgb(215, 227, 188);\">选择感兴趣的营地活动</strong></p><p class=\"ql-align-center\"><img src=\"http://api.steptousa.cn/storage/editor/335FtXc2dZD9CrM8kpak3P3dMlngVPqmF0zW1v4K.jpeg\"></p><p class=\"ql-align-center\"><br></p><p class=\"ql-align-center\"><strong style=\"background-color: rgb(215, 227, 188);\">在餐厅，和各国小伙伴交流</strong></p><p class=\"ql-align-center\"><img src=\"http://api.steptousa.cn/storage/editor/btbnw6ZYEehDpXpwrQicR6WiaC604BnYPVKECXon.jpeg\"></p><p class=\"ql-align-center\"><br></p><p class=\"ql-align-center\"><strong>入营小仪式</strong></p><p class=\"ql-align-center\"><strong style=\"background-color: rgb(215, 227, 188);\">听Guiders的话</strong></p><p class=\"ql-align-center\"><img src=\"http://api.steptousa.cn/storage/editor/N8GevgjJgYKX5yxzKnOdkAjdRVbEj7t5LUTjx27M.jpeg\"></p><p class=\"ql-align-center\"><br></p><p class=\"ql-align-center\">营地的第一天</p><p class=\"ql-align-center\">孩子们虽然略显拘谨</p><p class=\"ql-align-center\">表现都挺不错哟</p><p class=\"ql-align-center\">期待接下来的几天</p><p class=\"ql-align-center\">YMCA的丰富活动</p><p class=\"ql-align-center\">见证孩子们的成长</p><p class=\"ql-align-center\">❤❤❤</p><p class=\"ql-align-center\"><br></p><p class=\"ql-align-center\"><strong>Sixth Day&nbsp;</strong></p><p><br></p><p class=\"ql-align-justify\"><span style=\"color: rgb(0, 32, 96);\">如果您对美国留学感兴趣，</span></p><p class=\"ql-align-justify\"><span style=\"color: rgb(0, 32, 96);\">如果您的孩子有赴美求学的打算，</span></p><p class=\"ql-align-justify\"><span style=\"color: rgb(0, 32, 96);\">如果您想给孩子的未来多一个选择，</span></p><p class=\"ql-align-justify\"><span style=\"color: rgb(0, 32, 96);\">点击在线报名安唯IVY专属顾问将与您联系！</span></p><p class=\"ql-align-justify\"><span style=\"color: rgb(0, 32, 96);\">在安唯IVY，每个孩子都是独特的个体，</span></p><p class=\"ql-align-justify\"><span style=\"color: rgb(0, 32, 96);\">我们将全心为每个孩子量身定制申请方案，</span></p><p class=\"ql-align-justify\"><span style=\"color: rgb(0, 32, 96);\">为孩子的海外留学保驾护航！</span></p><p class=\"ql-align-justify\"><br></p><p><br></p><p><strong>扫码关注我们</strong></p><p><strong>了解更多留学资讯</strong></p><p><img src=\"http://api.steptousa.cn/storage/editor/TLbXNVahb4w37bybr23g5CKpwShdjqJx9B1Omlwp.jpeg\"></p><p class=\"ql-align-justify\"><br></p><p class=\"ql-align-justify\"><span style=\"color: rgb(0, 32, 96); background-color: rgba(255, 255, 255, 0.16);\">安唯（中国）IVY (China) Study Abroad Service Center 和位于美国纽约的总公司协同开展业务，旨在提供基于美国的优越教育资源，为全球来美学生提供全方位留学服务。我们面向各国学生提供来美学校申请、住宿寄宿、课程补习、课外实践、心理辅导等方面的完整解决方案，可根据不同的需求及侧重点做个性化调整。</span></p>', '1', '9986', '2019-08-11 00:00:00', '2019-08-27 10:16:32', '2019-09-05 10:58:37', null, '1', null, null, '1', null, null, null);
INSERT INTO `articles` VALUES ('17', null, null, '5', null, 'IVY小编', '【安唯夏令营】第7-8天~YMCA 玩耍ing', null, '安唯夏令营的第7-8天', 'http://api.steptousa.cn/storage/cover/lyuHm04X5unWcZNzZsRiSGstujeRFCqY763KkPn8.jpeg', '<p><br></p><p class=\"ql-align-center\"><strong>安唯夏令营的第7-8天</strong></p><p class=\"ql-align-center\"><br></p><p class=\"ql-align-center\">​早对YMCA有所耳闻</p><p class=\"ql-align-center\">? 历史悠久、全球知名...</p><p class=\"ql-align-center\">终于营地生活正式开始拉?</p><p class=\"ql-align-center\">我们所在的营地</p><p class=\"ql-align-center\">纽约郊区的Greenkill</p><p class=\"ql-align-center\">先来看看营地的环境</p><p class=\"ql-align-center\">绿树环绕、空气宜人</p><p class=\"ql-align-center\">赶紧深呼吸一下?</p><p><img src=\"http://api.steptousa.cn/storage/editor/Kmsbe2FLUlWYYPWxmFDwGV1apMSYpvZs7p7evnLT.jpeg\"></p><p><img src=\"http://api.steptousa.cn/storage/editor/t15lou03FTtyjuNTSQVTC5LXuKi1rfhaW9rwOi1G.jpeg\"></p><p><img src=\"http://api.steptousa.cn/storage/editor/sNoI4XHHGLHalY3F5WM9alKavopI1rhT1iE5gMJt.jpeg\"></p><p class=\"ql-align-center\"><br></p><p class=\"ql-align-center\"><br></p><p class=\"ql-align-center\">营地里的两个餐厅</p><p class=\"ql-align-center\">维持了木屋的结构</p><p><img src=\"http://api.steptousa.cn/storage/editor/EGDSbYfUzz3I2xvPDiWJTYlTw1evgtZOwoIpdv4z.jpeg\"></p><p><img src=\"http://api.steptousa.cn/storage/editor/xMLr8FzEPUM78La4Z4Jla1MqLdLBPhvQZZ8b021a.jpeg\"></p><p><br></p><p><br></p><p class=\"ql-align-center\">餐厅内摆放的方桌、圆桌</p><p class=\"ql-align-center\">方便小伙伴们围在一起交流</p><p class=\"ql-align-center\"><img src=\"http://api.steptousa.cn/storage/editor/AZ9AY3EQUTvLog6LWQHUX8oH35vPS1tW3MIIUw5w.jpeg\"></p><p class=\"ql-align-center\"><br></p><p class=\"ql-align-center\">水上项目的场地</p><p class=\"ql-align-center\"><img src=\"http://api.steptousa.cn/storage/editor/XaVfnTWu7I3sxkLNectrjvImqY65HaA1moukrN4I.jpeg\"></p><p><br></p><p><br></p><p class=\"ql-align-center\">在营地里</p><p class=\"ql-align-center\">一天可以参加好几场活动</p><p class=\"ql-align-center\">根据入营时的选择</p><p class=\"ql-align-center\">我们的小营员分散到了各个小组</p><p class=\"ql-align-center\">黄皮肤、白皮肤、黑皮肤</p><p class=\"ql-align-center\">只能用英语交流啦?</p><p><img src=\"http://api.steptousa.cn/storage/editor/VFhrUNPNeUFeDwC7GYY825qPkbsPtXAywN1WPM6l.jpeg\"></p><p class=\"ql-align-center\"><br></p><p class=\"ql-align-center\">那么美腻的环境</p><p class=\"ql-align-center\">户外活动是不能错过哒</p><p class=\"ql-align-center\">听说这叫Gaga Ball</p><p class=\"ql-align-center\">热身热身，动起来 ?</p><p class=\"ql-align-center\"><br></p><iframe class=\"ql-video\" frameborder=\"0\" allowfullscreen=\"true\" src=\"https://www.steptousa.cn/file/YMCA-1.mp4\"></iframe><p><br></p><p class=\"ql-align-center\"><img src=\"http://api.steptousa.cn/storage/editor/rGL0P4CnKiS97qJDoLwklHQnPI0LToWkI8gWodzp.jpeg\"></p><p><br></p><p class=\"ql-align-center\">手工课很受欢迎</p><p class=\"ql-align-center\">还是第一次玩这样的“撕纸作画”?</p><p class=\"ql-align-center\">大胆发挥无限的想象力吧?</p><p class=\"ql-align-justify\"><br></p><iframe class=\"ql-video\" frameborder=\"0\" allowfullscreen=\"true\" src=\"https://www.steptousa.cn/file/YMCA-2.mp4\"></iframe><p><br></p><p><img src=\"http://api.steptousa.cn/storage/editor/ga1OgErh2Up6QX2le49wtXjbRr3paxVWtnrgI0xy.jpeg\"></p><p>成品图 ?</p><p><img src=\"http://api.steptousa.cn/storage/editor/phSygKrwaUBfYxOWlZw7QlgdSwpgFEv4ChaAmu9d.jpeg\"></p><p class=\"ql-align-center\"><br></p><p class=\"ql-align-center\">除了“撕纸作画”</p><p class=\"ql-align-center\">陶艺课也很interesting</p><p class=\"ql-align-center\">我捏，我捏，我捏捏捏</p><p><img src=\"http://api.steptousa.cn/storage/editor/hFqMrUa8wQLbHyionPKEfaN4p2U0PuuZWxl2fZxX.jpeg\"></p><p class=\"ql-align-center\"><br></p><p class=\"ql-align-center\">烧脑活动</p><p class=\"ql-align-center\">规则听起来有点似懂非懂</p><p class=\"ql-align-center\">赶紧找小哥哥问问清楚</p><p class=\"ql-align-center\">原来和我们的三国杀差不多嘛?</p><p>桌游</p><p><img src=\"http://api.steptousa.cn/storage/editor/fmPaQPAz8ZSCnHcAlvsoTFDZ0EB3NPwxdTKees2n.jpeg\"></p><p class=\"ql-align-center\"><br></p><p class=\"ql-align-center\">欢快地玩耍过后</p><p class=\"ql-align-center\">大家都渐渐适应了营地生活</p><p class=\"ql-align-center\">虽然有一点点疲惫</p><p class=\"ql-align-center\">但不停吸收、成长的感觉好棒</p><p class=\"ql-align-center\">明天精彩继续&nbsp;</p><p class=\"ql-align-center\">?????</p><p><img src=\"http://api.steptousa.cn/storage/editor/fXtkrU9NymnhvKDK255FAUCloFLU6XZULpXyDktZ.jpeg\"></p><p><br></p><p class=\"ql-align-justify\"><span style=\"color: rgb(0, 32, 96);\">如果您对美国留学感兴趣，</span></p><p class=\"ql-align-justify\"><span style=\"color: rgb(0, 32, 96);\">如果您的孩子有赴美求学的打算，</span></p><p class=\"ql-align-justify\"><span style=\"color: rgb(0, 32, 96);\">如果您想给孩子的未来多一个选择，</span></p><p class=\"ql-align-justify\"><span style=\"color: rgb(0, 32, 96);\">点击</span><a href=\"https://mp.weixin.qq.com/cgi-bin/appmsg?t=media/appmsg_edit&amp;action=edit&amp;type=10&amp;appmsgid=100000187&amp;isMul=1&amp;token=490814245&amp;lang=zh_CN\" target=\"_blank\" style=\"color: rgb(87, 107, 149); background-color: rgb(255, 251, 0);\"><strong>在线报名</strong></a><span style=\"color: rgb(0, 32, 96);\">安唯IVY专属顾问将与您联系！</span></p><p class=\"ql-align-justify\"><span style=\"color: rgb(0, 32, 96);\">在安唯IVY，每个孩子都是独特的个体，</span></p><p class=\"ql-align-justify\"><span style=\"color: rgb(0, 32, 96);\">我们将全心为每个孩子量身定制申请方案，</span></p><p class=\"ql-align-justify\"><span style=\"color: rgb(0, 32, 96);\">为孩子的海外留学保驾护航！</span></p><p class=\"ql-align-justify\"><br></p><p><br></p><p><br></p><p><strong>扫码关注我们</strong></p><p><strong>了解更多留学资讯</strong></p><p class=\"ql-align-justify\"><img src=\"http://api.steptousa.cn/storage/editor/u91ARMrSccaCtY2dEYPWTPba0nf8HilONIt4ZA80.jpeg\"></p><p class=\"ql-align-justify\"><span style=\"background-color: rgba(255, 255, 255, 0.16); color: rgb(0, 32, 96);\">安唯（中国）IVY (China) Study Abroad Service Center 和位于美国纽约的总公司协同开展业务，旨在提供基于美国的优越教育资源，为全球来美学生提供全方位留学服务。我们面向各国学生提供来美学校申请、住宿寄宿、课程补习、课外实践、心理辅导等方面的完整解决方案，可根据不同的需求及侧重点做个性化调整。</span></p>', '1', '9985', '2019-08-12 00:00:00', '2019-08-27 10:45:59', '2019-09-04 15:40:03', null, '1', null, null, '1', null, null, null);
INSERT INTO `articles` VALUES ('18', null, null, '5', null, 'IVY小编', '【安唯夏令营】第9天~精彩继续', null, '安唯夏令营的第9天', 'http://api.steptousa.cn/storage/cover/aOgUTqMWQelweCuzyLDcJxp28KMzaQWMFeGpwkSm.jpeg', '<p class=\"ql-align-justify\"><br></p><p class=\"ql-align-center\"><strong>安唯夏令营的第9天</strong></p><p class=\"ql-align-center\"><br></p><p class=\"ql-align-center\">​在营地的生活进入了第4天拉</p><p class=\"ql-align-center\">童鞋们越来越在状态</p><p class=\"ql-align-center\">美好的一天从例会开始</p><p class=\"ql-align-center\"><br></p><iframe class=\"ql-video\" frameborder=\"0\" allowfullscreen=\"true\" src=\"https://www.steptousa.cn/file/YMCA-3.mp4\"></iframe><p><br></p><p><img src=\"http://api.steptousa.cn/storage/editor/yPsA27L6lhddcWDNJtnJs6wDV2RSOc7JLAw4rvQl.jpeg\"></p><p><br></p><p class=\"ql-align-center\"><br></p><p class=\"ql-align-center\">今天终于有独木舟拉</p><p class=\"ql-align-center\">勇敢尝试一下</p><p class=\"ql-align-center\">原来不难又好玩?</p><p><br></p><iframe class=\"ql-video\" frameborder=\"0\" allowfullscreen=\"true\" src=\"https://www.steptousa.cn/file/YMCA-4.mp4\"></iframe><p><br></p><p><img src=\"http://api.steptousa.cn/storage/editor/ZQ2KnQhHibA1rInVZmU2x2RGnE6ou6VrD2sZ6pSz.jpeg\"></p><p class=\"ql-align-center\"><br></p><p class=\"ql-align-center\">瑜伽做过不少</p><p class=\"ql-align-center\">在草地上做瑜伽</p><p class=\"ql-align-center\">这样的体验还是第一次</p><p class=\"ql-align-center\">大自然的味道</p><p class=\"ql-align-center\">如此清新</p><p><img src=\"http://api.steptousa.cn/storage/editor/4EqCzVAaSVgGDACeNewfBHQery4D81bbANAoUTg3.jpeg\"></p><p class=\"ql-align-center\"><br></p><p class=\"ql-align-center\">球类运动</p><p class=\"ql-align-center\">也是不能错过的项目</p><p><br></p><iframe class=\"ql-video\" frameborder=\"0\" allowfullscreen=\"true\" src=\"https://www.steptousa.cn/file/YMCA-5.mp4\"></iframe><p><br></p><p><img src=\"http://api.steptousa.cn/storage/editor/83FqKoPHKWIC83hpZj2MCwVFLUt5ycZBW3KajUDV.jpeg\"></p><p class=\"ql-align-center\"><br></p><p class=\"ql-align-center\">户外玩耍好了</p><p class=\"ql-align-center\">室内手工课走起~</p><p class=\"ql-align-center\">接着昨天的陶艺</p><p class=\"ql-align-center\">继续捏捏捏</p><p class=\"ql-align-center\"><img src=\"http://api.steptousa.cn/storage/editor/HIEWVspXZNTkzYW6WbEhkk5s8R9JD1qBvNmMF9G3.jpeg\"></p><p class=\"ql-align-center\"><br></p><p class=\"ql-align-center\">编绳活动</p><p class=\"ql-align-center\">交流很顺畅</p><p class=\"ql-align-center\">还交了新朋友</p><p class=\"ql-align-center\">互留了Email ✌</p><p class=\"ql-align-center\"><img src=\"http://api.steptousa.cn/storage/editor/2fGaVuLQSFExiAJEkBYnB8UPZ4ovnEoKiPV4dLNB.jpeg\"></p><p class=\"ql-align-center\"><br></p><p class=\"ql-align-center\">木棒创作</p><p class=\"ql-align-center\">再次发挥无限想象力</p><p class=\"ql-align-center\">成品很棒哟</p><p class=\"ql-align-center\"><img src=\"http://api.steptousa.cn/storage/editor/QJSFkSELlQKP1As8sC6ICGNfLfKzqEBQh4m3a282.jpeg\"></p><p class=\"ql-align-center\"><br></p><p class=\"ql-align-center\">\"撕纸作画\"的成品</p><p class=\"ql-align-center\">手动点无限赞???</p><p class=\"ql-align-center\"><img src=\"http://api.steptousa.cn/storage/editor/wwi10E8jwCQDaJlIsVOKT7RVkkxcIUFUBbGWyvFU.jpeg\"></p><p class=\"ql-align-center\"><br></p><p class=\"ql-align-center\">丰富多彩的一天</p><p class=\"ql-align-center\">在欢乐中结束</p><p class=\"ql-align-center\">明日继续</p><p class=\"ql-align-center\">晚安 (￣o￣) . z Z</p><p><br></p><p class=\"ql-align-justify\"><span style=\"color: rgb(0, 32, 96);\">如果您对美国留学感兴趣，</span></p><p class=\"ql-align-justify\"><span style=\"color: rgb(0, 32, 96);\">如果您的孩子有赴美求学的打算，</span></p><p class=\"ql-align-justify\"><span style=\"color: rgb(0, 32, 96);\">如果您想给孩子的未来多一个选择，</span></p><p class=\"ql-align-justify\"><span style=\"color: rgb(0, 32, 96);\">点击</span><a href=\"https://mp.weixin.qq.com/cgi-bin/appmsg?t=media/appmsg_edit&amp;action=edit&amp;type=10&amp;appmsgid=100000194&amp;isMul=1&amp;token=490814245&amp;lang=zh_CN\" target=\"_blank\" style=\"color: rgb(87, 107, 149); background-color: rgb(255, 251, 0);\"><strong>在线报名</strong></a><span style=\"color: rgb(0, 32, 96);\">安唯IVY专属顾问将与您联系！</span></p><p class=\"ql-align-justify\"><span style=\"color: rgb(0, 32, 96);\">在安唯IVY，每个孩子都是独特的个体，</span></p><p class=\"ql-align-justify\"><span style=\"color: rgb(0, 32, 96);\">我们将全心为每个孩子量身定制申请方案，</span></p><p class=\"ql-align-justify\"><span style=\"color: rgb(0, 32, 96);\">为孩子的海外留学保驾护航！</span></p><p><br></p><p><br></p><p><br></p><p><strong>扫码关注我们</strong></p><p><strong>了解更多留学资讯</strong></p><p><img src=\"http://api.steptousa.cn/storage/editor/BaNphT8UHUXG8BPcSG1H5czCl6s5mNlMbcqbpRfx.jpeg\"></p><p class=\"ql-align-justify\"><br></p><p><span style=\"background-color: rgba(255, 255, 255, 0.16); color: rgb(0, 32, 96);\">安唯（中国）IVY (China) Study Abroad Service Center 和位于美国纽约的总公司协同开展业务，旨在提供基于美国的优越教育资源，为全球来美学生提供全方位留学服务。我们面向各国学生提供来美学校申请、住宿寄宿、课程补习、课外实践、心理辅导等方面的完整解决方案，可根据不同的需求及侧重点做个性化调整。</span></p>', '1', '9984', '2019-08-13 00:00:00', '2019-08-27 11:08:23', '2019-09-04 15:00:50', null, '1', null, null, '1', null, null, null);
INSERT INTO `articles` VALUES ('19', null, null, '5', null, 'IVY小编', '【安唯夏令营】第10天~发现不一样的自己', null, '安唯夏令营的第10天', 'http://api.steptousa.cn/storage/cover/I3r8ToWRHTIhWcg8cb7WYgTrsnSq4K5Wvdt0Y2BY.jpeg', '<p class=\"ql-align-center\"><strong>安唯夏令营的第10天</strong></p><p class=\"ql-align-center\"><br></p><p class=\"ql-align-center\">​天气：阳光灿烂 ☀</p><p class=\"ql-align-center\">饮食：基本适应?</p><p class=\"ql-align-center\">贡献：打扫寝室?</p><p class=\"ql-align-center\"><br></p><p class=\"ql-align-center\">户外活动走起~</p><p class=\"ql-align-center\">再次体验水上项目</p><p class=\"ql-align-center\">勇敢地向前划 ✊</p><p class=\"ql-align-center\"><img src=\"http://api.steptousa.cn/storage/editor/K5rN1k1IKLDLzWR1PHRrOFTlqnoqMJMbZCnLV7fS.jpeg\"></p><p class=\"ql-align-center\"><br></p><p class=\"ql-align-center\">野外自然课</p><p class=\"ql-align-center\">认真听讲</p><p class=\"ql-align-center\">发现大自然的美</p><p class=\"ql-align-center\"><img src=\"http://api.steptousa.cn/storage/editor/MaPMYJiGluqLNzydqtPaVcjQnW4l3jmV1m3qSo0K.jpeg\"></p><p class=\"ql-align-center\"><br></p><p class=\"ql-align-center\">喜欢画画的童鞋们</p><p class=\"ql-align-center\">参加户外写生课</p><p class=\"ql-align-center\">作品一级棒?</p><p>户外写生</p><p class=\"ql-align-justify\"><img src=\"http://api.steptousa.cn/storage/editor/w1fPWm50LyQZowq5KLvpXxonKzJQBAstEhJmMK3M.jpeg\"></p><p class=\"ql-align-center\"><br></p><p class=\"ql-align-center\">热门课程之一——手工课</p><p class=\"ql-align-center\">专注地编绳中</p><p class=\"ql-align-center\">期待完工后的作品</p><p class=\"ql-align-center\"><img src=\"http://api.steptousa.cn/storage/editor/TkZx8hab0KeDnGFo1kOqrjs1EvxY9sRSrBlOMf7j.jpeg\"></p><p><br></p><p class=\"ql-align-center\">陶艺课进入到最后阶段</p><p class=\"ql-align-center\">给作品上色</p><p class=\"ql-align-center\">成品即将诞生✌</p><iframe class=\"ql-video\" frameborder=\"0\" allowfullscreen=\"true\" src=\"https://www.steptousa.cn/file/YMCA-6.mp4\"></iframe><p><img src=\"http://api.steptousa.cn/storage/editor/yCitFEHflFKOfzZOldXXhOhhesRBaNPaRlMRJ8Xl.jpeg\"></p><p class=\"ql-align-center\"><br></p><p class=\"ql-align-center\">充满活力的舞蹈课</p><p class=\"ql-align-center\">跟着音乐扭动起来~</p><iframe class=\"ql-video\" frameborder=\"0\" allowfullscreen=\"true\" src=\"https://www.steptousa.cn/file/YMCA-7.mp4\"></iframe><p class=\"ql-align-justify\"><br></p><p class=\"ql-align-center\"><br></p><p class=\"ql-align-center\">遇见新朋友</p><p class=\"ql-align-center\">发现不一样的自己</p><p class=\"ql-align-center\">这里的每天都精彩纷呈</p><p class=\"ql-align-center\">❤❤❤</p><p><br></p><p class=\"ql-align-justify\"><span style=\"color: rgb(0, 32, 96);\">如果您对美国留学感兴趣，</span></p><p class=\"ql-align-justify\"><span style=\"color: rgb(0, 32, 96);\">如果您的孩子有赴美求学的打算，</span></p><p class=\"ql-align-justify\"><span style=\"color: rgb(0, 32, 96);\">如果您想给孩子的未来多一个选择，</span></p><p class=\"ql-align-justify\"><span style=\"color: rgb(0, 32, 96);\">点击</span><a href=\"https://mp.weixin.qq.com/cgi-bin/appmsg?t=media/appmsg_edit&amp;action=edit&amp;type=10&amp;appmsgid=100000200&amp;isMul=1&amp;token=490814245&amp;lang=zh_CN\" target=\"_blank\" style=\"color: rgb(87, 107, 149); background-color: rgb(255, 251, 0);\"><strong>在线报名</strong></a><span style=\"color: rgb(0, 32, 96);\">安唯IVY专属顾问将与您联系！</span></p><p class=\"ql-align-justify\"><span style=\"color: rgb(0, 32, 96);\">在安唯IVY，每个孩子都是独特的个体，</span></p><p class=\"ql-align-justify\"><span style=\"color: rgb(0, 32, 96);\">我们将全心为每个孩子量身定制申请方案，</span></p><p class=\"ql-align-justify\"><span style=\"color: rgb(0, 32, 96);\">为孩子的海外留学保驾护航！</span></p><p class=\"ql-align-justify\"><br></p><p><br></p><p><strong>扫码关注我们</strong></p><p><strong>了解更多留学资讯</strong></p><p class=\"ql-align-justify\"><img src=\"http://api.steptousa.cn/storage/editor/0KzBwPfswPDHiZX8e6t4LWe1OXzlHs2OEFddHdGC.jpeg\"></p><p class=\"ql-align-justify\"><span style=\"background-color: rgba(255, 255, 255, 0.16); color: rgb(0, 32, 96);\">安唯（中国）IVY (China) Study Abroad Service Center 和位于美国纽约的总公司协同开展业务，旨在提供基于美国的优越教育资源，为全球来美学生提供全方位留学服务。我们面向各国学生提供来美学校申请、住宿寄宿、课程补习、课外实践、心理辅导等方面的完整解决方案，可根据不同的需求及侧重点做个性化调整。</span></p>', '1', '9983', '2019-08-14 00:00:00', '2019-08-27 11:43:05', '2019-09-04 14:10:57', null, '1', null, null, '1', null, null, null);
INSERT INTO `articles` VALUES ('20', null, null, '5', null, 'IVY小编', '【安唯夏令营】第11天~告别YMCA', null, '安唯夏令营的第11天', 'http://api.steptousa.cn/storage/cover/bNIsOiXTjfru41wMA4mJD3ckgpyArslSb7pvwUSN.jpeg', '<p class=\"ql-align-center\"><strong>安唯夏令营的第11天</strong></p><p class=\"ql-align-center\"><br></p><p class=\"ql-align-center\">在YMCA的最后一天</p><p class=\"ql-align-center\">手工艺课</p><p class=\"ql-align-center\">编织、陶艺继续</p><p class=\"ql-align-center\">都是心灵手巧的童鞋们?</p><p><img src=\"http://api.steptousa.cn/storage/editor/nA8KNayZuarPtTyCUVUigv3NIIMMNNDIDw79Fwxa.jpeg\"></p><p class=\"ql-align-center\">编织ing</p><p><br></p><p class=\"ql-align-center\"><img src=\"http://api.steptousa.cn/storage/editor/TuUcM4t2gdU1hf230z0wBCTov1hiXrp26a9b1jsj.jpeg\"></p><p class=\"ql-align-justify\">想吃饺子? ?</p><p><br></p><p class=\"ql-align-center\"><br></p><p class=\"ql-align-center\">今日重头戏 -野外自然课</p><p class=\"ql-align-center\">猪鼻蛇初体验</p><p class=\"ql-align-center\">看似让人害怕的蛇?</p><p class=\"ql-align-center\">其实挺温和哒</p><p class=\"ql-align-center\">了解自然规律、了解动物习性</p><p class=\"ql-align-center\">就可以愉快地相处 ?</p><p class=\"ql-align-center\">童鞋们胆子都很大哟 ✌</p><iframe class=\"ql-video\" frameborder=\"0\" allowfullscreen=\"true\" src=\"https://www.steptousa.cn/file/YMCA-8.mp4\"></iframe><p><br></p><p class=\"ql-align-center\"><br></p><p><br></p><p><img src=\"http://api.steptousa.cn/storage/editor/QyoX13MkmQHHzgnjFoo9VB0gbmTNDeVcYqz8lrgE.jpeg\"></p><p><br></p><p class=\"ql-align-center\"><br></p><p><strong>科普课堂</strong></p><p>猪鼻蛇，拉丁学名Heterodon；Lystrophis；Leioheterodon。主要以蛙类和蟾蜍类为食。在习性上，西部猪鼻蛇是日型性的地栖蛇类，善于钻土捕食藏在地下的蟾蜍类，所以在饲养时可以喂食当做红龙食物的小牛蛙为主，否则只有喂小鼠一途，但是并不是所有个体都能够接受小鼠，约有三成的个体必须经过适当的诱食才能习惯 吃小鼠，所以最好在买的时候就先试过会吃小鼠才买，以免买到拒食的个体，虽然猪鼻蛇有毒牙，唾液也有毒性，但是因为猪鼻蛇个性温驯，几乎没有攻击性，同时它们的毒牙属于后毒牙，是位于咽喉处，所以就算是被咬也不会直接被毒牙咬到，同时它们的毒性也很温和，只足够瘫痪蟾蜍，不足以影响人类，安全无虞，是一种小型毒蛇。</p><p><img src=\"http://api.steptousa.cn/storage/editor/fxoQLKocNmlKp0WaexEeNPW8Kus1IoxxQIn2dEz5.jpeg\"></p><p class=\"ql-align-center\"><br></p><p class=\"ql-align-center\">离开营地前</p><p class=\"ql-align-center\">和营地遇见的伙伴们</p><p class=\"ql-align-center\">合影留个纪念吧</p><p><img src=\"http://api.steptousa.cn/storage/editor/FCvs4rQJ6pk0vTwvaoI1QggpOtT9m4kwcmGTDwFV.jpeg\"></p><p class=\"ql-align-center\"><br></p><p class=\"ql-align-center\">Goodbye ❤ YMCA ❤</p><p class=\"ql-align-center\">离家近2周</p><p class=\"ql-align-center\">甚是想念家的味道</p><p class=\"ql-align-center\">此行的最后一顿晚餐</p><p class=\"ql-align-center\">就以火锅完美ending吧 ?</p><p><img src=\"http://api.steptousa.cn/storage/editor/I69WB0Sx5ZbhLerCudYjLEJjJaHYDBRThFXr0Sib.png\"></p><p><br></p><p><br></p><p><br></p><p><span style=\"color: rgb(0, 32, 96);\">如果您对美国留学感兴趣，</span></p><p><span style=\"color: rgb(0, 32, 96);\">如果您的孩子有赴美求学的打算，</span></p><p><span style=\"color: rgb(0, 32, 96);\">如果您想给孩子的未来多一个选择，</span></p><p><span style=\"color: rgb(0, 32, 96);\">点击</span><a href=\"https://mp.weixin.qq.com/cgi-bin/appmsg?t=media/appmsg_edit&amp;action=edit&amp;type=10&amp;appmsgid=100000205&amp;isMul=1&amp;token=490814245&amp;lang=zh_CN\" target=\"_blank\" style=\"color: rgb(87, 107, 149); background-color: rgb(255, 251, 0);\"><strong>在线报名</strong></a><strong style=\"color: rgb(0, 32, 96);\">&nbsp;</strong><span style=\"color: rgb(0, 32, 96);\">安唯IVY专属顾问将与您联系！</span></p><p><span style=\"color: rgb(0, 32, 96);\">在安唯IVY，每个孩子都是独特的个体，</span></p><p><span style=\"color: rgb(0, 32, 96);\">我们将全心为每个孩子量身定制申请方案，</span></p><p><span style=\"color: rgb(0, 32, 96);\">为孩子的海外留学保驾护航！</span></p><p><br></p><p><strong>扫码关注我们</strong></p><p><strong>了解更多留学资讯</strong></p><p><img src=\"http://api.steptousa.cn/storage/editor/Ox4hqFY09vtOe4YZnM6SXHanaI46Mz9PRaqtu6J5.jpeg\"></p><p><span style=\"color: rgb(0, 32, 96); background-color: rgba(255, 255, 255, 0.16);\">安唯（中国）IVY (China) Study Abroad Service Center 和位于美国纽约的总公司协同开展业务，旨在提供基于美国的优越教育资源，为全球来美学生提供全方位留学服务。我们面向各国学生提供来美学校申请、住宿寄宿、课程补习、课外实践、心理辅导等方面的完整解决方案，可根据不同的需求及侧重点做个性化调整。</span></p>', '1', '9982', '2019-08-15 00:00:00', '2019-08-27 11:50:05', '2019-09-04 13:30:40', null, '1', null, null, '1', null, null, null);
INSERT INTO `articles` VALUES ('21', null, null, '3', null, 'IVY小编', '【IVY原创】Niche 2020 纽约州私立高中排名', null, '近日，Nichi网发布了2020院校排名，作为本土选校人气王的Nichi排名是众多学生选校时的重要参考工具。\n纽约州，是安唯老师们重点关注的区域，今天我们就来看看该州的私立高中排名吧。', 'http://api.steptousa.cn/storage/cover/cuWtouneraLf2Y5aSymgQn4UGPetO6cxmEPTNFIc.jpeg', '<p class=\"ql-align-center\">​<strong><img src=\"https://mmbiz.qpic.cn/mmbiz_png/ubN0wibpqBFvA8RcCvgMy04OUAwOoGsX1rbqjarpaicaG2aMbyEwd4zZvSgUkMgOsrI0Bnzq40cJrhicBrnfaibRNg/640?wx_fmt=gif\" width=\"auto\">Niche 2020 纽约州私立高中排名</strong></p><p class=\"ql-align-center\"><img src=\"http://api.steptousa.cn/storage/editor/eyDFBPcVBeC2jMuYMYN1CIIMFylWVOQ1go8qu70c.jpeg\"></p><p class=\"ql-align-center\"><br></p><p class=\"ql-align-center\">近日，Nichi网发布了2020院校排名，作为本土选校人气王的Nichi排名是众多学生选校时的重要参考工具。</p><p class=\"ql-align-center\">纽约州，是安唯老师们重点关注的区域，今天我们就来看看该州的私立高中排名吧。</p><p class=\"ql-align-center\"><img src=\"http://api.steptousa.cn/storage/editor/sYmpMtyQGTLC56Wg5FTC9Io0Jo1XmC8BhG1GumP1.jpeg\"></p><p class=\"ql-align-center\">（完整排名参考：https://www.niche.com/k12/search/best-private-schools/s/new-york/）</p><p class=\"ql-align-center\"><br></p><p class=\"ql-align-center\"><img src=\"http://api.steptousa.cn/storage/editor/ZMThZSWQ3XKSEUYv8PF3ajlXQzMP8drNKJoqUn0j.jpeg\"></p>', '1', '9980', '2019-08-26 00:00:00', '2019-08-27 14:30:04', '2019-09-06 11:26:20', null, '1', null, null, '1', null, null, null);
INSERT INTO `articles` VALUES ('22', null, null, '3', null, 'IVY小编', '美国本科教育体系 （Undergraduate Education System）', null, '美国有超过1,000所两年制大学。这些学校也被称为初级或社区学院。在大多数州，社区学院由州立大学的一个部门或当地特区运营，但需要得到州政府机构的指导。选择高等教育学习两年制课程的学生可以获得副学士学位。', 'http://api.steptousa.cn/storage/cover/rl8NkDThkcSzb6fRBtQahtb74O0npnTRshEKOSBO.jpeg', '<p><br></p><p><img src=\"http://api.steptousa.cn/storage/editor/N1DK4o3ALDDLb2nB8Wn4SrtEzYolpkLJUMfz7WL4.jpeg\"><img src=\"http://api.steptousa.cn/storage/editor/C4qeZaYxY9jTYq1WudOHsIeFqCZCxNWliK6CIR7S.jpeg\"></p>', '1', '9979', '2019-08-28 00:00:00', '2019-09-06 11:39:44', '2019-09-06 13:56:42', null, '1', null, null, '1', null, null, null);
INSERT INTO `articles` VALUES ('23', null, null, '3', null, 'IVY小编', '美国研究生教育体系（Graduate Education System）', null, '随着高等教育的普及，越来越多的学生在本科毕业后选择赴美继续深造，接受研究生阶段的教育。通过研究生阶段的学习，学生可以获得硕士或博士学位。', 'http://api.steptousa.cn/storage/cover/UMRakaLNq1WF3CEJqtUzHcwCUkRWTJoy4ggC4WdP.jpeg', '<p><br></p><p><img src=\"http://api.steptousa.cn/storage/editor/fg88D0TNDLgNWQppErNUE7gH3hqKpxf2696XCzb5.jpeg\"><img src=\"http://api.steptousa.cn/storage/editor/ToJYxHNoOePekbRSyRTSeAjS8B4Ylq40ufNMXk8f.jpeg\"></p>', '1', '9978', '2019-08-29 00:00:00', '2019-09-06 13:53:17', '2019-09-06 13:58:11', null, '1', null, null, '1', null, null, null);
INSERT INTO `articles` VALUES ('24', null, null, '3', null, 'IVY小编', '美国大学申请时间计划', null, '当计划去美国留学时，制定一个合理有效的时间规划，是非常有必要的。我们拟从入学前18个月开始制作了一份简单的计划，希望对各位准备申请中的童鞋们有帮助。', 'http://api.steptousa.cn/storage/cover/Tq5XJCMsEv0MqUPNSAlHncUaBvKHGAhIyqonKoAq.jpeg', '<p><br></p><p><img src=\"http://api.steptousa.cn/storage/editor/eSIALFzmXKJwGqUDSgObv0oGhvds5SnVclIw07pa.jpeg\"><img src=\"http://api.steptousa.cn/storage/editor/KbGyqGXKqMHO1TQfnUHvGhr9197Hb330liruzXox.jpeg\"></p>', '1', '9977', '2019-09-03 00:00:00', '2019-09-10 12:00:14', '2019-09-10 12:02:19', null, '1', null, null, '1', null, null, null);
INSERT INTO `articles` VALUES ('25', null, null, '3', null, 'IVY小编', '美国硕士申请：全面了解商科专业', null, '无论是商科抑或是其他任何一门专业，如果您感兴趣或打算申请，那么至少应先了解几点（以商科为例）：\n1、商科下有哪些专业\n2、这些专业需要的背景条件和必备技能有哪些？\n3、这些专业是否符合自己的兴趣方向和自己的性格？', 'http://api.steptousa.cn/storage/cover/PsHU27afXT2EF6P1mHUllA7vmPRlEiHX5X06rS77.jpeg', '<p><br></p><p><img src=\"http://api.steptousa.cn/storage/editor/LQYZTDZeLA5QFwx9I3sw4RiGDUhAvuWijv6wR77S.jpeg\"><img src=\"http://api.steptousa.cn/storage/editor/BAruzCw7jP2wRktirXYNBsUBvSTlWpvezxKBcfxA.jpeg\"></p>', '1', '9976', '2019-09-09 00:00:00', '2019-09-11 11:02:16', '2019-09-11 11:02:16', null, '1', null, null, '1', null, null, null);
INSERT INTO `articles` VALUES ('26', null, null, '3', null, 'IVY小编', '重磅！2020 USNEWS 美国大学排名发布！', null, '“老师，我家孩子可以进前30吗？”\n“老师，我能否申到综排前50的学校?”\n这个学生、家长眼中最权威的排名，\n每年9月更新，今年准时出炉拉~！', 'http://api.steptousa.cn/storage/cover/ZDy3O9Ki5cquS26yAiZI7TUT4KdQupl0uqfkg1TB.jpeg', '<p><br></p><p><img src=\"http://api.steptousa.cn/storage/editor/dfUGmywR1e9JkDHQLUaZfiwBfIWJLt2ge5rpP3iz.jpeg\"><img src=\"http://api.steptousa.cn/storage/editor/9FDoiCQGIfVWCGVmcDjRJ83kMiP5hRc69rTwjJPg.jpeg\"></p>', '1', '9975', '2019-09-09 00:00:00', '2019-09-12 10:50:10', '2019-09-12 10:52:00', null, '1', null, null, '1', null, null, null);
INSERT INTO `articles` VALUES ('27', null, null, '3', null, 'IVY小编', '美国本科申请 To-Do List', null, '随着美本申请难度的日益提升，许多学生已将开始准备的时间提早到9年级。精心的规划与选择，这些课堂内外的成长将成为申请时的优势，让自己在众多申请者中脱颖而出。而以往的案例也充分体现了尽早地规划与执行无疑是获得理想大学录取的前提。下面这份9-12年级的To-Do List 希望会对您和您孩子有帮助。', 'http://api.steptousa.cn/storage/cover/Ip1YTz0EauH55YIQ580P6wqc6TBg4DptrkJ8669B.jpeg', '<p><br></p><p><img src=\"http://api.steptousa.cn/storage/editor/ITBqAzrcgkFJxhe0iuhcwU7r9XgyGsIWBEivmD6F.jpeg\"></p><p><img src=\"http://api.steptousa.cn/storage/editor/VLSMWkHorzOUoR2RhX8PRMh44W0ZvtoRHOckocin.jpeg\"></p>', '1', '9974', '2019-09-11 09:31:10', '2019-11-07 09:31:10', '2019-11-07 11:32:43', null, '1', null, null, '1', null, null, null);
INSERT INTO `articles` VALUES ('28', null, null, '3', null, 'IVY小编', '最新~THE泰晤士高等教育2020世界大学排名', null, '前不久，世界四大排名之一的泰晤士高等教育发布了2019-2020最新世界大学排名。本次排名共涉及92个国家和地区的1396所大学，为历史上规模最大的一次。', 'http://api.steptousa.cn/storage/cover/zamCmn22RTd3V7scXxCYPhpOOc7Q2JtM64NIcj7q.jpeg', '<p>前不久，世界四大排名之一的泰晤士高等教育发布了2019-2020最新世界大学排名。本次排名共涉及92个国家和地区的1396所大学，为历史上规模最大的一次。</p><p><br></p><p><img src=\"http://api.steptousa.cn/storage/editor/5ncVM07EukucSeAgJVCWefvggaKEa0AILvd3QgcS.png\"></p><p><img src=\"http://api.steptousa.cn/storage/editor/iTDsTnmd1Pbc1C5eFrefJQgyMXtGLMiEI9d07xZi.png\"></p>', '1', '9973', '2019-09-16 10:19:00', '2019-11-07 10:19:00', '2019-11-07 11:32:08', null, '1', null, null, '1', null, null, null);
INSERT INTO `articles` VALUES ('29', null, null, '3', null, 'IVY小编', '决定是否留学需考虑的问题（1）', null, '你是否想 \"在美国寻找dream school\" ？\n去美国留学是一项需要严肃考虑的事情，并且费用不菲。\n在跨出这一步前，应仔细考虑：在美国的学习能否匹配自己的长期教育规划、职业规划以及人生目标 ？', 'http://api.steptousa.cn/storage/cover/jrfXGyuy9bfaAIbl5IgnNgE5QD2UwHpGIwoSaW46.jpeg', '<p><br></p><p><img src=\"http://api.steptousa.cn/storage/editor/VIUNL5opMseRrQQfWjY2e7ul9ezYCW7lLWalavpA.jpeg\"></p><p><img src=\"http://api.steptousa.cn/storage/editor/sP8T7nlOYicjJ9WneWCoicVdIa1IonapNbfz3G1d.jpeg\"></p>', '1', '9972', '2019-09-18 16:06:00', '2019-11-07 11:31:09', '2019-11-07 11:31:09', null, '1', null, null, '1', null, null, null);
INSERT INTO `articles` VALUES ('30', null, null, '3', null, 'IVY小编', '决定是否留学需考虑的问题（2）- 教育认证', null, '你需要确保你正在考虑的任何美国大学机构都是获得美国教育部认可的机构。由于美国中央政府不控制教育系统，因此建立了私立的非政府机构来审查高等教育机构及其项目。如果学校获得认证，那么你可以放心，他们的课程和计划、教师及招聘流程、招生指南等的质量都符合认证机构规定的特定标准。', 'http://api.steptousa.cn/storage/cover/tILtGxPRhhLsekzwgJuy5qIbQXOgXgunKxV1pXBW.jpeg', '<p><br></p><p><img src=\"http://api.steptousa.cn/storage/editor/tKxVyo7hq66fNNB1WiJICcTQmcuei4PfFNsxXEVH.jpeg\"></p><p><img src=\"http://api.steptousa.cn/storage/editor/03U9nuAtX2Mk9pwOheG3RJVu1Bd7AQzvlBkFP9pn.jpeg\"></p>', '1', '9971', '2019-09-20 00:00:00', '2019-11-14 09:32:06', '2019-11-14 09:49:39', null, '1', null, null, '1', null, null, null);
INSERT INTO `articles` VALUES ('31', null, null, '3', null, 'IVY小编', '决定是否留学需要考虑的问题（3）- 质量和其他教育因素', null, '由于美国高等教育机构的规模和种类繁多，任何一所即使是经过认证的机构，其课程的质量也很难确定。最昂贵的机构不一定是最好的，同样的，即便是一所声誉很高的大学里，每一个项目的质量也是层次不齐的。', 'http://api.steptousa.cn/storage/cover/0csUKWatGYRhU6gJ2g1JakDGFSOJDUm2tMNqI0j3.jpeg', '<p><br></p><p><img src=\"http://api.steptousa.cn/storage/editor/yKw9vrRk5njRXjB3Gyrlro8I5bKYbAmcmqtSgns8.jpeg\"></p><p><img src=\"http://api.steptousa.cn/storage/editor/Hbovc6lQJAtcO4iY7mBOtnmIYGSB3Ybi4MreCJzJ.jpeg\"></p>', '1', '9970', '2019-11-14 10:00:10', '2019-11-14 10:00:10', '2019-11-14 10:00:10', null, '1', null, null, '1', null, null, null);
INSERT INTO `articles` VALUES ('32', null, null, '3', null, 'IVY小编', '决定是否留学需要考虑的问题（4）- 费用', null, '在美国学习一般要承担昂贵的支出。不同的教育机构的学费差别很大：社区学院每年的学费可能是2,000美元，而高选择性的私立大学每年的学费、食宿费可能需要35,000美元甚至更多。', 'http://api.steptousa.cn/storage/cover/u9SYmH1vWCUg7l7w3H0BGeLvvccUleB47zOAlhzv.jpeg', '<p><br></p><p><img src=\"http://api.steptousa.cn/storage/editor/7Mj82Ev8iFVjN4Ci1KTiahvB6k9IG6wdyVZXWiCM.jpeg\"></p><p><img src=\"http://api.steptousa.cn/storage/editor/UixA1SjYfz0Iayl6aHGw0MWsYnDDocVOb9R28y5O.jpeg\"></p>', '1', '9969', '2019-09-25 00:00:00', '2019-11-14 11:07:45', '2019-11-14 11:07:45', null, '1', null, null, '1', null, null, null);
INSERT INTO `articles` VALUES ('33', null, null, '3', null, 'IVY小编', '决定是否留学需要考虑的问题（5）', null, '掌握良好的英语书面和口语能力对你的申请非常有利。大多数大学要求国际本科生和研究生通过参加外语考试（TOEFL）来证明他们的英语语言能力是招生过程的一部分。除托福要求外，一些大学要求申请人至少提交一篇论文作为其申请的一部分; 也有部分学校会要求面试或电话会议，来了解你的英语表达能力。因此，提前了解英语考试政策和申请要求对你来说是非常有帮助的，在你感兴趣的英语学习机构学习，也可以帮助', 'http://api.steptousa.cn/storage/cover/6gFSPR0dmnG4y69AVpcUw7v0QDagDMR497RwbQZK.jpeg', '<p><br></p><p><img src=\"http://api.steptousa.cn/storage/editor/NBMFEgwpZWQfvhgHtRwcrhhmx3mqt9u96D1R6lKP.jpeg\"></p>', '1', '9968', '2019-09-27 11:23:09', '2019-11-14 11:23:09', '2019-11-14 11:35:36', null, '1', null, null, '1', null, null, null);
INSERT INTO `articles` VALUES ('34', null, null, '6', null, 'IVY小编', '【2020安唯冬令营】这个寒假你不可错过的纽约艺术之旅', null, '2020年的寒假，你计划好了吗？本次安唯冬令营安排了超级丰富的四大主题活动。如果你是一个热爱艺术的孩子，那就和我们一起进行一场艺术的洗礼吧！', 'http://api.steptousa.cn/storage/cover/itNIwkA12zHMdCiGdYjYdM7WVYvt4qNv6xvtOe23.jpeg', '<p><br></p><p><img src=\"http://api.steptousa.cn/storage/editor/NsFGfPloOweEsI1LhV5nKhZExGSjwLepY2B0vLWB.jpeg\"></p><p><img src=\"http://api.steptousa.cn/storage/editor/i270PlzDhtLzn4tTbU0MyfbtuKnLqTSCrdbiNF1H.jpeg\"></p>', '1', '9967', '2019-09-30 00:00:00', '2019-11-14 12:00:07', '2019-11-14 13:12:53', null, '1', null, null, '1', null, null, null);
INSERT INTO `articles` VALUES ('35', null, null, '6', null, 'IVY小编', '【2020安唯冬令营】伊斯特伍兹学校 East Woods School', null, '此次安唯冬令营的插班生活动安排在纽约长岛地区的EAST WOODS SCHOOL，成立于1946年，学校是全国独立学校协会（NAIS）和纽约州独立学校协会（NYSAIS）的成员，全日制私立学校。', 'http://api.steptousa.cn/storage/cover/F4OjEdEW3iFRj1VapE4xdaSr97S62SKpSIGV8jxq.jpeg', '<p><br></p><p><img src=\"http://api.steptousa.cn/storage/editor/YQhStbWrMoC3BNDjvZDpltQUeZWkThx6MkrfN9KY.jpeg\"></p><p><img src=\"http://api.steptousa.cn/storage/editor/hrxP7JJ6fBUe7R0n6HYxXI0wusIhLJc6NQMTBuN4.jpeg\"></p>', '1', '9966', '2019-10-10 00:00:00', '2019-11-14 13:17:51', '2019-11-14 13:17:51', null, '1', null, null, '1', null, null, null);
INSERT INTO `articles` VALUES ('36', null, null, '3', null, 'IVY小编', '决定是否留学需要考虑的问题（6）-住宿', null, '住宿是一个重要的考虑因素，因为当你开始查看出国留学时的住宿时，可以选择多种方式。如果你是单身，并希望全方位体验在美国的大学生活，与美国室友住在校园宿舍可能会吸引你。宿舍也有常驻顾问（通常每层楼一个），可帮助新生找到符合他们兴趣的活动和组织。', 'http://api.steptousa.cn/storage/cover/Wt2DdYiQs1Hnhjhu9C40x1wiIObnhCFA70WEkiWB.jpeg', '<p><br></p><p><img src=\"http://api.steptousa.cn/storage/editor/ODeGt9jWPKD0eLdga5YpmDcGgH5xsEKMHFhkAURh.jpeg\"></p><p><img src=\"http://api.steptousa.cn/storage/editor/fwgpMFgKfhtDfCD2jflqiQ0t2gbKbcsaqGZAwaMM.jpeg\"></p>', '1', '9965', '2019-10-11 17:02:01', '2019-11-15 10:32:42', '2019-11-15 11:43:43', null, '1', null, null, '1', null, null, null);
INSERT INTO `articles` VALUES ('37', null, null, '3', null, 'IVY小编', '决定是否留学需要考虑的问题（7）-安全问题', null, '人身安全对于世界各地的人们都很重要，而且远在他乡会使你的家人更为担心你在离家学习时的安全问题。', 'http://api.steptousa.cn/storage/cover/3JdESirriJT1pgzlTDFroNbgVfNZ415DJvsO69yE.jpeg', '<p><br></p><p><img src=\"http://api.steptousa.cn/storage/editor/MaAr7HEQVQy18mUJwD9jdGXEv9k0FGQQTPSRaOqn.jpeg\"></p><p><img src=\"http://api.steptousa.cn/storage/editor/gQt65ByJpDcLGbCZc1WjQTyUGS54o7PuKKmvDlmD.jpeg\"></p>', '1', '9964', '2019-10-12 13:08:27', '2019-11-15 11:42:32', '2019-11-15 11:44:21', null, '1', null, null, '1', null, null, null);
INSERT INTO `articles` VALUES ('38', null, null, '6', null, 'IVY小编', '【2020安唯冬令营】长岛美术学院 Long Island Academy of Fine Arts', null, '长岛美术学院 （Long Island Academy of Fine Arts） 于1999年由Robert和Flora Armetta非正式创办，当时罗伯特开始在纽约Riverhead市中心的主街第一公理会地下室教授绘画课程。2000年，我们正式成为LIAFA。', 'http://api.steptousa.cn/storage/cover/5y4SHd1Rk4uPbrPJQbczWtdK7sWnmLRhQhFfxLz9.jpeg', '<p><br></p><p><img src=\"http://api.steptousa.cn/storage/editor/1xzArs7FOxLTfhsE7lBRLMOZazpXmhDQm2TiQiaV.jpeg\"></p><p><img src=\"http://api.steptousa.cn/storage/editor/Bb3wLFZWHGO4QXZlcxhn0gxl5ZcLXym0VpxjsKwi.jpeg\"></p>', '1', '9963', '2019-10-15 17:15:02', '2019-11-15 11:53:40', '2019-11-15 12:07:07', null, '1', null, null, '1', null, null, null);
INSERT INTO `articles` VALUES ('39', null, null, '6', null, 'IVY小编', '【2020安唯冬令营】i音乐学校 i School of Music+Art', null, 'i 音乐学校创建于2005年，是纽约地区第一所以连锁方式来开发、经营的音乐学校。它坐落于美国富饶美丽的纽约长岛地区，目前有三所分校。i音乐学校的教师队伍由纽约地区一流的音乐家组成。它每年为美国常春藤大学输送了大批人才。目前一些学生已经活跃在纽约著名的百老汇舞台上和交响乐团中。', 'http://api.steptousa.cn/storage/cover/yWXGbmDGkgeh9qVmC3Cy7Q8SE6tCqy1JiXjSbYuZ.jpeg', '<p><br></p><p><img src=\"http://api.steptousa.cn/storage/editor/LU8a0IaLEwZ4y26py3aZkE1ybn5KwmQmgCzEohMQ.jpeg\"></p><p class=\"ql-align-center\"><strong style=\"color: rgb(255, 0, 0);\">热情 Passion</strong></p><p class=\"ql-align-center\"><strong style=\"color: rgb(0, 176, 240);\">乐趣 Fun</strong></p><p class=\"ql-align-center\"><strong style=\"color: rgb(227, 108, 9);\">坚持 Persistence</strong></p><p class=\"ql-align-center\"><strong style=\"color: rgb(0, 176, 80);\">成果 Results</strong></p><p><br></p><p><img src=\"http://api.steptousa.cn/storage/editor/2L1ao34mSmFqVEFn40NWQimtJa47tDAhinTpu2ep.jpeg\"></p><p><img src=\"http://api.steptousa.cn/storage/editor/TtcNTvH9xnsxV51ZxX0UM5HWQ4xQIxDEsGd7jEJb.jpeg\"></p>', '1', '9962', '2019-10-17 17:24:18', '2019-11-15 12:05:02', '2019-11-15 12:06:48', null, '1', null, null, '1', null, null, null);
INSERT INTO `articles` VALUES ('40', null, null, '6', null, 'IVY小编', '【2020安唯冬令营】艺术殿堂 MoMA 纽约现代艺术博物馆（上篇）', null, '冠有现代艺术头衔的博物馆家族里，纽约MoMA现代艺术博物馆可谓首屈一指 ，充满设计感的建筑里，拥有超过15万件现代艺术藏品，成为无数文艺生心中的圣殿。', 'http://api.steptousa.cn/storage/cover/pf59QGyCAuyLOc37bpRln2QFkvDF3yNqggKGjvlA.jpeg', '<p><br></p><p><img src=\"http://api.steptousa.cn/storage/editor/GiJ8rHid82cf7wOdZypKKnEjGzu7Pww0Yn9FkG7J.jpeg\"><img src=\"http://api.steptousa.cn/storage/editor/yecFMmQ5aol5WeRJoWHqD1Ta5Qv92ZJNtdD6SJWy.jpeg\"></p>', '1', '9961', '2019-10-23 18:39:52', '2019-11-15 12:11:18', '2019-11-15 13:22:15', null, '1', null, null, '1', null, null, null);
INSERT INTO `articles` VALUES ('41', null, null, '6', null, 'IVY小编', '【2020安唯冬令营】艺术殿堂 MoMA 纽约现代艺术博物馆（下篇）', null, '艺术殿堂 MoMA 纽约现代艺术博物馆作品简介', 'http://api.steptousa.cn/storage/cover/NVA8oGnrLN1izE15WM6n2fNjAHL00HXHyWVADZKE.jpeg', '<p><br></p><p><img src=\"http://api.steptousa.cn/storage/editor/c8X9seBYxosf5rS1sh79z6k6r2UdtJx8ZrKATwVk.jpeg\"><img src=\"http://api.steptousa.cn/storage/editor/FHVxChL0cWcIX3tpqCpmngP2GH1Wj834U5Ikg1W8.jpeg\"></p>', '1', '9960', '2019-10-24 18:15:31', '2019-11-15 13:20:13', '2019-11-15 13:22:29', null, '1', null, null, '1', null, null, null);
INSERT INTO `articles` VALUES ('42', null, null, '6', null, 'IVY小编', '【2020安唯冬令营】电影博物馆奇妙夜取景地~美国纽约自然历史博物馆', null, '英文名称American Museum of Natural History ，简称 AMNH, 1869年建立，位于中央公园旁，是纽约著名景点之一 博物馆共有四层，设有45个常设展厅和1个天文馆，收藏超过3000万+的动植物地质标本（从恐龙化石，到动物骨骼，到太空陨石）。', 'http://api.steptousa.cn/storage/cover/7i4h6AwrU1t61EqBWDvshD3hABlW4Nwh9MHV7jLL.jpeg', '<p><br></p><p><img src=\"http://api.steptousa.cn/storage/editor/QzBwTJiA7QQj6EN91UWEee2cFJ34P8LTW2Tys5ex.png\"></p><p><img src=\"http://api.steptousa.cn/storage/editor/LctiiTalmydCj00sUOvpSvoOOy4Vzoha3he4uttA.png\"><img src=\"http://api.steptousa.cn/storage/editor/40lAER4Lb6qavByirIMpWccIZTHyeYLGsUvq74nE.png\"><img src=\"http://api.steptousa.cn/storage/editor/q39YntrxvaNjNZ82aXjB8rhvYfX5WyV9dSb6Cd1E.png\"><img src=\"http://api.steptousa.cn/storage/editor/Y70nucC5gOTIHVzuCzFaH6q67kuh83Nt5Nvv8nqi.png\"><img src=\"http://api.steptousa.cn/storage/editor/S5bZ8Y0xMQpHIej8kEmzT4ZOYFNFiZ8A454iKdWB.png\"></p>', '1', '9959', '2019-10-29 14:21:27', '2019-11-15 14:21:27', '2019-11-15 16:33:14', null, '1', null, null, '1', null, null, null);
INSERT INTO `articles` VALUES ('43', null, null, '6', null, 'IVY小编', '【2020安唯冬令营】走进顶级艺术殿堂-大都会艺术博物馆（1）', null, '纽约有着众多大大小小的博物馆和美术馆，从馆藏极为丰富的世界三大博物馆之一的大都会，到纽约的MOMA现代艺术馆，都能让喜爱艺术的你大呼满足！', 'http://api.steptousa.cn/storage/cover/PBeAGteriPyuJrRdBsWneUEV9oFElg5PQS77fMTf.jpeg', '<p><br></p><p><img src=\"http://api.steptousa.cn/storage/editor/XSTIfArdmLlnlkSHKNQnsZLVBtyUSb1A6opfUhxx.jpeg\"><img src=\"http://api.steptousa.cn/storage/editor/Cvo4NWbCdfyibTk9aNiTikJ5GOli7xo9rQokiMAo.png\"></p>', '1', '9958', '2019-11-04 18:26:22', '2019-11-25 15:11:01', '2019-11-25 15:20:55', null, '1', null, null, '1', null, null, null);
INSERT INTO `articles` VALUES ('44', null, null, '6', null, 'IVY小编', '【2020安唯冬令营】走进顶级艺术殿堂-大都会艺术博物馆（2）', null, '陈丹青（知名艺术家、作家）说：\n“我没上过高中大学，大都会美术馆就是我的大学，我不知道去过多少次，到现在我也没从这里毕业。“', 'http://api.steptousa.cn/storage/cover/Hb52ittmfI2CD1C2x2j8VY76ce9YefesRpQPYyIV.jpeg', '<p><br></p><p><img src=\"http://api.steptousa.cn/storage/editor/98Sjnyn5q910nADOc0XPD1e3KFgXcmeTkiXstq04.jpeg\"><img src=\"http://api.steptousa.cn/storage/editor/hxRKxCe4zvrgjIViHdbmppziXl1JnuGf4Ltu7Idf.jpeg\"></p>', '1', '9957', '2019-11-06 17:20:17', '2019-11-25 15:16:36', '2019-11-25 15:16:36', null, '1', null, null, '1', null, null, null);

-- ----------------------------
-- Table structure for article_logs
-- ----------------------------
DROP TABLE IF EXISTS `article_logs`;
CREATE TABLE `article_logs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `admin_id` int(10) unsigned NOT NULL COMMENT '操作人员',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '预留字段1提交，2已提交初审，3初审通过，复审通过',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of article_logs
-- ----------------------------

-- ----------------------------
-- Table structure for article_tag
-- ----------------------------
DROP TABLE IF EXISTS `article_tag`;
CREATE TABLE `article_tag` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `article_id` int(10) unsigned NOT NULL COMMENT 'article 主键',
  `tag_id` int(10) unsigned NOT NULL COMMENT 'tag 主键',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=113 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of article_tag
-- ----------------------------
INSERT INTO `article_tag` VALUES ('1', '1', '2', null, null, null);
INSERT INTO `article_tag` VALUES ('2', '2', '2', null, null, null);
INSERT INTO `article_tag` VALUES ('3', '3', '1', null, null, null);
INSERT INTO `article_tag` VALUES ('4', '4', '1', null, null, null);
INSERT INTO `article_tag` VALUES ('5', '4', '2', null, null, null);
INSERT INTO `article_tag` VALUES ('6', '5', '2', null, null, null);
INSERT INTO `article_tag` VALUES ('7', '6', '1', null, null, null);
INSERT INTO `article_tag` VALUES ('8', '7', '2', null, null, null);
INSERT INTO `article_tag` VALUES ('9', '8', '2', null, null, null);
INSERT INTO `article_tag` VALUES ('10', '9', '2', null, null, null);
INSERT INTO `article_tag` VALUES ('11', '10', '2', null, null, null);
INSERT INTO `article_tag` VALUES ('12', '11', '1', null, null, null);
INSERT INTO `article_tag` VALUES ('13', '11', '4', null, null, null);
INSERT INTO `article_tag` VALUES ('14', '11', '3', null, null, null);
INSERT INTO `article_tag` VALUES ('15', '12', '1', null, null, null);
INSERT INTO `article_tag` VALUES ('16', '12', '3', null, null, null);
INSERT INTO `article_tag` VALUES ('17', '12', '4', null, null, null);
INSERT INTO `article_tag` VALUES ('18', '13', '1', null, null, null);
INSERT INTO `article_tag` VALUES ('19', '13', '3', null, null, null);
INSERT INTO `article_tag` VALUES ('20', '13', '4', null, null, null);
INSERT INTO `article_tag` VALUES ('21', '14', '1', null, null, null);
INSERT INTO `article_tag` VALUES ('22', '14', '3', null, null, null);
INSERT INTO `article_tag` VALUES ('23', '14', '4', null, null, null);
INSERT INTO `article_tag` VALUES ('24', '15', '1', null, null, null);
INSERT INTO `article_tag` VALUES ('25', '15', '3', null, null, null);
INSERT INTO `article_tag` VALUES ('26', '15', '4', null, null, null);
INSERT INTO `article_tag` VALUES ('27', '16', '1', null, null, null);
INSERT INTO `article_tag` VALUES ('28', '16', '3', null, null, null);
INSERT INTO `article_tag` VALUES ('29', '16', '4', null, null, null);
INSERT INTO `article_tag` VALUES ('30', '17', '1', null, null, null);
INSERT INTO `article_tag` VALUES ('31', '17', '3', null, null, null);
INSERT INTO `article_tag` VALUES ('32', '17', '4', null, null, null);
INSERT INTO `article_tag` VALUES ('33', '18', '1', null, null, null);
INSERT INTO `article_tag` VALUES ('34', '18', '3', null, null, null);
INSERT INTO `article_tag` VALUES ('35', '18', '4', null, null, null);
INSERT INTO `article_tag` VALUES ('36', '19', '1', null, null, null);
INSERT INTO `article_tag` VALUES ('37', '19', '3', null, null, null);
INSERT INTO `article_tag` VALUES ('38', '19', '4', null, null, null);
INSERT INTO `article_tag` VALUES ('39', '20', '1', null, null, null);
INSERT INTO `article_tag` VALUES ('40', '20', '3', null, null, null);
INSERT INTO `article_tag` VALUES ('41', '20', '4', null, null, null);
INSERT INTO `article_tag` VALUES ('42', '21', '2', null, null, null);
INSERT INTO `article_tag` VALUES ('43', '22', '6', null, null, null);
INSERT INTO `article_tag` VALUES ('44', '22', '2', null, null, null);
INSERT INTO `article_tag` VALUES ('45', '23', '6', null, null, null);
INSERT INTO `article_tag` VALUES ('46', '24', '2', null, null, null);
INSERT INTO `article_tag` VALUES ('47', '24', '6', null, null, null);
INSERT INTO `article_tag` VALUES ('48', '25', '2', null, null, null);
INSERT INTO `article_tag` VALUES ('49', '25', '6', null, null, null);
INSERT INTO `article_tag` VALUES ('50', '26', '6', null, null, null);
INSERT INTO `article_tag` VALUES ('51', '26', '2', null, null, null);
INSERT INTO `article_tag` VALUES ('52', '27', '6', null, null, null);
INSERT INTO `article_tag` VALUES ('53', '27', '2', null, null, null);
INSERT INTO `article_tag` VALUES ('54', '28', '6', null, null, null);
INSERT INTO `article_tag` VALUES ('55', '28', '2', null, null, null);
INSERT INTO `article_tag` VALUES ('56', '29', '6', null, null, null);
INSERT INTO `article_tag` VALUES ('57', '29', '2', null, null, null);
INSERT INTO `article_tag` VALUES ('58', '30', '6', null, null, null);
INSERT INTO `article_tag` VALUES ('59', '30', '2', null, null, null);
INSERT INTO `article_tag` VALUES ('60', '31', '6', null, null, null);
INSERT INTO `article_tag` VALUES ('61', '31', '2', null, null, null);
INSERT INTO `article_tag` VALUES ('62', '32', '6', null, null, null);
INSERT INTO `article_tag` VALUES ('63', '32', '2', null, null, null);
INSERT INTO `article_tag` VALUES ('64', '33', '6', null, null, null);
INSERT INTO `article_tag` VALUES ('65', '33', '2', null, null, null);
INSERT INTO `article_tag` VALUES ('66', '34', '1', null, null, null);
INSERT INTO `article_tag` VALUES ('67', '34', '3', null, null, null);
INSERT INTO `article_tag` VALUES ('68', '34', '4', null, null, null);
INSERT INTO `article_tag` VALUES ('69', '34', '5', null, null, null);
INSERT INTO `article_tag` VALUES ('70', '35', '2', null, null, null);
INSERT INTO `article_tag` VALUES ('71', '35', '6', null, null, null);
INSERT INTO `article_tag` VALUES ('72', '35', '4', null, null, null);
INSERT INTO `article_tag` VALUES ('73', '35', '1', null, null, null);
INSERT INTO `article_tag` VALUES ('74', '36', '6', null, null, null);
INSERT INTO `article_tag` VALUES ('75', '36', '2', null, null, null);
INSERT INTO `article_tag` VALUES ('76', '37', '6', null, null, null);
INSERT INTO `article_tag` VALUES ('77', '37', '2', null, null, null);
INSERT INTO `article_tag` VALUES ('78', '38', '1', null, null, null);
INSERT INTO `article_tag` VALUES ('79', '38', '2', null, null, null);
INSERT INTO `article_tag` VALUES ('80', '38', '3', null, null, null);
INSERT INTO `article_tag` VALUES ('81', '38', '4', null, null, null);
INSERT INTO `article_tag` VALUES ('82', '38', '5', null, null, null);
INSERT INTO `article_tag` VALUES ('83', '39', '1', null, null, null);
INSERT INTO `article_tag` VALUES ('84', '39', '2', null, null, null);
INSERT INTO `article_tag` VALUES ('85', '39', '3', null, null, null);
INSERT INTO `article_tag` VALUES ('86', '39', '4', null, null, null);
INSERT INTO `article_tag` VALUES ('87', '39', '5', null, null, null);
INSERT INTO `article_tag` VALUES ('88', '40', '2', null, null, null);
INSERT INTO `article_tag` VALUES ('89', '40', '3', null, null, null);
INSERT INTO `article_tag` VALUES ('90', '40', '4', null, null, null);
INSERT INTO `article_tag` VALUES ('91', '40', '5', null, null, null);
INSERT INTO `article_tag` VALUES ('92', '40', '1', null, null, null);
INSERT INTO `article_tag` VALUES ('93', '41', '5', null, null, null);
INSERT INTO `article_tag` VALUES ('94', '41', '4', null, null, null);
INSERT INTO `article_tag` VALUES ('95', '41', '3', null, null, null);
INSERT INTO `article_tag` VALUES ('96', '41', '2', null, null, null);
INSERT INTO `article_tag` VALUES ('97', '41', '1', null, null, null);
INSERT INTO `article_tag` VALUES ('98', '42', '1', null, null, null);
INSERT INTO `article_tag` VALUES ('99', '42', '5', null, null, null);
INSERT INTO `article_tag` VALUES ('100', '42', '2', null, null, null);
INSERT INTO `article_tag` VALUES ('101', '42', '3', null, null, null);
INSERT INTO `article_tag` VALUES ('102', '42', '4', null, null, null);
INSERT INTO `article_tag` VALUES ('103', '43', '4', null, null, null);
INSERT INTO `article_tag` VALUES ('104', '43', '5', null, null, null);
INSERT INTO `article_tag` VALUES ('105', '43', '1', null, null, null);
INSERT INTO `article_tag` VALUES ('106', '43', '2', null, null, null);
INSERT INTO `article_tag` VALUES ('107', '43', '3', null, null, null);
INSERT INTO `article_tag` VALUES ('108', '44', '5', null, null, null);
INSERT INTO `article_tag` VALUES ('109', '44', '4', null, null, null);
INSERT INTO `article_tag` VALUES ('110', '44', '3', null, null, null);
INSERT INTO `article_tag` VALUES ('111', '44', '2', null, null, null);
INSERT INTO `article_tag` VALUES ('112', '44', '1', null, null, null);

-- ----------------------------
-- Table structure for categories
-- ----------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '分类名称',
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '分类描述',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  `sort` int(11) NOT NULL DEFAULT '999' COMMENT '排序，数值越小排序越靠前',
  `articles_count` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '分类下的文章个数',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of categories
-- ----------------------------
INSERT INTO `categories` VALUES ('1', '学校生活', '学校生活的描述', '1', '996', '0', '2019-04-01 15:49:55', '2019-11-07 09:22:52', null);
INSERT INTO `categories` VALUES ('2', '艺术活动', '简介', '1', '997', '0', '2019-04-01 16:11:32', '2019-11-07 09:22:35', null);
INSERT INTO `categories` VALUES ('3', '留学申请', '留学申请', '1', '998', '0', '2019-04-19 17:23:02', '2019-11-07 09:22:07', null);
INSERT INTO `categories` VALUES ('4', '实习就业', '实习就业', '1', '999', '0', '2019-04-19 17:23:30', '2019-04-19 17:23:30', null);
INSERT INTO `categories` VALUES ('5', '夏令营', '在美夏令营活动实录', '1', '995', '0', '2019-08-22 15:06:29', '2019-11-07 09:23:03', null);
INSERT INTO `categories` VALUES ('6', '冬令营', '美国纽约艺术冬令营', '1', '994', '0', '2019-11-07 09:21:15', '2019-11-07 09:23:12', null);

-- ----------------------------
-- Table structure for operation_log
-- ----------------------------
DROP TABLE IF EXISTS `operation_log`;
CREATE TABLE `operation_log` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uid` int(10) DEFAULT NULL,
  `role_name` varchar(255) DEFAULT NULL COMMENT '角色',
  `name` varchar(255) DEFAULT NULL COMMENT '登录人员名称',
  `path` varchar(255) DEFAULT NULL,
  `method` varchar(255) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `sql` text,
  `input` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of operation_log
-- ----------------------------
INSERT INTO `operation_log` VALUES ('1', '0', null, null, 'api/admin/auth/login', 'POST', '127.0.0.1', '', '{\"email\":\"admin@admin.com\",\"password\":\"bossPassword\"}', '2021-06-04 13:46:52', '2021-06-04 13:46:52');
INSERT INTO `operation_log` VALUES ('4', '1', '超级管理员', 'admin', 'api/admin/auth/info', 'GET', '127.0.0.1', '', '[]', '2021-06-04 14:49:22', '2021-06-04 14:49:22');
INSERT INTO `operation_log` VALUES ('5', '1', '超级管理员', 'admin', 'api/admin/auth/login', 'POST', '127.0.0.1', '', '{\"email\":\"admin@admin.com\",\"password\":\"bossPassword\"}', '2021-06-04 15:05:05', '2021-06-04 15:05:05');
INSERT INTO `operation_log` VALUES ('6', '1', '超级管理员', 'admin', 'api/admin/auth/login', 'POST', '127.0.0.1', '', '{\"email\":\"admin@admin.com\",\"password\":\"bossPassword\"}', '2021-06-04 15:05:30', '2021-06-04 15:05:30');
INSERT INTO `operation_log` VALUES ('7', '1', '超级管理员', 'admin', 'api/admin/auth/info', 'GET', '127.0.0.1', '', '[]', '2021-06-04 15:05:57', '2021-06-04 15:05:57');
INSERT INTO `operation_log` VALUES ('8', '1', '超级管理员', 'admin', 'api/admin/auth/login', 'POST', '127.0.0.1', '', '{\"email\":\"admin@admin.com\",\"password\":\"bossPassword\"}', '2021-06-04 15:21:03', '2021-06-04 15:21:03');
INSERT INTO `operation_log` VALUES ('9', '1', '超级管理员', 'admin', 'api/admin/auth/login', 'POST', '127.0.0.1', '', '{\"email\":\"admin@admin.com\",\"password\":\"bossPassword\"}', '2021-06-04 16:07:59', '2021-06-04 16:07:59');
INSERT INTO `operation_log` VALUES ('10', '1', '超级管理员', 'admin', 'api/admin/auth/login', 'POST', '127.0.0.1', '', '{\"email\":\"admin@admin.com\",\"password\":\"bossPassword\"}', '2021-06-04 17:17:38', '2021-06-04 17:17:38');
INSERT INTO `operation_log` VALUES ('11', '1', '超级管理员', 'admin', 'api/admin/auth/login', 'POST', '127.0.0.1', '', '{\"email\":\"admin@admin.com\",\"password\":\"bossPassword\"}', '2021-06-05 09:26:57', '2021-06-05 09:26:57');
INSERT INTO `operation_log` VALUES ('12', '10', '客户经理', 'Salesman', 'api/admin/auth/login', 'POST', '218.94.146.142', '', '{\"email\":\"001@admin.com\",\"password\":\"bossPassword\"}', '2021-06-09 10:05:31', '2021-06-09 10:05:31');
INSERT INTO `operation_log` VALUES ('13', '11', '风控', 'RiskOfficer', 'api/admin/auth/login', 'POST', '218.94.146.142', '', '{\"email\":\"002@admin.com\",\"password\":\"bossPassword\"}', '2021-06-09 10:08:18', '2021-06-09 10:08:18');
INSERT INTO `operation_log` VALUES ('14', '12', '总经理', 'Manager', 'api/admin/auth/login', 'POST', '218.94.146.142', '', '{\"email\":\"003@admin.com\",\"password\":\"bossPassword\"}', '2021-06-09 10:10:22', '2021-06-09 10:10:22');
INSERT INTO `operation_log` VALUES ('15', '10', '客户经理', 'Salesman', 'api/admin/auth/login', 'POST', '218.94.146.142', '', '{\"email\":\"001@admin.com\",\"password\":\"bossPassword\"}', '2021-06-09 10:12:34', '2021-06-09 10:12:34');
INSERT INTO `operation_log` VALUES ('16', '12', '总经理', 'Manager', 'api/admin/auth/login', 'POST', '218.94.146.142', '', '{\"email\":\"003@admin.com\",\"password\":\"bossPassword\"}', '2021-06-09 10:12:53', '2021-06-09 10:12:53');
INSERT INTO `operation_log` VALUES ('17', '1', '超级管理员', 'Chen, Charlie', 'api/admin/auth/login', 'POST', '127.0.0.1', '', '{\"email\":\"shanghai@steptousa.com\",\"password\":\"bossPassword\"}', '2021-06-15 14:02:27', '2021-06-15 14:02:27');
INSERT INTO `operation_log` VALUES ('18', '1', '超级管理员', 'Chen, Charlie', 'api/admin/auth/login', 'POST', '127.0.0.1', '', '{\"email\":\"shanghai@steptousa.com\",\"password\":\"bossPassword\"}', '2021-06-17 09:47:54', '2021-06-17 09:47:54');

-- ----------------------------
-- Table structure for orders
-- ----------------------------
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_sn` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '订单编号',
  `user_id` int(10) unsigned NOT NULL COMMENT '订单用户',
  `product_id` int(10) unsigned NOT NULL COMMENT '订单产品',
  `product_snapshot` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '产品快照',
  `from` tinyint(3) unsigned NOT NULL,
  `from_id` int(10) unsigned NOT NULL,
  `wants_country` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '意向国家',
  `commission` decimal(10,2) unsigned NOT NULL COMMENT '佣金比例，如 12.34%，储存为 1234',
  `total_fee` decimal(12,2) unsigned NOT NULL COMMENT '总费用',
  `left_fee` decimal(12,2) unsigned NOT NULL COMMENT '剩余金额',
  `paid_fee` decimal(12,2) unsigned NOT NULL COMMENT '已付金额',
  `remark` text COLLATE utf8mb4_unicode_ci COMMENT '订单备注',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '预留字段',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `admin_id` int(10) unsigned DEFAULT NULL COMMENT '管理员信息，订单创建者信息，关联到adimn表',
  `activity_summer_camp_id` bigint(20) unsigned NOT NULL COMMENT '报名记录id',
  PRIMARY KEY (`id`),
  KEY `orders_activity_summer_camp_id_index` (`activity_summer_camp_id`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of orders
-- ----------------------------
INSERT INTO `orders` VALUES ('50', '20191119NK3QM50', '0', '12', '{\"id\":12,\"product_category_id\":4,\"name\":\"\\u7f8e\\u56fd\\u590f\\/\\u51ac\\u4ee4\\u8425\\u9879\\u76ee\",\"commission\":\"0.00\",\"price\":\"39000.00\",\"description\":null,\"content\":null,\"sort\":6,\"status\":1,\"created_at\":\"2019-05-14 14:38:45\",\"updated_at\":\"2019-10-23 10:43:01\",\"deleted_at\":null}', '3', '12', 'com', '0.00', '0.00', '0.00', '0.00', null, '1', '2019-11-19 10:22:55', '2019-11-19 10:22:55', null, null, '103');
INSERT INTO `orders` VALUES ('51', '20191119H3BD451', '0', '12', '{\"id\":12,\"product_category_id\":4,\"name\":\"\\u7f8e\\u56fd\\u590f\\/\\u51ac\\u4ee4\\u8425\\u9879\\u76ee\",\"commission\":\"0.00\",\"price\":\"39000.00\",\"description\":null,\"content\":null,\"sort\":6,\"status\":1,\"created_at\":\"2019-05-14 14:38:45\",\"updated_at\":\"2019-10-23 10:43:01\",\"deleted_at\":null}', '3', '16', 'com', '0.00', '0.00', '0.00', '0.00', null, '1', '2019-11-19 11:08:20', '2019-11-19 11:08:20', null, null, '104');
INSERT INTO `orders` VALUES ('52', '201911192QLY852', '0', '12', '{\"id\":12,\"product_category_id\":4,\"name\":\"\\u7f8e\\u56fd\\u590f\\/\\u51ac\\u4ee4\\u8425\\u9879\\u76ee\",\"commission\":\"0.00\",\"price\":\"39000.00\",\"description\":null,\"content\":null,\"sort\":6,\"status\":1,\"created_at\":\"2019-05-14 14:38:45\",\"updated_at\":\"2019-10-23 10:43:01\",\"deleted_at\":null}', '3', '20', 'com', '0.00', '0.00', '0.00', '0.00', null, '1', '2019-11-19 11:11:05', '2019-11-19 11:11:05', null, null, '105');
INSERT INTO `orders` VALUES ('53', '20191119HKBLM53', '0', '12', '{\"id\":12,\"product_category_id\":4,\"name\":\"\\u7f8e\\u56fd\\u590f\\/\\u51ac\\u4ee4\\u8425\\u9879\\u76ee\",\"commission\":\"0.00\",\"price\":\"39000.00\",\"description\":null,\"content\":null,\"sort\":6,\"status\":1,\"created_at\":\"2019-05-14 14:38:45\",\"updated_at\":\"2019-10-23 10:43:01\",\"deleted_at\":null}', '3', '32', 'com', '0.00', '0.00', '0.00', '0.00', null, '1', '2019-11-19 11:11:25', '2019-11-19 11:11:25', null, null, '106');
INSERT INTO `orders` VALUES ('54', '201911231ENHE54', '0', '12', '{\"id\":12,\"product_category_id\":4,\"name\":\"\\u7f8e\\u56fd\\u590f\\/\\u51ac\\u4ee4\\u8425\\u9879\\u76ee\",\"commission\":\"0.00\",\"price\":\"39000.00\",\"description\":null,\"content\":null,\"sort\":6,\"status\":1,\"created_at\":\"2019-05-14 14:38:45\",\"updated_at\":\"2019-10-23 10:43:01\",\"deleted_at\":null}', '3', '13', 'com', '0.00', '0.00', '0.00', '0.00', null, '1', '2019-11-23 12:43:22', '2019-11-23 12:43:22', null, null, '107');
INSERT INTO `orders` VALUES ('55', '201911249ZUXM55', '0', '12', '{\"id\":12,\"product_category_id\":4,\"name\":\"\\u7f8e\\u56fd\\u590f\\/\\u51ac\\u4ee4\\u8425\\u9879\\u76ee\",\"commission\":\"0.00\",\"price\":\"39000.00\",\"description\":null,\"content\":null,\"sort\":6,\"status\":1,\"created_at\":\"2019-05-14 14:38:45\",\"updated_at\":\"2019-10-23 10:43:01\",\"deleted_at\":null}', '2', '0', 'com', '0.00', '0.00', '0.00', '0.00', null, '1', '2019-11-24 11:48:57', '2019-11-24 11:48:57', null, null, '108');
INSERT INTO `orders` VALUES ('56', '201911243FZLL56', '0', '12', '{\"id\":12,\"product_category_id\":4,\"name\":\"\\u7f8e\\u56fd\\u590f\\/\\u51ac\\u4ee4\\u8425\\u9879\\u76ee\",\"commission\":\"0.00\",\"price\":\"39000.00\",\"description\":null,\"content\":null,\"sort\":6,\"status\":1,\"created_at\":\"2019-05-14 14:38:45\",\"updated_at\":\"2019-10-23 10:43:01\",\"deleted_at\":null}', '2', '0', 'com', '0.00', '0.00', '0.00', '0.00', null, '1', '2019-11-24 11:53:29', '2019-11-24 11:53:29', null, null, '109');
INSERT INTO `orders` VALUES ('57', '20191202SXFC057', '0', '12', '{\"id\":12,\"product_category_id\":4,\"name\":\"\\u7f8e\\u56fd\\u590f\\/\\u51ac\\u4ee4\\u8425\\u9879\\u76ee\",\"commission\":\"0.00\",\"price\":\"39000.00\",\"description\":null,\"content\":null,\"sort\":6,\"status\":1,\"created_at\":\"2019-05-14 14:38:45\",\"updated_at\":\"2019-10-23 10:43:01\",\"deleted_at\":null}', '3', '40', 'com', '0.00', '0.00', '0.00', '0.00', null, '1', '2019-12-02 17:26:36', '2019-12-02 17:26:36', null, null, '110');
INSERT INTO `orders` VALUES ('58', '201912029YLWQ58', '0', '12', '{\"id\":12,\"product_category_id\":4,\"name\":\"\\u7f8e\\u56fd\\u590f\\/\\u51ac\\u4ee4\\u8425\\u9879\\u76ee\",\"commission\":\"0.00\",\"price\":\"39000.00\",\"description\":null,\"content\":null,\"sort\":6,\"status\":1,\"created_at\":\"2019-05-14 14:38:45\",\"updated_at\":\"2019-10-23 10:43:01\",\"deleted_at\":null}', '3', '40', 'com', '0.00', '0.00', '0.00', '0.00', null, '1', '2019-12-02 17:29:13', '2019-12-02 17:29:13', null, null, '111');
INSERT INTO `orders` VALUES ('59', '20191202TU4MH59', '0', '12', '{\"id\":12,\"product_category_id\":4,\"name\":\"\\u7f8e\\u56fd\\u590f\\/\\u51ac\\u4ee4\\u8425\\u9879\\u76ee\",\"commission\":\"0.00\",\"price\":\"39000.00\",\"description\":null,\"content\":null,\"sort\":6,\"status\":1,\"created_at\":\"2019-05-14 14:38:45\",\"updated_at\":\"2019-10-23 10:43:01\",\"deleted_at\":null}', '3', '40', 'com', '0.00', '0.00', '0.00', '0.00', null, '1', '2019-12-02 21:28:34', '2019-12-02 21:28:34', null, null, '112');
INSERT INTO `orders` VALUES ('60', '20191203BI1JL60', '0', '12', '{\"id\":12,\"product_category_id\":4,\"name\":\"\\u7f8e\\u56fd\\u590f\\/\\u51ac\\u4ee4\\u8425\\u9879\\u76ee\",\"commission\":\"0.00\",\"price\":\"39000.00\",\"description\":null,\"content\":null,\"sort\":6,\"status\":1,\"created_at\":\"2019-05-14 14:38:45\",\"updated_at\":\"2019-10-23 10:43:01\",\"deleted_at\":null}', '3', '43', 'com', '0.00', '0.00', '0.00', '0.00', null, '1', '2019-12-03 15:21:36', '2019-12-03 15:21:36', null, null, '113');
INSERT INTO `orders` VALUES ('61', '20191207I5GGG61', '0', '12', '{\"id\":12,\"product_category_id\":4,\"name\":\"\\u7f8e\\u56fd\\u590f\\/\\u51ac\\u4ee4\\u8425\\u9879\\u76ee\",\"commission\":\"0.00\",\"price\":\"39000.00\",\"description\":null,\"content\":null,\"sort\":6,\"status\":1,\"created_at\":\"2019-05-14 14:38:45\",\"updated_at\":\"2019-10-23 10:43:01\",\"deleted_at\":null}', '3', '20', 'com', '0.00', '0.00', '0.00', '0.00', null, '1', '2019-12-07 09:52:26', '2019-12-07 09:52:26', null, null, '114');
INSERT INTO `orders` VALUES ('62', '20191209QT3BZ62', '0', '12', '{\"id\":12,\"product_category_id\":4,\"name\":\"\\u7f8e\\u56fd\\u590f\\/\\u51ac\\u4ee4\\u8425\\u9879\\u76ee\",\"commission\":\"0.00\",\"price\":\"39000.00\",\"description\":null,\"content\":null,\"sort\":6,\"status\":1,\"created_at\":\"2019-05-14 14:38:45\",\"updated_at\":\"2019-10-23 10:43:01\",\"deleted_at\":null}', '3', '13', 'com', '0.00', '0.00', '0.00', '0.00', null, '1', '2019-12-09 23:11:37', '2019-12-09 23:11:37', null, null, '115');
INSERT INTO `orders` VALUES ('63', '201912162TBTN63', '0', '12', '{\"id\":12,\"product_category_id\":4,\"name\":\"\\u7f8e\\u56fd\\u590f\\/\\u51ac\\u4ee4\\u8425\\u9879\\u76ee\",\"commission\":\"0.00\",\"price\":\"39000.00\",\"description\":null,\"content\":null,\"sort\":6,\"status\":1,\"created_at\":\"2019-05-14 14:38:45\",\"updated_at\":\"2019-10-23 10:43:01\",\"deleted_at\":null}', '3', '13', 'com', '0.00', '0.00', '0.00', '0.00', null, '1', '2019-12-16 17:47:31', '2019-12-16 17:47:31', null, null, '116');
INSERT INTO `orders` VALUES ('64', '20191217ESSCF64', '0', '12', '{\"id\":12,\"product_category_id\":4,\"name\":\"\\u7f8e\\u56fd\\u590f\\/\\u51ac\\u4ee4\\u8425\\u9879\\u76ee\",\"commission\":\"0.00\",\"price\":\"39000.00\",\"description\":null,\"content\":null,\"sort\":6,\"status\":1,\"created_at\":\"2019-05-14 14:38:45\",\"updated_at\":\"2019-10-23 10:43:01\",\"deleted_at\":null}', '3', '10', 'com', '0.00', '0.00', '0.00', '0.00', null, '1', '2019-12-17 10:05:41', '2019-12-17 10:05:41', null, null, '117');
INSERT INTO `orders` VALUES ('65', '201912176LZS365', '0', '12', '{\"id\":12,\"product_category_id\":4,\"name\":\"\\u7f8e\\u56fd\\u590f\\/\\u51ac\\u4ee4\\u8425\\u9879\\u76ee\",\"commission\":\"0.00\",\"price\":\"39000.00\",\"description\":null,\"content\":null,\"sort\":6,\"status\":1,\"created_at\":\"2019-05-14 14:38:45\",\"updated_at\":\"2019-10-23 10:43:01\",\"deleted_at\":null}', '2', '0', 'com', '0.00', '0.00', '0.00', '0.00', null, '1', '2019-12-17 10:42:05', '2019-12-17 10:42:05', null, null, '118');
INSERT INTO `orders` VALUES ('66', '20200830GQFUL66', '0', '12', '{\"id\":12,\"product_category_id\":4,\"name\":\"\\u7f8e\\u56fd\\u590f\\/\\u51ac\\u4ee4\\u8425\\u9879\\u76ee\",\"commission\":\"0.00\",\"price\":\"39000.00\",\"description\":null,\"content\":null,\"sort\":6,\"status\":1,\"created_at\":\"2019-05-14 14:38:45\",\"updated_at\":\"2019-10-23 10:43:01\",\"deleted_at\":null}', '2', '0', 'com', '0.00', '0.00', '0.00', '0.00', null, '1', '2020-08-30 10:25:33', '2020-08-30 10:25:33', null, null, '119');

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for permissions
-- ----------------------------
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tag` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '权限tag，用于标注分类',
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=97 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of permissions
-- ----------------------------
INSERT INTO `permissions` VALUES ('1', 'dashboard.index', 'dashboard', '首页', null, '2019-03-24 22:26:37', '2019-03-24 22:26:37');
INSERT INTO `permissions` VALUES ('2', 'admin.index', 'system', '管理员列表', null, '2019-03-24 22:26:37', '2019-03-24 22:26:37');
INSERT INTO `permissions` VALUES ('3', 'admin.show', 'system', '管理员详情', null, '2019-03-24 22:26:37', '2019-03-24 22:26:37');
INSERT INTO `permissions` VALUES ('4', 'admin.store', 'system', '添加管理员', null, '2019-03-24 22:26:37', '2019-03-24 22:26:37');
INSERT INTO `permissions` VALUES ('5', 'admin.destroy', 'system', '删除管理员', null, '2019-03-24 22:26:37', '2019-03-24 22:26:37');
INSERT INTO `permissions` VALUES ('6', 'admin.update', 'system', '修改管理员', null, '2019-03-24 22:26:37', '2019-03-24 22:26:37');
INSERT INTO `permissions` VALUES ('7', 'role.index', 'system', '角色列表', null, '2019-03-24 22:26:37', '2019-03-24 22:26:37');
INSERT INTO `permissions` VALUES ('8', 'role.show', 'system', '角色详情', null, '2019-03-24 22:26:37', '2019-03-24 22:26:37');
INSERT INTO `permissions` VALUES ('9', 'role.store', 'system', '添加角色', null, '2019-03-24 22:26:37', '2019-03-24 22:26:37');
INSERT INTO `permissions` VALUES ('10', 'role.destroy', 'system', '删除角色', null, '2019-03-24 22:26:37', '2019-03-24 22:26:37');
INSERT INTO `permissions` VALUES ('11', 'role.update', 'system', '修改角色', null, '2019-03-24 22:26:37', '2019-03-24 22:26:37');
INSERT INTO `permissions` VALUES ('12', 'permission.index', 'system', '权限列表', null, '2019-03-24 22:26:37', '2019-03-24 22:26:37');
INSERT INTO `permissions` VALUES ('13', 'permission.show', 'system', '权限详情', null, '2019-03-24 22:26:37', '2019-03-24 22:26:37');
INSERT INTO `permissions` VALUES ('14', 'permission.store', 'system', '添加权限', null, '2019-03-24 22:26:37', '2019-03-24 22:26:37');
INSERT INTO `permissions` VALUES ('15', 'permission.destroy', 'system', '删除权限', null, '2019-03-24 22:26:37', '2019-03-24 22:26:37');
INSERT INTO `permissions` VALUES ('16', 'permission.update', 'system', '修改权限', null, '2019-03-24 22:26:37', '2019-03-24 22:26:37');
INSERT INTO `permissions` VALUES ('17', 'piece_model.index', 'piece', '碎片模型列表', null, '2019-03-24 22:26:37', '2019-03-24 22:26:37');
INSERT INTO `permissions` VALUES ('18', 'piece_model.show', 'piece', '碎片模型详情', null, '2019-03-24 22:26:37', '2019-03-24 22:26:37');
INSERT INTO `permissions` VALUES ('19', 'piece_model.store', 'piece', '添加碎片模型', null, '2019-03-24 22:26:37', '2019-03-24 22:26:37');
INSERT INTO `permissions` VALUES ('20', 'piece_model.destroy', 'piece', '删除碎片模型', null, '2019-03-24 22:26:37', '2019-03-24 22:26:37');
INSERT INTO `permissions` VALUES ('21', 'piece_model.update', 'piece', '修改碎片模型', null, '2019-03-24 22:26:37', '2019-03-24 22:26:37');
INSERT INTO `permissions` VALUES ('22', 'piece.index', 'piece', '碎片列表', null, '2019-03-24 22:26:37', '2019-03-24 22:26:37');
INSERT INTO `permissions` VALUES ('23', 'piece.show', 'piece', '碎片详情', null, '2019-03-24 22:26:37', '2019-03-24 22:26:37');
INSERT INTO `permissions` VALUES ('24', 'piece.store', 'piece', '添加碎片', null, '2019-03-24 22:26:37', '2019-03-24 22:26:37');
INSERT INTO `permissions` VALUES ('25', 'piece.destroy', 'piece', '删除碎片', null, '2019-03-24 22:26:37', '2019-03-24 22:26:37');
INSERT INTO `permissions` VALUES ('26', 'piece.update', 'piece', '修改碎片', null, '2019-03-24 22:26:37', '2019-03-24 22:26:37');
INSERT INTO `permissions` VALUES ('27', 'user.index', 'user', '注册用户列表', null, '2019-03-24 22:26:37', '2019-03-24 22:26:37');
INSERT INTO `permissions` VALUES ('28', 'user.show', 'user', '注册用户详情', null, '2019-03-24 22:26:37', '2019-03-24 22:26:37');
INSERT INTO `permissions` VALUES ('29', 'user.store', 'user', '添加注册用户', null, '2019-03-24 22:26:37', '2019-03-24 22:26:37');
INSERT INTO `permissions` VALUES ('30', 'user.destroy', 'user', '删除注册用户', null, '2019-03-24 22:26:37', '2019-03-24 22:26:37');
INSERT INTO `permissions` VALUES ('31', 'user.update', 'user', '修改注册用户', null, '2019-03-24 22:26:37', '2019-03-24 22:26:37');
INSERT INTO `permissions` VALUES ('32', 'user.consult', 'user', '咨询日志', null, '2019-03-24 22:26:37', '2019-03-24 22:26:37');
INSERT INTO `permissions` VALUES ('33', 'category.index', 'article', '文章分类列表', '文章分类列表', '2019-03-24 22:26:37', '2019-08-22 11:08:35');
INSERT INTO `permissions` VALUES ('34', 'category.show', 'article', '文章分类详情', '文章分类详情', '2019-03-24 22:26:37', '2019-08-22 11:08:38');
INSERT INTO `permissions` VALUES ('35', 'category.store', 'article', '添加文章分类', '添加分类文章', '2019-03-24 22:26:37', '2019-08-22 11:08:44');
INSERT INTO `permissions` VALUES ('36', 'category.destroy', 'article', '删除文章分类', '删除分类', '2019-03-24 22:26:37', '2019-08-22 11:08:51');
INSERT INTO `permissions` VALUES ('37', 'category.update', 'article', '修改文章分类', '更新文章分类', '2019-03-24 22:26:37', '2019-08-22 11:08:28');
INSERT INTO `permissions` VALUES ('38', 'tag.index', 'article', '文章标签列表', null, '2019-03-24 22:26:37', '2019-03-24 22:26:37');
INSERT INTO `permissions` VALUES ('39', 'tag.show', 'article', '文章标签详情', null, '2019-03-24 22:26:37', '2019-03-24 22:26:37');
INSERT INTO `permissions` VALUES ('40', 'tag.store', 'article', '添加文章标签', null, '2019-03-24 22:26:37', '2019-03-24 22:26:37');
INSERT INTO `permissions` VALUES ('41', 'tag.destroy', 'article', '删除文章标签', null, '2019-03-24 22:26:37', '2019-03-24 22:26:37');
INSERT INTO `permissions` VALUES ('42', 'tag.update', 'article', '修改文章标签', null, '2019-03-24 22:26:37', '2019-03-24 22:26:37');
INSERT INTO `permissions` VALUES ('43', 'article.index', 'article', '文章列表', null, '2019-03-24 22:26:37', '2019-03-24 22:26:37');
INSERT INTO `permissions` VALUES ('44', 'article.show', 'article', '文章详情', null, '2019-03-24 22:26:37', '2019-03-24 22:26:37');
INSERT INTO `permissions` VALUES ('45', 'article.store', 'article', '添加文章', null, '2019-03-24 22:26:37', '2019-03-24 22:26:37');
INSERT INTO `permissions` VALUES ('46', 'article.destroy', 'article', '删除文章', null, '2019-03-24 22:26:37', '2019-03-24 22:26:37');
INSERT INTO `permissions` VALUES ('47', 'article.update', 'article', '修改文章', null, '2019-03-24 22:26:37', '2019-03-24 22:26:37');
INSERT INTO `permissions` VALUES ('48', 'organization.index', 'organization', '机构列表', null, '2019-03-24 22:26:37', '2019-03-24 22:26:37');
INSERT INTO `permissions` VALUES ('49', 'organization.show', 'organization', '机构详情', null, '2019-03-24 22:26:37', '2019-03-24 22:26:37');
INSERT INTO `permissions` VALUES ('50', 'organization.store', 'organization', '添加机构', null, '2019-03-24 22:26:37', '2019-03-24 22:26:37');
INSERT INTO `permissions` VALUES ('51', 'organization.destroy', 'organization', '删除机构', null, '2019-03-24 22:26:37', '2019-03-24 22:26:37');
INSERT INTO `permissions` VALUES ('52', 'organization.update', 'organization', '修改机构', null, '2019-03-24 22:26:37', '2019-03-24 22:26:37');
INSERT INTO `permissions` VALUES ('53', 'salesman.index', 'salesman', '业务员列表', null, '2019-03-24 22:26:37', '2019-03-24 22:26:37');
INSERT INTO `permissions` VALUES ('54', 'salesman.show', 'salesman', '业务员详情', null, '2019-03-24 22:26:37', '2019-03-24 22:26:37');
INSERT INTO `permissions` VALUES ('55', 'salesman.destroy', 'salesman', '删除业务员', null, '2019-03-24 22:26:37', '2019-03-24 22:26:37');
INSERT INTO `permissions` VALUES ('56', 'product_category.index', 'product', '产品分类列表', null, '2019-03-24 22:26:37', '2019-03-24 22:26:37');
INSERT INTO `permissions` VALUES ('57', 'product_category.show', 'product', '产品分类详情', null, '2019-03-24 22:26:37', '2019-03-24 22:26:37');
INSERT INTO `permissions` VALUES ('58', 'product_category.store', 'product', '添加产品分类', null, '2019-03-24 22:26:37', '2019-03-24 22:26:37');
INSERT INTO `permissions` VALUES ('59', 'product_category.destroy', 'product', '删除产品分类', null, '2019-03-24 22:26:37', '2019-03-24 22:26:37');
INSERT INTO `permissions` VALUES ('60', 'product_category.update', 'product', '修改产品分类', null, '2019-03-24 22:26:37', '2019-03-24 22:26:37');
INSERT INTO `permissions` VALUES ('61', 'product.index', 'product', '产品列表', null, '2019-03-24 22:26:37', '2019-03-24 22:26:37');
INSERT INTO `permissions` VALUES ('62', 'product.show', 'product', '产品详情', null, '2019-03-24 22:26:37', '2019-03-24 22:26:37');
INSERT INTO `permissions` VALUES ('63', 'product.store', 'product', '添加产品', null, '2019-03-24 22:26:37', '2019-03-24 22:26:37');
INSERT INTO `permissions` VALUES ('64', 'product.destroy', 'product', '删除产品', null, '2019-03-24 22:26:37', '2019-03-24 22:26:37');
INSERT INTO `permissions` VALUES ('65', 'product.update', 'product', '修改产品', null, '2019-03-24 22:26:37', '2019-03-24 22:26:37');
INSERT INTO `permissions` VALUES ('66', 'order.index', 'order', '订单列表', null, '2019-03-24 22:26:37', '2019-03-24 22:26:37');
INSERT INTO `permissions` VALUES ('67', 'order.show', 'order', '订单详情', null, '2019-03-24 22:26:37', '2019-03-24 22:26:37');
INSERT INTO `permissions` VALUES ('68', 'order.store', 'order', '添加订单', null, '2019-03-24 22:26:37', '2019-03-24 22:26:37');
INSERT INTO `permissions` VALUES ('69', 'order.destroy', 'order', '删除订单', null, '2019-03-24 22:26:37', '2019-03-24 22:26:37');
INSERT INTO `permissions` VALUES ('70', 'order.update', 'order', '修改订单', null, '2019-03-24 22:26:37', '2019-03-24 22:26:37');
INSERT INTO `permissions` VALUES ('71', 'order.detail', 'order', '订单详情', null, '2019-03-24 22:26:37', '2019-03-24 22:26:37');
INSERT INTO `permissions` VALUES ('72', 'pay_log.index', 'order', '缴费记录列表', null, '2019-03-24 22:26:37', '2019-03-24 22:26:37');
INSERT INTO `permissions` VALUES ('73', 'pay_log.show', 'order', '缴费记录详情', null, '2019-03-24 22:26:37', '2019-03-24 22:26:37');
INSERT INTO `permissions` VALUES ('74', 'pay_log.store', 'order', '添加缴费记录', null, '2019-03-24 22:26:37', '2019-03-24 22:26:37');
INSERT INTO `permissions` VALUES ('75', 'pay_log.destroy', 'order', '删除缴费记录', null, '2019-03-24 22:26:37', '2019-03-24 22:26:37');
INSERT INTO `permissions` VALUES ('76', 'pay_log.update', 'order', '修改缴费记录', null, '2019-03-24 22:26:37', '2019-03-24 22:26:37');
INSERT INTO `permissions` VALUES ('77', 'report.orders', 'report', '订单维度', '订单维度', '2019-03-24 22:26:37', '2019-04-29 13:34:50');
INSERT INTO `permissions` VALUES ('78', 'report.products', 'report', '产品维度', '产品维度', '2019-03-24 22:26:37', '2019-04-29 13:33:08');
INSERT INTO `permissions` VALUES ('79', 'report.salesmen', 'report', '业务员维度', '业务员维度', '2019-03-24 22:26:37', '2019-04-29 13:35:01');
INSERT INTO `permissions` VALUES ('80', 'activity_summer_camp.index', 'activity_summer_camp', '夏令营列表', null, '2019-03-24 22:26:37', '2019-03-24 22:26:37');
INSERT INTO `permissions` VALUES ('81', 'activity_summer_camp.show', 'activity_summer_camp', '夏令营详情', null, '2019-03-24 22:26:37', '2019-03-24 22:26:37');
INSERT INTO `permissions` VALUES ('82', 'activity_summer_camp.store', 'activity_summer_camp', '添加夏令营', null, '2019-03-24 22:26:37', '2019-03-24 22:26:37');
INSERT INTO `permissions` VALUES ('83', 'activity_summer_camp.destroy', 'activity_summer_camp', '删除夏令营', null, '2019-03-24 22:26:37', '2019-03-24 22:26:37');
INSERT INTO `permissions` VALUES ('84', 'activity_summer_camp.update', 'activity_summer_camp', '修改夏令营', null, '2019-03-24 22:26:37', '2019-03-24 22:26:37');
INSERT INTO `permissions` VALUES ('86', 'user_cash_request.index', 'user_cash_request', '提现申请记录', '提现申请记录', '2019-04-29 13:47:18', '2019-04-29 13:47:18');
INSERT INTO `permissions` VALUES ('87', 'partner.index', 'partner', '合作者列表', '合作者列表', '2019-05-01 21:59:28', '2019-05-01 21:59:28');
INSERT INTO `permissions` VALUES ('88', 'partner.update', 'partner', '修改合作者', '修改合作者', '2019-05-01 22:00:03', '2019-05-01 22:00:03');
INSERT INTO `permissions` VALUES ('89', 'activity_summer_camp.consult', 'activity_summer_camp', '咨询日志', null, '2019-07-22 11:00:03', '2019-07-22 11:00:03');
INSERT INTO `permissions` VALUES ('90', 'activity_summer_camp.create_order', 'activity_summer_camp', '创建订单', null, '2019-07-22 11:00:03', '2019-07-22 11:00:03');
INSERT INTO `permissions` VALUES ('91', 'activity_summer_camp.order_detail', 'activity_summer_camp', '订单详情', null, '2019-07-22 11:00:03', '2019-07-22 11:00:03');
INSERT INTO `permissions` VALUES ('92', 'extern_salesman.index', 'extern_salesman', '外部业务员列表', '外部业务员列表', '2019-11-18 10:50:13', '2019-11-18 10:50:13');
INSERT INTO `permissions` VALUES ('93', 'extern_salesman.store', 'extern_salesman', '添加外部业务员', '添加外部业务员', '2019-11-18 10:50:28', '2019-11-18 10:50:28');
INSERT INTO `permissions` VALUES ('95', 'extern_salesman.update', 'extern_salesman', '更新外部业务员', '更新外部业务员', '2019-11-18 10:50:53', '2019-11-18 10:50:53');
INSERT INTO `permissions` VALUES ('96', 'extern_salesman.destory', 'extern_salesman', '删除外部业务员', '删除外部业务员', '2019-11-18 10:51:08', '2019-11-18 10:51:08');

-- ----------------------------
-- Table structure for permission_role
-- ----------------------------
DROP TABLE IF EXISTS `permission_role`;
CREATE TABLE `permission_role` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `permission_role_role_id_foreign` (`role_id`),
  CONSTRAINT `permission_role_ibfk_1` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `permission_role_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of permission_role
-- ----------------------------
INSERT INTO `permission_role` VALUES ('1', '2');
INSERT INTO `permission_role` VALUES ('2', '2');
INSERT INTO `permission_role` VALUES ('3', '2');
INSERT INTO `permission_role` VALUES ('4', '2');
INSERT INTO `permission_role` VALUES ('5', '2');
INSERT INTO `permission_role` VALUES ('6', '2');
INSERT INTO `permission_role` VALUES ('7', '2');
INSERT INTO `permission_role` VALUES ('8', '2');
INSERT INTO `permission_role` VALUES ('9', '2');
INSERT INTO `permission_role` VALUES ('10', '2');
INSERT INTO `permission_role` VALUES ('11', '2');
INSERT INTO `permission_role` VALUES ('27', '2');
INSERT INTO `permission_role` VALUES ('28', '2');
INSERT INTO `permission_role` VALUES ('29', '2');
INSERT INTO `permission_role` VALUES ('30', '2');
INSERT INTO `permission_role` VALUES ('31', '2');
INSERT INTO `permission_role` VALUES ('32', '2');
INSERT INTO `permission_role` VALUES ('33', '2');
INSERT INTO `permission_role` VALUES ('34', '2');
INSERT INTO `permission_role` VALUES ('35', '2');
INSERT INTO `permission_role` VALUES ('36', '2');
INSERT INTO `permission_role` VALUES ('37', '2');
INSERT INTO `permission_role` VALUES ('38', '2');
INSERT INTO `permission_role` VALUES ('39', '2');
INSERT INTO `permission_role` VALUES ('40', '2');
INSERT INTO `permission_role` VALUES ('41', '2');
INSERT INTO `permission_role` VALUES ('42', '2');
INSERT INTO `permission_role` VALUES ('43', '2');
INSERT INTO `permission_role` VALUES ('44', '2');
INSERT INTO `permission_role` VALUES ('45', '2');
INSERT INTO `permission_role` VALUES ('46', '2');
INSERT INTO `permission_role` VALUES ('47', '2');
INSERT INTO `permission_role` VALUES ('48', '2');
INSERT INTO `permission_role` VALUES ('49', '2');
INSERT INTO `permission_role` VALUES ('50', '2');
INSERT INTO `permission_role` VALUES ('51', '2');
INSERT INTO `permission_role` VALUES ('52', '2');
INSERT INTO `permission_role` VALUES ('53', '2');
INSERT INTO `permission_role` VALUES ('54', '2');
INSERT INTO `permission_role` VALUES ('55', '2');
INSERT INTO `permission_role` VALUES ('56', '2');
INSERT INTO `permission_role` VALUES ('57', '2');
INSERT INTO `permission_role` VALUES ('58', '2');
INSERT INTO `permission_role` VALUES ('59', '2');
INSERT INTO `permission_role` VALUES ('60', '2');
INSERT INTO `permission_role` VALUES ('61', '2');
INSERT INTO `permission_role` VALUES ('62', '2');
INSERT INTO `permission_role` VALUES ('63', '2');
INSERT INTO `permission_role` VALUES ('64', '2');
INSERT INTO `permission_role` VALUES ('65', '2');
INSERT INTO `permission_role` VALUES ('66', '2');
INSERT INTO `permission_role` VALUES ('67', '2');
INSERT INTO `permission_role` VALUES ('68', '2');
INSERT INTO `permission_role` VALUES ('69', '2');
INSERT INTO `permission_role` VALUES ('70', '2');
INSERT INTO `permission_role` VALUES ('71', '2');
INSERT INTO `permission_role` VALUES ('72', '2');
INSERT INTO `permission_role` VALUES ('73', '2');
INSERT INTO `permission_role` VALUES ('74', '2');
INSERT INTO `permission_role` VALUES ('75', '2');
INSERT INTO `permission_role` VALUES ('76', '2');
INSERT INTO `permission_role` VALUES ('77', '2');
INSERT INTO `permission_role` VALUES ('78', '2');
INSERT INTO `permission_role` VALUES ('79', '2');
INSERT INTO `permission_role` VALUES ('80', '2');
INSERT INTO `permission_role` VALUES ('81', '2');
INSERT INTO `permission_role` VALUES ('82', '2');
INSERT INTO `permission_role` VALUES ('83', '2');
INSERT INTO `permission_role` VALUES ('84', '2');
INSERT INTO `permission_role` VALUES ('86', '2');
INSERT INTO `permission_role` VALUES ('87', '2');
INSERT INTO `permission_role` VALUES ('88', '2');
INSERT INTO `permission_role` VALUES ('89', '2');
INSERT INTO `permission_role` VALUES ('90', '2');
INSERT INTO `permission_role` VALUES ('91', '2');
INSERT INTO `permission_role` VALUES ('92', '2');
INSERT INTO `permission_role` VALUES ('93', '2');
INSERT INTO `permission_role` VALUES ('95', '2');
INSERT INTO `permission_role` VALUES ('96', '2');
INSERT INTO `permission_role` VALUES ('1', '3');
INSERT INTO `permission_role` VALUES ('23', '3');
INSERT INTO `permission_role` VALUES ('24', '3');
INSERT INTO `permission_role` VALUES ('26', '3');
INSERT INTO `permission_role` VALUES ('33', '3');
INSERT INTO `permission_role` VALUES ('34', '3');
INSERT INTO `permission_role` VALUES ('35', '3');
INSERT INTO `permission_role` VALUES ('36', '3');
INSERT INTO `permission_role` VALUES ('37', '3');
INSERT INTO `permission_role` VALUES ('38', '3');
INSERT INTO `permission_role` VALUES ('39', '3');
INSERT INTO `permission_role` VALUES ('40', '3');
INSERT INTO `permission_role` VALUES ('41', '3');
INSERT INTO `permission_role` VALUES ('42', '3');
INSERT INTO `permission_role` VALUES ('43', '3');
INSERT INTO `permission_role` VALUES ('44', '3');
INSERT INTO `permission_role` VALUES ('45', '3');
INSERT INTO `permission_role` VALUES ('46', '3');
INSERT INTO `permission_role` VALUES ('47', '3');
INSERT INTO `permission_role` VALUES ('1', '4');
INSERT INTO `permission_role` VALUES ('27', '4');
INSERT INTO `permission_role` VALUES ('28', '4');
INSERT INTO `permission_role` VALUES ('29', '4');
INSERT INTO `permission_role` VALUES ('31', '4');
INSERT INTO `permission_role` VALUES ('32', '4');
INSERT INTO `permission_role` VALUES ('33', '4');
INSERT INTO `permission_role` VALUES ('34', '4');
INSERT INTO `permission_role` VALUES ('35', '4');
INSERT INTO `permission_role` VALUES ('36', '4');
INSERT INTO `permission_role` VALUES ('37', '4');
INSERT INTO `permission_role` VALUES ('38', '4');
INSERT INTO `permission_role` VALUES ('39', '4');
INSERT INTO `permission_role` VALUES ('40', '4');
INSERT INTO `permission_role` VALUES ('41', '4');
INSERT INTO `permission_role` VALUES ('42', '4');
INSERT INTO `permission_role` VALUES ('43', '4');
INSERT INTO `permission_role` VALUES ('44', '4');
INSERT INTO `permission_role` VALUES ('45', '4');
INSERT INTO `permission_role` VALUES ('46', '4');
INSERT INTO `permission_role` VALUES ('47', '4');
INSERT INTO `permission_role` VALUES ('56', '4');
INSERT INTO `permission_role` VALUES ('57', '4');
INSERT INTO `permission_role` VALUES ('58', '4');
INSERT INTO `permission_role` VALUES ('60', '4');
INSERT INTO `permission_role` VALUES ('61', '4');
INSERT INTO `permission_role` VALUES ('62', '4');
INSERT INTO `permission_role` VALUES ('63', '4');
INSERT INTO `permission_role` VALUES ('65', '4');
INSERT INTO `permission_role` VALUES ('66', '4');
INSERT INTO `permission_role` VALUES ('67', '4');
INSERT INTO `permission_role` VALUES ('68', '4');
INSERT INTO `permission_role` VALUES ('70', '4');
INSERT INTO `permission_role` VALUES ('71', '4');
INSERT INTO `permission_role` VALUES ('72', '4');
INSERT INTO `permission_role` VALUES ('73', '4');
INSERT INTO `permission_role` VALUES ('74', '4');
INSERT INTO `permission_role` VALUES ('76', '4');
INSERT INTO `permission_role` VALUES ('77', '4');
INSERT INTO `permission_role` VALUES ('78', '4');
INSERT INTO `permission_role` VALUES ('79', '4');
INSERT INTO `permission_role` VALUES ('80', '4');
INSERT INTO `permission_role` VALUES ('81', '4');
INSERT INTO `permission_role` VALUES ('82', '4');
INSERT INTO `permission_role` VALUES ('1', '6');
INSERT INTO `permission_role` VALUES ('80', '6');
INSERT INTO `permission_role` VALUES ('81', '6');
INSERT INTO `permission_role` VALUES ('82', '6');
INSERT INTO `permission_role` VALUES ('83', '6');
INSERT INTO `permission_role` VALUES ('84', '6');
INSERT INTO `permission_role` VALUES ('1', '7');

-- ----------------------------
-- Table structure for permission_user
-- ----------------------------
DROP TABLE IF EXISTS `permission_user`;
CREATE TABLE `permission_user` (
  `permission_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `user_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`user_id`,`permission_id`,`user_type`),
  KEY `permission_user_permission_id_foreign` (`permission_id`),
  CONSTRAINT `permission_user_ibfk_1` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of permission_user
-- ----------------------------

-- ----------------------------
-- Table structure for pieces
-- ----------------------------
DROP TABLE IF EXISTS `pieces`;
CREATE TABLE `pieces` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `piece_model_id` int(10) unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '碎片名称',
  `values` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '碎片具体的内容',
  `sort` int(11) NOT NULL COMMENT '排序，值越小排序越靠前',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of pieces
-- ----------------------------

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES ('1', 'super-admin', '超级管理员', null, '2019-03-24 22:26:37', '2019-03-24 22:26:37');
INSERT INTO `roles` VALUES ('2', 'admin', '管理员', null, '2019-03-24 22:26:37', '2019-03-24 22:26:37');
INSERT INTO `roles` VALUES ('3', 'editor', '编辑', null, '2019-03-24 22:26:37', '2019-03-24 22:26:37');
INSERT INTO `roles` VALUES ('4', 'salesman', '业务员', null, '2019-03-24 22:26:37', '2019-03-24 22:26:37');
INSERT INTO `roles` VALUES ('5', 'accountant', '会计', null, '2019-03-24 22:26:37', '2019-03-24 22:26:37');
INSERT INTO `roles` VALUES ('6', 'guest', '访客', null, '2019-03-24 22:26:37', '2019-03-24 22:26:37');
INSERT INTO `roles` VALUES ('7', 'test', null, '这是一个测试', '2019-04-28 10:04:39', '2019-04-28 10:04:39');

-- ----------------------------
-- Table structure for role_user
-- ----------------------------
DROP TABLE IF EXISTS `role_user`;
CREATE TABLE `role_user` (
  `role_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `user_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`,`user_type`),
  KEY `role_user_role_id_foreign` (`role_id`),
  CONSTRAINT `role_user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of role_user
-- ----------------------------
INSERT INTO `role_user` VALUES ('1', '1', 'App\\Admin');
INSERT INTO `role_user` VALUES ('1', '8', 'App\\Admin');
INSERT INTO `role_user` VALUES ('2', '3', 'App\\Admin');
INSERT INTO `role_user` VALUES ('2', '4', 'App\\Admin');
INSERT INTO `role_user` VALUES ('2', '6', 'App\\Admin');
INSERT INTO `role_user` VALUES ('2', '7', 'App\\Admin');
INSERT INTO `role_user` VALUES ('2', '9', 'App\\Admin');
INSERT INTO `role_user` VALUES ('4', '5', 'App\\Admin');
INSERT INTO `role_user` VALUES ('4', '10', 'App\\Admin');
INSERT INTO `role_user` VALUES ('6', '2', 'App\\Admin');

-- ----------------------------
-- Table structure for sensitive
-- ----------------------------
DROP TABLE IF EXISTS `sensitive`;
CREATE TABLE `sensitive` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sensitive
-- ----------------------------

-- ----------------------------
-- Table structure for tags
-- ----------------------------
DROP TABLE IF EXISTS `tags`;
CREATE TABLE `tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '标签名称',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '启用状态',
  `sort` int(11) NOT NULL DEFAULT '999' COMMENT '排序，越小排序越靠前',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of tags
-- ----------------------------
INSERT INTO `tags` VALUES ('1', '游玩', '1', '999', '2019-04-01 16:12:34', '2019-04-01 16:13:03', null);
INSERT INTO `tags` VALUES ('2', '学习', '1', '999', '2019-04-01 16:12:47', '2019-04-01 16:12:47', null);
INSERT INTO `tags` VALUES ('3', '娱乐', '1', '999', '2019-04-18 12:15:36', '2019-04-18 12:15:36', null);
INSERT INTO `tags` VALUES ('4', '课外活动', '1', '999', '2019-04-18 12:15:44', '2019-04-18 12:15:44', null);
INSERT INTO `tags` VALUES ('5', '艺术', '1', '999', '2019-04-19 17:44:27', '2019-04-19 17:44:27', null);
INSERT INTO `tags` VALUES ('6', '留学', '1', '999', '2019-09-06 11:36:55', '2019-09-06 11:36:55', null);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '头像',
  `sex` tinyint(3) unsigned DEFAULT '3' COMMENT '性别：1 男 2 女 3 其他',
  `age` tinyint(3) unsigned DEFAULT '0' COMMENT '年龄',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '账号状态，默认为开启',
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `nickname` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '微信昵称',
  `openid` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '微信openid',
  `unionid` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '微信unionid',
  `wechat_snapshot` text COLLATE utf8mb4_unicode_ci COMMENT '微信信息快照',
  `brief` text COLLATE utf8mb4_unicode_ci COMMENT '简介',
  `profession` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '职业',
  `score` int(11) DEFAULT '0' COMMENT '总积分',
  `invite_id` int(11) DEFAULT NULL COMMENT '邀请人ID',
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '手机号码',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('32', 'cherry', null, 'https://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTJPpziaqOoIpGsmsGNxOM4PuVUEUkOciaL0EB7LCw9BCuh64R2DaqpxP0ia8a64rL74P2IzoLo9Sa1gA/132', '3', '0', '1', null, '2019-06-28 09:35:18', '2019-06-28 09:37:53', null, 'cherry', 'oHEJH41Km0-XS3GwzD9vUhUyoERA', null, null, null, null, null, null, null);
INSERT INTO `users` VALUES ('33', 'CharlieChen', null, 'https://wx.qlogo.cn/mmopen/vi_32/ykZIEicZFIuEtKj9Te6FcQSn2v6B4AglUYiaVAgd97bibrjCGK566jREfrpqd132evKBE4XRiaQicheiaWIgm4qMB9Vw/132', '3', '0', '1', null, '2019-06-28 10:30:19', '2020-02-26 08:50:43', null, 'Charlie Chen', 'oHEJH46-3el5MThw7H_P-241zO9Q', null, null, null, null, null, null, null);
INSERT INTO `users` VALUES ('34', '吉祥测试', null, 'https://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTL2F4Ym8BicWJF5Hlt1WoTZDX8unib8iaEXE6xRfKbSZ62NQibZyibnLs25VLonNRKjedTjG0J6SUfFuvw/132', '3', '0', '1', null, '2019-06-28 13:46:03', '2019-11-14 14:46:14', null, '正冬廿五。', 'oHEJH46ydnGaN_-YMUTwxXeZGdKw', null, null, null, null, null, null, null);
INSERT INTO `users` VALUES ('35', 'Cherry Pan', null, 'https://wx.qlogo.cn/mmopen/vi_32/OefmXGrI5KB1OEwgMLzl6iaGPVch9YJ8J6ibA2QfibgshtsA27jUcziaGT7ibwqu66SH9uNrfPfJl2aDyhPctgsTVeQ/132', '3', '0', '1', null, '2019-10-12 11:35:52', '2019-10-12 11:36:41', null, '安唯 IVY-Cherry', 'oHEJH484zDXAbGM3AlGMKn0CwnpY', null, null, null, null, null, null, null);
INSERT INTO `users` VALUES ('36', '蔡斌', null, 'undefined', '3', '0', '1', null, '2019-10-16 12:40:40', '2019-11-17 21:21:06', null, 'undefined', 'oHEJH48Ly-vGOxMb5VzTn4g0dpQI', null, null, null, null, null, null, null);
INSERT INTO `users` VALUES ('37', '马晓曦', null, 'https://wx.qlogo.cn/mmopen/vi_32/plqV9qyLOYyfyHicGibzVXCw9ibQjlnnjpMv5miaiclcdibibOIDeG2ARXgYxY2jg0XlNHcdEDFaLvnQgxG9TjbCOfY0Q/132', '3', '0', '1', null, '2019-10-22 21:41:35', '2019-10-25 08:14:54', null, '吉格尔古__马晓曦', 'oHEJH4_cMbsZBwXe_MPImAK-hbdk', null, null, null, null, null, null, null);
INSERT INTO `users` VALUES ('38', '', null, null, '3', '0', '1', '$2y$10$uYrVBvhY.xgXWgJ3DmKze.3inhSbSZEDMNKXB.fpCpuDF8Cp0g1fm', '2021-06-21 14:10:48', '2021-06-21 14:10:48', null, null, null, null, null, null, null, '0', null, '15161146908');

-- ----------------------------
-- Table structure for user_alipays
-- ----------------------------
DROP TABLE IF EXISTS `user_alipays`;
CREATE TABLE `user_alipays` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL COMMENT '用户id',
  `account` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '支付宝账户名',
  `last_used_at` datetime NOT NULL COMMENT '最近一次使用的时间，用于提示最近一次数据',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of user_alipays
-- ----------------------------

-- ----------------------------
-- Table structure for user_cards
-- ----------------------------
DROP TABLE IF EXISTS `user_cards`;
CREATE TABLE `user_cards` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL COMMENT '用户id',
  `card_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '银行卡号',
  `bank_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '开户行',
  `branch_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '支行名称',
  `last_used_at` datetime NOT NULL COMMENT '最近一次使用时间，用于提示最近使用的提现信息',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `real_name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '真实姓名',
  `tel` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '银行预留手机号',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of user_cards
-- ----------------------------

-- ----------------------------
-- Table structure for user_cash_requests
-- ----------------------------
DROP TABLE IF EXISTS `user_cash_requests`;
CREATE TABLE `user_cash_requests` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL COMMENT '用户id',
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '姓名',
  `tel` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '电话',
  `cash_way` tinyint(3) unsigned NOT NULL COMMENT '提现方式：1、支付宝 2、银行卡',
  `alipay_account` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '支付宝账号',
  `bank_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '银行',
  `branch_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '支行名称',
  `card_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '银行卡号信息',
  `cash_amount` decimal(12,2) unsigned NOT NULL COMMENT '体现金额',
  `status` tinyint(4) NOT NULL COMMENT '体现状态：0 未审核  1 处理中 2 已审核 3 审核失败',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of user_cash_requests
-- ----------------------------

-- ----------------------------
-- Table structure for user_column
-- ----------------------------
DROP TABLE IF EXISTS `user_column`;
CREATE TABLE `user_column` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) DEFAULT NULL,
  `category_id` int(10) DEFAULT NULL COMMENT '我的栏目',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='我的栏目';

-- ----------------------------
-- Records of user_column
-- ----------------------------
INSERT INTO `user_column` VALUES ('2', '38', '2', null, null);
INSERT INTO `user_column` VALUES ('3', '38', '3', null, null);
INSERT INTO `user_column` VALUES ('4', '38', '5', '2021-06-22 09:38:01', '2021-06-22 09:38:01');

-- ----------------------------
-- Table structure for user_enshrine
-- ----------------------------
DROP TABLE IF EXISTS `user_enshrine`;
CREATE TABLE `user_enshrine` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) DEFAULT NULL,
  `article_id` int(10) DEFAULT NULL COMMENT '文章id',
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT '收藏',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='收藏';

-- ----------------------------
-- Records of user_enshrine
-- ----------------------------
INSERT INTO `user_enshrine` VALUES ('1', '38', '40', '2021-06-22 15:47:26');

-- ----------------------------
-- Table structure for user_keyword
-- ----------------------------
DROP TABLE IF EXISTS `user_keyword`;
CREATE TABLE `user_keyword` (
  `id` int(10) NOT NULL,
  `keyword` varchar(255) DEFAULT NULL COMMENT '关键词',
  `created_at` timestamp NULL DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_keyword
-- ----------------------------

-- ----------------------------
-- Table structure for user_like
-- ----------------------------
DROP TABLE IF EXISTS `user_like`;
CREATE TABLE `user_like` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) DEFAULT NULL,
  `article_id` int(10) DEFAULT NULL COMMENT '文章id',
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT '收藏',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='点赞';

-- ----------------------------
-- Records of user_like
-- ----------------------------
INSERT INTO `user_like` VALUES ('1', '38', '44', null);

-- ----------------------------
-- Table structure for user_new_words
-- ----------------------------
DROP TABLE IF EXISTS `user_new_words`;
CREATE TABLE `user_new_words` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `type` tinyint(1) DEFAULT '1' COMMENT '1为四级，2为六级，3为考研词汇，4为d词典',
  `user_id` int(10) DEFAULT NULL,
  `word` varchar(255) DEFAULT NULL COMMENT '单词',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_new_words
-- ----------------------------

-- ----------------------------
-- Table structure for user_read
-- ----------------------------
DROP TABLE IF EXISTS `user_read`;
CREATE TABLE `user_read` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `article_id` int(10) DEFAULT NULL COMMENT '新闻id',
  `user_id` int(10) DEFAULT NULL COMMENT '用户id',
  `created_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0' COMMENT '1为已读，0为未读',
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='用户阅读列表';

-- ----------------------------
-- Records of user_read
-- ----------------------------
INSERT INTO `user_read` VALUES ('1', '1', '38', '2021-06-24 14:02:39', '0', '2021-06-24 14:02:39');
INSERT INTO `user_read` VALUES ('2', '2', '38', null, '0', null);

-- ----------------------------
-- Table structure for user_read_notes
-- ----------------------------
DROP TABLE IF EXISTS `user_read_notes`;
CREATE TABLE `user_read_notes` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `article_id` int(10) DEFAULT NULL COMMENT '文章id',
  `content` text COMMENT '笔记内容',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='阅读笔记';

-- ----------------------------
-- Records of user_read_notes
-- ----------------------------
INSERT INTO `user_read_notes` VALUES ('1', '1', '这是笔记，这是笔记，这是笔记', '2021-06-25 10:19:53', '2021-06-25 10:19:53', '38');
INSERT INTO `user_read_notes` VALUES ('2', '1', '这是笔记，这是笔记，这是笔记', '2021-06-25 10:20:53', '2021-06-25 10:20:53', '38');

-- ----------------------------
-- Table structure for user_score
-- ----------------------------
DROP TABLE IF EXISTS `user_score`;
CREATE TABLE `user_score` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `score` int(10) DEFAULT NULL,
  `user_id` int(10) DEFAULT NULL COMMENT '用户id',
  `gain_id` int(10) DEFAULT NULL COMMENT '积分方式',
  `gain` varchar(255) DEFAULT NULL COMMENT '积分获取或者消耗',
  `type` tinyint(1) DEFAULT '1' COMMENT '1为增加，2为减少',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_score
-- ----------------------------

-- ----------------------------
-- Table structure for user_set
-- ----------------------------
DROP TABLE IF EXISTS `user_set`;
CREATE TABLE `user_set` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) DEFAULT NULL,
  `is_preference` tinyint(1) DEFAULT '1' COMMENT '1为设置，0为不设置',
  `four_level` tinyint(1) DEFAULT '0' COMMENT '0为不开，1为打开',
  `six_level` tinyint(1) DEFAULT NULL,
  `kaoyan` tinyint(1) DEFAULT '1' COMMENT '1为设置，0为不设置',
  `niujin` tinyint(1) DEFAULT '1',
  `maike` tinyint(1) DEFAULT '1',
  `kelinsi` tinyint(1) DEFAULT '1',
  `is_intact` tinyint(1) DEFAULT '1',
  `analysis_fitst` tinyint(1) DEFAULT '1',
  `analysis_too` tinyint(1) DEFAULT '0',
  `analysis_three` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `is_news` tinyint(1) DEFAULT '1' COMMENT '1为接收，0为不接受',
  `font_size` tinyint(1) DEFAULT '1' COMMENT '字体大小',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_set
-- ----------------------------

-- ----------------------------
-- Table structure for user_share
-- ----------------------------
DROP TABLE IF EXISTS `user_share`;
CREATE TABLE `user_share` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) DEFAULT NULL,
  `article_id` int(10) DEFAULT NULL COMMENT '文章id',
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT '收藏',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='分享';

-- ----------------------------
-- Records of user_share
-- ----------------------------
INSERT INTO `user_share` VALUES ('1', '38', '44', null);

-- ----------------------------
-- Table structure for user_task
-- ----------------------------
DROP TABLE IF EXISTS `user_task`;
CREATE TABLE `user_task` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) DEFAULT NULL,
  `title` text,
  `content` text,
  `title_en` text,
  `content_en` text,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_task
-- ----------------------------

-- ----------------------------
-- Table structure for wechat_users
-- ----------------------------
DROP TABLE IF EXISTS `wechat_users`;
CREATE TABLE `wechat_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `openid` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'openid信息',
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '头像',
  `nickname` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '昵称',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `wechat_users_openid_unique` (`openid`)
) ENGINE=InnoDB AUTO_INCREMENT=114 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of wechat_users
-- ----------------------------
INSERT INTO `wechat_users` VALUES ('36', 'oHEJH437-3MzhkI8fhTXuEWroyfw', 'https://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTJo6OYpugblmIUITU1H9Gld3JicIEjSZqia8Vm5K6s2Jh50iatXzFVhW619CiaU6rC17ibIYcBvXLuWDTg/132', 'Josen', '2019-06-26 18:15:56', '2019-06-26 18:15:56');
INSERT INTO `wechat_users` VALUES ('37', 'oHEJH441QbW8lPCJr7KT7WuZFRls', 'https://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTJaRIAKVbf23j06gAoBdHIBKDdwXMeANxzJ8LGibTwJhptrVMewcpicFfdW4sKRQbQNvNF7icMRUWduA/132', 'Yvonne Z ?', '2019-06-27 13:31:20', '2019-06-27 13:31:20');
INSERT INTO `wechat_users` VALUES ('38', 'oHEJH41Km0-XS3GwzD9vUhUyoERA', 'https://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTJPpziaqOoIpGsmsGNxOM4PuVUEUkOciaL0EB7LCw9BCuh64R2DaqpxP0ia8a64rL74P2IzoLo9Sa1gA/132', 'cherry', '2019-06-27 13:31:42', '2019-06-27 13:31:42');
INSERT INTO `wechat_users` VALUES ('39', 'oHEJH484zDXAbGM3AlGMKn0CwnpY', 'https://wx.qlogo.cn/mmopen/vi_32/OefmXGrI5KB1OEwgMLzl6iaGPVch9YJ8J6ibA2QfibgshtsA27jUcziaGT7ibwqu66SH9uNrfPfJl2aDyhPctgsTVeQ/132', '安唯 IVY-Cherry', '2019-06-27 20:37:51', '2019-06-27 20:37:51');
INSERT INTO `wechat_users` VALUES ('40', 'oHEJH46ydnGaN_-YMUTwxXeZGdKw', 'https://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTL2F4Ym8BicWJF5Hlt1WoTZDX8unib8iaEXE6xRfKbSZ62NQibZyibnLs25VLonNRKjedTjG0J6SUfFuvw/132', '正冬廿五。', '2019-06-28 10:10:56', '2019-11-14 14:46:14');
INSERT INTO `wechat_users` VALUES ('41', 'oHEJH46-3el5MThw7H_P-241zO9Q', 'https://wx.qlogo.cn/mmopen/vi_32/ykZIEicZFIuEtKj9Te6FcQSn2v6B4AglUYiaVAgd97bibrjCGK566jREfrpqd132evKBE4XRiaQicheiaWIgm4qMB9Vw/132', 'Charlie Chen', '2019-06-28 10:21:33', '2020-02-26 08:50:43');
INSERT INTO `wechat_users` VALUES ('42', 'oHEJH4-EKykwWpJeG-06b3mqjuvo', 'https://wx.qlogo.cn/mmopen/vi_32/AngGB6RVYm1ZTCKjx7Dr0KWGkVd4Mvp46bPMuvuU4AWos6rBZJfvc5TJibw1ia3ez8oZW39MnOzV44LYSeziaFRng/132', '安唯 IVY-Yvonne', '2019-06-28 10:33:47', '2019-06-28 10:33:47');
INSERT INTO `wechat_users` VALUES ('43', 'oHEJH4-h5QjrCvO_Mt_KLkgj-cO4', 'https://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTIwX34ia7XZUKI1gnWLAqaibhjLjiaknlR386RGgeQPPibXcF50wXGwwvqGh9FB3X1oK04VtCibaicRaV3w/132', 'cherry', '2019-06-28 10:37:49', '2019-06-28 10:37:49');
INSERT INTO `wechat_users` VALUES ('44', 'oHEJH4_aAAcTBfraieyM8g_lsCDc', 'https://wx.qlogo.cn/mmhead/otv0kYVrS6UB1JxvEeia8IoujKYxIib32poNOU1c0LIWU/132', '李曼贞', '2019-06-28 16:45:49', '2019-06-28 16:45:49');
INSERT INTO `wechat_users` VALUES ('45', 'oHEJH40CGabV31TVXKGsztVCmddE', 'https://wx.qlogo.cn/mmopen/vi_32/Sd3E2gVQs5mg4qBQeWLIsxqmibwUic6hvorlhJYAKmz46c7Savch8MmdFcFjERWpw4t9kfLT4bZIK6icbrtPFsRQg/132', 'Nimo', '2019-07-01 10:52:00', '2019-07-01 10:52:00');
INSERT INTO `wechat_users` VALUES ('46', 'oHEJH47JWvN8aU0N5WjfSZnVeZaU', 'https://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTIKoEicqUZTJlygvicNJeS4j8nmSq6zibGCO509MYLjtBTYydHc5LuK5JDeYtY5iaRbpicl1IJWjCy6XvQ/132', '大久_寶', '2019-07-01 18:13:30', '2019-07-01 18:13:30');
INSERT INTO `wechat_users` VALUES ('47', 'oHEJH48Ly-vGOxMb5VzTn4g0dpQI', 'undefined', 'undefined', '2019-07-03 15:21:52', '2019-11-17 21:21:06');
INSERT INTO `wechat_users` VALUES ('48', 'oHEJH4w74UX0LlKGDFcsUo4D21F8', 'https://wx.qlogo.cn/mmopen/vi_32/p0M6RbnZzhf4quzpicF6Oic6DLfExaGm7NqQUwHQglfQUyryuOY1PSjE6nxx4p0JBYzAYHSFek5maMNaiadqdvlyQ/132', '汤圆大媛宝W', '2019-07-05 13:22:53', '2019-07-05 13:22:53');
INSERT INTO `wechat_users` VALUES ('49', 'oHEJH46k8NmY0g2dtsCWc4WaPDxM', 'https://wx.qlogo.cn/mmhead/Xiarz4Ie8iaUgXXJd2UicZBCAWSMawn62fvRMhwRaHa1vM/132', '张立男', '2019-07-10 18:53:32', '2019-07-10 18:53:32');
INSERT INTO `wechat_users` VALUES ('50', 'oHEJH48jzb8jS2QXNxoWlE-e3Fms', 'https://wx.qlogo.cn/mmhead/iawbcLCHcSjvcAbUFPpUX2xHMGdXh5Bbo55u4JeHSlNQ/132', '黄怡如', '2019-07-10 18:56:04', '2019-07-10 18:56:04');
INSERT INTO `wechat_users` VALUES ('51', 'oHEJH47K9Ubv4rUkPSLdpinWs_wk', 'https://wx.qlogo.cn/mmhead/hrOia9MVVnoUH89JiaQrGrMuH3X7KK9wdYfsyoPciaK8CY/132', '陈重依', '2019-07-10 19:03:46', '2019-07-10 19:03:46');
INSERT INTO `wechat_users` VALUES ('52', 'oHEJH4zzrBqAY_mLcaG2MipRrG7k', 'https://wx.qlogo.cn/mmhead/MaK1fApTh67hOUb3DtvRgMmg7rm50TN0y1GL7kIcVNc/132', '倪盈如', '2019-07-11 01:12:39', '2019-07-11 01:12:39');
INSERT INTO `wechat_users` VALUES ('53', 'oHEJH41SpUm5l--PNUywDZsiTon0', 'https://wx.qlogo.cn/mmhead/tSx1oy7QTB6sVcspqXxmTXCCCYawPQCwmwD0MhPia28E/132', '甯梦妃', '2019-07-11 05:31:15', '2019-07-11 05:31:15');
INSERT INTO `wechat_users` VALUES ('54', 'oHEJH413IGS_NjgQmK8ZbVltH_FI', 'https://wx.qlogo.cn/mmhead/rneMlzCiabb4AnIG0ibqGC9PwRrf0PSdSpFQehXNwHq0I/132', '陈美平', '2019-07-18 04:40:06', '2019-07-18 04:40:06');
INSERT INTO `wechat_users` VALUES ('55', 'oHEJH466SQyP7cA8GULWPS0OzrHQ', 'https://wx.qlogo.cn/mmopen/vi_32/l68eJQsAVWJt7x8OhuD191T0EiciaRmpujR9A5Z22g62icEbMbJuniaUCII6AIpcNfNCuU4HbRgPDIGIgz7DUbGMbA/132', '饭饭小猪', '2019-07-22 10:42:31', '2019-07-22 10:42:31');
INSERT INTO `wechat_users` VALUES ('56', 'oHEJH49i-3Xg32jLLWwZDrmbEhX0', 'https://wx.qlogo.cn/mmhead/76qQJ0BiciaiblG9d1PkqtgvvGKaB26qzsxnAGyMelMnG4/132', '林建辉', '2019-07-25 04:16:42', '2019-07-25 04:16:42');
INSERT INTO `wechat_users` VALUES ('57', 'oHEJH48N260HukCXCfJPRvJzdrdY', 'https://wx.qlogo.cn/mmhead/C0ETvO6dZsQEkKiaq0ewMCbGSJcYKTibyicCFdldl5Yz2g/132', '张俊吉', '2019-08-01 07:15:20', '2019-08-01 07:15:20');
INSERT INTO `wechat_users` VALUES ('58', 'oHEJH47GHrhAA0j1qwWItyG9Sbo4', 'https://wx.qlogo.cn/mmhead/szMvTY3jlCpB0836ChX9XicQC0FAE4E7EiaJOiahvBT04s/132', '曾建玮', '2019-08-08 02:39:32', '2019-08-08 02:39:32');
INSERT INTO `wechat_users` VALUES ('59', 'oHEJH45b4uTlNNJFE2QDJYdIc2zI', 'https://wx.qlogo.cn/mmopen/vi_32/5EjGcbubqBohc1dgZasl1WahY9K9AerIeARFxyS4dcbXC63Je1ibR0euQqVayfg4zjecSDagAtJJCqtX5Q8kibnQ/132', '杨坤', '2019-08-12 09:55:34', '2019-08-12 09:55:34');
INSERT INTO `wechat_users` VALUES ('60', 'oHEJH4xSIeHlZ0hsbOCpboCBxRPo', 'https://wx.qlogo.cn/mmhead/HwkaLG2b2LpoygibaCcvqPSzl6mibv9BRXvCZlleUaWHg/132', '王琼梦', '2019-08-15 06:49:41', '2019-08-15 06:49:41');
INSERT INTO `wechat_users` VALUES ('61', 'oHEJH4zVBKiwqRjSxN6fqxr9NKNM', 'https://wx.qlogo.cn/mmhead/BqXybahcmzbbSerXdaEM3W3otVFjBAEosmRdoojntPI/132', '安丽君', '2019-08-22 08:24:12', '2019-08-22 08:24:12');
INSERT INTO `wechat_users` VALUES ('62', 'oHEJH4_G4YewzQZ-Dkdc2dGCCku0', 'https://wx.qlogo.cn/mmhead/Bht2A0vgicb4sovMV5vEq8LGXAV853HG7Mw3KDvE3E7Q/132', '夏智钧', '2019-08-29 06:58:15', '2019-08-29 06:58:15');
INSERT INTO `wechat_users` VALUES ('63', 'oHEJH48ht8JIz4QNQzhfKaQwo3fA', 'https://wx.qlogo.cn/mmopen/vi_32/c8s3YZTcniaGqESxAZoX3MPQeBQxDhsG09GN7WVoAJzSHGj1zaxcJ5U9unqjickPtQkR121Qib7U5y0NQgewK1mXA/132', '樊大帅', '2019-09-04 04:29:47', '2019-09-04 04:29:47');
INSERT INTO `wechat_users` VALUES ('64', 'oHEJH40ARxvaYYvo4cF_ki4Iilz8', 'https://wx.qlogo.cn/mmhead/IzicUF7YSwAfeibezojqLLpmmVeU5fPzC6NVgRD5cmTOo/132', '李明汉', '2019-09-05 04:53:11', '2019-09-05 04:53:11');
INSERT INTO `wechat_users` VALUES ('65', 'oHEJH40gN6IOAmHZNb-Zv1RLcBDo', 'https://wx.qlogo.cn/mmopen/vi_32/DYAIOgq83erNJGciaubuz5de2Bd0CmYzz8gjYRFOB8OltJoANSuCWjbXEicjvicqI6IYdqKMI1SgbT6wG88zxKQAQ/132', 'jason chen', '2019-09-05 06:38:15', '2019-09-05 06:38:15');
INSERT INTO `wechat_users` VALUES ('66', 'oHEJH4wr5cvPMQUjzCghz04b64Ug', 'https://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTIgmWmb9ia7ekhKuCfgV7ibRTzjP9nT17S31bqkbiaicAgrAicaaNrYE0MotofFznf94cohgeEyDXPENUA/132', 'Julie', '2019-09-05 18:31:03', '2019-09-05 18:31:03');
INSERT INTO `wechat_users` VALUES ('67', 'oHEJH44m6F0UB_n90hyFqBwLmZ1Q', 'https://wx.qlogo.cn/mmhead/zNNO2CfGOzm8MTZjwcPB3ozhoKic1icKcAFtHbkpl4ibCs/132', '林可怡', '2019-09-12 09:19:16', '2019-09-12 09:19:16');
INSERT INTO `wechat_users` VALUES ('68', 'oHEJH43CzFBMON_yHiadmu2CKLpw', 'https://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTLVScib46BY76iaNKwGf5oS9cXpibWKSeRJH1PteM0MKKa2xeEFIgSvpF5Z03evtEnazSVcXTHtkadTg/132', '樊全红13453412913', '2019-09-13 00:02:07', '2019-09-13 00:02:07');
INSERT INTO `wechat_users` VALUES ('69', 'oHEJH4-q9qdQ_4vN_AspqtEpxKiY', 'https://wx.qlogo.cn/mmhead/gOo88bpbDGHCX3vQTm5FrkqVl1daxVGvdVJhx6zbSo4/132', '林佩昆', '2019-09-19 05:39:19', '2019-09-19 05:39:19');
INSERT INTO `wechat_users` VALUES ('70', 'oHEJH4_5NcznXs0p1lL_KRNLDL8E', 'https://wx.qlogo.cn/mmhead/PDUdrUmQaWic6TRFsy3zMwxfibBibN4icMbKo9cl8mEa2cg/132', '洪祯昌', '2019-09-26 13:06:56', '2019-09-26 13:06:56');
INSERT INTO `wechat_users` VALUES ('71', 'oHEJH4-QdOqHrbAWbZMkwiWUvbe0', 'https://wx.qlogo.cn/mmhead/K0olExic1ZUXqicdicMegBic0kkWw8tp7WXib0B5L68dKyh0/132', '王登康', '2019-09-30 15:39:17', '2019-09-30 15:39:17');
INSERT INTO `wechat_users` VALUES ('72', 'oHEJH47sDe38YBLM1q7TOYJYIVe0', 'undefined', 'undefined', '2019-09-30 18:53:25', '2019-09-30 18:53:25');
INSERT INTO `wechat_users` VALUES ('73', 'oHEJH47dDonVCpJ2mKpqtL0iyZLE', 'https://wx.qlogo.cn/mmhead/iaeyHGc3yVgibypPGKWjVQc0TpWgqymPic6roic0nqHhslc/132', '蓝紫启', '2019-10-01 06:00:24', '2019-10-01 06:00:24');
INSERT INTO `wechat_users` VALUES ('74', 'oHEJH4ygnQRsbhkxq-TdinKDPWuM', 'https://wx.qlogo.cn/mmhead/AV7HfW2bsiauQBVOicrlfrXdWlegDsGNtAqvMnEic3CPia4/132', '王佩桦', '2019-10-03 09:25:59', '2019-10-03 09:25:59');
INSERT INTO `wechat_users` VALUES ('75', 'oHEJH4xeIvh5Cy0ADSsYuWYAKzTQ', 'https://wx.qlogo.cn/mmhead/0APmnLuDpvbQr6t5ld6yfWsyIHEh4trbockibE4VYMAU/132', '于嘉雯', '2019-10-10 10:29:04', '2019-10-10 10:29:04');
INSERT INTO `wechat_users` VALUES ('76', 'oHEJH4zrJPulAlDG5y-HlyJRNtgI', 'https://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTKsnriblte2JuQ397YCzjbPHf5kiagKicT9AgIddqY1xFV35uTj6ibdGlHEMDOzP2MnyxSrXAv4SRtbibA/132', '无敌小霹雳鱼?', '2019-10-10 14:21:51', '2019-10-10 14:21:51');
INSERT INTO `wechat_users` VALUES ('77', 'oHEJH40hIZeRd9UkFLZh2TKB2IFc', 'https://wx.qlogo.cn/mmopen/vi_32/DYAIOgq83eorwiaJcRPxKMHIEOAj7jwPcNiaOEX349z3yIZQyajDnrHaRsY3s9TQsTibwNMcagxJPOFNDOlry9d4g/132', '阿芙', '2019-10-12 21:58:59', '2019-10-12 21:58:59');
INSERT INTO `wechat_users` VALUES ('78', 'oHEJH460RijPTHHgIS4QrlHMtWcg', 'https://wx.qlogo.cn/mmhead/ajuS1gBpJgkwmMkmxdOkTmTTjc94aIYibj0k1EABkyqI/132', '杨冠廷', '2019-10-17 09:09:45', '2019-10-17 09:09:45');
INSERT INTO `wechat_users` VALUES ('79', 'oHEJH4zyk8snfmPzBQcI835ZCOF8', 'https://wx.qlogo.cn/mmopen/vi_32/J2LLw7tMib7H5Riba5KZty0Zm1OpzBWGSvWpjyj9OnrNmSmnmvXeMSPcOWF0OPx6srPTDsAzenI4gdT1s2JWdpzQ/132', '金角大王', '2019-10-17 15:00:31', '2019-10-17 15:00:31');
INSERT INTO `wechat_users` VALUES ('80', 'oHEJH45RUvMm1I38djObifaUyQJQ', 'https://wx.qlogo.cn/mmhead/DjOqtuOGRTErXBibDwvUL20u6GFYHXyafM63mw9peuTg/132', '蔡欣昆', '2019-10-20 01:36:57', '2019-10-20 01:36:57');
INSERT INTO `wechat_users` VALUES ('81', 'oHEJH4_cMbsZBwXe_MPImAK-hbdk', 'https://wx.qlogo.cn/mmopen/vi_32/plqV9qyLOYyfyHicGibzVXCw9ibQjlnnjpMv5miaiclcdibibOIDeG2ARXgYxY2jg0XlNHcdEDFaLvnQgxG9TjbCOfY0Q/132', '吉格尔古__马晓曦', '2019-10-22 13:34:19', '2019-10-22 13:34:19');
INSERT INTO `wechat_users` VALUES ('82', 'oHEJH45ilVldouAHtVjha0FxMfG0', 'https://wx.qlogo.cn/mmopen/vi_32/DYAIOgq83erHptprpbDzymjKy6qsWRy84XZNBXeIOEGyWh2p6YianQOZImFhCNrrgkEStiaJiapq6ppSm1fLXHaLA/132', 'Bonnie', '2019-10-24 00:48:54', '2019-10-24 00:48:54');
INSERT INTO `wechat_users` VALUES ('83', 'oHEJH42NHBiSFINXo-Y9w9KCOoxU', 'https://wx.qlogo.cn/mmhead/K0olExic1ZUXqicdicMegBic0kkWw8tp7WXib0B5L68dKyh0/132', '黄正湖', '2019-10-24 20:24:10', '2019-10-24 20:24:10');
INSERT INTO `wechat_users` VALUES ('84', 'oHEJH4yYFIKHFGL7sirZBhpCaG7Y', 'https://wx.qlogo.cn/mmhead/Aia5pFwBiaGeatR2wUYBqN6OqpXpXQV7j9BDY6wq8vODE/132', '郑俐雪', '2019-10-31 02:16:23', '2019-10-31 02:16:23');
INSERT INTO `wechat_users` VALUES ('85', 'oHEJH454UUgQU1vs8I_WFE6_SB98', 'undefined', 'undefined', '2019-10-31 15:14:05', '2019-10-31 15:14:14');
INSERT INTO `wechat_users` VALUES ('86', 'oHEJH4643R_PNxzvxXgTORgasods', 'https://wx.qlogo.cn/mmopen/vi_32/JDyCcvZlUImVkNa0AmbDMgQTq577iabO8e6OAIgS2Yzf5qw6JGO4iasRuzBfwveaVEKmqwWq1xfRFJNdc8XcnQmQ/132', 'IVY(China) Study Abroad Service', '2019-10-31 22:43:20', '2019-10-31 22:43:20');
INSERT INTO `wechat_users` VALUES ('87', 'oHEJH44KP9ae_bY3egSmgw_63bos', 'undefined', 'undefined', '2019-11-06 10:17:26', '2019-11-06 10:17:26');
INSERT INTO `wechat_users` VALUES ('88', 'oHEJH49Ljyuj96firYIPeLEHN9Ec', 'undefined', 'undefined', '2019-11-06 10:17:26', '2019-11-06 10:17:26');
INSERT INTO `wechat_users` VALUES ('89', 'oHEJH49WI2a57auEVNZmQKsY3TQE', 'https://wx.qlogo.cn/mmhead/rneMlzCiabb4AnIG0ibqGC9PwRrf0PSdSpFQehXNwHq0I/132', '陈淑媛', '2019-11-06 10:18:07', '2019-11-06 10:18:07');
INSERT INTO `wechat_users` VALUES ('90', 'oHEJH4z_5xM_NxA86BOkNw-dzPl8', 'https://wx.qlogo.cn/mmhead/NVscISQ1icjE2ic4gKXfx5HajElCnAMJQPRr3W3UQEHZM/132', '黄淑君', '2019-11-06 13:00:46', '2019-11-06 13:00:46');
INSERT INTO `wechat_users` VALUES ('91', 'oHEJH48Zpkn9xqFXLp8-I2zHTjXM', 'https://wx.qlogo.cn/mmhead/IvkNORWNwOwX7yqKmLFsCMQoF8RYW02ibXcXhQDrwCJc/132', '何淑娟', '2019-11-07 03:13:27', '2019-11-07 03:13:27');
INSERT INTO `wechat_users` VALUES ('92', 'oHEJH491n5PSLX_e8-MAUnEloi3U', 'undefined', 'undefined', '2019-11-10 21:26:52', '2019-11-10 21:26:52');
INSERT INTO `wechat_users` VALUES ('93', 'oHEJH4-ph1-1Zaz3c1f4_h_jeo4M', 'https://wx.qlogo.cn/mmhead/YKSebHHibqWbkQjrMT7RFHnyibUybEj1zu8vicV9XYkzFw/132', '李佩冰', '2019-11-14 08:05:52', '2019-11-14 08:05:52');
INSERT INTO `wechat_users` VALUES ('94', 'oHEJH43qvtZzm0K_KRcibYzyZFDk', 'undefined', 'undefined', '2019-11-14 11:16:29', '2019-11-14 11:16:29');
INSERT INTO `wechat_users` VALUES ('95', 'oHEJH4wKJFp6hTUBdTZHWHlxLCDA', 'undefined', 'undefined', '2019-11-14 11:16:29', '2019-11-14 11:16:29');
INSERT INTO `wechat_users` VALUES ('96', 'oHEJH450jH7oPARtOXy9bbQmgxUk', 'undefined', 'undefined', '2019-11-14 14:35:56', '2019-11-14 14:35:56');
INSERT INTO `wechat_users` VALUES ('97', 'oHEJH42dbUDI_cbOxhlhzR66BqgA', 'undefined', 'undefined', '2019-11-14 14:41:50', '2019-11-14 14:41:50');
INSERT INTO `wechat_users` VALUES ('98', 'oHEJH42jyk7b8tjY3I_wqTOHHUzM', 'https://wx.qlogo.cn/mmopen/vi_32/DYAIOgq83ep7a4SBjp2ib39p1NO5ZwBdds2vw9zmJEHUwuiabtNwl9Vssfw6GhAYUQ4UyNXKTXNyhcUKV5WIVUtg/132', '罗浩', '2019-11-14 14:50:38', '2019-11-14 14:50:38');
INSERT INTO `wechat_users` VALUES ('99', 'oHEJH40GXXh5YualQ1Pj3D0KciH8', 'undefined', 'undefined', '2019-11-14 16:50:29', '2019-11-14 16:50:29');
INSERT INTO `wechat_users` VALUES ('100', 'oHEJH4wdYMp6ksb_t9e6JWFe9Dz0', 'undefined', 'undefined', '2019-11-14 16:50:29', '2019-11-14 16:50:29');
INSERT INTO `wechat_users` VALUES ('101', 'oHEJH4yDVgqDH3nNsgxorCzxSdeo', 'https://wx.qlogo.cn/mmhead/ndiboYMXoszJ762tXW8ac8rsEM6KVM2r3AqmtWvGmjiaY/132', '杨凯珠', '2019-11-15 07:35:26', '2019-11-15 07:35:26');
INSERT INTO `wechat_users` VALUES ('102', 'oHEJH4wsTY9-3QWsMAxEXsHn3eC8', 'https://wx.qlogo.cn/mmhead/EicEyUIj6jFkneKK1LzfY5JJdTUia3ooluFQABicPu2v0g/132', '林白珊', '2019-11-16 05:35:29', '2019-11-16 05:35:29');
INSERT INTO `wechat_users` VALUES ('103', 'oHEJH46jbaO_PdOanXwJjdjTkwoM', 'undefined', 'undefined', '2019-12-28 07:18:43', '2019-12-28 07:18:43');
INSERT INTO `wechat_users` VALUES ('105', 'oHEJH4-rM87o4TK2oZ2k417G9mI4', 'undefined', 'undefined', '2020-04-22 04:22:02', '2020-04-22 04:22:02');
INSERT INTO `wechat_users` VALUES ('106', 'oHEJH45BDm4GJTFPCKMKwBybuG_c', 'https://wx.qlogo.cn/mmopen/vi_32/p2R8yFwI68hjBrPc95BicP7rAjF9d7c7qaLKzywwhX7Ms8vfD7hJicrtQfKvvdNHGxgXaDk1wsGjTIJ38ZnnxeJQ/132', '[强]抽奖游戏I小程序I网站I招代理', '2020-06-12 14:36:20', '2020-06-12 14:36:20');
INSERT INTO `wechat_users` VALUES ('107', 'oHEJH45eaLHpWEMkjOzCrFjgQZ7Y', 'undefined', 'undefined', '2020-07-19 07:33:58', '2020-07-19 07:33:58');
INSERT INTO `wechat_users` VALUES ('109', 'oHEJH4-mwD_BvSLNU6E_3Xoyw7O8', 'undefined', 'undefined', '2020-08-26 04:53:43', '2020-08-26 04:53:43');
INSERT INTO `wechat_users` VALUES ('111', 'oHEJH40Yd6ew6ocJGHNQz4cdS7J8', 'undefined', 'undefined', '2020-11-17 08:36:41', '2020-11-17 08:36:41');
INSERT INTO `wechat_users` VALUES ('112', 'oHEJH485FjSPzH27i2nNrABnnRQw', 'undefined', 'undefined', '2021-01-01 05:36:48', '2021-01-01 05:36:48');
INSERT INTO `wechat_users` VALUES ('113', 'oHEJH49ZIH-jjRLAK23iT7v_YVEk', 'undefined', 'undefined', '2021-02-25 04:19:24', '2021-02-25 04:19:24');

-- ----------------------------
-- Table structure for word
-- ----------------------------
DROP TABLE IF EXISTS `word`;
CREATE TABLE `word` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `word` varchar(255) DEFAULT NULL,
  `type` int(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of word
-- ----------------------------
