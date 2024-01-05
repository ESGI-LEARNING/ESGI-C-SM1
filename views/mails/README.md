## Template de mail

### Ajouter un message
```html
<table class="subcopy" width="100%" cellpadding="0" cellspacing="0" role="presentation">
    <tr>
        <td>
            {{ $slot }}
        </td>
    </tr>
</table>
```

### Ajouter un button
```html
<table class="action" align="{{ $align }}" width="100%" cellpadding="0" cellspacing="0" role="presentation">
    <tr>
        <td align="{{ $align }}">
            <table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation">
                <tr>
                    <td align="{{ $align }}">
                        <table border="0" cellpadding="0" cellspacing="0" role="presentation">
                            <tr>
                                <td>
                                    <a href="#" class="button button-{{ $color }}" target="_blank"
                                       rel="noopener">
                                        {{ $slot }}
                                    </a>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
```