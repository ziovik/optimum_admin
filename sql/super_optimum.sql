drop database if exists super_optimum;
CREATE DATABASE super_optimum CHARACTER SET utf8 COLLATE utf8_general_ci;

use super_optimum;

create table admins (
  id            int                not null auto_increment,
  user_email    varchar(30)        not null,
  user_pass     varchar(100)       not null,
 

  primary key (id)
  
);

insert into admins values
  (1, 'admin', 'admin'),
  (2, 'velox', '1234');
 


-- roles table
create table role (
  id   int                not null auto_increment,
  name varchar(10) unique not null,

  primary key (id)
);

insert into role values
  (1, 'admin'),
  (2, 'user');

create table credentials (
  id       int                not null auto_increment,
  login    varchar(30) unique not null,
  password varchar(100)       not null,
  role_id  int                not null,

  primary key (id),
  foreign key (role_id) references role (id)
    on delete cascade
    on update cascade
);

insert into credentials values
  (1, 'admin', 'admin', 1),
  (2, 'alex', 'alex', 2),
  (3, 'daniel', 'daniel', 2),
  (4, 'apple', 'apple', 2),
  (5, 'avon', 'avon', 2),
  (6, 'reebok', 'reebok', 2);

-- country table
create table country (
  id   bigint              not null auto_increment,
  name varchar(100) unique not null,

  primary key (id)
);

insert into country (id, name) values
  (1, 'Россия'),
  (2, 'США');

-- region table --
create table region (
  id         bigint              not null auto_increment,
  name       varchar(255) unique not null,
  code       int unique          not null,
  country_id bigint              not null,

  primary key (id),
  foreign key (country_id) references country (id)
    on delete cascade
    on update cascade
);

insert into region (id, name, code, country_id) values
  (1, 'Курск', 46, 1),
  (2, 'Белгород', 31, 1),
  (3, 'Воронеж', 36, 1),
  (4, 'Сан-Франциско', 49, 2),
  (5, 'Вашингтон', 50, 2);

-- street table
create table street (
  id        bigint              not null auto_increment,
  name      varchar(255) unique not null,
  region_id bigint              not null,

  primary key (id),
  foreign key (region_id) references region (id)
    on delete cascade
    on update cascade
);

insert into street values
  (1, 'Ленина', 1),
  (2, 'Радищева', 1),
  (3, 'Харьковская', 2),
  (4, 'Шишкова', 3),
  (5, 'Хилтон Роуз', 4),
  (6, 'Рузвельт стрит', 5);

-- address table, address_id
create table address (
  id         bigint      not null auto_increment,
  index_code varchar(10) not null,
  street_id  bigint      not null,
  building   varchar(10) not null,
  house      varchar(10),

  primary key (id),
  foreign key (street_id) references street (id)
    on delete cascade
    on update cascade
);

insert into address (id, index_code, street_id, building, house) values
  (1, '102020', 1, 10, 1), -- it's Daniel address
  (2, '305020', 2, 3, null),
  (3, '234345', 3, 104, null),
  (4, '232232', 4, 34, null), -- its Alex addres
  (5, '343434344', 5, 123, 2),
  (6, '244435', 6, 12, null);

-- table company --
create table company (
  id   bigint       not null auto_increment,
  name varchar(255) not null,
  ogrn varchar(255) not null,
  inn  varchar(255) not null,

  primary key (id)
);

insert into company (id, name, ogrn, inn) values
  (1, 'Apple', '123-24-234', '234-34-342'),
  (2, 'Avon', '123-24-234', '234-34-342'),
  (3, 'Reebok', '123-24-234', '234-34-342'),
  (4, 'Daniel Monday SUper Man', '123-24-234', '234-34-342');

-- contact table --
create table contact (
  id        bigint       not null auto_increment,
  email     varchar(255) not null,
  telephone varchar(50)  not null,

  primary key (id)
);

insert into contact (id, email, telephone) values
  (1, 'alex@yahoo.com', '34-43-43'),
  (2, 'dan@gmail.com', '44-55-66'),
  (3, 'apple@gmail.com', '342-23-45'),
  (4, 'avon@rambler.com', '11-12-36'),
  (5, 'reebok@yahoo.com', '3432-234345-345');

