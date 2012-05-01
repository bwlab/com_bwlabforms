drop table if exists #__bwlabforms;

create table #__bwlabforms
(
    id      int(11) not null AUTO_INCREMENT,
    name    varchar(255),
    title   text,
    published   boolean,
    description                  longtext,
    send_mail   boolean, 
    mail_from   varchar(255),
    mail_to     varchar(255), 
    mail_cc     varchar(255),
    mail_bcc    varchar(255), 
    mail_subject    varchar(255),
    mail_receipit   boolean, 
    mail_receipit_subject   varchar(255),
    mail_receipit_text      longtext,
    mail_receipit_include_data  boolean,
    mail_receipit_include_file  boolean, 
    result_save     boolean,
    result_text     longtext,
    result_redirect     boolean,
    result_redirect_url     text, 
    advance_captcha     boolean, 
    advance_path_upload     varchar(255),
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
   hits type int(11),
   primary key (id)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

