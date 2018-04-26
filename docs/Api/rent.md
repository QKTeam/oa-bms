# /api/rent

## Rent a book

Router: /api/rent/{book_id}

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
    "token": "ad66f144-191d-473d-b25e-d8bb073c48c0"
}
```

Response:

- `code 200`

```json
{
    "status": 1,
    "expired_at": "2018-05-04 17:34:33"
}
```

- `code 401`    用户未登录或token失效
- `code 422`    请求参数出错
```json
{
    "token": [
        "The token field is required."
    ]
}
```
- `code 488`    用户借书数量到达上限
- `code 499`    书已被借走

## Revert a book

Router: /api/revert/{book_id}

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
    "token": "ad66f144-191d-473d-b25e-d8bb073c48c0"
}
```

Response:

- `code 200`

```json
{
    "status": 1
}
```

- `code 401`    用户未登录或token失效
- `code 422`    请求参数出错

```json
{
    "token": [
        "The token field is required."
    ]
}
```

## Rent List

Router: /api/rent/list

Method: `GET`

Authorize: `Loged`

Params:

name | required | description
--- | --- | ---
token / remember_token | true | token for portal

Example:
```json
{
    "token": "ad66f144-191d-473d-b25e-d8bb073c48c0"
}
```

Response:

- `code 200`

```json
{
    "count": 2,
    "list": [
        {
            "id": 3,
            "name": "汇编语言",
            "description": "这是第三本汇编语言",
        },
        {
            "id": 2,
            "name": "汇编语言",
            "description": "这是第二本汇编语言",
        }
    ]
}
```