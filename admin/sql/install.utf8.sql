drop table if exists #__bwlabforms;

create table #__bwlabforms
(
   id                           int(11) not null AUTO_INCREMENT,
   name                         text,
   title                        text,
   description                  longtext,
   emailfrom                    text,
   emailto                      text,
   emailcc                      text,
   emailbcc                     text,
   subject						text,	
   created                      datetime,
   created_by                   int(11),
   hits                         int(11),
   published                    tinyint,
   saveresult                   tinyint,
   emailresult                  tinyint,
   textresult                   longtext,
   redirecturl					text,
   redirectdata			tinyint,
   captcha                    	tinyint,
   captchacustominfo		    text,
   captchacustomerror		    text,
   customjs						text,	
   uploadpath					text,
   maxfilesize					int,
   poweredby                   	tinyint,
   emailreceipt                 tinyint,
   emailreceipttext             longtext,
   emailreceiptsubject			text,
   emailreceiptincfield         tinyint,
   emailreceiptincfile          tinyint,
   emailresultincfile           tinyint,
   formCSSclass					text,
   displayip		            tinyint,
   displaydetail		        tinyint,
   fronttitle                   text,
   frontdescription             longtext,
   autopublish					tinyint,   
   primary key (id)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

drop table if exists #__bwlabfields;

create table #__bwlabfields
(
   id       int(11) not null AUTO_INCREMENT,
   fid      int(11),
   type     text, 
   label    text,
   name     text,
   value    text,
   title    text,
   ordering  int,
   published    boolean,
   required  boolean,
   readonly boolean,
   disabled boolean,
   maxlength int, 
   src  text, 
   size int, 
   checked  boolean,
   alt  varchar(255),
   accept   varchar(50),
   date_format varchar(10),
   date_today   boolean,
   radio_options    text, 
   select_options text,
   cols     int, 
   rows     int,
   cssclass varchar(50),
   labelcssclass varchar(50),
   custominfo   varchar(255), 
   customerror  varchar(255),
   customtextcssclass varchar(50),
   displaycustomtext boolean, 
   customtext   text, 
   primary key (id)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

drop table if exists #__bwlabprofiles;

create table #__bwlabprofiles
(
   id                           int(11) not null AUTO_INCREMENT,
   formid                       int(11),
   name                        	text,
   title                        text,
   description                  longtext,
   published                    tinyint,
   created                      datetime,
   created_by                   int(11),
   primary key (id)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

drop table if exists #__bwlabprofilefields;

create table #__bwlabprofilefields
(
   id                           int(11) not null AUTO_INCREMENT,
   profileid                    int(11),
   fieldid                      text,
   customlabel             	    text,
   defaultvalue					text,
   published                    tinyint,
   ordering                     int(11) not null DEFAULT 0, 
   created                      datetime,
   created_by                   int(11),
   primary key (id)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;
