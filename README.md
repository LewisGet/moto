修改 Bootstrap Form 設定
====

Bootstrap Form 是使用 https://github.com/phiamo/MopaBootstrapBundle

詳細文件請參考

http://knpbundles.com/phiamo/MopaBootstrapBundle#configuration


使用者系統
====

使用者系統我們採用 https://github.com/FriendsOfSymfony/FOSUserBundle

初始於 Aedes/UserBundle

詳細文件請參考

https://github.com/FriendsOfSymfony/FOSUserBundle/blob/master/Resources/doc/index.md


主選單
====

主選單使用 https://github.com/KnpLabs/KnpMenuBundle

初始 與 DI 設定檔在 Aedes/MotoBundle

詳細文件請參考

https://github.com/KnpLabs/KnpMenuBundle/blob/master/Resources/doc/index.md


圖片上傳
====

圖片上傳使用 https://github.com/dustin10/VichUploaderBundle

初始 與 DI 設定檔在 Aedes/ImageBundle

詳細文件請參考

https://github.com/dustin10/VichUploaderBundle/blob/master/Resources/doc/index.md


分頁功能
====

分頁功能使用 https://github.com/KnpLabs/KnpPaginatorBundle

詳細文件請參考

https://github.com/KnpLabs/KnpPaginatorBundle


Moto Bundle
====

Moto Bundle 預定功能

1. 機車資料搜尋
2. 機車資料 新增, 寫入, 刪除
3. 機車資料上傳圖片 ( 依賴 Aedes/ImageBundle)
4. 機車會員系統 ( 依賴 Aedes/UserBundle)
5. 機車廣告區塊
6. 機車排序依照使用者經驗 ( 暫緩 )


Symfony2 基本設定 與 指令
====

系統設定檔案

```
app/config/parameters.yml
```

## 資料庫操作

### 操作界面

```
$ app/console
```

### 資料庫建立

```
$ app/console doctrine:database:create
```

### Schema 匯入

```
$ app/console doctrine:schema:create
```

### Assets 載入

```
$ app/console assets:install
```

### 清除快取

```
$ app/console cache:clear
```

資料表原始設計
----

https://docs.google.com/spreadsheets/d/1mcC1CDdeS775jyFpvLfKKoc499zPlVpW3YwYBJcqqBg/edit?usp=sharing