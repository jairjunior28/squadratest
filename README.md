Criado a partir do skeleton aplication e implementado algumas telas de cadastros.



DROP TABLE IF EXISTS `sistema`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sistema` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(100) NOT NULL,
  `sigla` varchar(10) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `url` varchar(50) DEFAULT NULL,
  `usuario` varchar(100) DEFAULT NULL,
  `justificativa` varchar(500) DEFAULT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;


--
-- Dumping data for table `sistema`
--



INSERT INTO `sistema` VALUES (1,'jajsdf','sakldj','jjj@jj.jj','akldjsf','jair','jaksdjf','2016-08-11 18:38:32',NULL),(2,'jadklsj','sakldj','jjj@jj.jj','akldjsf','jair','jaksadjf','0000-00-00 00:00:00',NULL),(3,'jadklsj','sakldj','jjj@jj.jj','akldjsf','jair','jaksdjf','0000-00-00 00:00:00',NULL);


criacao das entidades com doctrine
doctrine-module orm:convert-mapping --namespace="Application\Model\" --force --from-database annotation f:/ZENDCRUD/module/Application/src







 # # #   P H P   C L I   S e r v e r 
 
 T h e   s i m p l e s t   w a y   t o   g e t   s t a r t e d   i f   y o u   a r e   u s i n g   P H P   5 . 4   o r   a b o v e   i s   t o   s t a r t   t h e   i n t e r n a l   P H P   c l i - s e r v e r   i n   t h e   r o o t   d i r e c t o r y : 
 
         p h p   - S   0 . 0 . 0 . 0 : 8 0 8 0   - t   p u b l i c /   p u b l i c / i n d e x . p h p 
 
 T h i s   w i l l   s t a r t   t h e   c l i - s e r v e r   o n   p o r t   8 0 8 0 ,   a n d   b i n d   i t   t o   a l l   n e t w o r k 
 i n t e r f a c e s . 
 
 * * N o t e :   * *   T h e   b u i l t - i n   C L I   s e r v e r   i s   * f o r   d e v e l o p m e n t   o n l y * . 
 
 # # #   A p a c h e   S e t u p 
 
 T o   s e t u p   a p a c h e ,   s e t u p   a   v i r t u a l   h o s t   t o   p o i n t   t o   t h e   p u b l i c /   d i r e c t o r y   o f   t h e 
 p r o j e c t   a n d   y o u   s h o u l d   b e   r e a d y   t o   g o !   I t   s h o u l d   l o o k   s o m e t h i n g   l i k e   b e l o w : 
 
         < V i r t u a l H o s t   * : 8 0 > 
                 S e r v e r N a m e   z f 2 - t u t o r i a l . l o c a l h o s t 
                 D o c u m e n t R o o t   / p a t h / t o / z f 2 - t u t o r i a l / p u b l i c 
                 S e t E n v   A P P L I C A T I O N _ E N V   d e v e l o p m e n t 
                 < D i r e c t o r y   / p a t h / t o / z f 2 - t u t o r i a l / p u b l i c > 
                         D i r e c t o r y I n d e x   i n d e x . p h p 
                         A l l o w O v e r r i d e   A l l 
                         O r d e r   a l l o w , d e n y 
                         A l l o w   f r o m   a l l 
                 < / D i r e c t o r y > 
         < / V i r t u a l H o s t > 
 
 
 "# squadratest" 
