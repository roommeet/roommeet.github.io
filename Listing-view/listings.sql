drop database if exists roomMeet;
create database roomMeet;
use roomMeet;

create table listing  (
    listingId integer auto_increment primary key,
    name varchar(100),
    price int,
    imageUrl varchar(300),
    address varchar(100),
    type varchar(30),
    size int,
    bedRooms int, 
    bathRooms int,
    booked varchar(30),
    capacity int,
    region varchar(50)
);

create table review
(
	reviewId INT auto_increment primary key,
    listingId INT NOT NULL,
    userId INT NOT NULL,
	reviewScore INT NOT NULL check (reviewScore between 1 and 5),
    desciprtion varchar(500),
    dateAttained DATE NOT NULL,

    CONSTRAINT fk_lisitingId1 FOREIGN KEY(listingId) REFERENCES listing(listingId)
    /*CONSTRAINT fk_userId1 FOREIGN KEY(userId) REFERENCES listings(listingId),*/
);


insert into listing (name, price, imageUrl, address, type, size, bedRooms, bathRooms, booked, capacity, region) values 
    ('The Rochester',100,'https://sg1-cdn.pgimgs.com/listing/23118957/UPHO.126886062.V800/The-Rochester-Buona-Vista-West-Coast-Clementi-New-Town-Singapore.jpg','33 Rochester Dr, Singapore 138638','Condo',861, 1, 1, "No", 1, "North");
insert into listing (name, price, imageUrl, address, type, size, bedRooms, bathRooms, booked, capacity, region) values 
    ('River Place',150,'https://sg1-cdn.pgimgs.com/listing/20346199/UPHO.81479692.V800/River-Place-Alexandra-Commonwealth-Singapore.jpg','60 Havelock Rd, Singapore 169658','Condo',1281, 2, 1, "No", 1, "West");
insert into listing (name, price, imageUrl, address, type, size, bedRooms, bathRooms, booked, capacity, region) values 
    ('River Place',150,'https://sg2-cdn.pgimgs.com/listing/23220393/UPHO.125203813.V800/Queens-Peak-Alexandra-Commonwealth-Singapore.jpg','60 Havelock Rd, Singapore 169658','Condo',1281, 1, 1, "Fully", 2, "South");
insert into listing (name, price, imageUrl, address, type, size, bedRooms, bathRooms, booked, capacity, region) values 
    ('My Manhattan',220,'https://media.karousell.com/media/photos/products/2020/9/5/studio_my_manhattan_condo_sime_1599309150_adf20ca1','31 Simei Street 3, Singapore 529902','Condo',1335, 1, 1, "halfAm", 2, "North");
insert into listing (name, price, imageUrl, address, type, size, bedRooms, bathRooms, booked, capacity, region) values 
    ('Emerald Garden',50,'https://sg2-cdn.pgimgs.com/listing/23619619/UPHO.131732803.V800/Emerald-Garden-Boat-Quay-Raffles-Place-Marina-Singapore.jpg','33 Club St, Singapore 069415','Condo',150, 2, 1, "halfPm", 1, "East");
insert into listing (name, price, imageUrl, address, type, size, bedRooms, bathRooms, booked, capacity, region) values 
    ('SkySuites 17',70,'https://sg1-cdn.pgimgs.com/listing/23737095/UPHO.131884328.V800/SkySuites-17-Balestier-Toa-Payoh-Singapore.jpg','17 Jln Rajah, Singapore 329137','Condo',355, 1, 1, "No", 3, "Central");

insert into listing (name, price, imageUrl, address, type, size, bedRooms, bathRooms, booked, capacity, region) values 
    ('404 Choa Chu Kang Avenue 3',70,'https://sg2-cdn.pgimgs.com/listing/23654000/UPHO.130839705.V800/404-Choa-Chu-Kang-Avenue-3-Dairy-Farm-Bukit-Panjang-Choa-Chu-Kang-Singapore.jpg','404 Choa Chu Kang Ave 3, Singapore 680404','HDB',1323, 3 , 2, "No", 2, "South");
insert into listing (name, price, imageUrl, address, type, size, bedRooms, bathRooms, booked, capacity, region) values 
    ('443C Fajar Road',100,'https://sg2-cdn.pgimgs.com/listing/23734037/UPHO.131843053.V800/443C-Fajar-Road-Dairy-Farm-Bukit-Panjang-Choa-Chu-Kang-Singapore.jpg','443C Fajar RdSingapore 673443','HDB', 1238, 2, 2, "halfPm", 3, "East");