-- table customer
create table customer (
  id             bigint       not null auto_increment,
  name           varchar(255) not null,
  company_id     bigint,
  contact_id     bigint,
  region_id      bigint,
  address_id     bigint,
  credentials_id int,

  primary key (id),
  foreign key (company_id) references company (id)
    on delete set null
    on update cascade,

  foreign key (contact_id) references contact (id)
    on delete set null
    on update cascade,

  foreign key (region_id) references region (id)
    on delete set null
    on update cascade,

  foreign key (address_id) references address (id)
    on delete set null
    on update cascade,

  foreign key (credentials_id) references credentials (id)
    on delete set null
    on update cascade
);

insert into customer (id, name,  contact_id, region_id, address_id, credentials_id) values
  (1, 'Alex', 1, 3, 4, 2), -- 3 is Voronej
  (2, 'Daniel',  2, 1, 1, 3); -- 1 is Kursk


create table distributor (
  id             bigint not null auto_increment,
  contact_id     bigint,
  company_id     bigint not null,
  credentials_id int,
  region_id      bigint,
  address_id     bigint,

  primary key (id),

  foreign key (company_id) references company (id)
    on update cascade,

  foreign key (contact_id) references contact (id)
    on delete set null
    on update cascade,

  foreign key (credentials_id) references credentials (id)
    on delete set null
    on update cascade,

  foreign key (region_id) references region (id)
    on delete set null
    on update cascade,

  foreign key (address_id) references address (id)
    on delete set null
    on update cascade
);

insert into distributor (id, contact_id, company_id, credentials_id, region_id, address_id) values
  (1, 3, 1, 4, 4, 5), -- Apple (from San-Fransisco)
  (2, 4, 2, 5, 5, 6), -- Avon (from Washington)
  (3, 5, 3, 6, 5, 6); -- Reebok (from Washington)

-- store place of products
create table store (
  id             bigint not null auto_increment,
  region_id      bigint not null,
  distributor_id bigint not null,
  

  primary key (id),

  foreign key (region_id) references region (id)
    on delete cascade
    on update cascade,

  foreign key (distributor_id) references distributor (id)
    on delete cascade
    on update cascade
);

insert into store (region_id, distributor_id) values
  (1, 1), -- Apple Store in Kursk
  (2, 1), -- Apple Store in Belgorod,

  (1, 2), -- Avon store in Kursk
  (3, 2), -- Avon store in Voronej

  (1, 3), -- Reebook store in Kursk
  (2, 3), -- Reebook store in Belgorod
  (3, 3); -- Reebook store in Voronej


create table category (
  id   bigint              not null auto_increment,
  name varchar(255) unique not null,

  primary key (id)
);

insert into category values
  (1, 'Космотология'),
  (2, 'Депиляция'),
  (3, 'Солярий'),
  (4, 'Массаж'),
  (5, 'Парикмахерская продукции'),
  (6, 'Ногтевой сервис'),
  (7, 'Ресницы и брови'),
  (8, 'Визаж'),
  (9, 'Татуаж и пирсинг'),
  (10, 'Расходные материалы и одноразовые принадлежности'),
  (11, 'терилизация и дезинфекция');



create table sub_category (
  id          bigint       not null auto_increment,
  name        varchar(255) not null,
  category_id bigint       not null,

  primary key (id),

  foreign key (category_id) references category (id)
    on delete cascade
    on update cascade
);

