		DROP TABLE IF EXISTS ims_lianhu_upgrade;
		create table ims_lianhu_upgrade(
                id   int(11)  unsigned auto_increment,
                version char(20) default null,
                add_time int(11) unsigned default 0,
                status   tinyint(1) unsigned default 1 comment'1=>自己更新，2=>系统更新',  
                primary key(id)      
        )engine=innodb charset=utf8 auto_increment=1;
        
		DROP TABLE IF EXISTS ims_lianhu_file;
        create table ims_lianhu_file(
                id              int(11) unsigned auto_increment,
                file_name       varchar(60),
                file_local      text,
                file_version    char(20),
                last_up_time    int(11) unsigned default 0,
                primary key(id)
        )engine=innodb charset=utf8 auto_increment=1;
		
		DROP TABLE IF EXISTS ims_lianhu_course_scan;
        create table ims_lianhu_course_scan(
                course_id   int(11) unsigned auto_increment,
				school_id  int(11) unsigned default 0,
				teacher_id  int(11) unsigned default 0,
                course_name  char(60),
                course_contet text,
                buy_url 	  tinytext,
                add_time      int(11) unsigned default 0,
                primary key(course_id)
        )engine=innodb charset=utf8 auto_increment=1;

		DROP TABLE IF EXISTS ims_lianhu_course_sign;
        create table ims_lianhu_course_sign(
                sign_id  int(11)  unsigned auto_increment,
				school_id  int(11) unsigned default 0,
                student_id int(11) unsigned default 0,
                all_num    int(1)  unsigned default 0,
                could_num  int(1) unsigned default 0,
                add_time   int(11) unsigned default 0,
                primary key(sign_id)
        )engine=innodb  charset=utf8 auto_increment=1;

		DROP TABLE IF EXISTS ims_lianhu_course_add;
        create table ims_lianhu_course_add(
                add_id int(11) unsigned auto_increment,
				school_id  int(11) unsigned default 0,
                student_id int(11) unsigned default 0,
                course_id  int(11) unsigned default 0,
                add_num    int(1)  unsigned default 0,
                add_time   int(11) unsigned default 0,
                admin_uid  int(11) unsigned default 0,
                primary key(add_id)
        )engine=innodb charset=utf8 auto_increment=1;
		
		DROP TABLE IF EXISTS ims_lianhu_course_delete;
        create table ims_lianhu_course_delete(
                delete_id  int(11) unsigned auto_increment,
				school_id  int(11) unsigned default 0,
				qrcode_id  int(11) unsigned default 0,
                student_id int(11) unsigned default 0,
                course_id  int(11) unsigned default 0,
                add_time   int(11) unsigned default 0,
                primary key(delete_id)
        )engine=innodb charset=utf8 auto_increment=1;
        
		DROP TABLE IF EXISTS ims_lianhu_course_qrcode;
		create table ims_lianhu_course_qrcode(
                qrcode_id int(11) unsigned auto_increment ,
                school_id int(11) unsigned default 0,
                course_id int(11) unsigned default 0,
                qrcode_num int(1) unsigned default 0,
                scan_student_num int(11)   default 0,
                add_time  int(11) unsigned default 0,
                primary key(qrcode_id)
        )engine=innodb charset=utf8 auto_increment=1;
		
	
		DROP TABLE IF EXISTS ims_lianhu_cookbook;
  create table ims_lianhu_cookbook(
	  cookbook_id    int(11)   unsigned auto_increment,
	  uniacid        int(11)   unsigned default 0,
	  school_id 	 int(11)   unsigned default 0,
	  cookbook_week  char(20),
	  cookbooK_breakfast text,
	  cookbook_lunch     text,
	  cookbook_dinner    text,
	  add_time 	     int(11) unsigned default 0,
	  primary key(cookbook_id)
  )engine=innodb charset=utf8 ;
  
		DROP TABLE IF EXISTS ims_lianhu_jilv_class;
  create table ims_lianhu_jilv_class(
            class_id    int(11) unsigned auto_increment,
            class_name  varchar(60),            
            add_time    int(11) default 1,
            class_status tinyint(1) default 1 comment '状态',
            primary key(class_id)   
  )engine=innodb charset=utf8;

		DROP TABLE IF EXISTS ims_lianhu_msg_queue;
   create table ims_lianhu_msg_queue(
            queue_id int(11) unsigned auto_increment,
            queue_num char(32),
            openid   char(50),
            mobile   char(12),
            queue_type tinyint(1) default 1 comment '1=>模板消息；2=>客服消息;3=》短信消息',
            queue_content text    comment '消息内容',
            url           text,
            mu_id     char(60)    comment '模板ID',
            add_time   int(11) default 1,
            end_time   int(11) default 0,
            queue_status tinyint(1) default 1 comment '1=>未发送；2=>已经发送；3=>发送失败',
            primary key(queue_id)   
   )engine=innodb charset=utf8;
        
		DROP TABLE IF EXISTS ims_lianhu_send_like;
    create table ims_lianhu_send_like(
        like_id int(11) unsigned auto_increment,
        send_id int(11) unsigned,
        uid     int(11) unsigned,
        add_time int(11) unsigned default 0,
        primary key(like_id)
    )engine=innodb charset=utf8;
    
		DROP TABLE IF EXISTS ims_lianhu_send;
    create table ims_lianhu_send(
        send_id  int(11) unsigned auto_increment,
        uniacid  int(11) unsigned,
        school_id int(11) unsigned,
        class_id int(11) unsigned ,
        send_uid int(11) unsigned ,
        send_content text,
        send_image   text,
        send_status tinyint(1) default 1 comment '1=>ok ,2=>审核,3=>delete',
        send_like  int(1) default 1,
        add_time  int(11) unsigned ,
        primary key(send_id)
    )engine=innodb charset=utf8 comment '用户发表';
    
		DROP TABLE IF EXISTS ims_lianhu_send_comment;
    create table ims_lianhu_send_comment(
    comment_id int(11) unsigned auto_increment,
    send_id    int(11) unsigned,
    comment_uid int(11) unsigned,
    comment_text text,
    add_time  int(11) unsigned,
    comment_status tinyint(1) default 1 comment '1=>ok ,3=>delete',
    primary key(comment_id)
    )engine=innodb charset=utf8 ;
    
		DROP TABLE IF EXISTS ims_lianhu_leave;
  create table ims_lianhu_leave(
      leave_id   int(11) unsigned auto_increment,
      member_uid int(11) unsigned comment'发起请假的人',
	  school_id  int(11) unsigned default 0,
      student_id int(11) unsigned default 0,
      class_id   int(11) unsigned default 0,
      teacher_id      int(11) unsigned default 0,
      leave_reason    text comment '请假理由' ,
      time_date_begin int(11) default 0,
      time_date_end   int(11) default 0,
      teacher_text    text comment '教师备注',
      add_time        int(11) unsigned,
      leave_status    tinyint(1) default 1 comment '1=>申请中，2=>教师确认',
      primary key(leave_id)
  )engine=innodb charset=utf8 comment '请假记录';
  
		DROP TABLE IF EXISTS ims_lianhu_set;
