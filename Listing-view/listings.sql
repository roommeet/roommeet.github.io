drop database if exists roomMeet;
create database roomMeet;
use roomMeet;

create table listings  (
    id integer auto_increment primary key,
    name varchar(100),
    price int,
    imageUrl varchar(300),
    address varchar(100),
    type varchar(30),
    size int
);

insert into listings (name, price, imageUrl, address, type, size) values 
    ('The Rochester',100,'https://sg1-cdn.pgimgs.com/listing/23118957/UPHO.126886062.V800/The-Rochester-Buona-Vista-West-Coast-Clementi-New-Town-Singapore.jpg','33 Rochester Dr, Singapore 138638','Condo',861);
insert into listings (name, price, imageUrl, address, type, size) values 
    ('River Place',150,'https://sg1-cdn.pgimgs.com/listing/20346199/UPHO.81479692.V800/River-Place-Alexandra-Commonwealth-Singapore.jpg','60 Havelock Rd, Singapore 169658','Condo',1281);
insert into listings (name, price, imageUrl, address, type, size) values 
    ('River Place',150,'https://sg2-cdn.pgimgs.com/listing/23220393/UPHO.125203813.V800/Queens-Peak-Alexandra-Commonwealth-Singapore.jpg','60 Havelock Rd, Singapore 169658','Condo',1281);
insert into listings (name, price, imageUrl, address, type, size) values 
    ('My Manhattan',220,'https://media.karousell.com/media/photos/products/2020/9/5/studio_my_manhattan_condo_sime_1599309150_adf20ca1','31 Simei Street 3, Singapore 529902','Condo',1335);
insert into listings (name, price, imageUrl, address, type, size) values 
    ('Emerald Garden',50,'https://sg2-cdn.pgimgs.com/listing/23619619/UPHO.131732803.V800/Emerald-Garden-Boat-Quay-Raffles-Place-Marina-Singapore.jpg','33 Club St, Singapore 069415','Condo',150);
insert into listings (name, price, imageUrl, address, type, size) values 
    ('SkySuites 17',70,'https://sg1-cdn.pgimgs.com/listing/23737095/UPHO.131884328.V800/SkySuites-17-Balestier-Toa-Payoh-Singapore.jpg','17 Jln Rajah, Singapore 329137','Condo',355);

insert into listings (name, price, imageUrl, address, type, size) values 
    ('404 Choa Chu Kang Avenue 3',70,'https://sg2-cdn.pgimgs.com/listing/23654000/UPHO.130839705.V800/404-Choa-Chu-Kang-Avenue-3-Dairy-Farm-Bukit-Panjang-Choa-Chu-Kang-Singapore.jpg','404 Choa Chu Kang Ave 3, Singapore 680404','HDB',1323);
insert into listings (name, price, imageUrl, address, type, size) values 
    ('443C Fajar Road',100,'https://sg2-cdn.pgimgs.com/listing/23734037/UPHO.131843053.V800/443C-Fajar-Road-Dairy-Farm-Bukit-Panjang-Choa-Chu-Kang-Singapore.jpg','443C Fajar RdSingapore 673443','HDB', 1238);
insert into listings (name, price, imageUrl, address, type, size) values 
    ('Pinnacle @ Duxton',130,'https://sg1-cdn.pgimgs.com/listing/23725616/UPHO.131800190.V800/Pinnacle-Duxton-Chinatown-Tanjong-Pagar-Singapore.jpg','1G Cantonment Rd, Singapore 085301','HDB', 1152);
insert into listings (name, price, imageUrl, address, type, size) values 
    ('233 Bain Street',100,'https://sg2-cdn.pgimgs.com/listing/23281502/UPHO.130933343.V800/233-Bain-Street-Beach-Road-Bugis-Rochor-Singapore.jpg','233 Bain StSingapore 180233','HDB', 883);
insert into listings (name, price, imageUrl, address, type, size) values 
    ('275B Compassvale Link',40,'https://sg1-cdn.pgimgs.com/listing/23734936/UPHO.131855658.V800/275B-Compassvale-Link-Hougang-Punggol-Sengkang-Singapore.jpg','275B Compassvale LinkSingapore 542275','HDB', 160);
insert into listings (name, price, imageUrl, address, type, size) values 
    ('137 Pasir Ris Street 11',100,'https://sg1-cdn.pgimgs.com/listing/23729498/UPHO.131801196.V800/137-Pasir-Ris-Street-11-Pasir-Ris-Tampines-Singapore.jpg','137 Pasir Ris Street 11, Singapore 510137','HDB', 1603);
   
 
       
    

