# user_x_book

TYPE | NAME | NULLABLE | DEFAULT | REFERENCE | UNIQUE | COMMENT
--- | --- | --- | --- | --- | --- | ---
int | id | FALSE | | | TRUE |
int | user_id | FALSE | | user.id | FALSE | 
int | book_id | FALSE | | book.id | FALSE |
date | rent_time | FALSE | | | FALSE | 借出时间
date | return_time | FALSE | | | FALSE | 应当归还时间