create table ims_lianhu_set(
    set_id 		int(11) unsigned auto_increment,
    uniacid 	int(11) unsigned,
    school_id 	int(11) unsigned,
    keyword   	char(20) ,
    content 	text,
    primary key(set_id)    
)engine=innodb charset=utf8 ;

		DROP TABLE IF EXISTS ims_lianhu_homework;
create table ims_lianhu_homework(
    homework_id int(11) unsigned auto_increment,
    school_id   int(11) unsigned,
    uniacid     int(11) unsigned,
    course_id   int(11) unsigned,
    class_id    int(11) unsigned,
    teacher_id  int(11) unsigned,
    content     text,
    img         text,
    voice       text,
    add_time    int(11) unsigned,
    status      tinyint(1)  default 1 ,
    primary key(homework_id)
)engine=innodb charset=utf8;

		DROP TABLE IF EXISTS ims_lianhu_school_admin;
create table ims_lianhu_school_admin(
    admin_id int(11) unsigned auto_increment,
    uniacid  int(11) unsigned,
    school_id int(11) unsigned,
    uid        int(11) unsigned,
    status   tinyint(1) default 1 ,
    primary key(admin_id)
)engine=innodb charset=utf8 auto_increment=1;

    
		DROP TABLE IF EXISTS ims_lianhu_appointment_course;
