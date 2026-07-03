<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Reset kata kunci Akun MOOC</title>
    <style>
        /* Reset CSS untuk konsistensi */
        body, table, td, a { 
            -webkit-text-size-adjust: 100%; 
            -ms-text-size-adjust: 100%; 
        }
        table, td { 
            mso-table-lspace: 0pt; 
            mso-table-rspace: 0pt; 
        }
        img { 
            -ms-interpolation-mode: bicubic; 
            border: 0; 
            height: auto; 
            line-height: 100%; 
            outline: none; 
            text-decoration: none; 
        }
        
        body {
            margin: 0 !important;
            padding: 0 !important;
            width: 100% !important;
            height: 100% !important;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f7fa;
        }
    </style>
</head>
<body>
    <!-- Outer wrapper -->
    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="background-color: #f4f7fa; padding: 20px 0;">
        <tr>
            <td align="center">
                <!-- Main container -->
                <table class="email-container" width="600" border="0" cellspacing="0" cellpadding="0" style="background: #ffffff; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                    
                    <!-- Header -->
                    <tr>
                        <td class="header" style="background: linear-gradient(135deg, #1b84ff 0%, #0056cc 100%); padding: 40px 30px; text-align: center; border-radius: 8px 8px 0 0;">
                            <!-- Logo (optional) -->
                            <!-- <img src="{{ asset('assets/media/logos/logo-white.png') }}" alt="MOOC Logo" style="max-width: 180px; height: auto; margin-bottom: 15px;"> -->
                            
                            <h1 style="color: #ffffff; font-size: 28px; font-weight: 700; margin: 0; line-height: 1.3;">
                                🔐 Reset kata kunci Akun MOOC
                            </h1>
                            <p style="color: rgba(255, 255, 255, 0.9); font-size: 14px; margin: 8px 0 0 0;">
                                Universitas Nurul Jadid
                            </p>
                        </td>
                    </tr>
                    
                    <!-- Content -->
                    <tr>
                        <td class="content" style="padding: 40px 30px; background: #ffffff;">
                            
                            <!-- Greeting -->
                            <p class="greeting" style="font-size: 20px; font-weight: 600; color: #2d3748; margin: 0 0 20px 0;">
                                Halo, {{ $user->name }}! 👋
                            </p>
                            
                            <!-- Message -->
                            <p class="message" style="font-size: 16px; line-height: 1.6; color: #4a5568; margin: 0 0 20px 0;">
                                Anda menerima email ini karena ada permintaan untuk <strong>reset kata kunci</strong> akun Anda di <strong>{{ config('app.name') }}</strong>.
                            </p>
                            
                            <p class="message" style="font-size: 16px; line-height: 1.6; color: #4a5568; margin: 0 0 20px 0;">
                                Jika Anda yang mengajukan permintaan ini, silakan atur ulang kata kunci dengan menekan tombol di bawah.
                            </p>
                            
                            <!-- Reset Box -->
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td class="verification-box" style="background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%); border: 2px solid #1b84ff; border-radius: 12px; padding: 30px; text-align: center;">
                                        
                                        <!-- Icon -->
                                        <div style="width: 50px; height: 50px; margin: 0 auto 20px; background: linear-gradient(135deg, #1b84ff 0%, #0056cc 100%); border-radius: 50%; display: inline-block; line-height: 50px; text-align: center;">
                                            <span style="font-size: 30px; color: #ffffff;">🔑</span>
                                        </div>
                                        
                                        <p class="verification-text" style="font-size: 16px; color: #1e40af; font-weight: 600; margin-bottom: 25px;">
                                            Atur ulang kata kunci akun Anda
                                        </p>
                                        
                                        <!-- Button -->
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td align="center" style="padding: 20px 0;">
                                                    <!--[if mso]>
                                                    <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="{{ $url }}" style="height:50px;v-text-anchor:middle;width:250px;" arcsize="16%" stroke="f" fillcolor="#1b84ff">
                                                        <w:anchorlock/>
                                                        <center style="color:#ffffff;font-family:sans-serif;font-size:16px;font-weight:bold;">Reset kata kunci Saya</center>
                                                    </v:roundrect>
                                                    <![endif]-->
                                                    <!--[if !mso]><!-->
                                                    <a href="{{ $url }}" class="verify-button" style="display: inline-block; padding: 16px 40px; background: linear-gradient(135deg, #1b84ff 0%, #0056cc 100%); color: #ffffff !important; text-decoration: none; border-radius: 8px; font-size: 16px; font-weight: 700; letter-spacing: 0.5px; box-shadow: 0 4px 15px rgba(27, 132, 255, 0.3);">
                                                        Reset kata kunci Saya
                                                    </a>
                                                    <!--<![endif]-->
                                                </td>
                                            </tr>
                                        </table>
                                        
                                    </td>
                                </tr>
                            </table>
                            
                            <!-- Info Box -->
                            <table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top: 25px;">
                                <tr>
                                    <td class="info-box" style="background: #fef3c7; border-left: 4px solid #f59e0b; border-radius: 6px; padding: 20px;">
                                        <p style="margin: 0; font-size: 14px; color: #78350f; line-height: 1.6;">
                                            ⏰ <strong>Penting:</strong> Link reset kata kunci ini hanya berlaku selama <strong>15 menit</strong> sejak email ini dikirim. Setelah itu, Anda perlu meminta link reset baru.
                                        </p>
                                    </td>
                                </tr>
                            </table>
                            
                            <!-- URL Fallback -->
                            <table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top: 25px;">
                                <tr>
                                    <td class="url-fallback" style="background: #f8fafc; border: 1px dashed #cbd5e0; border-radius: 6px; padding: 20px;">
                                        <p style="margin: 0 0 10px 0; font-size: 14px; color: #4a5568; font-weight: 600;">
                                            Tombol tidak berfungsi? Salin link berikut:
                                        </p>
                                        <a href="{{ $url }}" style="color: #1b84ff; font-size: 13px; word-wrap: break-word;">{{ $url }}</a>
                                    </td>
                                </tr>
                            </table>
                            
                            <!-- Divider -->
                            <div class="divider" style="height: 1px; background: linear-gradient(to right, transparent, #e5e7eb, transparent); margin: 30px 0;"></div>
                            
                            <!-- Security Tips Section -->
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td class="features" style="padding: 25px; background: linear-gradient(135deg, #f9fafb 0%, #f3f4f6 100%); border-radius: 8px;">
                                        
                                        <h3 style="font-size: 18px; color: #1f2937; margin: 0 0 20px 0; text-align: center; font-weight: 700;">
                                            Tips Menjaga Keamanan Akun Anda
                                        </h3>
                                        
                                        <!-- Tip 1 -->
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-bottom: 15px;">
                                            <tr>
                                                <td width="40" style="vertical-align: top;">
                                                    <div style="width: 40px; height: 40px; background: linear-gradient(135deg, #1b84ff 0%, #0056cc 100%); border-radius: 8px; text-align: center; line-height: 40px;">
                                                        <span style="font-size: 20px;">🔒</span>
                                                    </div>
                                                </td>
                                                <td style="padding-left: 15px; vertical-align: top;">
                                                    <h4 style="margin: 0 0 5px 0; font-size: 15px; color: #1f2937; font-weight: 600;">Gunakan kata kunci yang Kuat</h4>
                                                    <p style="margin: 0; font-size: 13px; color: #6b7280; line-height: 1.5;">Kombinasikan huruf besar, huruf kecil, angka, dan simbol.</p>
                                                </td>
                                            </tr>
                                        </table>
                                        
                                        <!-- Tip 2 -->
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-bottom: 15px;">
                                            <tr>
                                                <td width="40" style="vertical-align: top;">
                                                    <div style="width: 40px; height: 40px; background: linear-gradient(135deg, #1b84ff 0%, #0056cc 100%); border-radius: 8px; text-align: center; line-height: 40px;">
                                                        <span style="font-size: 20px;">🙅‍♂️</span>
                                                    </div>
                                                </td>
                                                <td style="padding-left: 15px; vertical-align: top;">
                                                    <h4 style="margin: 0 0 5px 0; font-size: 15px; color: #1f2937; font-weight: 600;">Jangan Berbagi kata kunci</h4>
                                                    <p style="margin: 0; font-size: 13px; color: #6b7280; line-height: 1.5;">Jangan berikan kata kunci kepada siapa pun, termasuk yang mengaku dari admin.</p>
                                                </td>
                                            </tr>
                                        </table>
                                        
                                        <!-- Tip 3 -->
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td width="40" style="vertical-align: top;">
                                                    <div style="width: 40px; height: 40px; background: linear-gradient(135deg, #1b84ff 0%, #0056cc 100%); border-radius: 8px; text-align: center; line-height: 40px;">
                                                        <span style="font-size: 20px;">📧</span>
                                                    </div>
                                                </td>
                                                <td style="padding-left: 15px; vertical-align: top;">
                                                    <h4 style="margin: 0 0 5px 0; font-size: 15px; color: #1f2937; font-weight: 600;">Waspada Email Mencurigakan</h4>
                                                    <p style="margin: 0; font-size: 13px; color: #6b7280; line-height: 1.5;">Pastikan link yang Anda klik benar-benar berasal dari {{ config('app.name') }}.</p>
                                                </td>
                                            </tr>
                                        </table>
                                        
                                    </td>
                                </tr>
                            </table>
                            
                            <!-- Security Notice -->
                            <p style="font-size: 13px; color: #6b7280; line-height: 1.6; margin: 25px 0 0 0;">
                                ⚠️ <strong>Catatan:</strong> Jika Anda tidak merasa meminta reset kata kunci, abaikan email ini. kata kunci Anda tidak akan berubah tanpa mengklik link di atas.
                            </p>
                            
                        </td>
                    </tr>
                    
                    <!-- Footer -->
                    <tr>
                        <td class="footer" style="background: #1f2937; padding: 30px; text-align: center; border-radius: 0 0 8px 8px;">
                            
                            <p style="color: #9ca3af; font-size: 13px; line-height: 1.6; margin: 0 0 15px 0;">
                                Email ini dikirim otomatis oleh sistem. Mohon untuk tidak membalas email ini.
                            </p>
                            
                            <div style="height: 1px; background: rgba(255,255,255,0.1); margin: 20px 0;"></div>
                            
                            <p style="color: #6b7280; font-size: 12px; margin: 0;">
                                &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.<br>
                                Universitas Nurul Jadid, Probolinggo, Jawa Timur
                            </p>
                            
                        </td>
                    </tr>
                    
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