insert into listing (name, price, imageUrl, address, type, size, bedRooms, bathRooms, booked, capacity, region) values 
    ('Pinnacle @ Duxton',130,'https://sg1-cdn.pgimgs.com/listing/23725616/UPHO.131800190.V800/Pinnacle-Duxton-Chinatown-Tanjong-Pagar-Singapore.jpg','1G Cantonment Rd, Singapore 085301','HDB', 1152, 3, 2, "halfAm", 2, "Central");
insert into listing (name, price, imageUrl, address, type, size, bedRooms, bathRooms, booked, capacity, region) values 
    ('233 Bain Street',100,'https://sg2-cdn.pgimgs.com/listing/23281502/UPHO.130933343.V800/233-Bain-Street-Beach-Road-Bugis-Rochor-Singapore.jpg','233 Bain StSingapore 180233','HDB', 883, 2, 2, "Fully", 1, "West");
insert into listing (name, price, imageUrl, address, type, size, bedRooms, bathRooms, booked, capacity, region) values 
    ('275B Compassvale Link',40,'https://sg1-cdn.pgimgs.com/listing/23734936/UPHO.131855658.V800/275B-Compassvale-Link-Hougang-Punggol-Sengkang-Singapore.jpg','275B Compassvale LinkSingapore 542275','HDB', 160, 3, 2, "No", 1, "North");
insert into listing (name, price, imageUrl, address, type, size, bedRooms, bathRooms, booked, capacity, region) values 
    ('137 Pasir Ris Street 11',100,'https://sg1-cdn.pgimgs.com/listing/23729498/UPHO.131801196.V800/137-Pasir-Ris-Street-11-Pasir-Ris-Tampines-Singapore.jpg','137 Pasir Ris Street 11, Singapore 510137','HDB', 1603, 3, 2, "No", 3, "Central");
   
insert into review (listingId, userId, reviewScore, dateAttained) values 
    (1, 1, 4, "2021-11-12"),(1, 1, 5, "2021-11-12"), (1, 1, 3, "2021-11-12"),(1, 1, 5, "2021-11-12");
insert into review (listingId, userId, reviewScore, dateAttained) values 
    (2, 1, 4, "2021-11-12"),(2, 1, 5, "2021-11-12"), (2, 1, 3, "2021-11-12"),(2, 1, 5, "2021-11-12");
insert into review (listingId, userId, reviewScore, dateAttained) values 
    (3, 1, 4, "2021-11-12"),(3, 1, 4, "2021-11-12"), (3, 1, 3, "2021-11-12"),(3, 1, 5, "2021-11-12");
insert into review (listingId, userId, reviewScore, dateAttained) values 
    (4, 1, 4, "2021-11-12"),(4, 1, 5, "2021-11-12"), (4, 1, 5, "2021-11-12"),(4, 1, 5, "2021-11-12");
insert into review (listingId, userId, reviewScore, dateAttained) values 
    (5, 1, 4, "2021-11-12"),(5, 1, 1, "2021-11-12"), (5, 1, 1, "2021-11-12"),(5, 1, 3, "2021-11-12");
insert into review (listingId, userId, reviewScore, dateAttained) values 
    (6, 1, 4, "2021-11-12"),(6, 1, 4, "2021-11-12");
insert into review (listingId, userId, reviewScore, dateAttained) values 
    (7, 1, 4, "2021-11-12"),(7, 1, 5, "2021-11-12"), (7, 1, 3, "2021-11-12"),(7, 1, 3, "2021-11-12");
insert into review (listingId, userId, reviewScore, dateAttained) values 
    (8, 1, 4, "2021-11-12"),(8, 1, 5, "2021-11-12"), (8, 1, 3, "2021-11-12"),(8, 1, 5, "2021-11-12");
insert into review (listingId, userId, reviewScore, dateAttained) values 
    (9, 1, 4, "2021-11-12"),(9, 1, 5, "2021-11-12"), (9, 1, 3, "2021-11-12"),(9, 1, 5, "2021-11-12");
insert into review (listingId, userId, reviewScore, dateAttained) values 
    (10, 1, 4, "2021-11-12"),(10, 1, 5, "2021-11-12"), (10, 1, 3, "2021-11-12"),(10, 1, 5, "2021-11-12");
insert into review (listingId, userId, reviewScore, dateAttained) values 
    (11, 1, 4, "2021-11-12"),(11, 1, 5, "2021-11-12"), (11, 1, 3, "2021-11-12"),(11, 1, 5, "2021-11-12");
insert into review (listingId, userId, reviewScore, dateAttained) values 
    (12, 1, 4, "2021-11-12"),(12, 1, 5, "2021-11-12"), (12, 1, 3, "2021-11-12"),(12, 1, 5, "2021-11-12");

    