create table ims_lianhu_appointment_course(
        course_id   int(11) unsigned auto_increment,
        school_id   int(11) unsigned ,
        uniacid     int(11) unsigned,
        course_name varchar(255),
        course_type     tinyint(1) unsigned default 1 comment '1=>长课程，2=>短课程',
        course_time     text,
        course_num      int(1) default 0,
        course_content  text,
        status          tinyint(1) default 1,
        primary key(course_id)
)engine=innodb charset=utf8 comment='可预约课程';
    
		DROP TABLE IF EXISTS ims_lianhu_wechat;
create table ims_lianhu_wechat(
    wechat_id int(11) unsigned auto_increment,
    uniacid int(11),
    code char(40),
    type tinyint(1) unsigned comment '1=>access_token,2=>jsapi_ticket,3=>jia_token',
    addtime int(11) unsigned,
    primary key(wechat_id)     
)engine=innodb charset=utf8 ;

		DROP TABLE IF EXISTS ims_lianhu_student_live;
create table ims_lianhu_student_live(
    live_id int(11) unsigned auto_increment,
    school_id int(11) unsigned,
    teacher_id int(11) unsigned,
    uniacid int(11)  unsigned,
    student_id int(11) unsigned,
    addtime int(11) unsigned,
	time_date char(20),
	in_type  char(20),
	class_id int(11) unsigned default 0,
	grade_id int(11) unsigned default 0,
    primary key(live_id)
)engine=innodb charset=utf8;

		DROP TABLE IF EXISTS ims_lianhu_sms_record;
create table ims_lianhu_sms_record(
        record_id int(11) unsigned auto_increment,
        uniacid int(11) default 0,
        school_id int(11) default 0,
        student_id int(11) default 0,
        uid        int(11) default 0,
        content text,
        status tinyint(1) default 0,
        primary key(record_id)
    )engine=innodb charset=utf8 auto_increment=1;
    
		DROP TABLE IF EXISTS ims_lianhu_money_record;
create table ims_lianhu_money_record(
		record_id int(11) auto_increment,
		uniacid int(11) default 0,
		school_id int(11) default 0,
		limit_id int(11),
		limit_much float(8,2) default 0.00,
		student_id int(11) comment '学生id',
		fan_id 	int(11) comment '绑定的用户id',
		uid int(11) comment '支付人的uid',
		addtime int(11),
		status tinyint(1) default 0 comment '支付状态;0=>未支付；1=》支付成功',
		primary key(record_id)
)engine=innodb charset=utf8 auto_increment=1;

		DROP TABLE IF EXISTS ims_lianhu_money_limit;
create table ims_lianhu_money_limit(
		limit_id int(11) auto_increment,
		uniacid int(11) ,
		school_id int(11) ,		
	    limit_name varchar(30) comment '限制名字',
		limit_module varchar(30) comment '限制的模块',
		limit_type tinyint(1) default 1 comment '限制类型：1=》永远；2=》每年；3=》每月',
		limit_much float(8,2) default 0.00,
		status tinyint(1) default 1 comment '状态；1=》有效；2=》失效',
		addtime int(11) default 0,
		primary key(limit_id)
)engine=innodb charset=utf8 auto_increment=1;

		DROP TABLE IF EXISTS ims_lianhu_school;
create table ims_lianhu_school(
		school_id int(11) auto_increment,
		uniacid int(11),
		school_name varchar(200),
		addtime int(11),
        mu_str varchar(30),
		status tinyint(1) default 1 ,
		line_status tinyint(1) default 1,
		cookbook_status tinyint(1) default 1,
		primary key(school_id)
)engine=innodb charset=utf8 auto_increment=1;

		DROP TABLE IF EXISTS ims_lianhu_line;
create table ims_lianhu_line(
	line_id int(11) auto_increment,
	class_id int(11),
	teacher_id int(11),
	teacher_intro text,
	line_title tinytext,
	line_content text,
	line_look int(11) default 0,
	status tinyint(1) default 1,
	addtime int(11),
	line_type tinyint(1) default 1,
	school_id int(11),
	uniacid int(11),
	primary key(line_id)
)engine=innodb charset=utf8 auto_increment=1012;

		DROP TABLE IF EXISTS ims_lianhu_appointment;
