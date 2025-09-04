<div class="version-badge-wrapper">
    <div class="version-badge" style="background-color: {{ $bgColor }};">
        v{{ $version }}
        <div class="version-tooltip">
            {{ str_rot13($label) }} {{ $license }}<br>
            Build: v{{ $version }}
        </div>
    </div>
</div>
