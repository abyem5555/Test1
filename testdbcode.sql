CREATE TABLE `test122` (
          `id` int(10) UNSIGNED NOT NULL PRIMARY KEY COMMENT "ID" DEFAULT 0,
          `user_name` VARCHAR(40) NOT NULL COMMENT "名前",
          `age` int(10) NOT NULL COMMENT "年齢" DEFAULT 0
        );

alter table test122 modify column age int(10) NOT NULL default 0;
show fields from test122;

insert into test122 values(,'佐藤一郎',32);