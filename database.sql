drop database if exists dogpals;

create database dogpals;
use dogpals;

CREATE TABLE if not exists users (
  userID int NOT NULL AUTO_INCREMENT,
  username varchar(150) NOT NULL,
  email varchar(150) NOT NULL,
  password_hash varchar(65) NOT NULL,
  PRIMARY KEY (userID)

);

INSERT INTO users (username, email, password_hash)
values ("sam", "user1@gmail.com", "$2y$10$GpkAgBMWQJCnOzrGdZmv0u8z4xhCXKcylWA3CJwCfGiLkkugkDDIG"),
("maya", "user2@gmail.com", "$2y$10$Kj0.NVjfWC4PV5Ch5QhUteBWcu31xeGNnbfufjDxHMLo/Z8Wywl12"),
("timothy", "user3@gmail.com", "$2y$10$O/geEJqN4kTdrH93.xHKJORsugb7yt4BU/gHBLfoQLE6N8Xmt1mZ6"),
("wendy", "user4@gmail.com", "$2y$10$kCVex3wpLdBsrvUiuSR1oeoCJPC/wdBLffo6k1gDPtKiPiqthItGK"),
("kylie", "user5@gmail.com", "$2y$10$djYyJQtD7r7wOskjmyUbG.k5xHBSDZO21B1pfDVgHfNf1CiZTIyVi"),
("raymond", "user6@gmail.com", "$2y$10$u/lBQy/NefQQ/MDNByljQ.EM9Ag7e8kD7IjT//wcDIxYOq46gJ/IW"),
("denise", "user7@gmail.com", "$2y$10$/SUg3KtEISpiRztA4R8XcOky.NtYLAt83LArgPpONFj3ATBkRNQyO"),
("ashley", "user8@gmail.com", "$2y$10$J4RCmsGeF/fc1aRtdrXXq.vJxiRm4O8j6de1EpuZHzpdbUxTiQjD."),
("kevin", "user9@gmail.com", "$2y$10$7JEpLZyfURraryHGNAJbTudRwxrQG6YLV3Lf9iNSN2riVMdcKmG9a"),
("john", "user10@gmail.com", "$2y$10$QPXdp2Y9.AeiblEowCvI2estmKMgp52GcIEkesFchN0myF1dcnZ8O"),
("hazel", "hazel@gmail.com", "$2y$10$Eo1kWgfLrq/gQNUg8CZiWerG2.5Wv30HK6HoNaFf959vr5E.OehmK"),
("darien", "darien@gmail.com", "$2y$10$DM7lJZjG1ZEo2O7r41CRFec/CVvrl/0cw8qF5inWp3NNQet/7PTIe"),
("ben","ben@gmail.com","$2y$10$/mNZD6kgP7M//6R01Or3u.vhcwVBt.Ot9.gHxFsFdXPw5yGFnHszy"),
("joey", "joey@gmail.com", "$2y$10$Z5jE4Gaq5MxwqgJnCPh65OGK0fRzJ4DgrOMbKIsNmInd.DzSsXIde"),
("shambhavi", "shambhavi@gmail.com", "$2y$10$xkLyXnvS47iFtXedjZ7RFOcpCHApmWt7AtxXFJwYeWqy4EwcK1fV.");


CREATE TABLE if not exists profile (
  profileID int NOT NULL AUTO_INCREMENT,
  username varchar(150) NOT NULL,
  first_name varchar(150) ,
  last_name varchar(150) ,
  gender varchar(11) ,
  birthday varchar(256) ,
  image_url varchar(1000),
  PRIMARY KEY (profileID)

);

INSERT INTO profile (username, first_name, last_name, gender, birthday, image_url)
VALUES ("sam", "Sam", "Ng", "Male", "1998-07-01","images/profile_avatar.png"),
("maya", "Maya", "Tan", "Female", "1996-01-03","images/profile_avatar.png"),
("timothy", "Timothy", "Goh", "Male", "1992-02-05","images/profile_avatar.png"),
("wendy", "Wendy","Wong", "Female", "1995-05-09", "images/profile_avatar.png"),
("kylie", "Kylie", "Chia", "Female", "1999-12-25", "images/profile_avatar.png"),
("raymond", "Raymond", "Ong", "Male","1999-01-08","images/profile_avatar.png"),
("denise", "Denise","Tan", "Female", "2000-09-10","images/profile_avatar.png"),
("ashley", "Ashley", "Sim", "Female", "2001-03-02", "images/profile_avatar.png"),
("kevin", "Kevin", "Lim", "Male", "2000-02-17","images/profile_avatar.png"),
("john", "John", "Tan", "Male", "1995-08-01","images/profile_avatar.png"),
("hazel", "Hazel", "Ma", "Female", "2000-05-01","images/testimonial3.jpg"),
("darien", "Darien", "Tan", "Male", "1998-05-28","images/testimonial1.jpg"),
("ben", "Benjamin", "Tan", "Male", "1999-02-25","images/testimonial2.jpg"),
("joey", "Joey", "Lau", "Female", "2000-06-26","images/testimonial4.jpg"),
("shambhavi", "Shambhavi", "Goenka", "Female", "1999-04-02","images/profile_avatar.png");

