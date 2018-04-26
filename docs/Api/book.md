# /api/book

## Add new books

Router: /api/book

Method: `POST`

Authorize: `Admin`

Params:

name | required | description
--- | --- | ---
token / remember_token | true | token for portal
name | true | name of book
description | true | description of book
isbn | true | isbn of the book

Example:

```json
{
    "token": "ad66f144-191d-473d-b25e-d8bb073c48c0",
    "name": "汇编语言",
    "description": "这是汇编语言",
    "isbn": "9787121060748"
}
```

Response:

- `code 200`

```json
{
    "book_id": 1,
}
```

- `code 401`    用户未登录或token失效
- `code 403`    用户没有管理员权限
- `code 422`    请求参数出错

```json
{
    "name": [
        "The name field is required."
    ],
    "description": [
        "The description field is required."
    ]
}
```

## Get all books

Router: /api/book

Method: `GET`

Authorize: `All`

Params:

`NULL`

Response:

- `code 200`

```json
[
  {
    "id": 1,
    "name": "汇编语言",
    "description": "这是一本汇编语言",
    "available": true,
    "next_available_time": null
  },
  {
    "id": 2,
    "name": "汇编语言",
    "description": "这是另一本汇编语言",
    "available": true,
    "next_available_time": null
  },
  {
    "id": 3,
    "name": "汇编语言",
    "description": "这是第三本汇编语言",
    "available": true,
    "next_available_time": null
  }
]
```

## Get book detail

Router: /api/book/{book_id}

Method: `GET`

Authorize: `All`

Params:

name | required | description
--- | --- | ---
book_id | true | token for portal

Example:

```json
{
    "book_id": 1,
}
```

Response:

- `code 200`

`未借出`

```json
{
    "id": 1,
    "name": "编程之美",
    "description": "这是编程之美",
    "e_book": null,
    "available": true,
    "next_available_time": null,
    "publisher": "电子工业出版社",
    "publishDate": "2008-03-01",
    "authors": "《编程之美》小组",
    "img_url": "https://images.isbndb.com/covers/07/48/9787121060748.jpg"
}
```

`已借出`

```json
{
    "id": 1,
    "name": "编程之美",
    "description": "这是编程之美",
    "e_book": null,
    "available": false,
    "next_available_time": "2018-05-04 17:34:33",
    "publisher": "电子工业出版社",
    "publishDate": "2008-03-01",
    "authors": "《编程之美》小组",
    "img_url": "https://images.isbndb.com/covers/07/48/9787121060748.jpg"
}
```

- `code 404`    不存在对应id的书


## Change book

Router: /api/book

Method: `PUT`

Authorize: `Admin`

Params:

name | required | description
--- | --- | ---
book_id | true | id of the book which your want to change
token / remember_token | true | token for portal
description | false | new description of book

Example:

`仅修改描述`

```json
{
    "book_id": 1,
    "token": "ad66f144-191d-473d-b25e-d8bb073c48c0",
    "description": "new description"
}
```

Response:

- `code 200`

```json
{
    "book_id": 1,
}
```

- `code 401`    用户未登录或token失效
- `code 403`    用户没有管理员权限

## Delete book

Router: /api/book

Method: `DELETE`

Authorize: `Admin`

Params:

name | required | description
--- | --- | ---
book_id | true | id of the book which your want to delete
token / remember_token | true | token for portal

Example:

```json
{
    "book_id": 1,
    "token": "ad66f144-191d-473d-b25e-d8bb073c48c0"
}
```

Response:

- `code 200`

```json
[]
```

- `code 401`    用户未登录或token失效
- `code 403`    用户没有管理员权限
- `code 422`    请求参数出错

```json
{
    "book_id": [
        "The book_id field is required."
    ]
}
```