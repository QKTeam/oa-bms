# book

TYPE | NAME | NULLABLE | DEFAULT | REFERENCE | UNIQUE | COMMENT
--- | --- | --- | --- | --- | --- | ---
int | id | FALSE | | | TRUE |
string | name | FALSE | | | FALSE | 
string | description | TRUE | | | FALSE | 描述
boolean | available | FALSE | TRUE | | FALSE | true代表能借到
string | e_book | TRUE | | | FALSE | 电子书的路径
date | next_available_time | TRUE | | | FALSE | 下次能借到的时间
