<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: sans-serif; line-height: 1.6; color: #333; }
        .container { width: 100%; max-width: 600px; margin: 0 auto; border: 1px solid #eee; padding: 20px; }
        .header { background: #045184; color: #fff; padding: 10px; text-align: center; }
        .content { padding: 20px; }
        .field { margin-bottom: 10px; border-bottom: 1px dashed #ccc; padding-bottom: 5px; }
        .label { font-weight: bold; color: #045184; }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h2>Yeni Vakansiya Müraciəti</h2>
    </div>
    <div class="content">
        <div class="field"><span class="label">Ad Soyad:</span> {{ $formData['contact_name'] }} </div>
        <div class="field"><span class="label">E-mail:</span> {{ $formData['contact_email'] }}</div>
        <div class="field"><span class="label">Telefon:</span> {{ $formData['contact_phone'] }}</div>
        <div class="field"><span class="label">Vəzifə:</span> {{ $formData['contact_message'] }}</div>
{{--        <div class="field"><span class="label">İş Təcrübəsi:</span> {{ $formData['contact_experience'] }}</div>--}}
{{--        <div class="field"><span class="label">Yaxınlaşa biləcəyi günlər:</span> {{ implode(', ', $formData['days'] ?? []) }}</div>--}}
        <div class="field">
            <span class="label">Haqqında:</span><br>
            {{ $formData['message'] }}
        </div>
    </div>
</div>
</body>
</html>
