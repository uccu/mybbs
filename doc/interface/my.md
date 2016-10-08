[返回](main.md)


***

### 1. choose_char

###### 说明：`选择用户角色`

###### 接口地址：`app/my/choose_char`

###### 传入参数：

无

###### 返回参数：

无



***

### 1. change_u_info

###### 说明：`修改用户信息`

###### 接口地址：`app/my/change_u_info`

###### 传入参数：

**nickname** `昵称` 

**sex** `性别，1男2女` 

**city** `城市ID` 

**plant** `关注设备ID`

**thumb** `头像地址`

###### 返回参数：

无



***

### 2. change_o_info

###### 说明：`完善资料并申请成为运维`

###### 接口地址：`app/my/change_o_info`

###### 传入参数：

**nickname** `昵称` 

**sex** `性别，1男2女` 

**city** `城市ID` 

**plant** `关注设备ID`

**conpany** `供职单位`

**at_start** `供职时间起`

**at_end** `供职时间止`

**experience** `从业经验`

**generator** `发电机组`

**标签** `label`

**field** `擅长领域`

**thumb** `头像地址`

###### 返回参数：

无

***



### 3. my_info

###### 说明：`获取我的信息`

###### 接口地址：`app/my/my_info`

###### 传入参数：

无

###### 返回参数：

**password** [用户信息字典](#用户信息字典)

***




# 字典


#### **用户信息字典**

**user_token**  `用户标识`

**uid**         `用户UID`

**news**        `是否为新增加用户`

**type**        `用户的类型，-1为选择，0用户，1运维，2专家`

**apply**         `是否有提交审核中的角色，1为运维，2为专家，0为没有`

**complete**    `是否完善资料`

```
    {
        "user_token": "XXXXXXXXXXXXXXXXXXXXXXX",
        "uid": "2",
        "news": "1",
        "type": "0",
        "apply": "1"
        "complete":"0"
    }

```