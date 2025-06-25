<tr>
  <td>
    <table class="footer" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation" style="margin: 0 auto; padding: 0; text-align: center;">
      <tr>
        <td class="content-cell" align="center" style="padding: 24px; font-size: 0.85rem; color: #9ca3af;">
          {{ Illuminate\Mail\Markdown::parse($slot) }}

          <p style="margin-top: 12px; font-size: 0.85rem; color: #6b7280;">
            &copy; {{ date('Y') }} <strong style="color: #10b981;">CampusHome</strong>. Tous droits réservés.
          </p>
        </td>
      </tr>
    </table>
  </td>
</tr>