create table ims_lianhu_appointment(
	appointment_id int(11) auto_increment,
	appointment_limit text comment'限制' ,
	appointment_type_limit tinyint(1),
	appointment_grade_class text,
	appointment_mutex text comment '互斥',
	appointment_name tinytext,
	appointment_intro text,
	appointment_content text,
	appointment_start 	int(11),
	appointment_end 	int(11),
	appointment_addtime int(11),
	appointment_type tinyint(1) default 1 comment '预约类型;1=>课程；2=》活动；3=》兴趣小组',
	appointment_max_num int(11),
	appointment_join_num int(11) default 0,
	teacher_id 	int(11),
	status 	tinyint(1) default 1 comment '预约状态1=>正常，0=》失效，2=》完成',
	school_id int(11),
	uniacid int(11),		
	primary key(appointment_id)
)engine=innodb charset=utf8 auto_increment=1012;

		DROP TABLE IF EXISTS ims_lianhu_applist;
create table ims_lianhu_applist(
	list_id int(11) auto_increment,
	appointment_id int(11),
	student_id int(11),
	addtime int(11),
	content text,
	status tinyint(1) default 0 comment '预约状态0:：待审核1=》通过，2=》未通过',
	reason text ,
	teacher_reason text,
	teacher_id int(11),
	school_id int(11),
	uniacid int(11),	
	primary key(list_id)
)engine=innodb charset=utf8 auto_increment=1012;

		DROP TABLE IF EXISTS ims_lianhu_log;
create table ims_lianhu_log(
	log_id int(11) auto_increment,
	log_type tinytext,
	log_content text,
	addtime int(11),
	uid int(11),
	school_id int(11),
	uniacid int(11),
	primary key(log_id)
)engine=innodb charset=utf8 auto_increment=1012;

		DROP TABLE IF EXISTS ims_lianhu_scorejilv;
create table ims_lianhu_scorejilv(
	scorejilv_id int(11) auto_increment,
	scorejilv_name tinytext,
	grade_id int(11),
	addtime int(11),
	status tinyint(1) default 1,
	school_id int(11),
	uniacid int(11),	
	primary key(scorejilv_id)
)engine=innodb charset=utf8 auto_increment=1012;

		DROP TABLE IF EXISTS ims_lianhu_scorelist;
create table ims_lianhu_scorelist(
	scorelist_id int(11) auto_increment,
	course_name tinytext,
	course_id 	int(11) default 0,
	teacher_name tinytext,
	teacher_id 	int(11) default 0,
	grade_id 	int(11) default 0,
	class_name tinytext,
	class_id 	int(11) default 0,		
	student_name tinytext,
	student_id 	int(11) default 0,		
	score float(5,1),
	ji_lv_id int(11),	
	addtime int(11),
	uid int(11),
	school_id int(11),
	uniacid int(11),	
	primary key(scorelist_id)
)engine=innodb charset=utf8 auto_increment=1012;


		DROP TABLE IF EXISTS ims_lianhu_syllabus;
create table ims_lianhu_syllabus(
	syllabus_id int(11) auto_increment,
	teacher_uid int(11),
	class_id int(11),
	grade_id int(11),
	on_school tinyint(1) default 5 comment '在校天数',
	am_much tinyint(1) default 0,
	pm_much tinyint(1) default 0,
	ye_much tinyint(1) default 0,
	content text,
	addtime int(11),
	school_id int(11),
	uniacid int(11),	
	url     text,
	primary key(syllabus_id)
)engine=innodb charset=utf8 auto_increment=1012;

		DROP TABLE IF EXISTS ims_lianhu_msg;
create table ims_lianhu_msg(
  msg_id int(11) AUTO_INCREMENT,
  msg_title tinytext,
  msg_content text,
  status tinyint(1) default 1,
  addtime int(11),
  school_id int(11),
  uniacid int(11), 
  primary key(msg_id)
)engine=innodb CHARSET=utf8 AUTO_INCREMENT=1012;

		DROP TABLE IF EXISTS ims_lianhu_course;
