@props([
    'url',
    'color' => 'primary',
])

@php
    switch ($color) {
        case 'success':
            $backgroundColor = '#10b981'; // vert
            break;
        case 'error':
            $backgroundColor = '#ef4444'; // rouge
            break;
        case 'secondary':
            $backgroundColor = '#6b7280'; // gris
            break;
        default:
            $backgroundColor = '#3b82f6'; // bleu par défaut
    }
@endphp

<table class="action" align="center" width="100%" cellpadding="0" cellspacing="0" role="presentation">
<tr>
<td align="center">
    <table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation">
        <tr>
            <td align="center">
                <a href="{{ $url }}"
                   class="button"
                   target="_blank"
                   rel="noopener"
                   style="
                       display: inline-block;
                       padding: 12px 24px;
                       background-color: {{ $backgroundColor }};
                       color: #ffffff;
                       border-radius: 8px;
                       font-size: 16px;
                       font-weight: 600;
                       text-decoration: none;
                       text-align: center;
                       transition: background-color 0.3s ease;
                   ">
                    {{ $slot }}
                </a>
            </td>
        </tr>
    </table>
</td>
</tr>
</table>
