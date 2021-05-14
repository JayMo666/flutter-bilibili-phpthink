[TOC]

# 读琴



## Base URL

地址：``



## 用户

### 列表

地址：`/api/user/list`

类型：`POST(body)`

参数：

```javascript
{
    *page: 1,
    *limit: 10,
    type: null, // 角色 NORMAL_USER DQ_SINGER DQ_OFFICIAL_ACCOUNT
}
```

返回：

```json
{
    "code": 0,
    "msg": "success",
    "page": {}
}
```

### 详情

地址：`/api/user/info/:id`

类型：`GET(path)`

参数：

返回：

```json
{
    "code": 0,
    "msg": "success",
    "info": {}
}
```



## 歌曲

### 列表

地址：`/api/song/list`

类型：`POST(body)`

参数：

```javascript
{
    *page: 1,
    *limit: 10,
}
```

返回：

```json
{
    "code": 0,
    "msg": "success",
    "page": {}
}
```

### 详情

地址：`/api/song/info/:id`

类型：`GET(path)`

参数：

返回：

```json
{
    "code": 0,
    "msg": "success",
    "info": {}
}
```



## 文章

### 列表

地址：`/api/article/list`

类型：`POST(body)`

参数：

```javascript
{
    *page: 1,
    *limit: 10,
}
```

返回：

```json
{
    "code": 0,
    "msg": "success",
    "page": {}
}
```

### 详情

地址：`/api/article/info/:id`

类型：`GET(path)`

参数：

返回：

```json
{
    "code": 0,
    "msg": "success",
    "info": {}
}
```



## 视频

### 列表

地址：`/api/video/list`

类型：`POST(body)`

参数：

```javascript
{
    *page: 1,
    *limit: 10,
}
```

返回：

```json
{
    "code": 0,
    "msg": "success",
    "page": {}
}
```

### 详情

地址：`/api/video/info/:id`

类型：`GET(path)`

参数：

返回：

```json
{
    "code": 0,
    "msg": "success",
    "info": {}
}
```



## 推荐

### 列表

地址：`/api/recommend/list`

类型：`POST(body)`

参数：

```javascript
{
    *page: 1,
    *limit: 10,
}
```

返回：

```json
{
    "code": 0,
    "msg": "success",
    "page": {}
}
```

