# /api/rent

## Rent a book

Router: /api/rent

Method: `PUT`

Authorize: `Loged`

Params:

name | required | description
--- | --- | ---
token / remember_token | true | token for portal
book_id | true | id of book

Example:
```json
{
    "token": "ad66f144-191d-473d-b25e-d8bb073c48c0",
    "book_id": 1,
}
```

Response:

- `code 200`

```json
{
    "status": 1,
    "expired_at": "2018-05-04 17:34:33",
}
```

- `code 401`    用户未登录或token失效
- `code 422`    请求参数出错
```json
{
    "token": [
        "The token field is required."
    ],
    "book_id": [
        "The book_id field is required."
    ]
}
```
- `code 488`    用户借书数量到达上限
- `code 499`    书已被借走

## Revert a book

Router: /api/revert

Method: `PUT`

Authorize: `Loged`

Params:

name | required | description
--- | --- | ---
token / remember_token | true | token for portal
book_id | true | id of book

Example:
```json
{
    "token": "ad66f144-191d-473d-b25e-d8bb073c48c0",
    "book_id": 1,
}
```

Response:

- `code 200`

```json
{
    "status": 1,
}
```

- `code 401`    用户未登录或token失效
- `code 422`    请求参数出错

```json
{
    "token": [
        "The token field is required."
    ],
    "book_id": [
        "The book_id field is required."
    ]
}
```