# php-passport-login

ลิงค์ลงทะเบียนแอปพลิเคชั่น
http://passport.yru.ac.th/developer/oauth-apps

### การทดสอบใช้งาน ###
ให้นำ CLIENT_ID และ CLIENT_SECRET ที่ได้รับจากการลงทะเบียนไปตั้งค่าที่ไฟล์ YRUPassport.php ที่บรรทัดที่ 5 กับ 6

```php
class YRUPassport
{
    private const CLIENT_ID     = 'Your ID Client';
    private const CLIENT_SECRET = 'Your Client Secret';
    
    // ...
}
```