CREATE TABLE if not exists friends (
  friendID int NOT NULL AUTO_INCREMENT,
  username varchar(150) NOT NULL,
  image_url varchar(1000) NOT NULL,
  dog_name varchar(150) NOT NULL,
  friend_username varchar(150) NOT NULL,
  friend_image_url varchar(1000) NOT NULL,
  friend_dog_name varchar(150) NOT NULL,
  PRIMARY KEY (friendID)
);

INSERT INTO friends(username, image_url, dog_name, friend_username, friend_image_url, friend_dog_name) 
VALUES ("ben", "https://cdn2.thedogapi.com/images/BkgKXlqE7.jpg", "Callie","darien", "https://cdn2.thedogapi.com/images/Hkxk4ecVX.jpg", "Butterscotch"),
("ben", "https://cdn2.thedogapi.com/images/BkgKXlqE7.jpg", "Callie", "hazel", "https://cdn2.thedogapi.com/images/BkrJjgcV7.jpg", "Gigi"),
("joey", "https://cdn2.thedogapi.com/images/SJIUQl9NX.jpg", "Jax", "kevin", "https://cdn2.thedogapi.com/images/Hyjcol947.jpg", "Jack"),
("shambhavi", "https://cdn2.thedogapi.com/images/By-hGecVX.jpg", "Penny", "john", "https://cdn2.thedogapi.com/images/rJ6iQeqEm.jpg", "Nugget");


create table if not exists dogs (
    DogID int(11) AUTO_INCREMENT primary key,
    username varchar(150) NOT NULL,
    name varchar(256) NOT NULL,
    gender varchar(11) NOT NULL,
    age int(11) NOT NULL,
    birthday varchar(256) NOT NULL,
    breed varchar(1000) NOT NULL,
    image_url varchar(1000) NOT NULL,
    personality varchar(1000) NOT NULL,
    weight varchar(100) NOT NULL, 
    size varchar(100) NOT NULL, 
    likes int(11) NULL, 
    fav_places varchar(1000) NOT NULL
);

