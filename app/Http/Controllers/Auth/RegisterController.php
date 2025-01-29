<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class RegisterController extends Controller
{
    /**
     * عرض نموذج التسجيل
     */
    public function showRegistrationForm()
    {
        return view('auth.register'); // تأكد من وجود ملف register.blade.php في مجلد auth
    }

    /**
     * معالجة طلبات التسجيل
     */
    public function register(Request $request)
    {
        // التحقق من صحة البيانات
        $request->validate([
            'full_name' => 'required|string|max:50',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|max:12|confirmed', // تأكد من تطابق كلمة المرور وتأكيدها
            'phone_number' => 'required|string|max:15',
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:H,F',
            'preferred_language' => 'required|in:ar,en,fr',
            'terms' => 'required|accepted',
        ]);

        // حفظ صورة الملف الشخصي
        $profilePicturePath = $request->file('profile_picture')->store('profile_pictures', 'public');

        // إنشاء مستخدم جديد
        $user = User::create([
            'name' => $request->full_name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // تشفير كلمة المرور
            'phone_number' => $request->phone_number,
            'profile_picture' => $profilePicturePath,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender === 'H' ? 'male' : 'female', // تحويل القيم لتتوافق مع قاعدة البيانات
            'preferred_language' => $request->preferred_language,
            'role' => 'user', // القيمة الافتراضية
        ]);

        // إعادة توجيه المستخدم بعد التسجيل
        return redirect()->route('login')->with('success', 'تم التسجيل بنجاح!');
    }
}