insert into sub_category values
  (1, 'Инъекционная', 1),
  (2, 'Аппаратная', 1),
  (3, 'Уход за волосами', 1),

  (4, 'Депиряций', 2),

  (5, 'Солярий', 3),

  (6, 'Массаж', 4),

  (7, 'Стайлинг', 5),
  (8, 'Нарашивание волос', 5),
  (9, 'Инструменты, аксесуары и расходные материалы', 5),

  (10, 'Моделирование', 6),
  (11, 'Уход за ногтями и кожей рук', 6),
  (12, 'Декор ногтей', 6),
  (13, 'Инструменты и техника', 6),
  (14, 'Расходные материалы', 6),

  (15, 'Оформление бровей', 7),
  (16, 'Наращивание ресниц', 7),
  (17, 'Ламинирование ресниц', 7),
  (18, 'Микропигментирование', 7),
  (19, 'Инструменты и расходные материалы', 7),

  (20, 'Макияж лица', 8),
  (21, 'Макияж глаз', 8),
  (22, 'Макияж губ', 8),
  (23, 'Кисти для Макияжа', 8),
  (24, 'Кейсы и палитра', 8),
  (25, 'Инструменты', 8),

  (26, 'Татуаж', 9),
  (27, 'Пирсинг', 9),

  (28, 'Одноразовые простыни,полотенца, салфетки', 10),
  (29, 'Одноразовая одежда и перчатки', 10),
  (30, 'Кисти, шпатели, баночки', 10),
  (31, 'Ватные диски, спонжи', 10),
  (32, 'Другое', 10),

  (33, 'Средства для обработки кожи', 11),
  (34, 'Средства для обработки инструментов и поверхностей', 11),
  (35, 'Стерилизаторы, принадлежности и расходники', 11);




create table product (
  id              bigint              not null auto_increment,
  distributor_id  bigint              not null,
  sub_category_id bigint,
  name            varchar(255)        unique not null,
  manufacturer    varchar(255),
  expires         date,
  licence         varchar(255),
  code            varchar(50),
  discount        double,
  description     varchar(255),
  
  
  
  primary key (id),

  foreign key (distributor_id) references distributor (id)
    on delete cascade
    on update cascade,

  foreign key (sub_category_id) references sub_category (id)
    on delete set null
    on update cascade
);


create table store_item (
  id              bigint          not null auto_increment,
  product_id      bigint          not null,
  store_id        bigint,
  price           double              not null,
  min_order       double,
  max_order       double,

  primary key (id),

  foreign key (product_id) references product (id)
    on delete cascade
    on update cascade,

  foreign key (store_id) references store (id)
    on delete set null
    on update cascade
);




-- cart table --
create table cart (
  id          bigint      not null auto_increment,
  customer_id bigint      not null,
  status      varchar(20) not null, -- active/inactive (inactive is in history)

  primary key (id),

  foreign key (customer_id) references customer (id)
    on delete cascade
    on update cascade
);

insert into cart (id, customer_id, status) values
  (1, 1, 'inactive'); -- my cart in past


-- product_item table --
create table product_item (
  id         bigint not null auto_increment,
  product_id bigint not null,
  quantity   double not null,
  cart_id    bigint not null,
  onscreen_status  varchar(20) ,

  primary key (id),

  foreign key (product_id) references product (id)
    on delete cascade
    on update cascade,

  foreign key (cart_id) references cart (id)
    on delete cascade
    on update cascade
);




-- history table --
create table history (
  id         bigint not null auto_increment,
  product_id bigint not null,
  quantity   double not null,
  cart_id    bigint not null,
  status     varchar(20) not null, -- active/inactive (inactive is in history)
  order_date datetime not null,

  primary key (id),

  foreign key (product_id) references product (id)
    on delete cascade
    on update cascade,

  foreign key (cart_id) references cart (id)
    on delete cascade
    on update cascade
);

create table simple_order (
  id                bigint   not null auto_increment,
  registration_date datetime not null,
  cart_id           bigint   not null,

  primary key (id),

  foreign key (cart_id) references cart (id)
    on delete no action
    on update cascade
);

insert into simple_order values
  (1, now() - interval 10 day, 1); -- my order in past


create table customer_chat (
   id                bigint   not null  primary key auto_increment,
   customer_id       bigint   not null,
   
   distributor_id    bigint   not null,
   message           varchar(255),
   message_date     datetime  not null 
);



create table distributor_chat (
   id                bigint   not null  primary key auto_increment,
   distributor_id    bigint   not null,
   
   customer_id       bigint   not null,
   message           varchar(255),
   message_date     datetime  not null 
);