insert into dogs values (1, "sam", "Oreo", "Male", 9, "2011-12-15", "Affenpinscher", "https://cdn2.thedogapi.com/images/BJa4kxc4X.jpg", "Stubborn, Curious, Playful, Adventurous, Energetic, Fun-loving", "Less than 15 kg", "small", 44, "US Dog Bakery, Casa Verde, Canopy Garden Dining, Jurong Lake Gardens, Sembawang Park, Brownie Buddies");
insert into dogs values (2, "maya" , "Xiao Bai", "Male", 10, "2011-05-03", "American Eskimo (Miniature)", "https://cdn2.thedogapi.com/images/Bymjyec4m.jpg", "Friendly, Alert, Reserved, Intelligent, Protective", "15kg - 25 kg", "medium", 54, "I.N.U. Cafe and Boutique, Gardens by the Bay, Sunny Heights, Sembawang Park");
insert into dogs values (3, "timothy" , "Peanut", "Male", 12, "2009-01-06", "American Eskimo (Miniature)", "https://cdn2.thedogapi.com/images/_gn8GLrE6.jpg", "Friendly, Alert, Reserved, Intelligent, Protective", "Less than 15 kg", "small", 87, "Casa Verde, Katong Park Run Dog, Pet Cruise");
insert into dogs values (4, "wendy", "Roscoe", "Male", 3, "2018-02-12", "American Water Spaniel", "https://cdn2.thedogapi.com/images/SkmRJl9VQ.jpg", "Friendly, Energetic, Obedient, Intelligent, Protective, Trainable", "Less than 15 kg", "small", 32, "Ah B Cafe, Canopy Garden Dining, Katong Park Run Dog, Gardens by the Bay");
insert into dogs values (5, "kylie", "Sophie", "Female", 10, "2011-07-29", "Poodle (Toy)", "https://cdn2.thedogapi.com/images/rJFJVxc4m.jpg", "Obedient, Companionable, Intelligent, Joyful", "Less than 15 kg", "small", 81, "Canopy Garden Dining, Pet Cruise, The Green Corridor");
insert into dogs values (6, "raymond", "Snowy", "Female", 15, "2006-04-22", "Bichon Frise", "https://cdn2.thedogapi.com/images/HkuYlxqEQ.jpg", "Feisty, Affectionate, Cheerful, Playful, Gentle, Sensitive", "Less than 15 kg", "small", 63, "Wooftopia Pet Cafe, Paws N' Pans, US Dog Bakery, Sembawang Park, Sunny Heights");
insert into dogs values (7, "denise", "Milo", "Male", 8, "2013-12-25", "Miniature Schnauzer", "https://cdn2.thedogapi.com/images/SJIUQl9NX.jpg", "Fearless, Friendly, Spirited, Alert, Obedient, Intelligent", "Less than 15 kg", "small", 42, "Happenstance Cafe, Paws N' Pans, Singapore Botanic Gardens, Tampines Central Park Dog Run, Amara Sanctuary Resort");
insert into dogs values (8, "ashley", "Mocha", "Female", 3, "2018-02-12", "Tibetan Terrier", "https://cdn2.thedogapi.com/images/6f5n_42mB.jpg", "Affectionate, Energetic, Amiable, Reserved, Gentle, Sensitive", "Less than 15 kg", "small", 85, "OFUR Paw Cafe, Ulu Ulu Pet Cafe, Casa Verde, Marina Barrage, Sembawang Park");
insert into dogs values (9, "kevin", "Jack", "Male", 10, "2010-02-26", "Tibetan Spaniel", "https://cdn2.thedogapi.com/images/Hyjcol947.jpg", "Willful, Aloof, Assertive, Independent, Playful, Intelligent, Happy", "Less than 15 kg", "small", 90, "Ah B Cafe, The Garden Slug, We Are The Furballs (WTF), Tampines Central Park Dog Run, Brownie Buddies");
insert into dogs values (10, "john", "Nugget", "Male", 4, "2017-01-19", "Pembroke Welsh Corgi", "https://cdn2.thedogapi.com/images/rJ6iQeqEm.jpg", "Tenacious, Outgoing, Friendly, Bold, Playful, Protective", "Less than 15 kg", "small", 53, "We Are The Furballs (WTF), Menage Cafe, Sun Ray Cafe, Sembawang Park, West Coast Park and Dog Run, Bishan-Ang Mo Kio Park");
insert into dogs values (11, "hazel", "Gigi", "Female", 6, "2015-10-09", "Shih Tzu", "https://cdn2.thedogapi.com/images/BkrJjgcV7.jpg", "Clever, Spunky, Outgoing, Friendly, Affectionate, Lively, Alert, Loyal, Independent, Playful, Gentle, Intelligent, Happy, Active, Courageous", "Less than 15 kg", "small", 84, "I.N.U. Pet-Friendly Cafe, Pasta J");
insert into dogs values (12, "darien", "Butterscotch", "Female", 5, "2016-04-09", "Poodle (Miniature)", "https://cdn2.thedogapi.com/images/Hkxk4ecVX.jpg", "Friendly, Sociable, Playful, Intelligent, Active", "Less than 15 kg", "small", 81, "I.N.U. Cafe and Boutique, Kontiki, Tanjong Beach");
insert into dogs values (13, "ben", "Callie", "Female", 5, "2016-10-11", "Norwich Terrier", "https://cdn2.thedogapi.com/images/BkgKXlqE7.jpg", "Hardy, Affectionate, Energetic, Sensitive, Intelligent", "Less than 15 kg", "small", 55, "Paws N' Pans, Happenstance Cafe, Palawan Beach, Pet Cruise");
insert into dogs values (14, "joey", "Jax", "Male", 8, "2013-07-13", "Labrador Retriever", "https://cdn2.thedogapi.com/images/B1uW7l5VX.jpg", "Kind, Outgoing, Agile, Gentle, Intelligent, Trusting, Even Tempered", "More than 25 kg", "large", 28, "Ah B Cafe, Simpang Bedok Dog Run, Jurong Lake Gardens");
insert into dogs values (15, "shambhavi", "Penny", "Female", 10, "2011-05-11", "Irish Terrier", "https://cdn2.thedogapi.com/images/By-hGecVX.jpg", "Respectful, Lively, Intelligent, Dominant, Protective, Trainable", "Less than 15 kg", "small", 62, "Wooftopia Pet Cafe, Kontiki, Amara Sanctuary Resort, Sunny Height, Tanjong Beach");


