[返回](main.md)


***

### 1. expert_search

###### 说明：`专家搜索`

###### 接口地址：`app/inquiry/expert_search`

###### 传入参数：

**search**         `搜索内容`

**page**       `页数`

**limit**      `每页数量`

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

###### 接口地址：`app/inquiry/lists`

###### 传入参数：

**bid**        `设备分类ID`

**page**       `页数`

**limit**      `每页数量`

###### 返回参数：

**list** `所有回答`   [问诊信息字典](#问诊信息字典) 的数组 

***




### 5. search

###### 说明：`查询问诊列表`

###### 接口地址：`app/inquiry/search`

###### 传入参数：

**search**     `搜索内容`

**page**       `页数`

**limit**      `每页数量`

###### 返回参数：

**list** `所有回答`   [问诊信息字典](#问诊信息字典) 的数组 

***




### 6. answer

###### 说明：`回答问诊`

###### 接口地址：`app/inquiry/answer`

###### 传入参数：

**bid**         `问诊ID`

**content**     `内容`

**img**         `图片`

###### 返回参数：

无

***



### 7. publish

###### 说明：`发布问诊`

###### 接口地址：`app/inquiry/publish`

###### 传入参数：

**bid**         `设备分类ID`

**title**       `标题`

**content**     `内容`

**img**         `图片`

###### 返回参数：

无

***




### 8. collect

###### 说明：`收藏/取消收藏问诊`

###### 接口地址：`app/inquiry/collect`

###### 传入参数：

**id**         `问诊ID`

###### 返回参数：

**collected**         `成功后收藏状态，1是0否`

***



### 9. zan

###### 说明：`点赞/取消点赞回答`

###### 接口地址：`app/inquiry/zan`

###### 传入参数：

**id**         `问诊回答ID`

###### 返回参数：

**collected**         `成功后点赞状态，1是0否`

***








# 字典


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



#### **专家信息字典**


**uid**         `用户UID`

**thumb**       `头像`

**nickname**    `昵称`

**experience**  `经验`

**label**       `标签`

**answer**      `回答数`

**fans**        `粉丝数`

**follow**      `关注数`

**followed**    `是否已关注`

```
{
    "uid": "3",
    "thumb": "",
    "nickname": "用户_1475134303",
    "experience": "1年",
    "label": "大佬",
    "type": "2",
    "is_login": "0",
    "answer": "0",
    "fans": "0",
    "follow": "0",
    "followed": "0",
}

```