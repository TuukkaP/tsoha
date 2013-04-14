SET REFERENTIAL_INTEGRITY FALSE;

drop table if exists beer;

drop table if exists pub_beer;

drop table if exists brewery;

drop table if exists pub;

drop table if exists user;

SET REFERENTIAL_INTEGRITY TRUE;

drop sequence if exists beer_seq;

drop sequence if exists brewery_seq;

drop sequence if exists pub_seq;

drop sequence if exists user_seq;

