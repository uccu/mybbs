[返回](main.md)


***

### 1. all

###### 说明：`获取主页的内容`

###### 接口地址：`app/home/all`

###### 传入参数：

无

###### 返回参数：

**banner** [切图字典](#切图字典) 的数组  

**top_line** [头条字典](#头条字典) 的数组  

**expert** [推荐专家字典](#推荐专家字典) 的数组  

**repository** [知识库字典](#知识库字典) 的数组  

**inquiry** [问诊数量字典](#问诊数量字典) 的数组  

**message** 是否有消息  

***





### 2. repository_type

###### 说明：`获取知识库分类列表`

###### 接口地址：`app/home/repository_type`

###### 传入参数：

无

###### 返回参数：

**list** [知识库分类字典](#知识库分类字典) 的数组  

***




### 3. repository_list

###### 说明：`获取知识库列表`

###### 接口地址：`app/home/repository_list`

###### 传入参数：

**bid** `分类的ID，如果不传或0则获取第一个分类的知识库`

**page** `页数`

**limit** `每页限制数量`

###### 返回参数：

**list** [知识库字典](#知识库字典) 的数组  

**count** `数量`

***



### 4. repository_search

###### 说明：`获取知识库列表`

###### 接口地址：`app/home/repository_search`

###### 传入参数：

**search** `搜索的关键词`

**page** `页数`

**limit** `每页限制数量`

###### 返回参数：

**list** [知识库字典](#知识库字典) 的数组  

**count** `数量`

***




### 4. fast

###### 说明：`快速呼叫`

###### 接口地址：`app/home/fast`

###### 传入参数：

**equip** `设备类型（名字）`

**img** `图片`

**content** `描述`

**vioce** `录音`

###### 返回参数：

无

***




### 5. collect

###### 说明：`收藏/取消收藏知识库`

###### 接口地址：`app/home/collect`

###### 传入参数：

**id**         `知识库ID`

###### 返回参数：

**collected**         `成功后收藏状态，1是0否`

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



#### **问诊数量字典**


**finish**    `已解决数量`

**unfinish**  `未解决数量`

```
{
    "finish": 123,
    "unfinish": 22,

}
```




#### **知识库分类字典**


**rid**         `ID`

**ctime**       `创建时间`

**name**        `分类名字`


```
{
    "rid": "1",
    "ctime": "1700000000",
    "name": "精选",
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