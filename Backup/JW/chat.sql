use roomMeet;
DROP TABLE IF EXISTS chat;
create table chat  (
    users varchar(50) not null,
    chat_string varchar(300) not null,
    time datetime not null,
    sender varchar(25),
    CONSTRAINT chat_PK PRIMARY KEY (users, time)
);

insert into chat (users, chat_string, time, sender) values 
    ("JosephMary", "can I ask whether the price is negiotiable?", '2021-10-05 15:28:33', 'Joseph');

insert into chat (users, chat_string, time, sender) values 
    ("JosephMary", "Yes, of course", '2021-10-05 15:30:33', "Mary");
    
insert into chat (users, chat_string, time, sender) values 
    ("JosephMary", "can it be reduced to $50 from $40?", '2021-10-05 15:32:54', 'Joseph');

insert into chat (users, chat_string, time, sender) values 
    ("MarcusMary", "Hi, is eating in the room ok with you?", '2021-10-05 15:11:54', 'Mary');
    
insert into chat (users, chat_string, time, sender) values 
    ("JosephMarcus", "Hi, is eating in the room ok with you?", '2021-10-05 15:21:54', 'Joseph');
    
    
