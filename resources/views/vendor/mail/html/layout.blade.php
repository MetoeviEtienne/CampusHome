<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>{{ config('app.name') }}</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="color-scheme" content="light">
  <meta name="supported-color-schemes" content="light">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;700&display=swap');

    body {
      margin: 0;
      padding: 0;
      background-color: #f3f4f6;
      font-family: 'Nunito Sans', sans-serif;
      color: #1f2937;
    }

    .wrapper {
      width: 100%;
      background-color: #f3f4f6;
      padding: 0;
      margin: 0;
    }

    .content {
      width: 100%;
      margin: 0;
      padding: 0;
    }

    .inner-body {
      width: 570px;
      margin: 0 auto;
      background-color: #ffffff;
      border-radius: 12px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04);
      padding: 32px;
    }

    .footer {
      width: 570px;
      margin: 0 auto;
      text-align: center;
      padding: 24px;
      font-size: 0.85rem;
      color: #9ca3af;
    }

    .content-cell {
      padding: 0;
    }

    @media only screen and (max-width: 600px) {
      .inner-body,
      .footer {
        width: 100% !important;
        padding: 16px !important;
      }
    }

    @media only screen and (max-width: 500px) {
      .button {
        width: 100% !important;
      }
    }
  </style>

  {{ $head ?? '' }}
</head>
<body>
  <table class="wrapper" width="100%" cellpadding="0" cellspacing="0" role="presentation">
    <tr>
      <td align="center">
        <table class="content" width="100%" cellpadding="0" cellspacing="0" role="presentation">
          {{ $header ?? '' }}

          <!-- Email Body -->
          <tr>
            <td class="body" width="100%" cellpadding="0" cellspacing="0">
              <table class="inner-body" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
                <!-- Body content -->
                <tr>
                  <td class="content-cell">
                    {{ Illuminate\Mail\Markdown::parse($slot) }}

                    {{ $subcopy ?? '' }}
                  </td>
                </tr>
              </table>
            </td>
          </tr>

          {{ $footer ?? '' }}
        </table>
      </td>
    </tr>
  </table>
</body>
</html>







{{-- <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>{{ config('app.name') }}</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="color-scheme" content="light">
<meta name="supported-color-schemes" content="light">
<style>
@media only screen and (max-width: 600px) {
.inner-body {
width: 100% !important;
}

.footer {
width: 100% !important;
}
}

@media only screen and (max-width: 500px) {
.button {
width: 100% !important;
}
}
</style>
{{ $head ?? '' }}
</head>
<body>

<table class="wrapper" width="100%" cellpadding="0" cellspacing="0" role="presentation">
<tr>
<td align="center">
<table class="content" width="100%" cellpadding="0" cellspacing="0" role="presentation">
{{ $header ?? '' }}

<!-- Email Body -->
<tr>
<td class="body" width="100%" cellpadding="0" cellspacing="0" style="border: hidden !important;">
<table class="inner-body" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
<!-- Body content -->
<tr>
<td class="content-cell">
{{ Illuminate\Mail\Markdown::parse($slot) }}

{{ $subcopy ?? '' }}
</td>
</tr>
</table>
</td>
</tr>

{{ $footer ?? '' }}
</table>
</td>
</tr>
</table>
</body>
</html> --}}
