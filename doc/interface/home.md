[返回](main.md)


***

### 1. all

###### 说明：`获取验证码`

###### 接口地址：`tool/home/all`

###### 传入参数：

无

###### 返回参数：

**banner** [切图字典](#切图字典) 的数组  

**top_line** [头条字典](#头条字典) 的数组  

**expert** [推荐专家字典](#推荐专家字典) 的数组  

**top_line** [知识库字典](#知识库字典) 的数组  

**top_line** [头条字典](#头条字典) 的数组  

**message** 是否有消息  

***






# 字典


#### **切图字典**


**bid**         `ID`

**banner_img**  `图片`

**url**         `跳转地址`

**ctime**       `创建时间`

```
{
    "bid": "1",
    "banner_img": "xxx.jpg",
    "url": "xxx",
    "ctime": "1700000000"
} 

```


#### **头条字典**


**tid**         `ID`

**title**       `标题`

**content**     `内容`

**ctime**       `创建时间`

```
{
    "tid": "1",
    "title": "baka",
    "content": "测试测试",
    "ctime": "1700000000"
}
```


#### **推荐专家字典**


**nickname**    `昵称`

**thumb**       `头像`

**label**       `标题`

**uid**         `ID`

```
{
    "nickname": "用户_1475134303",
    "thumb": "",
    "label": "",
    "uid":"2"
}
```




#### **知识库字典**


**rid**         `ID`

**bid**         `分类ID`

**title**       `标题`

**content**     `内容`

**collection**  `收藏数`

**reading**     `阅读数`

**ctime**       `创建时间`

**describe**    `描述`

**thumb**       `缩略图`

**name**        `分类名字`


```
{
    "rid": "1",
    "mid": "1",
    "bid": "2",
    "title": "etrert",
    "content": "<p>erterter</p>",
    "collection": "0",
    "reading": "0",
    "ctime": "1474908939",
    "thumb": "",
    "describe":"",
    "name": "精选",
    "del": "0"
}
```