create table if not exists places (
  placeID int(11) NOT NULL AUTO_INCREMENT primary key,
  place varchar(1000) NOT NULL,
  placeLoc varchar(1000) NOT NULL,
  lat float(11) NOT NULL,
  lon float(11) NOT NULL,
  placeDesc varchar(1000) NOT NULL,
  placeType varchar(1000) NOT NULL,
  placeLink varchar(1000) NOT NULL,
  likes int(11) NULL
);

insert into places (place, placeLoc, lat, lon, placeDesc, placeType, placeLink)
VALUES ("Casa Verde", "1 Cluny Rd, Singapore Botanic Gardens, Singapore 259569", 1.3151, 103.8162, "Casa Verde is a laid-back trattoria nestled within the lush greenery of the Singapore Botanic Gardens, a cafe by day and restaurant by night.", "dining", "https://www.facebook.com/casaverdesingapore/"),
("Canopy Garden Dining", "1382 Ang Mo Kio Ave 1 Bishan Park 2, Singapore 569931", 1.36229, 103.847413, "Canopy's latest outlet features an all-day dining restaurant surrounded by lush greenery in Hort Park.", "dining", "https://www.facebook.com/canopydining/"),
("Jurong Lake Gardens", "Jurong Lake Gardens, Yuan Ching Road, Singapore 618662", 1.3359, 103.7262, "Sprawling park around a lake & swamp forest with a boardwalk, playgrounds, a dog run & water sports.", "park", "https://www.nparks.gov.sg/juronglakegardens"),
("Sembawang Park", "117 Beaulieu Road, Sembawang Park, Singapore 759837", 1.4617, 103.8369, "Situated in the north of Singapore facing the Johor Straits, Sembawang Park is a tranquil park away from the bustle of the city. ", "park", "https://www.nparks.gov.sg/gardens-parks-and-nature/parks-and-nature-reserves/sembawang-park"),
("Brownie Buddies"," Jalan Bukit Merah, #01-1830 Block 107, Singapore 160107", 1.2800, 103.8247, "Provides grooming services, derma spa, wash 'n' blow, teeth cleaning, boarding and many more!", "Pet Grooming", "https://www.facebook.com/browniebuddiesssg/"),
("Gardens by the Bay", "18 Marina Gardens Dr, Singapore 018953", 1.2816, 103.8636, "One of Asia's premier horticultural destinations, Gardens by the Bay offers a scenic paradise for nature and photography lovers, as well as the whole family. ", "other", "https://www.gardensbythebay.com.sg/"),
("Wooftopia Pet Cafe", "200 Turf Club Rd, #01-29, Singapore 287994", 1.337835972918924, 103.79344090767374, "Wooftopia Pet Cafe is a pet friendly cafe in the west region that diners can bring their beloved furkids in and dine together with other diners' pets. ", "dining", "https://www.facebook.com/Wooftopia.cafe/"),
("Paws N' Pans", "327 Joo Chiat Rd, Singapore 427584", 1.3092739593967075, 103.90284217058122, "The main purpose of Paws N Pans is to encourage adoption! Hopefully, by providing an environment for them to mingle around with other fellow hooman and furkids, it will increase their chance of being adopted. ", "dining", "https://www.facebook.com/Paws-n-pans-181545315956506/"),
("Pet Cruise", "1 Ang Mo Kio Industrial Park 2A, Singapore 568049", 1.3781, 103.8679, "The Dog Cruise is built on the ever successful romantic 3 or 6 course sunset dinner cruises on board the Royal Albatross.", "other", 'https://www.facebook.com/petcruise88/'),
("Ah B Cafe", "110 Turf Club Rd, Singapore 288000", 1.3349, 103.7946, "Known as one of the largest pet-friendly Cafes, Ah B is able to accommodate furry pals of all shapes and sizes. ", "dining", "https://www.quandoo.sg/place/ah-b-cafe-16761"),
("The Green Corridor", "100 Jln Hang Jebat, Singapore 139533", 1.3287533, 103.7814346, "Natural 24-kilometre 'green corridor' along old Singapore-Malayan Peninsula railway line through wood, marsh & grassland. ", "other", "https://www.nparks.gov.sg/railcorridor/rail-corridor"),
("Katong Park Run Dog", "59 Fort Rd, Singapore 439105", 1.2964538, 103.885949, "Katong Park is neighborhood park located in Katong, Singapore at the junction of Meyer Road and Fort Road.", "park", "https://foursquare.com/v/dog-run--katong-park/4c49dc3e3013a593574a52e3"),
("Sunny Heights", "110 Turf Club Rd, Singapore 288000", 1.3348911101205305, 103.79453340736099, "Sunny Heights is a daycare for dogs. A school adopting the 'humanimalist' belief that all dogs should be able to roam and play freely with one another. ", "park", "https://www.facebook.com/animalworldsg/"),
("Happenstance Cafe", "35 Opal Cres, Singapore 328425", 1.3277450364546228, 103.86644481290992, "Happenstance Cafe brings about a welcoming charm in its spacious and clean interior, a place where both pets and humans can conjugate to enjoy a meal together. ", "dining", "https://www.facebook.com/HappenstanceCafe/"),
("Tampines Central Park Dog Run", "Tampines Street 83, Singapore 520833", 1.3541164606086622, 103.93694466441782, "Designed by HDB architect Ms Lee-Loy Kwee Wah, they were inspired by the fruit farms of rural Tampines before the town was developed. ", "park", "https://woofwaggers.com/singapore/activities/dog-run-playground-playpen/East/TAMPINES-CENTRAL-PARK-DOG-RUN"),
("Palawan Beach"," Palawan Beach, Sentosa Island, Singapore 099981", 1.2480604926125778, 103.82385465471536, "Palawan Beach is meant for a perfect family spree. It is one of the three beaches located in the Sentosa Island of Singapore. ", "other", "https://www.sentosa.com.sg/en/things-to-do/attractions/palawan-beach/"),
("Marina Barrage", "8 Marina Gardens Dr, Singapore 018951", 1.2809384267937254, 103.87120712825259, "Marina Barrage is an icon of Singapore, visit its sloping green roof sometime to: have a picnic, fly a kite, or just take photos. ", "other", "https://www.pub.gov.sg/marinabarrage"),
("We Are The Furballs (WTF)", "#07-07, Bugis+, 201 Victoria St, Singapore 188067", 1.2999372509328904, 103.85471722640297, " Enjoy a relaxing weekend cuddling up with your favorite furry friends. Conveniently situated in the heart of Singapore. ", "dining", "https://www.facebook.com/wearethefurballs/"),
("Menage Cafe", "6 Sin Ming Rd, #01-01/02, Singapore 575585", 1.3531429675930768, 103.83624286873159, "Menage Cafe was born from the passion we have for our furkids. A heaven where we can all live . love . woof. " , "dining", "https://www.facebook.com/MenageCafeSG/"),
("Sun Ray Cafe", "79 Brighton Cres, Singapore 559218", 1.3632994955942934, 103.87128461106019, "Pet-friendly cafeteria serving artisanal bread & hand-brewed coffee in a homestyle setting. ", "dining", "https://www.facebook.com/SunRayCafeSG/"),
("Tanjong Beach Club", "Tanjong Beach Walk, 110, Singapore 098943", 1.2434706200486314, 103.82817091291012, "Lauded by Conde Naste as World's Top Beach Bar, Tanjong Beach Club is a serene sanctuary located on the finest sun-soaked stretch of sand in Sentosa. ", "dining", "https://www.facebook.com/tanjongbeachclub/"),
("Pet Lovers Centre", "80 Marine Parade Rd, #B1-13, Singapore 449269", 1.3027940372757065, 103.90538103438448, "Pet Lovers Centre (PLC) is not only Singapore's largest online pet shop, but also collectively the largest and only pet care retail chain in Southeast Asia.", "pet-store", "https://www.facebook.com/PetLoversCentreSingapore/"),
("Benji Pet Kennel", "212/214 Joo Chiat Pl, Singapore 427923", 1.3202977425686668, 103.90644225442578, "Benji Pet Kennel is one of the first in the pet care industry who solely dedicated themselves to the assistance of pets. ", "pet-store", "https://www.facebook.com/benjipet/"),
("Pet Mart", "#01-79, 151 Serangoon North Avenue 2, Singapore 550151", 1.37043520689061, 103.87423875767074, "Established in 1988, Petmart Pte. Ltd. is one of the pioneers in the aquarium and pets trade in Singapore. ", "pet-store", "https://www.facebook.com/petmart.sg/"),
("Polypet", "#01-27/29, Blk 109 Clementi Street 11, Singapore 120109", 1.322802230239417, 103.77093648835368, "Polypet is Singapore's #1 Pet Shop, located at Clementi, in the heart of Sunset Way. ", "pet-store", "https://www.facebook.com/PolypetSG/"),
("Perromart", "15 Changi South Street 2, #04-00, Singapore 486068", 1.3317143346066702, 103.96211037301221, "Perromart Singapore pet shop carries the widest range of Dog, Cat & Small Pet Products. Shop for your Pet's food, treats, toys, supplements and others. ", "pet-store", "https://www.facebook.com/perromart.sg/"),
("Pet’s Gantry", "92 Lor 4 Toa Payoh, #01-276, Singapore 310092", 1.3388837208645292, 103.84993384176849, "An One-Stop Store for your Pets' Supplies and Grooming! ", "pet-store", "https://www.facebook.com/pets.gantry/"),
("Pawpy Kisses", "238 Balestier Road #01-01, #01-02, #01-03, Singapore 329701", 1.32267623420834, 103.85328952698778, "Best pet shop in Singapore with leading pet grooming services. ", "Pet Grooming", "https://www.facebook.com/pawpykisses/"),
("Doggylicious Studio", "Blk 330 Ang Mo Kio Ave 1 # 01 – 1831, Singapore 560330", 1.3634363316730034, 103.85103995767075, "Largest established pet grooming salon in Ang Mo Kio and Singapore and we always aim to provide quality, fuss free and affordable dog grooming with transport services in Singapore. ", "Pet Grooming", "https://www.facebook.com/doggyliciousamk/"),
("Pet Loft", "371 Upper Paya Lebar Rd, #01-02 YI KAI COURT, Singapore 534969", 1.3491093346813023, 103.88006927301221, "Pet Loft was conceptualised with the idea of creating a wholesome and cosy environment for both owners and pets.", "Pet Grooming", "https://www.facebook.com/Petloft/"),
("Bubbly Petz", "266 Joo Chiat Rd, Singapore 427520", 1.31217995041233, 103.9011388730122, "Striving to change the world one groom at a time. Not just a pet store, we are a movement. The kindest, healthiest kibble on the market.", "Pet Grooming", "https://www.facebook.com/BubblyPetz/"),
("Art of Pets", "99 Frankel Ave, Singapore 458223", 1.315690344888905, 103.91920559630483, "Singapore Kennel Club and Korea Kennel Federation Appointed Grooming School. Professional Pet Grooming Course available for aspiring groomers. ", "Pet Grooming", "https://www.facebook.com/AOPGS/"),
("Pawtraits", "96 Yio Chu Kang Rd, Singapore 545574", 1.3595631498469554, 103.87479782698777, "Pawtraits provides a grooming service that strives to be the best at what we do. We are listed in Best Grooming Singapore 2021! ", "Pet Grooming", "https://www.facebook.com/pawtraitspl/"),
("Advanced Vetcare Clinic", "18 Jalan Pari Burong, Picardy Gardens, Singapore 488684", 1.3346601371698021, 103.94859361903667, "Round- the-clock, 24-hr emergency and critical care veterinary clinic for your beloved pet @ Bedok. ", "Vet Clinics", "https://www.facebook.com/advancedvetcaresg/"),
("The Visiting Vets Clinic", "9 Taman Serasi #01-09 Singapore 257720", 1.3092653350116814, 103.8194063804026, "We are a Veterinary clinic in Singapore, we provide veterinary care for all pets! From pet exams to pet dental, we offer a variety of services. ", "Vet Clinics", "https://www.facebook.com/visitingvets.sg/"),
("Animal World Veterinary Clinic", "16, Yio Chu Kang Road, Singapore 545527", 1.3559285518134487, 103.87775813437814, "Animal World Veterinary Clinic was founded to deliver enhancement and treatment of mobility related conditions in animals. ", "Vet Clinics", 'https://www.facebook.com/Animalworldveterinary/'),
("Singapore Veterinary Animal Clinic", "Block 768 Woodlands Avenue 6 #01-11 Woodlands Mart Singapore 730768", 1.447138990804962, 103.79840497301224, "Singapore Veterinary Animal Clinic provides Veterinary care for dogs, cats, rabbits, guinea pigs, hamsters and other pocket pets.", "Vet Clinics", "https://www.facebook.com/singvet.animalclinic/");
