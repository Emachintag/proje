<html>
        <head>
                <title>I Feel Code - Şifre Yenileme Talebi</title>
        </head>
        <body>
                <p><strong>Bu e-posta size {{date('Y-m-d H:i')}} tarihinde şifrenizi yenileme talebi oluşturduğunuz için I Feel Code tarafından otomatik olarak gönderilmiştir.</strong></p>
                <p>Şifrenizi yenilemek için <a href="https://ifeelcode.com/sifre-yenile?email={{$email}}&key={{$token}}">buraya</a> tıklayın ve açılan sayfada yeni şifrenizi belirleyin</p>
                <p>Uyarı: Eğer şifre yenileme talebini siz oluşturmadıysanız <a href="mailto:info@ifeelcode.com">buradan</a> bize bildirin.</p>
        </body>
</html>