create table ims_lianhu_course(
	course_id int(11) auto_increment,
	course_name varchar(60),
	course_basic tinyint(1) default 0,
	addtime int(11),
	status tinyint(1),
	school_id int(11),
	uniacid int(11),	
	primary key(course_id)
)engine=innodb charset=utf8 auto_increment=1012;

		DROP TABLE IF EXISTS ims_lianhu_teacher;
create table ims_lianhu_teacher(
	teacher_id int(11) auto_increment,
	fanid	   int(11) default 0 comment'系统登陆ID',
	uid 		int(11) default 0 comment '微信uid',
	course_id 	text    ,
	teacher_realname 	char(20),
	teacher_telphone	char(11),
	teacher_email		char(30),
	teacher_img			char(60),
	teacher_word		text,
	teacher_introduce 		text,
	teacher_model_power	    text,
	teacher_other_power		text,
	weixin_code varchar(60),
	addtime int(11) default 0,
	status tinyint(1) default 1,
	school_id int(11),
	uniacid int(11),	
	msg_id_str text,	
	primary key(teacher_id)
)engine=innodb charset=utf8 auto_increment=1012;
ALTER TABLE ims_lianhu_teacher ADD INDEX fanid (fanid);
ALTER TABLE ims_lianhu_teacher ADD INDEX teacher_realname (teacher_realname);

		DROP TABLE IF EXISTS ims_lianhu_grade;
create table ims_lianhu_grade(
	grade_id int(11) auto_increment,
	grade_name char(40),
	status 	tinyint(1) default 1,
	school_id int(11),
	uniacid int(11),	
	primary key(grade_id)
)engine=innodb charset=utf8 auto_increment=1012;
alter table ims_lianhu_grade add sort_order tinyint(1) unsigned default 0;

		DROP TABLE IF EXISTS ims_lianhu_grade_change;
create table ims_lianhu_grade_change(
    change_id int(11) unsigned auto_increment,
    grade_id int(11) unsigned,
    grade_name varchar(100),
    sort_order tinyint(1) unsigned ,
    add_time int(11) unsigned ,
    primary key(change_id)
)engine=innodb charset=utf8 ;

		DROP TABLE IF EXISTS ims_lianhu_class;
create table ims_lianhu_class(
	class_id int(11) auto_increment,
	grade_id int(11) default 0,
	course_ids text,
	class_name varchar(20),
	teacher_id int(11) default 0,
	status tinyint(1) default 1,
	school_id int(11),
	uniacid int(11),	
	primary key(class_id)
)engine=innodb charset=utf8 auto_increment=111012;
ALTER TABLE ims_lianhu_class ADD INDEX grade_id (grade_id);
ALTER TABLE ims_lianhu_class ADD INDEX teacher_id (teacher_id);
alter table ims_lianhu_class add video_ids text ;

		DROP TABLE IF EXISTS ims_lianhu_video;
create table ims_lianhu_video(
    video_id int(11) unsigned auto_increment,
    school_id int(11) unsigned ,
    uniacid     int(11) unsigned,
    video_name tinytext comment'视频名' ,
    video_url  tinytext comment'视频流地址',
    video_img  tinytext comment '视频封面',
    begin_time char(20) comment '开始时间24小时制',
    end_time   char(20)   comment '结束时间',
    add_time    int(11) unsigned default 0,
    status     tinyint(1) default 0,
    primary key(video_id)
)engine=innodb charset=utf8;


		DROP TABLE IF EXISTS ims_lianhu_student;
