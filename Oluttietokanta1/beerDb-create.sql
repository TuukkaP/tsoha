create table beer (
  id                        integer not null,
  name                      varchar(255),
  brewery_id                integer,
  constraint pk_beer primary key (id))
;

create table brewery (
  id                        integer not null,
  name                      varchar(255),
  constraint pk_brewery primary key (id))
;

create table pub (
  id                        integer not null,
  name                      varchar(255),
  constraint pk_pub primary key (id))
;

create table user (
  id                        integer not null,
  name                      varchar(255),
  constraint pk_user primary key (id))
;


create table pub_beer (
  pub_id                         integer not null,
  beer_id                        integer not null,
  constraint pk_pub_beer primary key (pub_id, beer_id))
;
create sequence beer_seq;

create sequence brewery_seq;

create sequence pub_seq;

create sequence user_seq;

alter table beer add constraint fk_beer_brewery_1 foreign key (brewery_id) references brewery (id) on delete restrict on update restrict;
create index ix_beer_brewery_1 on beer (brewery_id);



alter table pub_beer add constraint fk_pub_beer_pub_01 foreign key (pub_id) references pub (id) on delete restrict on update restrict;

alter table pub_beer add constraint fk_pub_beer_beer_02 foreign key (beer_id) references beer (id) on delete restrict on update restrict;
