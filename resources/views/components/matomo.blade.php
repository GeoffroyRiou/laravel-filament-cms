@php($matomo = $settings->matomo ?? null)

@if (!empty($matomo))
    <!-- Matomo -->
    <script>
        var _paq = window._paq = window._paq || [];
        /* tracker methods like "setCustomDimension" should be called before "trackPageView" */
        _paq.push(['trackPageView']);
        _paq.push(['enableLinkTracking']);
        _paq.push(['requireCookieConsent']);
        (function() {
            var u = "https://XXX.matomo.cloud/";
            _paq.push(['setTrackerUrl', u + 'matomo.php']);
            _paq.push(['setSiteId', '1']);
            var d = document,
                g = d.createElement('script'),
                s = d.getElementsByTagName('script')[0];
            g.async = true;
            g.src = 'https://cdn.matomo.cloud/XXXX.matomo.cloud/matomo.js';
            s.parentNode.insertBefore(g, s);
        })();
    </script>
    <!-- End Matomo Code -->
    <script data-category="analytics" type="text/plain" data-service="Matomo - Envoi des données utilisateur">
        _paq.push(['rememberCookieConsentGiven']);
    </script>
@endif
