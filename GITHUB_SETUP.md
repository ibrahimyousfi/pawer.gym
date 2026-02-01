# دليل رفع المشروع إلى GitHub

## الخطوات:

### 1. إنشاء مستودع جديد على GitHub

1. اذهب إلى [GitHub.com](https://github.com)
2. اضغط على زر **"New"** أو **"+"** في أعلى الصفحة
3. اختر **"New repository"**
4. أدخل اسم المستودع (مثلاً: `gym-management-system`)
5. اختر **Public** أو **Private** حسب رغبتك
6. **لا** تضع علامة على "Initialize this repository with a README"
7. اضغط **"Create repository"**

### 2. إضافة Remote ورفع المشروع

بعد إنشاء المستودع، GitHub سيعطيك رابط مثل:
```
https://github.com/username/gym-management-system.git
```

استخدم الأوامر التالية (استبدل الرابط برابطك):

```bash
# إضافة GitHub remote
git remote add origin https://github.com/username/gym-management-system.git

# تغيير اسم الفرع إلى main (إذا لزم الأمر)
git branch -M main

# رفع المشروع
git push -u origin main
```

### 3. إذا كان لديك المستودع بالفعل

إذا كان لديك مستودع موجود بالفعل، استخدم:

```bash
git remote add origin https://github.com/username/repository-name.git
git branch -M main
git push -u origin main
```

## ملاحظات مهمة:

- ✅ تم إنشاء commit بنجاح
- ✅ جميع الملفات تم إضافتها (167 ملف)
- ✅ ملف `.env` غير مضاف (محمي في .gitignore)
- ✅ ملفات `vendor` و `node_modules` غير مضافة (محمية)

## إذا واجهت مشاكل:

### خطأ: "repository not found"
- تأكد من أن رابط المستودع صحيح
- تأكد من أن لديك صلاحيات الوصول

### خطأ: "authentication failed"
- استخدم Personal Access Token بدلاً من كلمة المرور
- أو استخدم SSH بدلاً من HTTPS

### تغيير الرابط:
```bash
git remote set-url origin https://github.com/username/new-repo.git
```