create table ims_lianhu_student(
	student_id int(11) auto_increment,
	fanid int(11) default 0,
	fanid1 int(11) default 0,
	fanid2 int(11) default 0,
	grade_id int(11) default 0,
	class_id int(11) default 0,
	xuehao 	char(20),
	address varchar(255),
	student_link varchar(20),
	student_name char(20),
	student_img char(60),
	student_passport char(40),
	parent_name char(20),
	parent_phone char(20),
	status tinyint(1) default 1,
	addtime int(11),
	msg_id_str text comment '站内信ID',
	school_id int(11),
	uniacid int(11),	
	primary key(student_id)
)engine=innodb charset=utf8 auto_increment=1012;
ALTER TABLE ims_lianhu_student ADD INDEX fanid (fanid);
ALTER TABLE ims_lianhu_student ADD INDEX fanid1 (fanid1);
ALTER TABLE ims_lianhu_student ADD INDEX fanid2 (fanid2);
ALTER TABLE ims_lianhu_student ADD INDEX grade_id (grade_id);
ALTER TABLE ims_lianhu_student ADD INDEX class_id (class_id);

		DROP TABLE IF EXISTS ims_lianhu_work;
create table ims_lianhu_work(
	work_id 		int(11) auto_increment ,
	student_id 		int(11) default 0,
	teacher_id 		int(11) default 0 comment '后台uid',
	course_name     varchar(200),
	class_id        int(11),
	grade_id        int(11),
	word 			text,
	img 			char(60),
	content 		text,
	addtime 		int(11),
	school_id 		int(11),
	uniacid 		int(11),	
	jilv_class 		int(11) default 1,
	voice       	text,
	primary key(work_id)
)engine=innodb charset=utf8 auto_increment=1012;
ALTER TABLE ims_lianhu_work ADD INDEX student_id (student_id);
ALTER TABLE ims_lianhu_work ADD INDEX teacher_id (teacher_id);

		DROP TABLE IF EXISTS ims_lianhu_test;
create table ims_lianhu_test(
	test_id int(11) auto_increment,
	student_id int(11) default 0,
	teacher_id 	int(11) default 0 comment '后台uid',
	score		float(5,1) default 0,
	course_name varchar(200),
	class_id int(11),
	grade_id int(11),	
	word 		text,
	img 		char(60),
	addtime 	int(11),
	content 	text,
	school_id int(11),
	uniacid int(11),	
	primary key(test_id)
)engine=innodb charset=utf8 auto_increment=1012;
ALTER TABLE ims_lianhu_test ADD INDEX student_id (student_id);
ALTER TABLE ims_lianhu_test ADD INDEX teacher_id (teacher_id);

		DROP TABLE IF EXISTS ims_lianhu_weak;
create table ims_lianhu_weak(
	weak_id int(11) auto_increment,
	student_id  int(11) default 0,
	teacher_id int(11)	 default 0 comment '后台uid',
	course_name varchar(200),
	class_id int(11),
	grade_id int(11),	
	content 	text,
	content1	text,
	content2 	text,
	addtime		int(11),
	status tinyint(1) default 1,
	school_id int(11),
	uniacid int(11),	
	primary key(weak_id)
)engine=innodb charset=utf8 auto_increment=1012;
ALTER TABLE ims_lianhu_weak ADD INDEX student_id (student_id);
ALTER TABLE ims_lianhu_weak ADD INDEX teacher_id (teacher_id);

		DROP TABLE IF EXISTS ims_lianhu_jinbu;
create table ims_lianhu_jinbu(
	jinbu_id int(11) auto_increment,
	student_id int(11) default 0,
	teacher_id int(11) default 0 comment '后台uid',
	course_name varchar(200),
	class_id int(11),
	grade_id int(11),	
	content text,
	content1 text,
	content2 text,
	addtime int(11),
	school_id int(11),
	uniacid int(11),	
	primary key(jinbu_id)
)engine=innodb charset=utf8 auto_increment=1012;
ALTER TABLE ims_lianhu_jinbu ADD INDEX student_id (student_id);
ALTER TABLE ims_lianhu_jinbu ADD INDEX teacher_id (teacher_id);

		DROP TABLE IF EXISTS ims_lianhu_msg_record;
create table ims_lianhu_msg_record(
	record_id int(11) auto_increment,
	addtime int(11) default 0,
	uid 	int(11) default 0,
	status 	tinyint(1) default 1 comment '1=>全体，2=》已绑定的，3=》未绑定的，4=》单个用户',
	school_id int(11),
	uniacid int(11),	
	primary key(record_id)
)engine=innodb charset=utf8 auto_increment=1012;

insert into ims_lianhu_upgrade(version,add_time)values('2.8.7','1111');