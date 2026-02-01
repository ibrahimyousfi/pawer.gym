# دليل تشغيل مشروع Gym Management System

## متطلبات النظام
- PHP 8.2 أو أحدث ✅ (مثبت: PHP 8.2.4)
- Composer ✅ (مثبت)
- Node.js و npm ✅ (مثبت)
- SQLite (يستخدم قاعدة بيانات محلية)

## خطوات التشغيل

### 1. تثبيت التبعيات

#### تبعيات PHP (Composer)
```bash
composer install
```
✅ تم التثبيت بالفعل

#### تبعيات Node.js
```bash
npm install
```
✅ تم التثبيت

### 2. إعداد ملف البيئة (.env)
✅ ملف `.env` موجود بالفعل

### 3. إنشاء مفتاح التطبيق
```bash
php artisan key:generate
```

### 4. إعداد قاعدة البيانات
```bash
php artisan migrate
```
أو إذا كانت قاعدة البيانات موجودة:
```bash
php artisan migrate --force
```

### 5. بناء ملفات الأصول (CSS/JS)
```bash
npm run build
```
✅ تم البناء

### 6. تشغيل الخادم

#### الطريقة الأولى: تشغيل Laravel فقط
```bash
php artisan serve
```
سيعمل المشروع على: `http://127.0.0.1:8000`

#### الطريقة الثانية: تشغيل كامل (Laravel + Vite + Queue)
```bash
composer run dev
```
هذا الأمر سيشغل:
- خادم Laravel
- Vite (للملفات الأمامية)
- Queue Worker
- Pail (للمراقبة)

### 7. الوصول للتطبيق
افتح المتصفح وانتقل إلى:
```
http://127.0.0.1:8000
```

## ملاحظات مهمة

1. **قاعدة البيانات**: المشروع يستخدم SQLite، الملف موجود في `database/database.sqlite`

2. **البيئة**: تأكد من أن `APP_ENV=local` و `APP_DEBUG=true` في ملف `.env` للتطوير

3. **الصلاحيات**: تأكد من أن مجلدات `storage` و `bootstrap/cache` قابلة للكتابة

4. **التبعيات**: إذا واجهت مشاكل، قم بتشغيل:
   ```bash
   composer install --no-interaction
   npm install
   ```

## استكشاف الأخطاء

### خطأ في قاعدة البيانات
```bash
php artisan migrate:fresh
```

### مسح الكاش
```bash
php artisan config:clear
php artisan cache:clear
php artisan view:clear
```

### إعادة بناء الأصول
```bash
npm run build
```
