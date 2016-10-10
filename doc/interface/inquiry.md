[返回](main.md)


***

### 1. expert_search

###### 说明：`专家搜索`

###### 接口地址：`app/inquiry/expert_search`

###### 传入参数：

无

###### 返回参数：

**list** [专家信息字典](#专家信息字典) 的数组  


***



### 2. info

###### 说明：`问诊详情`

###### 接口地址：`app/inquiry/info`

###### 传入参数：

**id**         `问诊ID`

###### 返回参数：

**info** [问诊信息字典](#问诊信息字典) 

**follow** 是否是发布者的粉丝

**collect** 是否已经收藏该问诊 

**adopt** `已经采纳的回答`  [回答字典](#回答字典) 的数组 

**reply** `其他回答`   [回答字典](#回答字典) 的数组 

***




### 3. reply

###### 说明：`问诊回复详情`

###### 接口地址：`app/inquiry/reply`

###### 传入参数：

**id**         `问诊ID`

**page**       `页数`

**limit**      `每页数量`

###### 返回参数：

**reply** `所有回答`   [回答字典](#回答字典) 的数组 

***





### 4. lists

###### 说明：`问诊列表`

###### 接口地址：`app/inquiry/reply`

###### 传入参数：

**bid**         `设备分类ID`

**page**       `页数`

**limit**      `每页数量`

###### 返回参数：

**list** `所有回答`   [问诊信息字典](#问诊信息字典) 的数组 

***












# 字典


#### **问诊信息字典（简单）**

**id**          `问诊ID`

**uid**         `用户UID`

**bid**         `设备分类`

**title**       `标题`

**content**     `内容`

**img**         `图片`

**ctime**       `创建时间`

**finish**      `完成时间`

**answer**      `回答数`

**read**        `访问数`

**collect**     `收藏数`

**thumb**       `头像`

**nickname**    `昵称`

**collected**   `是否收藏`

```
{
    "id": "1",
    "uid": "1",
    "bid": "1",
    "title": "123",
    "content": "123",
    "img": "",
    "ctime": "0",
    "finish": "0",
    "answer": "0",
    "read": "2",
    "collect": "0",
    "thumb": "",
    "nickname": "",
    "collected":"0"
}

```





#### **问诊信息字典**

**id**          `问诊ID`

**uid**         `用户UID`

**bid**         `设备分类`

**title**       `标题`

**content**     `内容`

**img**         `图片`

**ctime**       `创建时间`

**finish**      `完成时间`

**answer**      `回答数`

**read**        `访问数`

**collect**     `收藏数`

**thumb**       `头像`

**nickname**    `昵称`

```
{
    "id": "1",
    "uid": "1",
    "bid": "1",
    "title": "123",
    "content": "123",
    "img": "",
    "ctime": "0",
    "finish": "0",
    "answer": "0",
    "read": "2",
    "collect": "0",
    "thumb": "",
    "nickname": ""
}

```


#### **回答字典**

**id**          `回答ID`

**uid**         `用户UID`

**bid**         `问诊ID`

**content**     `内容`

**img**         `图片`

**ctime**       `创建时间`

**adopt**      `是否采纳`

**thank**        `感谢词`

**thumb**       `头像`

**nickname**    `昵称`

```
{
    "id": "1",
    "uid": "1",
    "bid": "1",
    "content": "123",
    "img": "123.jpg",
    "ctime": "0",
    "adopt": "1",
    "thank": "",
    "zan": "0",
    "thumb": "",
    "nickname": ""
}

```
