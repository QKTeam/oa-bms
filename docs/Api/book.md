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

Example:

```json
{
    "token": "ad66f144-191d-473d-b25e-d8bb073c48c0",
    "name": "汇编语言",
    "description": "这是汇编语言"
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
    "description": "这是一本汇编语言"
  },
  {
    "id": 2,
    "name": "汇编语言",
    "description": "这是另一本汇编语言"
  },
  {
    "id": 3,
    "name": "汇编语言",
    "description": "这是第三本汇编语言"
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
    "name": "汇编语言",
    "description": "这是一本汇编语言",
    "e_book": null,
    "available": true,
    "next_available_time": null,
}
```

`已借出`

```json
{
    "id": 1,
    "name": "汇编语言",
    "description": "这是一本汇编语言",
    "e_book": null,
    "available": false,
    "next_available_time": "2018-05-04 17:34:33",
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
name | false | new name of book
description | false | new description of book

Example:

`修改名字和描述`

```json
{
    "book_id": 1,
    "token": "ad66f144-191d-473d-b25e-d8bb073c48c0",
    "name": "new 汇编",
    "description": "new description"
}
```

`仅修改名字`

```json
{
    "book_id": 1,
    "token": "ad66f144-191d-473d-b25e-d8bb073c48c0",
    "name": "new 汇编"
}
```

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
- `code 422`    请求参数出错

```json
{
    "book_id": [
        "The book_id field is required."
    ]
}
```

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
    "token": "ad66f144-191d-473d-b25e-d8bb073c48c0",
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