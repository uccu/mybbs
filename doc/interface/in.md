[返回](main.md)


***

### 1. login

###### 说明：`登录`

###### 接口地址：`app/in/login`

###### 传入参数：

**usercode** `账户` 

**password** `密码`

###### 返回参数：

[登录字典](#登录字典)

***




### 2. login_third

###### 说明：`第三方登录`

###### 接口地址：`app/in/login_third`

###### 传入参数：

**platform** `第三方类型` 

**key** `第三方标识`

###### 返回参数：

[登录字典](#登录字典)

***




### 3. bind

###### 说明：`绑定第三方`

###### 接口地址：`app/in/bind`

###### 传入参数：

**user_token** `用户标识`

**platform** `第三方类型` 

**key** `第三方标识`

###### 返回参数：

无

***





### 4. unbind

###### 说明：`解除第三方`

###### 接口地址：`app/in/unbind`

###### 传入参数：

**user_token** `用户标识`

**platform** `第三方类型` 


###### 返回参数：

无

***





### 5. register

###### 说明：`注册`

###### 接口地址：`app/in/register`

###### 传入参数：

**usercode** `账号` 

**password** `密码`

**captcha** `验证码`

###### 返回参数：

[登录字典](#登录字典)

***






### 6. forget

###### 说明：`忘记密码`

###### 接口地址：`app/in/forget`

###### 传入参数：

**usercode** `账号` 

**password** `密码`

**captcha** `验证码`

###### 返回参数：

无

***







# 字典


#### **登录字典**

**user_token**  `用户标识`

**uid**         `用户UID`

**news**        `是否为新增加用户`

**type**        `用户的类型，-1未选择，0用户，1运维，2专家`

**apply**       `是否有提交审核中的角色，1为运维，2为专家，0为没有`

**complete**    `是否完善资料`

**vip**         `VIP到期时间戳`

**isvip**       `是否VIP`

```
    {
        "user_token": "XXXXXXXXXXXXXXXXXXXXXXX",
        "uid": "2",
        "news": "1",
        "type": "0",
        "apply": "1"
        "complete":"0",
        "vip": "1999999999",
        "isvip": "1"
    }

```





